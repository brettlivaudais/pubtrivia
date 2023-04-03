<div class="card">
    <div class="card-header">{{ __('Company Information') }}</div>

    <div class="card-body">
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="hometown" class="col-md-4 col-form-label text-md-right">{{ __('Hometown') }}</label>

            <div class="col-md-6">
                <input id="hometown" type="text" class="form-control @error('hometown') is-invalid @enderror" name="hometown" value="{{ old('hometown', $user->hometown) }}" autocomplete="hometown">

                @error('hometown')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="introduction" class="col-md-4 col-form-label text-md-right">{{ __('Introduction') }}</label>
            <div class="col-md-6">
                <textarea id="introduction" class="form-control @error('introduction') is-invalid @enderror" name="introduction" rows="3">{{ old('introduction', $user->introduction) }}</textarea>

                @error('introduction')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="photo_url" class="col-md-4 col-form-label text-md-right">{{ __('Logo URL') }}</label>

            <div class="col-md-6">
                <input id="photo_url" type="text" class="form-control @error('photo_url') is-invalid @enderror" name="photo_url" value="{{ old('photo_url', $user->photo_url) }}" autocomplete="photo_url">

                @error('photo_url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    
    </div>
</div>