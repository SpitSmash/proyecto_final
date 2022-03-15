@extends('layouts.app')
@section('content')
    <h1 style="text-align: center;">Create Penalty:</h1>
    <div class="container">
        <form enctype="multipart/form-data" method="POST" action="{{ route('penalty.store') }}">
            @csrf
            <div>
                <label for="price">Price</label>
                <input type="number" id="price" name="price"  value="{{ $penalty->price }}">
            </div>

            <div>
                <label for="comments">Comments</label>
                <input type="text" id="comments" name="comments" value="{{ $penalty->comments }}">
            </div>

            <div>
                <label for="user_id">User ID</label>
                <input type="user_id" id="user_id" name="user_id" value="{{ $penalty->user_id }}">
            </div>

            <div>
                <label for="itineraty_id">Itineraty ID</label>
                <input type="text" id="itineraty_id" name="itineraty_id" value="{{ $penalty->itineraty_id }}">
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