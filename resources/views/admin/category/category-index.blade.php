@extends('admin.dashboard')

@section('title')
	Category index page
@endsection


@push('css')

@endpush

@section('content')
	
	@include('admin.partial.header')
	
<div class="container-fluid">
  <div class="row">
  
  @include('admin/partial/sidebar')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
	
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="{{route('admin.category.create')}}" type="button" class="btn btn-sm btn-outline-secondary">create</a>
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
              <th>Id</th>
              <th>Title</th>
              <th>Description</th>
              <th>Slug</th>
			  <th>SubCategory</th>
              <th>Created at</th>
			  <th>Updated at</th>
			  <th>Edit</th>
			  <th>Trash</th>
			  <th>Delete</th>
            </tr>
          </thead>
          <tbody>
           
		   @foreach($categories as $category)
				 <tr>
				 <td>{{$category->id}}</td>
              <td>{{$category->title}}</td>
              <td>{{$category->slug}}</td>
			  <td>@if($category->children)
					@foreach($category->children as $row)
					{{$row->title}}
					@endforeach
				  @endif
			  </td>
              <td>{{$category->description}}</td>
              <td>{{$category->created_at->toFormattedDateString()}}</td>
              <td>{{$category->updated_at->toFormattedDatestring()}}</td>
			  <td><a href="{{route('admin.category.edit',$category->id)}}" class="btn btn-info">Edit</a></td>
			  <td><a  class="btn btn-warning" onclick="
			  
								document.getElementById('delete-form-{{$category->id}}').submit();
			  ">Trash</a>
								<form  method="post" action="{{route('admin.category.destroy',$category->id)}}" id="delete-form-{{$category->id}}">
								@csrf
								@method('DELETE')
								</form>
			  </td>
			  <td><a href="#" class="btn btn-success" onclick="
						document.getElementById('category-delete-{{$category->id}}').submit();
			  ">Delete</a>
			  
					<form method="post" action="{{route('admin.category.delete',$category->id)}}" id="category-delete-{{$category->id}}">
					@csrf
					@method('delete')
					</form>
			</td>
			
            </tr>
		   @endforeach
           
          </tbody>
        </table>	
		
		{{$categories->links()}}
      </div>
    </main>
  </div>
</div>
	
@endsection

@push('js')
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endpush