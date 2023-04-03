@extends('layouts.app')

@section('content')
    <div class="container">
        

        @if (!is_null($city))
            <h1>Pub Trivia in {{ $city }}, {{ $state }}</h1>
        @endif

        

      

        <div class="row" data-masonry='{"percentPosition": true }'>
            @foreach ($locations as $location)
                @include('locations.parts.location_box',$location)
            @endforeach
        </div> 
    </div>
@endsection