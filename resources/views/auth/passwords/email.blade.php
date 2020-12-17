@extends('layouts.simple')

@section('content')
<div id="page-container">
                <main id="main-container">
<div class="bg-image" style="background-image: url('/media/photos/header_one.jpg');">
    <div class="row no-gutters bg-gd-sun-op">
        <div class="hero-static col-md-6 d-flex align-items-center bg-white">
            <div class="p-3 w-100">
                <div class="text-center">
                    <a class="link-fx text-warning font-w700 font-size-h1" href="index.html">
                        <span class="text-primary">Pas</span><span class="text-success">solution</span>
                    </a>
                    <p class="text-uppercase font-w700 font-size-sm text-muted">Password Reminder</p>
                </div>
                <div class="row no-gutters justify-content-center">
                    <div class="col-sm-8 col-xl-6">
                        <form class="js-validation-reminder" action="be_pages_auth_all.html" method="POST">
                            <div class="form-group py-3">
                                <input type="text" class="form-control form-control-lg form-control-alt" id="reminder-credential" name="reminder-credential" placeholder="Username or Email">
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-block btn-hero-lg btn-hero-warning">
                                    <i class="fa fa-fw fa-reply mr-1"></i> Password Reminder
                                </button>
                                <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="/login">
                                        <i class="fa fa-sign-in-alt text-muted mr-1"></i> Sign In
                                    </a>
                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="/register">
                                        <i class="fa fa-plus text-muted mr-1"></i> New Account
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
                <p class="display-4 font-w700 text-white mb-0">
                    Don’t worry of failure..
                </p>
                <p class="font-size-h1 font-w600 text-white-75 mb-0">
                    ..but learn from it!
                </p>
            </div>
        </div>
    </div>
</div>
    </main>
    </div>

@endsection
