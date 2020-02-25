@extends('layouts.master')

@section('title')

	Product model page
	
@endsection

@push('css')
	
@endpush

@section('content')
	
	<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Album example</h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
      <p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>
    </div>
  </section>
  
  <div class="row">
	<div class="col-md-3">
	</div>
	<div class="col-md-9">
	</div>
  </div>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
	  
	  @foreach($products as $product)

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img class="img-responsive" src="{{asset('storage/product/'.$product->image)}}">
            <div class="card-body">
              <p class="card-text">{{$product->description}}</p>
			  <p class="card-text">Product Price : <strong>{{$product->price}}</strong></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{route('productssingle',$product->slug)}}" type="button" class="btn btn-sm btn-outline-secondary">View</a>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
				  <a class="btn btn-sm btn-outline-secondary" type="button"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                </div>
                <small class="text-muted">{{$product->created_at->diffForHumans()}}</small>
              </div>
            </div>
          </div>
        </div>
      
	  @endforeach
      </div>
    </div>
  </div>

</main>

@endsection

@push('js')
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
@endpush