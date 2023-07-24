@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Pub Trivia Locations by State</h1>
        <hr/>
        <div class="row" data-masonry='{"percentPosition": true }'>
            @foreach ($citystate as $state=>$cities)
                <h2>{{ $state }}</h2>
                <ul class="list-unstyled d-flex flex-wrap px-4">
                @foreach($cities as $city=>$count)
                    <li class="mr-3 mb-3"><a href="{{ route('locations.city',['state'=>$state_lookup[$state], 'city' => $city]) }}">{{ $city }}</a> ({{ $count }})</li>
                @endforeach
                </ul>
            @endforeach
        </div> 
    </div>
@endsection