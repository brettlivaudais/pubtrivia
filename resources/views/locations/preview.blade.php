@extends('layouts.preview')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <img src="{{ $location->logo_url }}" style="width:100%"/>
                <iframe
                width="100%"
                height="200"
                style="border:0"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps/embed/v1/place?key={{ env('GOOGLE_MAP_API_KEY') }}&zoom=12&q={{ $location->address }}">
                </iframe>
            </div>
            <div class="col-md-8">
             
                <h1>{{ $location->name }}</h1>
                @include('locations.parts.rating_display', ['avgRating' => $avgRating])
                <p>By <a href="{{ route('users.show',$location->user->id) }}">{{ $location->user->name }}</a></p>
                

                <p>{{ $location->address }} - {{ $location->dayoftheweek }} at {{ $location->time }}</p>
                <div style="float: right"></div>
                <p>{{ $location->description }}</p>
                <a href="{{ route('locations.city',['state'=>$location->state, 'city' => $location->city]) }} ">More Pub Trivia locations in {{ $location->city }}, {{ $location->state }}</a>
                <br>
                <a href="{{ route('locations.host',$location->user->id) }}">More pub trivia events from {{ $location->user->name }}</a>
                <hr />
                <h3>Comments</h3>
                @foreach ($location->comments as $comment)
                    <hr>
                    <div class="comment">
                        <p>{{ $comment->comment }}</p>
                        <p><i>By {{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y') }}</i></p>
                    </div>
                    
                @endforeach
            </div>
            
        </div>
    </div>
@endsection
