@extends('layouts.app')
@section('content')
    <h1 style="text-align: center;">Create Bay:</h1>
    <div class="container">
        <form method="POST" action="{{ route('bay.store') }}">
            @csrf
            <div>
                <label for="available">Available:</label>
                <select id="available" name="available" required>
                    <option value="1" selected>Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div>
                <label for="size">Size:</label>
                <select id="size" name="size" required>
                    <option value="4" selected>4</option>
                    <option value="6">6</option>
                    <option value="8">8</option>
                    <option value="10">10</option>
                    <option value="12">12</option>
                    <option value="14">14</option>
                    <option value="16">16</option>
                    <option value="18">18</option>
                    <option value="20">20</option>
                </select>
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