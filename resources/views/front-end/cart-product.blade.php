@extends('layouts.master')

@section('title')
	cart Product show
@endsection

@push('css')
	
	<style>
		
		.bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
	  
	  html,
body {
  overflow-x: hidden; /* Prevent scroll on narrow devices */
}

body {
  
}

@media (max-width: 991.98px) {
  .offcanvas-collapse {
    position: fixed;
    top: 56px; /* Height of navbar */
    bottom: 0;
    left: 100%;
    width: 100%;
    padding-right: 1rem;
    padding-left: 1rem;
    overflow-y: auto;
    visibility: hidden;
    background-color: #343a40;
    transition: visibility .3s ease-in-out, -webkit-transform .3s ease-in-out;
    transition: transform .3s ease-in-out, visibility .3s ease-in-out;
    transition: transform .3s ease-in-out, visibility .3s ease-in-out, -webkit-transform .3s ease-in-out;
  }
  .offcanvas-collapse.open {
    visibility: visible;
    -webkit-transform: translateX(-100%);
    transform: translateX(-100%);
  }
}

.nav-scroller {
  position: relative;
  z-index: 2;
  height: 2.75rem;
  overflow-y: hidden;
}

.nav-scroller .nav {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: nowrap;
  flex-wrap: nowrap;
  padding-bottom: 1rem;
  margin-top: -1px;
  overflow-x: auto;
  color: rgba(255, 255, 255, .75);
  text-align: center;
  white-space: nowrap;
  -webkit-overflow-scrolling: touch;
}

.nav-underline .nav-link {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: .875rem;
  color: #6c757d;
}

.nav-underline .nav-link:hover {
  color: #007bff;
}

.nav-underline .active {
  font-weight: 500;
  color: #343a40;
}

.text-white-50 { color: rgba(255, 255, 255, .5); }

.bg-purple { background-color: #6f42c1; }

.lh-100 { line-height: 1; }
.lh-125 { line-height: 1.25; }
.lh-150 { line-height: 1.5; }


	</style>
@endpush

@section('content')
	
	<main role="main">

  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0 text-center">Total products : {{$totalProducts}} </h6>
	
	@if(session()->has('message'))
		<div class="alert alert-success">
		{{session()->get('message')}}
		</div>
	@endif
	
	@foreach($products as $slug => $product)
	
	<div class="card-group">
  <div class="card">
    <img src="{{asset('storage/product/'.$product['item']['image'])}}" style="height:200px; width:200px;" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{$product['item']['title']}}</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
	  <h3>Price : {{$product['price']}}</h3>
	  
	  <form method="post" action="{{route('productscart.update',$product['item']['slug'])}}">
	  @csrf
	 <input type="number" name="qty" id="qty" class="form-control col-md-3" min="0" max="99" value="{{$product['qty']}}"/>
	 <input type="submit" value="update" class="btn btn-block btn-outline-success btn-round btn-sm col-md-3">
   </form>
	 <div class="row">
		<div class="col-md-3">
			
		</div>
		<div class="col-md-3">
			<a href="{{route('productscart.remove',$product['item']['slug'])}}" type="button" class="btn btn-danger">Remove</a>
		</div>
		<div class="col-md-3">
			<a href="{{route('productscart.reduce',$product['item']['id'])}}" type="button" class="btn btn-danger">Reduce By One</a>
		</div>
	 </div>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
 
</div>


	@endforeach
	<div class="form-group">
		<p class="text-center">Total Price :{{$totalPrice}} </p>
	</div>
	<div class="form-group">
		<a href="{{route('productscheckout.get')}}" type="button" class="btn btn-primary">Check out</a>
	</div>
    <small class="d-block text-right mt-3">
      <a href="#">All updates</a>
    </small>
  </div>

</main>

@endsection

@push('js')

@endpush