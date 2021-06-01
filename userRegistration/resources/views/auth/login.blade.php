@extends('layout')

@section('content')
    <main>
        <div class="container">
            <div class="row valign-wrapper center-align justify-content-center">
                <div class="card hoverable">
                    <div class="card-tabs">
                        <ul class="tabs tabs-fixed-width">
                            <li class="tab">
                                <a class="active" href="#login">Login</a>
                            </li>
                            <li class="tab">
                                <a href="#register">Register</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-content blue lighten-5">
                        <div id="login">
                            <form action="{{ route('login.post') }}" method="POST" class="col">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12 m12 l12 xl12">
                                        <input id="login-username" name="username" type="text" class="validate" required>
                                        <label for="login-username">Username</label>
                                        @if ($errors->has('username'))
                                            <span class="helper-text" data-error="wrong" data-success="right">
                                                {{ $errors->first('username') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m12 l12 xl12">
                                        <input id="login-password" name="password" type="password" class="validate" required>
                                        <label for="login-password">Password</label>
                                        @if ($errors->has('password'))
                                            <span class="helper-text" data-error="wrong" data-success="right">
                                                {{ $errors->first('password') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m12 l12 xl12">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="register">
                            <form action="{{ route('register.post') }}" method="POST" class="col">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12 m12 l12 xl12">
                                        <input id="register-username" name="username" type="text" class="validate" required>
                                        <label for="register-username">Username</label>
                                        @if ($errors->has('username'))
                                            <span class="helper-text" data-error="wrong" data-success="right">
                                                {{ $errors->first('username') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m12 l12 xl12">
                                        <input id="register-password" name="password" type="password" class="validate" requiredk>
                                        <label for="register-password">Password</label>
                                        @if ($errors->has('password'))
                                            <span class="helper-text" data-error="wrong" data-success="right">
                                                {{ $errors->first('password') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m12 l12 xl12">
                                        <button type="submit" class="btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
