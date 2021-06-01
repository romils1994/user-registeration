@extends('layout')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <span class="card-title">Your Details</span>
                    <table class="striped highlight centered responsive-table">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $firstname }}</td>
                                <td>{{ $lastname }}</td>
                                <td>{{ $email }}</td>
                                <td><a href="{{ route('details') }}">Edit</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
