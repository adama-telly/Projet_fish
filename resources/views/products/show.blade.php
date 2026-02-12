@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6">
      @if($product->image_url)
        <img src="{{ $product->image_url }}" class="img-fluid" alt="{{ $product->nom }}">
      @else
        <div class="bg-secondary" style="height:300px"></div>
      @endif
    </div>
    <div class="col-md-6">
      <h2>{{ $product->nom }}</h2>
      <p class="text-muted">Catégorie: {{ $product->categorie }}</p>
      <h4 class="text-primary">{{ number_format($product->prix,0,',',' ') }} FCFA</h4>
      <p>{{ $product->description }}</p>
      <p><strong>Stock:</strong> {{ $product->stock }}</p>
      
      <form action="{{ route('order.create') }}" method="POST" class="mt-3">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="mb-3">
          <label for="quantity" class="form-label">Quantité :</label>
          <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" style="max-width:100px;">
        </div>
        <div>
          <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour</a>
          <button type="submit" class="btn btn-success btn-lg">Commander</button>
        </div>
      </form>
    </div>
  </div>
@endsection
