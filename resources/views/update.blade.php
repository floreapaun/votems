@extends('layouts.app-login')

@section('content')
<link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css"/>
<style>
span.badge.badge-primary, button.badge.badge-success, span.badge.badge-danger
{
    font-size: 110%;
}
</style>


<div class="container">
  <div class="row">
    <div class="col-sm">
    </div>
    <div class="col-sm-8">

        @php
            $myFile = __DIR__ . '/../../../public/state.txt';
            $f = fopen($myFile, 'r');
            $myFileContents = fread($f, filesize($myFile));
            fclose($f);
        @endphp
        <div class="form-group row">
          <span class="badge badge-danger col-sm-4 col-form-label col-form-label-sm">Incheie votarea </span>
          <div class="col-sm-8">
            @if (intval($myFileContents) == 1) 
                <input type="checkbox" id="voting_state" checked>
            @else
                <input type="checkbox" id="voting_state">
            @endif
          </div>
        </div>

        <div class="form-group row">
          <span class="badge badge-primary col-sm-4 col-form-label col-form-label-sm">Modifica PIB-ul judetului </span>
          <div class="col-sm-8">
            <select id='gdp_county' name='county_name' class='form-control'>
                @for ($i = 0; $i < count($data['countyname_arr']); $i++)
                    <option value='{{ $data['countyname_arr'][$i]->county_name }}'
                            data-gdp='{{ $data['countygdp_arr'][$i]->gdp }}' >
                                    {{ $data['countyname_arr'][$i]->county_name }}    
                    </option>
                @endfor
            </select>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-3" id="gdp_label">
          </div>
          <div class="col-6" id="gdp_input">
          </div>
          <div class="col-2" id="gdp_button">
          </div>
        </div>
        
        <div class="form-group row">
          <div class="col-3">
          </div>
          <div class="col-6" id="gdp_ans">
          </div>
          <div class="col-2">
          </div>
        </div>



        <div class="form-group row">
          <span class="badge badge-primary 
                      col-sm-4 col-form-label col-form-label-sm">Modifica nivelul de coruptie al judetului </span>
          <div class="col-sm-8">
            <select id='corr_county' name='county_name' class='form-control'>
                @for ($i = 0; $i < count($data['countyname_arr']); $i++)
                    <option value='{{ $data['countyname_arr'][$i]->county_name }}'
                            data-corr='{{ $data['countycorr_arr'][$i]->corruption_level }}'>
                                    {{ $data['countyname_arr'][$i]->county_name }}    
                    </option>
                @endfor
            </select>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-3" id="corr_label">
          </div>
          <div class="col-6" id="corr_input">
          </div>
          <div class="col-3" id="corr_button">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-3">
          </div>
          <div class="col-6" id="corr_ans">
          </div>
          <div class="col-2">
          </div>
        </div>
      
    </div>

    <div class="col-sm">
    </div>
  </div>
</div>



@endsection
