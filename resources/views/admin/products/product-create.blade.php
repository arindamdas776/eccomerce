@extends('admin.dashboard')

@section('title')
	Create new product page
@endsection

@push('css')

@endpush

@section('content')
	
	@include('admin.partial.header')
			
			<div class="container pt-4">
				<div class="card">
				<div class="card-title pt-3">
					<h3 class="text-center">Create new Products</h3>
					
					@if($errors->any())
						
							<div class="alert alert-danger">
								<ul>
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach	
								</ul>
							</div>
					@endif
					
					@if(session()->has('message'))
							
						<div class="alert alert-success">
						{{session()->get('message')}}
						</div>
					@endif
				</div>
  <div class="card-body">
  
    <form method="post" action="{{route('admin.product.store')}}" enctype="multipart/form-data">
	@csrf
  <div class="form-group">
    <label for="exampleFormControlInput1">Product name</label>
    <input type="text" class="form-control" name="product_name" id="exampleFormControlInput1" placeholder="Enter Product name">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Product Category select</label>
    <select class="form-control" name="select_category" id="exampleFormControlSelect1">
	
	@foreach($categories as $category)
      <option value="{{$category->id}}">{{$category->title}}</option>
    @endforeach  
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Select multiple category</label>
    <select multiple class="form-control" name="select_multiple_category" id="exampleFormControlSelect2">
	
	@foreach($categories as $category)
      <option value="{{$category->id}}">{{$category->title}}</option>
    @endforeach  
    </select>
  </div>
  <div class="form-group pt-2">
  <input type="file" name="select_image"/>
	<img src="" class="rounded mx-auto d-block" alt="...">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Product Description</label>
    <textarea class="form-control" name="product_description" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="row">
	<div class="col-md-6">
	
		<div class="form-group">
		<label>Price</label>
			<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">$</span>
  </div>
  <input type="text" class="form-control"name="price" aria-label="Amount (to the nearest dollar)">
  <div class="input-group-append">
    <span class="input-group-text">.00</span>
  </div>
</div>
		</div>
	</div>
	<div class="col-md-6">
	
	<div class="form-group">	
	<label>Discount</label>
	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">$</span>
  </div>
  <input type="text" class="form-control" name="discount" aria-label="Amount (to the nearest dollar)">
  <div class="input-group-append">
    <span class="input-group-text">.00</span>
  </div>
</div>
	</div>
	</div>
  </div>
  
 <div class="row">
	<div class="col-md-4">
	<div class="form-group">
	<label>Option</label>
	<input type="text" name="option" class="form-control" />
	</div>
	</div>
	
	<div class="col-md-8">
	<div class="form-group">
	<label>Values</label>
	<input type="text" name="values" class="form-control" / multiple>
	</div>
	<div class="form-group">
	<label>Additional Price</label>
	<input type="text" name="additional-price" class="form-control" / multiple>
	</div>
	</div>
 </div>
  <div class="form-group" align="center">
	<button type="submit" class="btn btn-success btn-lg">Submit</button>
  </div>	
</form>

  </div>
</div>
			</div>
@endsection

@push('js')

@endpush