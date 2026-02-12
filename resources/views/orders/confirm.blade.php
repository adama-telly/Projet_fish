@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-8 mx-auto">
      <h2 class="mb-4">Confirmation de commande</h2>
      
      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              @if($product->image_url)
                <img src="{{ $product->image_url }}" class="img-fluid" alt="{{ $product->nom }}">
              @else
                <div class="bg-secondary" style="height:200px"></div>
              @endif
            </div>
            <div class="col-md-8">
              <h4>{{ $product->nom }}</h4>
              <p class="text-muted">{{ $product->description }}</p>
              <hr>
              <table class="table table-borderless">
                <tr>
                  <td><strong>Catégorie :</strong></td>
                  <td>{{ $product->categorie }}</td>
                </tr>
                <tr>
                  <td><strong>Prix unitaire :</strong></td>
                  <td>{{ number_format($product->prix,0,',',' ') }} FCFA</td>
                </tr>
                <tr>
                  <td><strong>Quantité :</strong></td>
                  <td>{{ $quantity }}</td>
                </tr>
                <tr class="table-success">
                  <td><strong>Total :</strong></td>
                  <td><h5 class="text-success">{{ number_format($total,0,',',' ') }} FCFA</h5></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

      <form id="order-form" action="{{ route('order.submit') }}" method="POST" class="card">
        @csrf
        <div class="card-body">
          <h5>Informations de livraison</h5>
          
          <div class="mb-3">
            <label for="name" class="form-label">Nom complet *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Téléphone *</label>
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
            @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Adresse de livraison *</label>
            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
            @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <input type="hidden" name="quantity" value="{{ $quantity }}">
          <input type="hidden" name="total" value="{{ $total }}">
        </div>

        <div class="card-footer d-flex gap-2">
          <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">Modifier</a>
          <button type="submit" class="btn btn-success btn-lg">Valider la commande</button>
        </div>
      </form>

      <!-- Order success modal -->
      <div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-labelledby="orderSuccessLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="orderSuccessLabel">Commande reçue</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
              <p id="order-success-message">Merci de votre commande.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="order-success-ok">OK</button>
            </div>
          </div>
        </div>
      </div>

      <script>
        (function(){
          const form = document.getElementById('order-form');
          if (!form) return;

          const modalEl = document.getElementById('orderSuccessModal');
          let bsModal = null;
          if (modalEl && window.bootstrap && window.bootstrap.Modal) {
            bsModal = new bootstrap.Modal(modalEl);
          }

          const okBtn = document.getElementById('order-success-ok');

          function showSuccess(message){
            const msgEl = document.getElementById('order-success-message');
            if (msgEl) msgEl.textContent = message || 'Merci de votre commande.';
            if (bsModal) {
              bsModal.show();
              if (okBtn) okBtn.focus();
            } else {
              alert(message || 'Merci de votre commande.');
              window.location.href = '/';
            }
          }

          if (okBtn) {
            okBtn.addEventListener('click', function(){
              if (bsModal) bsModal.hide();
              window.location.href = '/';
            });
          }

          form.addEventListener('submit', async function(e){
            e.preventDefault();
            const url = form.action;
            const data = new FormData(form);

            try {
              const resp = await fetch(url, {
                method: 'POST',
                headers: {
                  'X-Requested-With': 'XMLHttpRequest',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: data
              });

              if (resp.ok) {
                const json = await resp.json();
                showSuccess(json.message || 'Merci de votre commande');
                return;
              }

              if (resp.status === 422) {
                const json = await resp.json();
                const errors = json.errors || {};
                const msgs = Object.values(errors).flat().join('\n');
                alert(msgs || 'Veuillez corriger les erreurs du formulaire.');
                return;
              }

              alert('Erreur serveur. Veuillez réessayer.');
            } catch (err) {
              console.error(err);
              alert('Erreur réseau. Veuillez vérifier votre connexion.');
            }
          });
        })();
      </script>
    </div>
  </div>
@endsection
