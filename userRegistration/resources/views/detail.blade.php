@extends('layout')

@section('content')
<main>
    <div class="container">
        <div class="row valign-wrapper center-align justify-content-center">
            <div class="col-">
            <div class="card hoverable">
                <div class="card-content blue lighten-5">
                    <form action="{{ route('details.post') }}" method="POST" class="col">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12 m12 l12 xl12">
                                <input id="firstname" name="firstname" type="text" class="validate" value="{{ $firstname ?? '' }}" required>
                                <label for="firstname">Firstname</label>
                                @if ($errors->has('firstname'))
                                    <span class="helper-text" data-error="wrong" data-success="right">
                                        {{ $errors->first('firstname') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12 l12 xl12">
                                <input id="lastname" name="lastname" type="text" class="validate" value="{{ $lastname ?? '' }}" required>
                                <label for="lastname">Lastname</label>
                                @if ($errors->has('lastname'))
                                    <span class="helper-text" data-error="wrong" data-success="right">
                                        {{ $errors->first('lastname') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12 l12 xl12">
                                <input id="email" name="email" type="email" class="validate" value="{{ $email ?? '' }}" required>
                                <label for="email">Email</label>
                                @if ($errors->has('email'))
                                    <span class="helper-text" data-error="wrong" data-success="right">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12 l12 xl12">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
