<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	$categories = Category::paginate(4);
        return view('admin.category.category-index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$categories = Category::all();
        return view('admin.category.create-category',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
			
			'title'   => 'required|unique:categories',
			'desc'    => 'required',
		]);
		
		$slug = str_slug($request->title);
		$category = new Category();
		
		$category->title = $request->title;
		$category->description = $request->desc;
		$category->slug = $slug;
		
		$category->save();
		$category->children()->attach($request->parent_id);
		
		return redirect()->route('admin.category.index')->with("category added successfully");
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category = Category::find($category)->first();
		return view('admin.category.edit-category',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request,[
			
			'title'    => 'required',
			'desc'    => 'required',
		]);
		
		$category->title = $request->title;
		$category->description = $request->desc;
		
		$category->save();
		
		return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category){
			
			$category->delete();
		}
		return redirect()->back();
    }
	
	public function delete(Category $category){
		
		if($category){
			
			$category->forceDelete();
			$category->children()->detach();
		}
		return redirect()->back();
	}
	public function recover($id){
		
		$categories = Category::onlyTrashed()->findOrFail($id);
		
			if($categories->restore()){
				
				return redirect()->back();
			}else{
				return redirect()->back();
			}
	}
	public function trash(){
		
		$category_trash = Category::onlyTrashed()->paginate(3);
		return view('admin.category-trash',compact('category_trash'));
	}
}
