@extends('admin.dashboard')

@section('title')

@endsection

@push('css')

@endpush

@Section('content')
	
	@include('admin.partial.header')
	
			
		<div class="container pt-4">
			
			<h3 class="text-center"> Trash Products</h3>
			
				@if(session()->has('message'))
					
					<div class="alert alert-success">
						
						{{session()->get('message')}}
				</div>
				@endif
			<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product name</th>
      <th scope="col">Deleted at</th>
      <th scope="col">Recover Trash</th>
    </tr>
  </thead>
  <tbody>
    <tr>
	
	@foreach($product as $trash )	
		
	  <td scope="row">{{$trash->id}}</td>  
      <td>{{$trash->title}}</td>
	  <td>{{$trash->deleted_at->toFormattedDateString()}}</td>
      <td><a href="{{route('admin.product.recover',$trash->id)}}" class="btn btn-success">Trash Recovery</a></td>
    </tr>
	
	@endforeach
  </tbody>
</table>
		</div>
@endsection

@push('js')

@endpush

