@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>RENTINGS</h1>
        <div style="max-width: 30%; float: left;">
            <form class="d-flex" method="POST" action="">
                @csrf
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn btn-primary btn-outline-secondary" style="color:black; font-weight: bold;"
                    type="submit">Search</button>
            </form>
        </div>

        <div class="container table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Ship ID</th>
                        <th scope="col">Bay ID</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date Estimated TakeOff</th>
                        <th scope="col">Date TakeOff</th>
                        <th scope="col">Date Estimated Landing</th>
                        <th scope="col">Date Landing</th>
                        <th scope="col">Cost</th>
                        <th class="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itineraties as $itineraty)
                        <tr>
                            <th scope="row">{{ $itineraty->id }}</th>
                            <td>{{ $itineraty->ship_id }}</td>
                            <td>{{ $itineraty->bay_id }}</td>
                            <td>{{ $itineraty->status }}</td>
                            <td>{{ $itineraty->date_estimated_takeoff }}</td>
                            <td>{{ $itineraty->date_takeoff }}</td>
                            <td>{{ $itineraty->date_estimated_landing }}</td>
                            <td>{{ $itineraty->date_landing }}</td>
                            <td>{{ $itineraty->cost }}</td>
                            <td></td>
                            <td>
                                <a href="">
                                    <button type="button" class="btn btn-outline-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pen-fill" viewBox="0 0 16 16">
                                            <path
                                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z">
                                            </path>
                                        </svg>
                                        Edit
                                    </button>
                                </a>
                            </td>
                            <td>
                                <a href="">
                                    <form method="POST" class="form-delete"
                                        action="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z">
                                                </path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <tr scope="row">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>

                        </td>
                    </tr>
            </table>
        </div>
        <div class="d-flex col-12 justify-content-center">
            
        </div>
    </div>
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('delete') == 'ok')
        <script>
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        </script>
    @endif
    <script>
        $('.form-delete').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>
@endsection
