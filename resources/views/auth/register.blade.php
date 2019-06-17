@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Date votant') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                          <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Nume') }}</label>
                          <div class="col-md-6">
                            <input id="first_name" type="text" 
                              class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                              name="first_name" value="{{ old('name') }}" required autofocus>

                              @if ($errors->has('first_name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('first_name') }}</strong>
                                  </span>
                              @endif

                          </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="second_name" class="col-md-4 col-form-label text-md-right">{{ __('Prenume') }}</label>
                          <div class="col-md-6">
                            <input id="second_name" type="text" 
                              class="form-control{{ $errors->has('second_name') ? ' is-invalid' : '' }}"
                              name="second_name" value="{{ old('name') }}" required>

                              @if ($errors->has('second_name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('second_name') }}</strong>
                                  </span>
                              @endif

                          </div>
                        </div>
    
                        
                        <div class="form-group row">
                          <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Varsta') }}</label>
                          <div class="col-md-6">
                            <input id="age" class="form-control" type="text" name="age" >
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresa e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Parola') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirma parola') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="education" class="col-md-4 col-form-label text-md-right">{{ __('Educatie') }}</label>
                          <div class="col-md-6">
                            <select name="education" class="form-control" id="education">
                              <option value="0">fara studii superioare</option>
                              <option value="1">cu studii superioare</option>
                            </select>
                          </div>  
                        </div>
                        
                        
                        <div class="form-group row">
                          <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Venit lunar') }}</label>
                          <div class="col-md-6">
                            <select name="salary" class="form-control" id="salary">
                              <option value="1">500-1400 lei</option>
                              <option value="2">1400-3500 lei</option>
                              <option value="3">peste 3500 lei</option>
                            </select>
                          </div>  
                        </div>
                
                        
                        <div class="form-group row">
                          <label for="family" class="col-md-4 col-form-label text-md-right">{{ __('Casatorit(a)') }}</label>
                          <div class="col-md-6">
                            <select name="family" class="form-control" id="family">
                              <option value="-1">nu</option>
                              <option value="0">fara copii</option>         
                              <option value="1">1 copil</option>         
                              <option value="2">2 copii</option>         
                              <option value="3">3 copii</option>         
                              <option value="4">4 copii</option>         
                              <option value="5">5 copii</option>         
                              <option value="10">mai mult de 5 copii</option>        
                            </select>
                          </div>  
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Creaza cont') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
