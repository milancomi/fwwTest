@extends('layouts.app')
@section('externalIncludes')
<script src="{{ asset('js/jquery.min.js') }}" ></script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">

                            <div id="error_field" class="alert alert-danger d-none">
                            <p id="error_content"><p>
                            </div>
                    <form method="POST" action="{{ route('loginApi') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button id="loginBtn" type="button" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

$(document).ready(function() {
    $('#loginBtn').click(function (e) {

e.preventDefault();
var name = $('#name').val();
var password = $('#password').val();

        $.ajax({
               type:'POST',
                url:"{{route('login_api')}}",
               data:{
                   _token:"{{ csrf_token() }}",
                   name: name,password,
                   password:password
               },
               success:function(data) {
                   if(data.startsWith("http"))
                   {
                    window.location.href = data;

                   } else{
                $('#error_content').text(data);
                $('#error_field').removeClass('d-none');
                   }

               }
            });



    });


});
</script>
@endsection
