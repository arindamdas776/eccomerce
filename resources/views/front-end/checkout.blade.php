@extends('layouts.master')

@section('title')
Checkout form
@endsection

@push('css')

<style>

.container {
  max-width: 960px;
}

.lh-condensed { line-height: 1.25; }

</style>
@endpush

@section('content')
	<div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">

   @if(session()->has('errors'))
      <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach  
            </ul>
      </div>
   @endif 
    <h2>Checkout form</h2>
    <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
  </div>

  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill">{{ $totalQty }}</span>
      </h4>
      <ul class="list-group mb-3">

        @foreach($products as $product)

        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Product name</h6>
            <small class="">{{ $product['item']['title'] }}</small>
          </div>
          <span class="text-muted">INR - {{ $product['price'] }}</span>
        </li>

       @endforeach
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong>${{ $totalPrice }}</strong>
        </li>
      </ul>

      <form class="card p-2" method="post" action="{{ route('productscheckout.post') }}">
	  @csrf
       {{-- <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                      </div>--}}
      </form>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      <form class="needs-validation" action="{{ route('productscheckout.post') }}" method="post"  novalidate>
	  @csrf
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" name="first_name" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
         @if($errors->has('first_name'))
            <div class="alert alert-danger">
                  {{ $errors->first('first_name') }}
            </div>
         @endif 
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" name="last_name" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        @if($errors->has('last_name'))
              <div class="alert alert-danger">
                  {{ $errors->first('last_name') }}
              </div>
        @endif  
        </div>

        <div class="mb-3">
          <label for="username">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="text" class="form-control" name="user_name" id="username" placeholder="Username" required>
            <div class="invalid-feedback" style="width: 100%;">
              Your username is required.
            </div>
          </div>
        @if($errors->has('user_name'))
            <div class="alert alert-danger">
                {{ $errors->first('user_name') }}
            </div>
        @endif  
        </div>

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>
      @if($errors->has('email'))
            <div class="alert alert-danger">
                  {{ $errors->first('email') }}
            </div>
      @endif

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>
      @if($errors->has('address'))
          <div class="alert alert-danger">
              {{ $errors->first('address') }}
          </div>
      @endif  

        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" name="address2" id="address2" placeholder="Apartment or suite">
        </div>
      @if($errors->has('address2'))
          <div class="alert alert-danger">
              {{ $errors->first('address2') }}
          </div>
      @endif  

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" name="country" id="country" required>
              <option value="">Choose...</option>
              <option>United States</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid country.
            </div>
          </div>
        @if($errors->has('country'))
            <div class="alert alert-danger">
                {{ $errors->first('country') }}
            </div>
        @endif  
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select class="custom-select d-block w-100" name="state" id="state" required>
              <option value="">Choose...</option>
              <option>California</option>
            </select>
            <div class="invalid-feedback">
              Please provide a valid state.
            </div>
          </div>
           @if($errors->has('state'))
            <div class="alert alert-danger">
                {{ $errors->first('state') }}
            </div>
        @endif  
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" name="zipcode" id="zip" placeholder="" required>
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
        @if($errors->has('zipcode'))
            <div class="alert alert-danger">
                {{ $errors->first('zipcode') }}
            </div>
        @endif  
        </div>
        <hr class="mb-4">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" name="shiipping_address" id="same-address">
          <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="save-info">
          <label class="custom-control-label" for="save-info">Save this information for next time</label>
        </div>
      
        <hr class="mb-4">

        <h4 class="mb-3">Shipping</h4>
		<div class="col-md-12 order-md-1" id="shipping_address">

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" name="shipping_name" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
           <div class="col-md-6 mb-3">
            <label for="firstName">Last name</label>
            <input type="text" class="form-control" name="shipping_last_name" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
        </div>


        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control"  name="shipping_email" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" name="shipping_address" id="address" placeholder="1234 Main St" required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" name="shipping_address2" id="address2" placeholder="Apartment or suite">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" name="shipping_country" id="country" required>
              <option value="">Choose...</option>
              <option>United States</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid country.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select class="custom-select d-block w-100" name="shipping_state" id="state" required>
              <option value="">Choose...</option>
              <option>California</option>
            </select>
            <div class="invalid-feedback">
              Please provide a valid state.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" name="shipping_zip" id="zip" placeholder="" required>
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
          <hr class="mb-4">
         <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
        </form>
        </div>
		</div>
        <hr class="mb-4">

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017-2019 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
@endsection

@push('js')
<script>

	$(function(){
		$('#same-address').on('change',function(){
			$('#shipping_address').slideToggle(!this.checked);
		});
	});
</script>

@endpush