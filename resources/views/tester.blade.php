@extends('layouts.master')

@section('content')
 <div class="login-inner-form">
                            <form action="http://storage.googleapis.com/themevessel-products/logdy/index.html" method="GET">
                                <div class="form-group form-box">
                                    <input type="email" name="email" class="input-text" placeholder="Email Address" />
                                    <i class="flaticon-mail-2"></i>
                                </div>
                                <div class="form-group form-box">
                                    <input type="password" name="Password" class="input-text" placeholder="Password" />
                                    <i class="flaticon-password"></i>
                                </div>
                                <div class="checkbox clearfix">
                                    <div class="form-check checkbox-theme">
                                        <input class="form-check-input" type="checkbox" value="" id="rememberMe" />
                                        <label class="form-check-label" for="rememberMe">
                        Remember me
                      </label>
                                    </div>
                                    <a href="forgot-password-9.html">Forgot Password</a>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn-md btn-theme btn-block">
                      Login
                    </button>
                                </div>
                            </form>
                        </div>
@endsection