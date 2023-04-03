@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Location</h1>
        <form action="{{ route('locations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city">
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" class="form-control" id="state" name="state">
            </div>
            <div class="form-group">
                <label for="zip">Zip:</label>
                <input type="text" class="form-control" id="zip" name="zip">
            </div>
            <div class="form-group">
                <label for="slug">Slug:</label>
                <input type="text" class="form-control" id="slug" name="slug">
            </div>
            <div class="form-group">
                <label for="lat">Latitude:</label>
                <input type="text"class="form-control" id="lat" name="lat">
            </div>
            <div class="form-group">
                <label for="long">Longitude:</label>
                <input type="text" class="form-control" id="long" name="long">
            </div>
            <div class="form-group">
                <label for="dayoftheweek">Day of the Week:</label>
                <input type="text" class="form-control" id="dayoftheweek" name="dayoftheweek">
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="text" class="form-control" id="time" name="time">
            </div>
            <div class="form-group">
                <label for="logo_url">Logo URL:</label>
                <input type="text" class="form-control" id="logo_url" name="logo_url">
            </div>
            <div class="form-group">
                <label for="published">Published:</label>
                <select class="form-control" id="published" name="published">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Add Location</button>
        </form>
    </div>
@endsection

