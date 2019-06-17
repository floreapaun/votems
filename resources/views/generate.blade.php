@extends('layouts.app-login')

@section('content')
<link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css"/>
<style>
span.badge.badge-primary, button.badge.badge-success 
{
    font-size: 110%;
}
</style>


  <div class='row'>
    <div class="col-sm-7 text-center">
      <div class='col-sm-12'>
        <div class="form-inline">
          <span class="badge badge-primary">Varsta medie a votantilor partidului</span>
          <select class="form-control" id='party' name='party'>
              @foreach($partyname_arr as $p)
                  <option value='{{ $p->party_name }}'>{{ $p->party_name }}</option>
              @endforeach
          </select> 
          <button class="badge badge-success" id='BttnGenAvgAge'>Genereaza</button>
        </div>
      </div>
      <div class='col-sm-12'>
        <p id='AvgAge'colspan='2'></p>
      </div>
      <div class='col-sm-12'>
        <div class="form-inline">
          <span class="badge badge-primary">Numarul de voturi provenite din cel mai sarac judet din tara</span>
          <button class="badge badge-success" id='BttnGenCntPoor'>Genereaza</button>
        </div>
      </div>
      <div class='col-sm-12'>
        <p id='CntPoor'></p>
      </div>
      <div class='col-sm-12'>
        <div class="form-inline">
          <span class="badge badge-primary">Topul partidelor din regiunea</span>
          <select class="form-control" id='region'>
            <option value='Banat'>Banat</option>
            <option value='Crisana'>Crisana</option>
            <option value='Dobrogea'>Dobrogea</option>
            <option value='Maramures'>Maramures</option>
            <option value='Moldova'>Moldova</option>
            <option value='Muntenia'>Muntenia</option>
            <option value='Oltenia'>Oltenia</option>
            <option value='Transilvania'>Transilvania</option>
          </select> 
          <button class="badge badge-success" id='BttnGenTopRegion'>Genereaza</button>
        </div>
      </div>
      <div class='col-sm-12'>
        <p></p>
      </div>
      <div class='col-sm-12'>
        <div class="form-inline">
          <span class="badge badge-primary">Topul partidelor votate de tineri (sub 30 ani)</span>
          <button class="badge badge-success" id='BttnGenTopYng'>Genereaza</button>
        </div>
      </div>
      <div class='col-sm-12'>
        <p></p>
      </div>
      <div class='col-sm-12'>
        <div class="form-inline">
          <span class="badge badge-primary">Topul partidelor votate de cei cu studii superioare</span>
          <button class="badge badge-success" id='BttnGenTopHgh'>Genereaza</button>
        </div>
      </div>
      <div class='col-sm-12'>
        <p></p>
      </div>
      <div class='col-sm-12'>
        <div class="form-inline">
          <span class="badge badge-primary">Partidul castigator din judetul cel mai corupt</span>
          <button class="badge badge-success" id='BttnGenTopCorrupt'>Genereaza</button>
        </div>
      </div>
      <div class='col-sm-12'>
        <p id="TopCorrupt"></p>
      </div>
    </div>
    <div id="img_div" class="col-sm-3 text-center">
      {{--
      <img src="images/pielabelsex5.jpg" alt="">
      --}}
    </div>
</div>


</div>


@endsection
