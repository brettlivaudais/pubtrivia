<div class="card">
    <div class="card-header">{{ __('Social Media') }}</div>

    <div class="card-body">

        <div class="form-group row">
            <label for="instagram" class="col-md-4 col-form-label text-md-right">{{ __('Instagram') }}</label>

            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input id="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" value="{{ old('instagram', $user->instagram) }}" autocomplete="instagram">
                </div>

                @error('instagram')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="facebook" class="col-md-4 col-form-label text-md-right">{{ __('Facebook') }}</label>

            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input id="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ old('facebook', $user->facebook) }}" autocomplete="facebook">
                </div>
                @error('facebook')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="snapchat" class="col-md-4 col-form-label text-md-right">{{ __('Snapchat') }}</label>

            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span><input id="snapchat" type="text" class="form-control @error('snapchat') is-invalid @enderror" name="snapchat" value="{{ old('snapchat', $user->snapchat) }}" autocomplete="snapchat">
                </div>
                @error('snapchat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="twitter" class="col-md-4 col-form-label text-md-right">{{ __('Twitter') }}</label>

            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span><input id="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{ old('twitter', $user->twitter) }}" autocomplete="twitter">
                </div>
                @error('twitter')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="tiktok" class="col-md-4 col-form-label text-md-right">{{ __('TikTok') }}</label>

            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span><input id="tiktok" type="text" class="form-control @error('tiktok') is-invalid @enderror" name="tiktok" value="{{ old('tiktok', $user->tiktok) }}" autocomplete="tiktok">
                </div>
                @error('tiktok')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="linkedin" class="col-md-4 col-form-label text-md-right">{{ __('LinkedIn') }}</label>

            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span><input id="linkedin" type="text" class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" value="{{ old('linkedin', $user->linkedin) }}" autocomplete="linkedin">
                </div>
                @error('linkedin')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="github" class="col-md-4 col-form-label text-md-right">{{ __('GitHub') }}</label>

            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span><input id="github" type="text" class="form-control @error('github') is-invalid @enderror" name="github" value="{{ old('github', $user->github) }}" autocomplete="github">
                </div>
                @error('github')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="discord" class="col-md-4 col-form-label text-md-right">{{ __('Discord') }}</label>

            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span><input id="discord" type="text" class="form-control @error('discord') is-invalid @enderror" name="discord" value="{{ old('discord', $user->discord) }}" autocomplete="discord">
                </div>
                @error('discord')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="youtube" class="col-md-4 col-form-label text-md-right">{{ __('YouTube') }}</label>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input id="youtube" type="text" class="form-control @error('youtube') is-invalid @enderror" name="youtube" value="{{ old('youtube', $user->youtube) }}" autocomplete="youtube">
                </div>
                
                @error('youtube')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        
    </div>
</div>