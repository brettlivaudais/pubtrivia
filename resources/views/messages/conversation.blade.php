@extends('layouts.app')

@section('content')
<style>
    .unread {
        font-weight: bold !important;
    }
</style>



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

    <div class="btn-group  float-right">
        <a type="button" href="{{ route('messages.mailbox') }}" class="btn btn-primary" aria-expanded="false"><i class="fa-solid fa-circle-left"></i> Back to Inbox</a>
    
        
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-circle-question"></i>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Report Harassment</a></li>
            <li><a class="dropdown-item" href="#">Report Spam</a></li>
            <li><a class="dropdown-item" href="#">Block {{ $other->name }}</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Contact Us</a></li>
        </ul>
    </div>


    <h1>Conversation With {{ $other->name }}</h1>


    <table class="table ">
        <tbody>
        @foreach ($messages as $message)
            <tr>
                <th style="text-align: right">{{ $message->sender->name }}:</th>
                <td>{{ $message->body }}</td>
                <td>{{ $message->created_at->diffForHumans() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


 


    <h2>New Message</h2>


    <form method="POST" action="{{ route('messages.store') }}">
        @csrf

        <input type="hidden" name="recipient_id" value="{{ $other->id }}">

        <div class="form-group">
            <textarea name="body" id="body" rows="7" class="form-control @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
            @error('body')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Send <i class="fa-regular fa-paper-plane"></i></button>
        </div>
        <div class="clearfix"></div>
    </form>
  

</div>
@endsection