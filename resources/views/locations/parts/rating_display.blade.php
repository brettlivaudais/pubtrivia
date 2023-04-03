@if($avgRating > 0)
    <div>
        <i class="fa-{{ $avgRating>.5?'solid':'regular' }} fa-{{ $avgRating<.5 || $avgRating >= 1?'star':'star-half-stroke' }}"></i>
        <i class="fa-{{ $avgRating>1.5?'solid':'regular' }} fa-{{ $avgRating<1.5 || $avgRating >= 2?'star':'star-half-stroke' }}"></i>
        <i class="fa-{{ $avgRating>2.5?'solid':'regular' }} fa-{{ $avgRating<2.5 || $avgRating >= 3?'star':'star-half-stroke' }}"></i>
        <i class="fa-{{ $avgRating>3.5?'solid':'regular' }} fa-{{ $avgRating<3.5 || $avgRating >= 4?'star':'star-half-stroke' }}"></i>
        <i class="fa-{{ $avgRating>4.5?'solid':'regular' }} fa-{{ $avgRating<4.5 || $avgRating >= 4.75?'star':'star-half-stroke' }}"></i>
    </div>
@else
    <div>
        <i class="fa-regular fa-star greyed-out"></i>
        <i class="fa-regular fa-star greyed-out"></i>
        <i class="fa-regular fa-star greyed-out"></i>
        <i class="fa-regular fa-star greyed-out"></i>
        <i class="fa-regular fa-star greyed-out"></i>
    </div>
@endif