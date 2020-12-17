@extends('layouts.simple')

@section('content')
<div id="page-container">
                <main id="main-container">
<div class="bg-image" style="background-image: url('media/photos/header_one.jpg');">
    <div class="row no-gutters bg-primary-op">
        <div class="hero-static col-md-6 d-flex align-items-center bg-white">
            <div class="p-3 w-100">
                <div class="mb-3 text-center">
                    <a class="link-fx font-w700 font-size-h1" href="index.html">
                        <span class="text-primary">Pas</span><span class="text-success">solution</span>
                    </a>
                    <p class="text-uppercase font-w700 font-size-sm text-muted">LOGIN</p>
                </div>
                <div class="row no-gutters justify-content-center">
                    <div class="col-sm-8 col-xl-6">
                        <!--<form class="js-validation-signin" action="be_pages_auth_all.html" method="POST">-->
                        <form class="js-validation-signin" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="py-3">
                                <div class="form-group">
                                    <input id="email" type="email" class="form-control form-control-lg form-control-alt{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Benutzername" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                    <!--<input type="text" class="form-control form-control-lg form-control-alt" id="login-username" name="login-username" placeholder="Benutzername">-->
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control form-control-lg form-control-alt{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Passwort" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-hero-lg btn-hero-primary">
                                    {{ __('Login') }}
                                </button>
                                <!--
                                <button type="submit" class="btn btn-block btn-hero-lg btn-hero-primary">
                                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> anmelden
                                </button>-->
                                <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{ route('password.request') }}">
                                        <i class="fa fa-exclamation-triangle text-muted mr-1"></i> Passwort vergessen
                                    </a>
                                    @endif
                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="/register">
                                        <i class="fa fa-plus text-muted mr-1"></i> Neuer Account
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
            <div class="p-3">
                <p class="display-4 font-w700 text-white mb-3">
                    Willkommen in der Informationsdatenbank
                </p>
                <p class="font-size-lg font-w600 text-white-75 mb-0">
                    Copyright &copy; <span class="js-year-copy">2019</span>
                </p>
            </div>
        </div>
    </div>
</div>
    </main>
    </div>
@endsection
