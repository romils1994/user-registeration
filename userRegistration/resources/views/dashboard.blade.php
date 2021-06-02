@extends('layout')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card hoverable">
                    <div class="card-content">
                        <span class="card-title">Your Details</span>
                        <table class="striped highlight centered responsive-table">
                            <thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th rowspan="2"><a href="{{ route('details') }}">Edit</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $firstname }}</td>
                                    <td>{{ $lastname }}</td>
                                    <td>{{ $email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ( $wordCount > 0)
                    <div class="card hoverable">
                        <div class="card-content">
                            <span class="card-title">File Details</span>
                            <table class="striped highlight centered responsive-table">
                                <thead>
                                    <tr>
                                        <th>Word Count</th>
                                        <th>Download Link</th>
                                        <th rowspan="2"><a href="{{ route('details') }}">Upload Another File</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $wordCount }}</td>
                                        <td><a href="{{ route('download') }}">Download</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
