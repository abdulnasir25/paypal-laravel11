@extends('welcome')

@section('content')
    <div class="pt-3 sm:pt-5 lg:pt-0" style="padding: 50px;background: black;box-shadow: 2px 3px 10px 1px;border-radius: 10px;">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Centered Button -->
        <div class="flex justify-center">
            <a href="{{ route('paypal.payment') }}" class="btn btn-primary px-6 py-3 bg-green-700 text-white text-center rounded-md" style="background: darkblue;padding: 15px 50px;">
                Pay with PayPal
            </a>
        </div>
        
        <!-- Full Width Button -->
        <!-- <div class="w-full">
            <a href="{{ route('paypal.payment') }}" class="btn btn-primary w-full px-6 py-3 bg-green-700 text-white text-center rounded-md">
                Pay with PayPal
            </a>
        </div> -->
    </div>

@endsection
