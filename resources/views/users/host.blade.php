@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    @if ($user->photo_url)
                        <img src="{{ $user->photo_url }}" style="width:100%" alt="{{ $user->name }}'s photo"/>
                    @endif
                </div>
                <style>
                     
                     .facebook { color: #4267B2 !important; }
                     .instagram { color: #E1306C !important; }
                     .twitter { color: #1DA1F2 !important; }
                     .snapchat { color: #999703 !important; }
                     .tiktok { color: #000000 !important; }
                     .linkedin { color: #0077B5 !important; }
                     .github { color: #000000 !important; }
                     .discord { color: #7289da !important; }
                     .youtube { color: #FF0000 !important}

                </style>



                <div class="col-md-6 mb-2">
                    <h2>{{ $user->name }}</h2>
                    @if ($user->team_name)
                        <p>Team Name: {{ $user->team_name }}</p>
                    @endif
                    @if ($user->hometown)
                        <p>Hometown: {{ $user->hometown }}</p>
                    @endif
                    @if ($user->introduction)
                        <p>Introduction: {{ $user->introduction }}</p>
                    @endif
                   
                    @if ($user->instagram)
                        <a href="https://www.instagram.com/{{ $user->instagram }}" target="_blank" class="instagram"><i class="fa-brands fa-square-instagram fa-2xl"></i></a>&nbsp;
                    @endif
                    @if ($user->facebook)
                        <a href="https://www.facebook.com/{{ $user->facebook }}" target="_blank" class="facebook"><i class="fa-brands fa-square-facebook fa-2xl"></i></a>&nbsp;
                    @endif
                    @if ($user->twitter)
                        <a href="https://www.twitter.com/{{ $user->twitter }}" target="_blank" class="twitter"><i class="fa-brands fa-square-twitter fa-2xl"></i></a>&nbsp;
                    @endif
                    @if ($user->snapchat)
                        <a href="https://www.snapchat.com/{{ $user->snapchat }}" target="_blank" class="snapchat"><i class="fa-brands fa-square-snapchat fa-2xl"></i></a>&nbsp;
                    @endif
                    @if ($user->tiktok)
                        <a href="https://www.tiktok.com/{{ '@' . $user->tiktok }}" target="_blank" class="tiktok"><i class="fa-brands fa-tiktok fa-xl"></i></a>&nbsp;
                    @endif
                    @if ($user->linkedin)
                        <a href="https://www.linkedin.com/in/{{ $user->linkedin }}" target="_blank" class="linkedin"><i class="fa-brands fa-linkedin fa-2xl"></i></a>&nbsp;
                    @endif
                    @if ($user->github)
                        <a href="https://www.github.com/{{ $user->github }}" target="_blank" class="github"><i class="fa-brands fa-square-github fa-2xl"></i></a>&nbsp;
                    @endif
                    @if ($user->discord)
                        <a href="https://www.discord.com/{{ $user->discord }}" target="_blank" class="discord"><i class="fa-brands fa-discord fa-xl"></i></a>&nbsp;
                    @endif
                    @if ($user->youtube)
                        <a href="https://www.youtube.com/{{ '@' . $user->youtube }}" target="_blank" class="youtube"><i class="fa-brands fa-square-youtube fa-2xl"></i></a>&nbsp;
                    @endif
                </div>
            
                <div class="col-md-2">
                        <a type="button" href="{{ route('messages.conversation', $user->slug) }}" class="btn btn-primary" style="width:100%"><i class="fa-solid fa-envelope"></i> Send A Message</a>
                </div>
            </div>

            @if($user->show_favorites)
                <hr>
                <h2>Trivia Locations</h2>
                <div class="row" data-masonry='{"percentPosition": true }'>
                    @foreach ($locations as $location)
                        @include('locations.parts.location_box',$location)
                    @endforeach
                </div>
            @endif

        </div>
    </div>
@endsection