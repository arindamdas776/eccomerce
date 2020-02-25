@extends('admin.dashboard')

@section('title')

@endsection

@push('css')

@endpush

@section('content')
	
	@include('admin.partial.header')
	
		<div class="container pt-4">
		
			<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category name</th>
      <th scope="col">Deleted at</th>
      <th scope="col">Recover Trash</th>
    </tr>
  </thead>
  <tbody>
    <tr>
	
	@foreach($category_trash as $trash )	
		
	  <td scope="row">{{$trash->id}}</td>  
      <td>{{$trash->title}}</td>
	  <td>{{$trash->deleted_at->toFormattedDateString()}}</td>
      <td><a href="{{route('admin.category.recover',$trash->id)}}" class="btn btn-success">Trash Recovery</a></td>
    </tr>
	
	@endforeach
  </tbody>
</table>
		</div>

@endsection

@push('js')

@endpush