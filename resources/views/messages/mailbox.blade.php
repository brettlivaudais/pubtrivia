@extends('layouts.app')

@section('content')
<style>
    .unread {
        font-weight: bold !important;
    }
</style>
<div class="container">
    <h1>Messages</h1>


    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Status</th>
                <th scope="col">From</th>
                <th scope="col">Last Message</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($conversations as $conversation)
            <tr class="{{ $conversation->unread_messages > 0?'unread':'' }}" style="cursor: pointer;" onclick="location.href='{{ route('messages.conversation', $conversation->slug) }}'">
                <th><i class="fa-solid fa-envelope{{ $conversation->unread_messages == 0?'-open':'' }}"></i></th>
                <td>{{ $conversation->name }}</td>
                <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($conversation->latest_message))->diffForHumans() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection