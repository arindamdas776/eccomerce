@extends('layouts.master')

@section('title')

	Single Product page
	
@endsection

@push('css')

@endpush

@section('content')
	
	<main role="main">

  <div class="album py-5 bg-light">
    <div class="container">
		
		@if(session()->has('message'))
			
			<div class="alert alert-success">
			{{session()->get('message')}}
			</div>
		@endif
			
      <div class="row">
        <div class="col-md-12">
		
		<div class="col-md-4">
			<img src="{{asset('storage/product/'.$products->image)}}" class="img-thumbnail">
		</div>
		<div class="col-md-6">
				
				   <div class="card mb-4">
            <div class="card-body">
              <p class="card-text">{{$products->description}}.</p>
			  <p class="card-text">Product Price : <strong>{{$products->price}}</strong></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="{{route('productsaddToCart',$products->id)}}" type="button" class="btn btn-lg btn-outline-secondary"><i class="fa fa-shopping-cart"></i> Cart</a>
                  
                </div>
               
              </div>
            </div>
          </div>
		  
		</div>
  
        </div>

      </div>
    </div>
  </div>

</main>
</main>
@endsection

@push('js')

@endpush