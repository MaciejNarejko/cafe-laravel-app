@extends('layouts.app')

@section('content')
<div class="container login">
    <div class="row justify-content-center">
        <div class="col-sm-6 login">
            <div class="card">
                <div class="card-header signin">  <i class="fa fa-coffee" aria-hidden="true"></i>{{ __('Kawiarnia') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row" id="one">
                            <div class="col-sm-8 offset-2 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                              </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail') }}"name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="basic-addon2">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-8 offset-2 input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                              </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Hasło') }}" name="password" required autocomplete="current-password" aria-describedby="basic-addon1">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 offset-3 remember">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Zapamiętaj mnie') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                              <div class="col-sm-6 offset-3">
                                <button type="submit" class="btn btn-primary btn-lg log">
                                    {{ __('Zaloguj') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                              </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
