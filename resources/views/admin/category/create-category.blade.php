@extends('admin.dashboard')

@section('title')
	create category
@endsection

@push('css')
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@endpush

@section('content')

@include('admin.partial.header')

	<div class="container pt-4">
			
					<h3 class="text-center ">Create Category post</h3>
					
					<div class="col-sm-12">
							
							@if($errors->any())
									<div class="alert alert-danger">
											
											<ul>
												@foreach($errors->all() as $error)
										<li>{{$error}}</li>
									@endforeach
											</ul>
								</div>
							@endif
					</div>
					
					<div class="col-md-12">
							
							@if(session()->has('message'))
								<div class="alert alert-success">
									
									<ul>
											<li>{{session()->get('message')}}</li>
									</ul>
							</div>
							@endif	
					</div>
					
	<form method="post" action="{{route('admin.category.store')}}">
	
	@csrf
	
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <input type="text" class="form-control" name="desc" id="exampleInputPassword1" placeholder="Description">
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Select Category</label>
	
		 <select name="parent_id[]" id="parent_id" class="custom-select">
			<option selected></option>
			
			@if($categories)
					
				<option value="0">Top Lavel</option>
				
				option
				
		@foreach($categories as $category)	
			<option value="{{$category->id}}">{{$category->title}}</option>
		@endforeach
		
			@endif
			option
        </select>

  </div>
  
  <div class="form-gruop">
  
			 <label for="validationTextarea">Textarea</label>
    <textarea class="form-control is-invalid" name="description" id="validationTextarea" placeholder="Required example textarea" row="10" col="80"></textarea>
  </div>
  
			<div class="form-group pt-3" align="center">
					
					 <button type="submit" class="btn btn-primary">Submit</button>
			</div>
</form>
	</div>
</div>	

@endsection

@push('js')
	
@endpush