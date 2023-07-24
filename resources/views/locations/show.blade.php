@extends('layouts.app')
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

                <div class="btn-group float-right" role="group" aria-label="Basic example">
                    <a type="button" href="{{ route('welcome') }}" class="btn btn-primary"><i class="fa-solid fa-circle-left"></i> Back to Search</a>
                    @guest
                        <a type="button" href="{{ route('register') }}" class="btn btn-primary"><i class="fa-regular fa-heart"></i></a>
                    @else
                        <button type="button" href="{{ route('register') }}" location_id = '{{ $location->id }}' aria-label="{{ ($is_favorite?'un-':'') }}favorite this location." class="btn btn-primary favorite_location"><i class="fa-{{ ($is_favorite?'solid':'regular') }} fa-heart"></i></button>
                    @endguest
                </div>

                <h1>{{ $location->name }}</h1>
                @include('locations.parts.rating_display', ['avgRating' => $avgRating])
                <p>By <a href="{{ route('locations.host',$location->user->slug) }}">{{ $location->user->name }}</a></p>
                

                <p>{{ $location->address }} - {{ $location->dayoftheweek }} at {{ $location->time }}</p>
                <div style="float: right"></div>
                <p>{{ $location->description }}</p>
                <a href="{{ route('locations.city',['state'=>$location->state, 'city' => $location->city]) }} ">More Pub Trivia locations in {{ $location->city }}, {{ $location->state }}</a>
                <br>
                <a href="{{ route('locations.host',$location->user->slug) }}">More pub trivia events from {{ $location->user->name }}</a>
                <hr />
                

                
                @auth
                    <div class="float-right">
                        <small>Rate this location:</small>
                        <div class="star-rating">
                            <i class="fa fa-star {{ $rating>0?'active':'' }}" data-rating="1"></i>
                            <i class="fa fa-star {{ $rating>1?'active':'' }}" data-rating="2"></i>
                            <i class="fa fa-star {{ $rating>2?'active':'' }}" data-rating="3"></i>
                            <i class="fa fa-star {{ $rating>3?'active':'' }}" data-rating="4"></i>
                            <i class="fa fa-star {{ $rating>4?'active':'' }}" data-rating="5"></i>
                        </div>
                    </div>
                @endauth
                
                <h3>Comments</h3>
                @guest
                    Click here to 
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    or 
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    to rate or leave a comment.
                @else
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="location_id" value="{{ $location->id }}">
                        <div class="form-group clearfix">
                            <label for="comment">Leave a Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                            <button type="submit" class="btn btn-primary float-right mt-2">Submit Comment</button>
                        </div>
                    </form>
                @endguest
 
                @foreach ($location->comments as $comment)
                    <hr>
                    <div class="comment">
                        <p>{{ $comment->comment }}</p>
                        <p><i>By <a href="{{ route('users.show',$comment->user->slug) }}">{{ $comment->user->name }}</a> on {{ $comment->created_at->format('M d, Y') }}</i></p>
                    </div>
                    
                @endforeach
            
            </div>
            
        </div>
        


        
    </div>

    
@endsection
