<div class="col-sm- 6 col-lg-4" day="{{ $location->dayoftheweek }}">
    <div class="card">
        <a href="/locations/{{ $location->slug }}">
        <img class="bd-placeholder-img card-img-top" width="100%" style="border: 0" src = "{{ $location->logo_url }}"/></a>
        <div class="card-body">
            <h5 class="card-title">{{ $location->name }}</h5>
            {{ $location->address }}
        </div>
        <div class="card-footer text-muted">
        <div class="float-right">
            @include('locations.parts.rating_display', ['avgRating' => $location->averageRating()])
        </div>
        <p class="card-text">{{ $location->dayoftheweek }} at {{ $location->time }}
        </p>
        </div>
    </div>
    <div>
        &nbsp;

        
    </div>
</div>


