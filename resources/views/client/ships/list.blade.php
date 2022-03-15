@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Ships</h1>
        <div class="container table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ships as $ship)
                        <tr>
                            <th scope="row">{{ $ship->id }}</th>
                            <td>{{ $ship->user_id }}</td>
                            <td>{{ $ship->name }}</td>
                            <td>{{ $ship->type }}</td>
                            <td>{{ $ship->description }}</td>
                            <td>{{ $ship->status }}</td>
                            <td><img src="{{ URL::asset($ship->image) }}" alt=""></td>
                        </tr>
                    @endforeach
                    <tr scope="row">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
            </table>
        </div>
        <div class="d-flex col-12 justify-content-center">
            {{ $ships->links() }}
        </div>
    </div>
@endsection