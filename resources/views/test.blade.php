@extends('layouts.master')
@section('content')


   <div class="login-inner-form">
                                <form action="{{route('register')}}" method="POST">
                                 @csrf
                                <div class="form-group form-box">
                                    <div>
                                         <input id="name" type="text" id="name" name="name" class="input-text @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full Name" />
                                    <i class="flaticon-user"></i>
                                     @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                     @enderror
                                    </div>
                               
                                </div>
                                
                                <div class="form-group form-box">
                                    <div>
                                        <input id="email" type="email" name="email" class="input-text @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address" />
                                    <i class="flaticon-mail"></i> 
                                     @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                     @enderror

                                    </div>
                               
                                </div>
                                 <div class="form-group form-box">
                                     <div>
                                          <input id="membership_id" type="text" name="membership_id" class="input-text @error('membership_id') is-invalid @enderror" value="{{ old('membership_id') }}" required autocomplete="membership_id" placeholder="Membership ID" />
                                    <i class="flaticon-user"></i>
                                     @error('membership_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                     </div>
                                   
                                </div>
                                
                                <div class="form-group form-box">
                                    <div>
                                        <input id="password" type="password" name="password" class="input-text @error('password') is-invalid @enderror" required autocomplete="new-password" placeholder="Confirm Password" />
                                    <i class="flaticon-password"></i>
                                       @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                    </div>
                                    
                                </div>

                                <div class="form-group form-box">
                                    <input id="password-confirm" type="password" class="input-text" name="password_confirmation" required autocomplete="new-password" placeholder="Password" />
                                    <i class="flaticon-password"></i>
                                </div>

                                <div class="checkbox clearfix">
                                    <div class="form-check checkbox-theme">
                                        <input class="form-check-input" type="checkbox" value="" id="rememberMe" required />
                                        <label class="form-check-label" for="rememberMe">I agree to the<a href="#" class="terms">terms of service</a>
                              </label>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn-md btn-theme btn-block">
                                    {{__('Register')}}
                        </button>
                                </div>
                            </form>
                        </div>

@endsection




