@extends('layouts.app')

@section('content')



<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')
    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if($user->hasRole('player'))
                    @include('users.form_sections.personal_information')
                @elseif ($user->hasRole('host'))
                    @include('users.form_sections.company_information')
                @endif
            </div>
            <div class="col-md-6">
                @include('users.form_sections.social_media')
            </div>
        </div>
    <div class="form-group row mb-4">
        <div class="col-md-6 offset-md-5">
            <button type="submit" class="btn btn-primary">
                {{ __('Update') }}
            </button>
        </div>
    </div>
</form>


</div>
@endsection