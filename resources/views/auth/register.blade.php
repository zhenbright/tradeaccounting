<?php 
    if( !Session::has('userid') ) {

    
        echo "<script>alert('UserID has already been taken.')</script>";
        // $str = 
        // "<span class='invalid-feedback' role='alert'>
        //     <strong>
        //         {{ $errors->first('userID') }}
        //     </strong>
        //     </span>";
        // // echo "$('#usrid').append($str)";
        // echo $str;
        // die;

    }
    //     echo "<script>$('#userid').innerHTML('<span class='invalid-feedback' role='alert'><strong>{{ $errors->first('userID') }}</strong>
    // </span>')</script>";
?>


@extends('layouts.app')

@section('content')




<div class="container" style="height:100vh">
    <div class="row justify-content-center auth-body">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="get" action="{{url('user/register')}}" aria-label="{{ __('Register') }}">

                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="userID" class="col-md-4 col-form-label text-md-right">{{ __('User ID') }}</label>

                            <div class="col-md-6" id = "userid">
                                <input id="userID"  class="form-control{{ $errors->has('userID') ? ' is-invalid' : '' }}" name="userID" value="{{ old('userID') }}" required>

                                @if ($errors->has('userID'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('userID') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
