@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Produits</h1>
  </div>

  <div class="row">
    @forelse($products as $product)
      <div class="col-md-3 mb-4">
        <div class="card h-100">
          @if($product->image_url)
            <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->nom }}">
          @else
            <svg class="bd-placeholder-img card-img-top" width="100%" height="160" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#868e96"></rect></svg>
          @endif
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $product->nom }}</h5>
            <p class="card-text text-muted">{{ Str::limit($product->description, 60) }}</p>
            <div class="d-flex justify-content-between align-items-center mt-auto">
              <strong class="text-success">{{ number_format($product->prix,0,',',' ') }} FCFA</strong>
              <div class="btn-group btn-group-sm" role="group">
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary">Voir</a>
                <form action="{{ route('order.create') }}" method="POST" style="display:inline;">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" class="btn btn-success">Commander</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">Aucun produit trouvé.</div>
    @endforelse
  </div>

  <div class="d-flex justify-content-center">
    {{ $products->links() }}
  </div>
@endsection
