@extends('admin.dashboard')

@section('title')
	Product create page
@endsection

@push('css')

@endpush

@section('content')

	@include('admin/partial/header')
	
	<div class="container-fluid">
  <div class="row">
  
  @include('admin/partial/sidebar')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
		
		
					@if(session()->has('message'))
							
						<div class="alert alert-success">
						{{session()->get('message')}}
						</div>
					@endif
					
					
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="{{route('admin.product.create')}}" type="button" class="btn btn-sm btn-outline-secondary">Create Product</a>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

     

      <h2>Section title</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Product Title</th>
              <th>Product Price</th>
			  <th>Image</th>
			  <th>Edit</th>
			  <th>Trash</th>
			  <th>Delete</th>
			  
            </tr>
          </thead>
          <tbody>
            <tr>
			
			@foreach($products as $product)
				<td>{{$product->id}}</td>
              <td>{{$product->title}}</td>
              <td>{{$product->price}}</td>
              <td><img src="{{asset('/storage/product/'.$product->image)}}" style="width:200px;height:220px;" class="img-thumbnail"></td>
              <td><a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-success">Edit</a></td>
			  <td><a  class="btn btn-warning" onclick="
					document.getElementById('trash-product-{{$product->id}}').submit();
			  ">Trash</a>
					<form method="POST" action="{{route('admin.product.trash',$product->id)}}" id="trash-product-{{$product->id}}">
					@csrf
					@method('delete')
					</form>
			  </td>
			  <td><a href="#" class="btn btn-danger" onclick="
			  
					document.getElementById('delete-product-{{$product->id}}').submit();
			  " >Delete</a>
					
					<form method="POST" action="{{route('admin.product.destroy',$product->id)}}" id="delete-product-{{$product->id}}">
					@csrf
					@method('delete')
					</form>
			  </td>
         
            </tr>
			
			@endforeach
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
	
@endsection


@push('js')

@endpush