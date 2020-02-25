<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use App\Category;
use App\Customer;
use App\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Storage;
use App\Http\Requests\storeProduct;
use Intervention\Image\Facades\Image;
use Session;
use App\Http\Requests\checkout;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
		return view('admin.products.product',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
		return view('admin.products.product-create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeProduct $request)
    {
        $image = $request->file('select_image');
		$slug = str_slug($request->product_name);
		
			if(isset($image)){
				
				$current_date = carbon::now()->toDateString();
				$image_name = $slug.'.'.$current_date.'.'.uniqid().'.'.$image->getClientOriginalExtension();
			
				if(!Storage::disk('public')->exists('product')){
					Storage::disk('public')->makeDirectory('product');
				}
				$product_image = Image::make($image)->resize('300','200')->stream();
					Storage::disk('public')->put('product/'.$image_name,$product_image);
			}
         		$product = new Product();
				$product->title = $request->product_name;
				$product->image = $image_name;
				$product->price = $request->price;
				$product->slug = $slug;
				$product->discount = $request->discount;
				$product->option = $request->oprion;
				$product->description = $request->product_description;
				
				$product->save();
				
				$product->categories()->attach($request->select_category);
				$product->categories()->attach($request->select_multiple_category);
				
				return redirect()->back()->with('Produdt has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
		$products = Product::latest()->get();
        return view('front-end.product-view',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
		$category = Category::all();
        return view('admin.products.product-edit',compact('product','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(storeProduct $request, Product $product)
    {
        $image_name = $request->hidden_image;
		$image = $request->file('select_image');
		$slug = str_slug($product->title);
		
			if(isset($image)){
				$current_date = carbon::now()->toDateString();
				$name = $slug.'.'.$current_date.'.'.uniqid().'.'.$image->getClientOriginalExtension();
				
				if(Storage::disk('public')->exists('product/'.$product->image)){
					
					Storage::disk('public')->delete('product/'.$product->image);
				}
					if(!Storage::disk('public')->exists('product')){
					Storage::disk('public')->makeDirectory('product');
				}
				$product_image = Image::make($image)->resize('300','200')->stream();
					Storage::disk('public')->put('product/'.$image_name,$product_image);	
			}else{
				$product->image = $image_name;
			}
			
			$product->title = $request->product_name;
			$product->description = $request->product_description;
			$product->price = $request->price;
			$product->image = $image_name;
			$product->discount_price = $request->discount_price;
			
			$product->save();
			$product->categories()->attach($request->select_category);
			$product->categories()->attach($request->select_multiple_category);
			
			return redirect()->route('admin.product.index')->with('message','product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
       if($product){
		   
		   $product->forceDelete();
		  
		  $product->categories()->detach();
	   }
	   
	   return redirect()->back()->with('message','product has been deleted successfully');
    }
	public function trash($id){
		
		$product = Product::find($id);
		
			if($product){
				$product->delete();
			}
		return redirect()->back()->with('Product has been trash successfully');	
	}
	public function recover($id){
		
		$product = Product::onlyTrashed()->findOrFail($id);
		
			if($product->restore()){
				return redirect()->back()->with('message','Product has been trashed successfully');
			}else{
				return redirect()->back();
			}
	}
	
	public function getTrash(){
		
		$product = Product::onlyTrashed()->paginate(3);
		return view('admin.products.trash-product',compact('product'));
	}
	public function singleProduct($slug){
		$products = Product::where('slug',$slug)->first();
		return view('front-end.single-product',compact('products'));
	}
	public function addToCart(Request $request,$slug){
		
		$product = Product::find($slug);
		$oldCart = Session::has('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		$cart->add($product,$product->slug);
	
		Session::put('cart',$cart);
		return redirect()->back()->with('message','Product added to cart list');
	}
	public function showCart(){
		
		if(! Session::has('cart')){
			return redirect()->route('productsall');
		}else{
			$oldCart = Session::get('cart');
			$cart = new Cart($oldCart);
			return view('front-end.cart-product',['products' => $cart->content , 'totalPrice' => $cart->totalPrice , 'totalProducts' => $cart->totalQty]);
		}
	}
	
	public function reduce($slug){
		if(! Session::has('cart')){
			return redirect()->route('productscart.remove');
		}else{
			$product = Product::find($slug); 
			$oldCart = Session::get('cart');
			$cart = new Cart($oldCart);
			$cart->remove($product,$product->slug);
			
				if(count($cart->content)<=0){
					Session::forget('cart');
				}else{
					Session::put('cart',$cart);
				}
			return redirect()->route('productscart.show');	
		}
	}
	public function remove($slug){
		
		if(! Session::has('cart')){
			return redirect()->route('productscart.show');
		}else{
			$oldCart = Session::get('cart');
			$cart = new Cart($oldCart);
			$cart->delete($slug);
			
			if(count($cart->content)<=0){
					Session::forget('cart');
				}else{
					Session::put('cart',$cart);
				}
			return redirect()->route('productscart.show');
		}
	}
	public function updateCart( Request $request, Product $product,$slug){
		if(!Session::has('cart')){
			return redirect()->route('productsall');
		}else{
			$oldCart = Session::get('cart');
			$cart = new Cart($oldCart);
			$cart->update($product,$request->qty);
			
			Session::put('cart',$cart);
			return redirect()->back();
		}
	}
	public function getCheckout(){

		if (!Session::has('cart')) {
			return redirect()->route('productsall');
		}else{
			$oldCart = Session::get('cart');
			$cart = new Cart($oldCart);
		
			return view('front-end.checkout',['products' => $cart->content , 'totalPrice' => $cart->totalPrice , 'totalQty' => $cart->totalQty]);
		}
		
	}
	public function postcheckout(checkout $request){

			$cart = [];
			$order = "";
			$checkout = "";

		 if (! Session::has('cart')) {
		 	return redirect()->route('productsall');
		 }else{
		 	$cart = Session::get('cart');
		 }

		 if ($request->shiipping_address) {
		 		
		 		$customer = [

		 			'billing_first_name' => $request->first_name,
		 			'billing_last_name'  =>$request->last_name,
		 			'user_name'	 => $request->user_name,
		 			'billing_email'      => $request->email,
		 			'billing_address'   => $request->address,
		 			'billing_address2'  => $request->address2,
		 			'billing_country'   => $request->country,
		 			'billing_state' 	=> $request->state,
		 			'billing_zipcode'  => $request->zipcode,
		 			'shipping_first_name' => $request->shipping_name,
		 			'shipping_last_name' => $request->shipping_last_name,
		 			'shipping_email'	=> $request->shipping_email,
		 			'shipping_address'  => $request->shipping_address,
		 			'shipping_address2'	=>	$request->shipping_address2,
		 			'shipping_country'	=>	$request->shipping_country,
		 			'shipping_state'    => $request->shipping_state,
		 			'shipping_zipcode'		=>	$request->shipping_zip,

		 		];
		 }else{

		 		$customer = [

		 			'billing_first_name' => $request->first_name,
		 			'billing_last_name'  =>$request->last_name,
		 			'user_name'	 => $request->user_name,
		 			'billing_email'      => $request->email,
		 			'billing_address'   => $request->address,
		 			'billing_address2'  => $request->address2,
		 			'billing_country'   => $request->country,
		 			'billing_state' 	=> $request->state,
		 			'billing_zipcode'  => $request->zipcode,
		 		];
		 }

		 	DB::beginTransaction();
		 	$checkout = Customer::create($customer);

		 	foreach ($cart->content as $slug => $product) {
		 		$product = [

		 			'user_id' => $checkout->id,
		 			'product_id'=> $product['item']['id'],
		 			'qty'      => $product['qty'],
		 			'status'  => 'pending',
		 			'price'    => $product['price'],
		 			'payment_id' => 0,
		 		];
		 		$order = Order::create($product);
		 	}

		 		if ($checkout && $order) {
		 				
		 				DB::commit();
		 				return view('front-end.checkout');
		 		}else{
		 				Db::rollback();

		 			return redirect('/checkout/form',['invalid activity']);		
		 		}
	}
}
