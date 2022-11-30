@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ isset($url) ? ucwords($url) : ""}} {{ __('Register') }}</div>
                <div class="card-body">
                    @isset($url)
                    <form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}">
                        @else
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @endisset
                            @csrf
                            <input type="hidden" name="package" value="{{$packages}}">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" required autocomplete="phone">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="payment"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Payment Type') }}</label>

                                <div class="col-md-6">
                                    <input type="radio" class="payment" name="payment" value="1"> Bkash<br>
                                    <input type="radio" class="payment" name="payment" value="2"> Check<br>
                                    <input type="radio" class="payment" name="payment" value="3"> Cash on Delivery<br>
                                    {{-- <select name="payment" id="payment" class="form-control">
                                        <option value="" id="">Select One</option>
                                        <option value="1" id="bkash">Bkash</option>
                                        <option value="2" id="check">Check</option>
                                        <option value="3" id="cash">Cash on Delivery</option>
                                    </select> --}}
                                </div>
                            </div>

                            <div id="hiddenDiv1" class="form-group row" style="display:none">
                                <label for="bkash-transaction"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Transaction Id') }}</label>

                                <div class="col-md-6">
                                    <span class="" role="">
                                        <strong>{{ 'Merchant bKash Wallet No: 01745041636' }}</strong>
                                    </span>
                                    <input id="transaction-id" type="text" class="form-control" name="transaction_id"
                                        required>
                                </div>
                            </div>

                            <div id="hiddenDiv2" class="form-group row" style="display:none">
                                <label for="check-transaction"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Upload Your Check') }}</label>

                                <div class="col-md-6">
                                    <input id="check" type="file" class="" name="">
                                </div>
                            </div>
                            <div id="hiddenDiv3" class="form-group row" style="display:none">
                                <label for=""
                                    class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>

                                <div class="col-md-6">
                                    <span class="" role="">
                                        <strong>{{ 'Contact This Number:01945634056' }}</strong>
                                    </span>
                                </div>
                            </div>




                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {

        $(".payment").change(function () {
            var payment = $("input[name='payment']:checked").val();
            console.log(payment);
            if (payment == "1") {
                $("#hiddenDiv1").show();
                $("#hiddenDiv2").hide();
                $("#hiddenDiv3").hide();
            } else if (payment == "2") {
                $("#hiddenDiv2").show();
                $("#hiddenDiv1").hide();
                $("#hiddenDiv3").hide();
            } else if (payment == "3") {
                $("#hiddenDiv3").show();
                $("#hiddenDiv1").hide();
                $("#hiddenDiv2").hide();
            }
        });
    });
</script>
@endsection
