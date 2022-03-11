@extends('layouts.app')

@section('content')
    <h1 style="text-align: center;">Itineraty User: {{ $itineraty->id }}</h1>
    <div class="container">
        <form method="POST" action="{{ route('itineraty.update', $itineraty->id) }}">
            <div class="container">
                @csrf
                <div>
                    <label for="date_takeoff">Date TakeOff:</label>
                    <input type="text" id="date_takeoff" name="date_takeoff" value="{{ $itineraty->date_takeoff }}">
                </div>
                <div>
                    <label for="date_estimated_takeoff">Date Estimated TakeOff:</label>
                    <input type="text" id="date_estimated_takeoff" name="date_estimated_takeoff" value="{{ $itineraty->date_estimated_takeoff }}">
                </div>

                <div>
                    <label for="date_landing">Date Landing:</label>
                    <input type="text" id="date_landing" name="date_landing" value="{{ $itineraty->date_landing }}">
                </div>
                <div>
                    <label for="date_estimated_landing">Date Estimated Landing:</label>
                    <input type="text" id="date_estimated_landing" name="date_estimated_landing" value="{{ $itineraty->date_estimated_landing }}">
                </div>

                {{-- <div>
                    <label for="date_give">Date Give:</label>
                    <input type="text" id="date_give" name="date_give" value="{{ $itineraty->date_give }}">
                    <label>Actual Time: <?= date('Y-m-d h:i:s') ?> </label>
                </div> --}}
                <div>
                    <label for="cost">Cost:</label>
                    <input type="text" id="cost" name="cost" value="{{ $itineraty->cost }}">
                </div>

                <div>
                    <label for="ship_id">Ship ID:</label>
                    <input type="text" id="ship_id" name="ship_id" value="{{ $itineraty->ship_id }}">
                </div>

                <div>
                    <label for="bay_id">Bay ID:</label>
                    <input type="text" id="bay_id" name="bay_id" value="{{ $itineraty->bay_id }}">
                </div>
                <div>
                    <label for="status">Status</label>
                    <select name="status" id="status" required>
                        <option value="expectation" selected>Expectation</option>
                        <option value="accepted">Accepted</option>
                        <option value="refused">Refused</option>
                    </select>
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