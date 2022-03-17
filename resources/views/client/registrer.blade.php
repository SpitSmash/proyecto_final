@extends('layouts.app')
@section('content')
    <h1 style="text-align: center;">Registrer Ships:</h1>
    <div class="container">
        <form enctype="multipart/form-data" method="POST" action="{{ route('client.store') }}">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div>
                <label for="description">Description</label>
                <input type="text" id="description" name="description" required>
            </div>

            <div>
                <label for="type">Type</label>
                <input type="text" id="type" name="type" required>
            </div>

            <div>
                <label for="status">Status</label>
                <input type="text" id="status" name="status" required>
            </div>

            <div>
                <label for="image">Image</label>
                <input type="file" id="image" name="image" accept="image/*" required>
                <br/>
                @error('image')
                    <small class="text-danger" >{{ $message }}</small>
                @enderror
            </div>

            <div>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </div>

            <button type="submit" class="btn btn-success">
                Confirm
            </button>
            <button type="reset" class="btn btn-danger">
                Reset
            </button>
        </form>
    </div>
@endsection