@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Penalties</h1>
       
        <div class="container table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Price</th>
                        <th scope="col">Comments</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Itineraty ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penalties as $penalty)
                        <tr>
                            <th scope="row">{{ $penalty->id }}</th>
                            <td>{{ $penalty->price }}</td>
                            <td>{{ $penalty->comments }}</td>
                            <td>{{ $penalty->user_id }}</td>
                            <td>{{ $penalty->itineraty_id}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    <tr scope="row">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
            </table>
        </div>
        <div class="d-flex col-12 justify-content-center">

        </div>
    </div>
@endsection