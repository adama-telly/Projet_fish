@extends('layouts.app')

@section('content')
  <div class="bg-primary text-white py-5 rounded-3 mb-4" style="background-image: linear-gradient(90deg, rgba(2,0,36,0.7), rgba(9,121,113,0.7));">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-7">
          <h1 class="display-4 fw-bold">SenFISH 'Yékh Gnakk' </h1>
          <p class="lead">Poissons frais du jour, filets, préparations marinées et livraison locale.</p>
          <p><a class="btn btn-light btn-lg" href="{{ route('products.index') }}" role="button">Voir les produits</a></p>
        </div>
        <div class="col-md-5 text-center d-none d-md-block">
         <!-- <img src="/images/poisson_rouge.svg" alt="Poisson rouge" class="img-fluid" style="max-height:220px; filter: drop-shadow(0 6px 10px rgba(0,0,0,0.25));"> -->
        </div>
      </div>
    </div>
  </div>

  <div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="mb-0">Derniers arrivages</h3>
      <a href="{{ route('products.index') }}" class="small text-decoration-none">Voir tout</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-3">
      @forelse($latest ?? [] as $p)
        <div class="col">
          <div class="card h-100 shadow-sm">
            @if($p->image_url)
              <img src="{{ $p->image_url }}" class="card-img-top" style="height:190px;object-fit:cover;" alt="{{ $p->nom }}">
            @else
              <img src="/images/poisson_rouge.svg" class="card-img-top" style="height:190px;object-fit:cover;" alt="{{ $p->nom }}">
            @endif
            <div class="card-body d-flex flex-column">
              <h5 class="card-title mb-1">{{ $p->nom }}</h5>
              <p class="text-muted small mb-2">{{ Str::limit($p->description, 80) }}</p>
              <div class="d-flex justify-content-between align-items-center mt-auto">
                <div><strong class="text-success">{{ number_format($p->prix,0,',',' ') }} FCFA</strong></div>
                <div class="btn-group" role="group">
                  <a href="{{ route('products.show', $p->id) }}" class="btn btn-sm btn-outline-primary">Détails</a>
                  <form action="{{ route('order.create') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-sm btn-success">Commander</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">Aucun produit pour le moment.</div>
      @endforelse
    </div>
  </div>
@endsection
