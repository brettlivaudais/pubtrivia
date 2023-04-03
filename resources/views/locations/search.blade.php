

<div class="container">
    <div class="row">
      <div class="col">
        <div id="searchbox">
          <div class="input-group input-group-lg mb-3">
            <button class="btn btn-primary" type="button" id="getLocation"><i class="fa-solid fa-location-crosshairs"></i></button>
            <div class="form-floating flex-grow-1" style="width: 50%">
              <input type="text" id="location_search" class="form-control" placeholder="Search by city, state, or zip" aria-label="Recipient's username" aria-describedby="button-addon2">
              <label for="location_search">Search by city, state, or zip</label>
              <ul class="dropdown-menu" id="auto_complete" style="width: 100%">
              </ul>
            </div>

            <div class="form-floating" style="min-width: 85px">
              <select class="form-select" id="distance" aria-label="Distance">
                <option value="5">5 mi</option>
                <option value="15">15 mi</option>
                <option value="25">25 mi</option>
                <option value="50">50 mi</option>
              </select>
              <label for="distance">Distance</label>
            </div>
            <button class="btn btn-primary" type="button" id="location_search_btn">Search</button>
          </div>
        </div>
      </div>
    </div>

      
      
      <style>
        #map {
          height: 400px; /* The height is 400 pixels */
          width: 100%; /* The width is the width of the web page */
        }
      </style>


      <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&callback=initMap&v=weekly" defer ></script>
    
      <div class="row" style="padding-bottom: 15px">
        <div class="col">
          <div id="map"></div>
        </div>
        
      </div>

      <div class="row" style="padding-bottom: 15px">
        
        <div class="col d-grid gap-2">
          <input type="checkbox" checked class="btn-check" id="btn-check-all" autocomplete="off">
          <label class="btn btn-outline-primary" for="btn-check-all">All Days</label>
        </div>
        @foreach ($daysoftheweek as $dayoftheweek)
          <div class="col d-grid gap-2">
            <input type="checkbox" class="btn-check dayoftheweek" id="btn-check-{{ $dayoftheweek }}s" autocomplete="off">
            <label class="btn btn-outline-primary" for="btn-check-{{ $dayoftheweek }}s">{{ $dayoftheweek }}</label>
          </div>
        @endforeach
      </div>

      <div class="row" id="locations">

    

         
      </div>