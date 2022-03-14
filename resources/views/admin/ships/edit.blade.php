@extends('layouts.app')

@section('content')
    <h1 style="text-align: center;">Ships: {{ $ship->id }}</h1>
    <div class="container">
        <form method="POST" action="{{ route('ship.update', $ship->id) }}">
            <div class="container">
                @csrf
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ $ship->name }}">
                </div>
                <div>
                    <label for="description">Descrption</label>
                    <input type="text" id="description" name="description" value="{{ $ship->description }}">
                </div>
                <div>
                    <label for="type">Type:</label>
                    <input type="text" id="type" name="type" value="{{ $ship->type }}">
                </div>
                <div>
                    <label for="status">Status:</label>
                    <input type="text" id="status" name="status" value="{{ $ship->status }}">
                </div>

                <div>
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <input type="hidden" id="oldImage" name="oldImage" value="{{ $ship->image }}">
                    <br/>
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="user_id">User ID:</label>
                    <input type="text" id="user_id" name="user_id">
                </div>

                <button type="submit" class="btn btn-success">
                    Confirm
                </button>
                <button type="reset" class="btn btn-danger">
                    Reset
                </button>
            </div>
        </form>
    </div>
@endsection
