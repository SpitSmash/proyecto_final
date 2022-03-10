@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('request') }}">
            @csrf
            <div class="row">
                <button type="submit" class="btn btn-success col-12" style="font-size: 130px;">
                    Request Landing
                </button>
            </div>
            <div class="row" style="margin-top: 15px">
                <div class="col-4"></div>
                <div class="col-4">
                    <div class="btn btn-warning">
                        <input class="form-control" style="padding: 10px" type="text" id="to" name="to">
                        <select name="dropoffTime" id="dropoffTimeSelect">
                            <option value="00:00">00:00</option>
                            <option value="00:30">00:30</option>
                            <option value="01:00">01:00</option>
                            <option value="01:30">01:30</option>
                            <option value="02:00">02:00</option>
                            <option value="02:30">02:30</option>
                            <option value="03:00">03:00</option>
                            <option value="03:30">03:30</option>
                            <option value="04:00">04:00</option>
                            <option value="04:30">04:30</option>
                            <option value="05:00">05:00</option>
                            <option value="05:30">05:30</option>
                            <option value="06:00">06:00</option>
                            <option value="06:30">06:30</option>
                            <option value="07:00">07:00</option>
                            <option value="07:30">07:30</option>
                            <option value="08:00">08:00</option>
                            <option value="08:30">08:30</option>
                            <option value="09:00">09:00</option>
                            <option value="09:30">09:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                            <option selected="selected" value="13:00">13:00</option>
                            <option value="13:30">13:30</option>
                            <option value="14:00">14:00</option>
                            <option value="14:30">14:30</option>
                            <option value="15:00">15:00</option>
                            <option value="15:30">15:30</option>
                            <option value="16:00">16:00</option>
                            <option value="16:30">16:30</option>
                            <option value="17:00">17:00</option>
                            <option value="17:30">17:30</option>
                            <option value="18:00">18:00</option>
                            <option value="18:30">18:30</option>
                            <option value="19:00">19:00</option>
                            <option value="19:30">19:30</option>
                            <option value="20:00">20:00</option>
                            <option value="20:30">20:30</option>
                            <option value="21:00">21:00</option>
                            <option value="21:30">21:30</option>
                            <option value="22:00">22:00</option>
                            <option value="22:30">22:30</option>
                            <option value="23:00">23:00</option>
                            <option value="23:30">23:30</option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            class="bi bi-alarm" viewBox="0 0 16 16">
                            <path
                                d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z">
                            </path>
                            <path
                                d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
        </form>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if (session('success') == 'request')
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Request Successfully!',
                showConfirmButton: false,
                timer: 2000
                })
            @endif
            @if (session('error') == 'notship')
                Swal.fire('You must registrer a ship!');
            @endif
            @if (session('error') == 'bayfull')
                Swal.fire('Sorry the bay is full try it later!');
            @endif
            @if (session('error') == 'lessdate')
                Swal.fire('You must set a date that its greather!');
            @endif
            @if (session('error') == 'datempy')
                Swal.fire('You must set a takeoff date!');
            @endif
            @if (session('error') == 'difrole')
                Swal.fire('You must login with client!');
            @endif
        </script>
    </div>
@endsection
