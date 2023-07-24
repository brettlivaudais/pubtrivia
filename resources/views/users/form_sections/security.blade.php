<div class="card">
    <div class="card-header">{{ __('Privacy and Security') }}</div>

    <div class="card-body">

        

        <div class="form-group row">
            <label for="youtube" class="col-md-12 col-form-label text-md-center">
                <input type="checkbox" class="form-check-input" id="show_favorites" name="show_favorites" {{ $user->show_favorites ? 'checked' : '' }}>
                <label class="form-check-label" for="show_favorites">{{ __('Show favorite locations on your profile.') }}</label>
            </label>
        </div>



        <div class="form-group row">
            <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

            <div class="col-md-6">
                <input id="new_password" type="text" class="form-control @error('new_password') is-invalid @enderror" name="new_password" value="">

                @error('new_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

            <div class="col-md-6">
                <input id="new_password_confirmation" type="text" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" value="">

                @error('new_password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        
    </div>
</div>