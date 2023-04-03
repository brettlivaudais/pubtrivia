@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Edit Location</h1>

                

                    <form action="{{ isset($location) ? route('locations.update', $location->id) : route('locations.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($location))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ isset($location) ? $location->name : old('name') }}" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description" rows="7">{{ isset($location) ? $location->description : old('description') }}</textarea>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ isset($location) ? $location->address : old('name') }}" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ isset($location) ? $location->city : old('city') }}" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="state">State:</label>
                                <select class="form-control" id="state" name="state" required>
                                    <option></option>
                                    @foreach(config('states') as $code => $name)
                                        <option value="{{ $code }}" {{ isset($location) && $location->state==$code?'selected':'' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="zip">Zip:</label>
                                <input type="text" class="form-control" id="zip" name="zip" value="{{ isset($location) ? $location->zip : old('zip') }}" required>
                            </div>
                        
                            
                            <div class="form-group col-lg-3">
                                <label for="dayoftheweek">Day of the Week:</label>
                                <select class="form-control" id="dayoftheweek" name="dayoftheweek" required>
                                    <option></option>
                                    @foreach(config('daysoftheweek') as $code => $name)
                                        <option value="{{ $code }}" {{ isset($location) && $location->dayoftheweek==$code?'selected':'' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="time">Time:</label>
                                <input type="text" class="form-control" id="time" name="time" value="{{ isset($location) ? $location->time : old('time') }}" required>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="logo_url">Logo:</label>
                                <input type="file" name="logo_upload" class="form-control">
                                @if(isset($location))
                                    <a href="{{ $location->logo_url }}" target="_blank">preview the logo</a>
                                @endif
                            </div>
                            <div class="form-group" style="text-align:center">
                                <div class="form-check form-switch py-2">
                                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" style="transform: scale(1.8);" {{ isset($location) && $location->published ? 'checked' : '' }}>
                                    <label class="form-check-label" for="published" style="padding-left: 15px; font-size: 18px; margin-top:-3px">Published</label>
                                </div>
                            </div>
                        </div>
                        <div style="text-align:center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection