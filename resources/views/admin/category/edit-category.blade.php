@extends('admin.dashboard')

@section('title')

@endsection

@push('css')

@endpush

@section('content')
	
	@include('admin.partial.header')
	
	<div class="container pt-4 mt-3">
	
				<form method="post" action="{{route('admin.category.update',$category->id)}}">
					@csrf
					@method('put')
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" name="title" id="exampleInputEmail1" value="{{$category->title}}" aria-describedby="emailHelp" placeholder="Enter Title">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <textarea class="form-control is-invalid" name="desc" id="validationTextarea" placeholder="Required example textarea">{{$category->description}}</textarea>
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

	</div>
	
@endsection

@push('js')

@endpush