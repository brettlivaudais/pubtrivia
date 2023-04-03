<div class="card">
    <div class="card-header">{{ __('Personal Information') }}</div>

    <div class="card-body">
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

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
            <label for="team_name" class="col-md-4 col-form-label text-md-right">{{ __('Team Name') }}</label>

            <div class="col-md-6">
                <input id="team_name" type="text" class="form-control @error('team_name') is-invalid @enderror" name="team_name" value="{{ old('team_name', $user->team_name) }}" autocomplete="team_name">

                @error('team_name')
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
            <label for="photo_url" class="col-md-4 col-form-label text-md-right">{{ __('Photo URL') }}</label>

            <div class="col-md-6">
                <input id="photo_url" type="text" class="form-control @error('photo_url') is-invalid @enderror" name="photo_url" value="{{ old('photo_url', $user->photo_url) }}" autocomplete="photo_url">

                @error('photo_url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>

            <div class="col-md-6">
                <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday', $user->birthday) }}" autocomplete="birthday">

                @error('birthday')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

    
    </div>
</div>