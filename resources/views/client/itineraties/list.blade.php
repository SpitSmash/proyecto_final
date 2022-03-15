@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Itineraties</h1>
        
        <div class="container table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Ship Name</th>
                        <th scope="col">Bay ID</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date Estimated TakeOff</th>
                        <th scope="col">Date TakeOff</th>
                        <th scope="col">Date Estimated Landing</th>
                        <th scope="col">Date Landing</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itineraties as $itineraty)
                        <tr>
                            <th scope="row">{{ $itineraty->id }}</th>
                            <td>{{ $itineraty->ship->name }}</td>
                            <td>{{ $itineraty->bay_id }}</td>
                            <td>{{ $itineraty->status }}</td>
                            <td>{{ $itineraty->date_estimated_takeoff }}</td>
                            <td>{{ $itineraty->date_takeoff }}</td>
                            <td>{{ $itineraty->date_estimated_landing }}</td>
                            <td>{{ $itineraty->date_landing }}</td>
                            <td>{{ $itineraty->price }}</td>
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