@extends('layouts.app')

@section('content')
<div class="container">
   
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            <b>Error: </b>{{ session('error') }}
        </div>
    @endif


    @if($user->hasRole('host'))
    <a href="{{ route('locations.create') }}" class="btn btn-primary float-right" ><i class="fa-solid fa-circle-plus"></i> New Location</a>
    <h1>Locations</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>City</th>
                    <th>Rating</th>
                    <th>Day of the Week</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($locations as $location)
                    <tr>
                        <td>{{ $location->name }}</td>
                        <td>{{ $location->city }}</td>
                        <td>@include('locations.parts.rating_display', ['avgRating' => $location->averageRating()])</td>
                        <td>{{ $location->dayoftheweek }}</td>
                        <td>{{ $location->published ? 'Yes' : 'No' }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Actions for {{ $location->name }}">
                                <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-secondary"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal{{ $location->id }}"><i class="fa-solid fa-expand"></i> Preview</button>
                                <a href="{{ route('locations.show', $location->id) }}" class="btn btn-secondary" target="_blank"><i class="fa-solid fa-link"></i> Link</a>
                            </div>
                        </td>
                    </tr>

                    <div
                        class="modal fade"
                        id="modal{{ $location->id }}"
                        tabindex="-1"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-body">
                            <iframe
                                width="100%"
                                height="800vl"
                                src="{{ route('locations.preview',$location->id) }}"
                                title="{{ $location->name }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                            ></iframe>
                            </div>
                        </div>
                        </div>
                    </div>



                @endforeach
            </tbody>
        </table>
    @endif



    @if($user->hasRole('player'))
    <h1>Favorite Locations</h1>
        <div class="row" data-masonry='{"percentPosition": true }'>
            @foreach ($favorites as $favorite)
                @include('locations.parts.location_box',['location' => $favorite->location])
            @endforeach
        </div>
    @endif
</div>
@endsection
