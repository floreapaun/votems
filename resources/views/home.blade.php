@extends('layouts.app-login')
@section('content')

@if ($data['user_voted']==0)
    <form id='voteform' method="post" action='/makevote'>
      @csrf

        <div class="form-group row justify-content-center">
          <label for='county' class='col-sm-2 col-form-label text-sm-left'>Judet resedinta</label>
          <div class="col-sm-2">
            <select id='county' name='county_name' class="form-control">
                  <option value=''>Selecteaza</option>
                  @for($i = 0; $i < count($data['countyname_arr']); $i++)
                      <option value='{{ $data['countyid_arr'][$i]->county_id }}' 
                              data-regid='{{ $data['regionid_arr'][$i] }}'>
                        {{ $data['countyname_arr'][$i]->county_name }}    
                      </option>
                  @endfor
            </select>
          </div>
        </div>
        <div class="form-group row justify-content-center hidden" id="div_area">
          <label for='area' class='col-sm-2 col-form-label text-sm-left'>Zona</label>
          <div class="col-sm-2">
           <select id='area' name='area' class="form-control">
              <option value=''>Selecteaza</option>
              <option value='1'>Rural</option>
              <option value='2'>Urban</option>
            </select>
          </div>
        </div>
        <div class="form-group row justify-content-center hidden" id="div_bar">
                <div class="col-sm-3">
                    <span class="green_message">Incercam sa ghicim cu cine ai vota...</span>
                </div>
                <div class="col-sm-1">
                <div class="loader"></div>
                </div>
        </div>
        <div class='form-group row justify-content-center hidden' id="div_cand">
          <label for='candidate' class='col-sm-2 col-form-label text-sm-left'>Candidat</label></td>
          <div class="col-sm-2">
            <select id='candidate' name='candidate_id' class='form-control'>
                  <option value=''>Selecteaza</option>
                  @for($i = 0; $i < count($data['candidate_arr']); $i++)
                      <option value='{{ $data['candidate_arr'][$i]->candidate_id }}'>
                         {{ $data['candidate_arr'][$i]->first_name . " " . 
                            $data['candidate_arr'][$i]->second_name  }}    
                      </option>
                  @endfor
            </select>
          </div>
         </div>
        <div class='form-group row justify-content-center hidden' id="div_party">
          <label for='party' class='col-sm-1 col-form-label text-sm-left'>Partid</label></td>
          <div class="col-sm-3">
            <select id='party' name='party_name' class='form-control'>
                <option value=''>Selecteaza</option>
                @for($i = 0; $i < count($data['partyname_arr']); $i++)
                    <option value='{{ $data['partyname_arr'][$i]->party_name }}'>
                                    {{ $data['partyname_arr'][$i]->party_name }}    
                    </option>
                @endfor
            </select>
          </div>
        </div>
          <input type='hidden' name='os' id='platform' value=''>
            <script>
              document.getElementById("platform").value = navigator.platform;
            </script>
          <input type='hidden' name='user_education' id='user_education' value='{{ Auth::user()->education }}'>
          <input type='hidden' name='user_income' id='user_income' value='{{ Auth::user()->income }}'>
          <input type='hidden' name='user_family' id='user_family' value='{{ Auth::user()->family }}'>
          <input type='hidden' name='user_age' id='user_age' value='{{ Auth::user()->age }}'>
        <div class="form-group row justify-content-center hidden" id="div_VoteBttn">
          <div class="col-sm-4 text-sm-center">
            <button type='submit' class="btn btn-primary">Voteaza</button>
          </div>
        </div>
    </form>
   @else

       <!-- if logged user is the administrator -->     
       @if (Auth::user()->user_id == 877)

            <table>
              <tr>
                <td>
                      <table class="dbtbl">
                        <tr><th>Top candidati</th></tr>
                            @for($i = 0; $i < count($data['top_arr']); $i++)
                                <tr><td>
                                {{ $i+1 . ". " . $data['top_arr'][$i]->first_name . " " . $data['top_arr'][$i]->second_name }}
                                {{ " (" . $data['top_arr'][$i]->party . ") " }}
                                {{ $data['top_arr'][$i]->votes_cnt . " voturi" }}
                                </tr></td>
                                @endfor
                      </table>
                </td>

                <td>
                      <table class="dbtbl">
                        <tr><th>Ultimele voturi</th></tr>
                            @for($i = 0; $i < count($data['last_arr']); $i++)
                                <tr><td>
                                {{ $data['last_arr'][$i]->vote_date . " " . $data['last_arr'][$i]->vote_time . " " }}
                                {{ $data['last_arr'][$i]->first_name . " " . $data['last_arr'][$i]->second_name . " " }}
                                <img src="images/singlevote_logo.jpg" alt="Image" />
                                {{ " " }}
                                {{ $data['last_arr'][$i]->cfirst_name . " " . $data['last_arr'][$i]->csecond_name }}
                                </tr></td>
                                @endfor
                      </table>
                </td>
              </tr>
            </table>
        @else

            <!-- if simple voter user is logged in -->
            @php
                $myFile = "/srv/http/pollvot/public/state.txt";
                $f = fopen($myFile, 'r');
                $myFileContents = fread($f, filesize($myFile));
                fclose($f);
            @endphp
                
                @if (intval($myFileContents) == 0) 
                    <table>
                      <tr>
                        <td>
                          <span class="green_message"> Rezultatele 
                            voturilor vor fi afisate in data de 15.07.2019, ora 12:00!</span>
                        </td>
                      </tr>
                      <tr>
                        <td>
                              <table class="dbtbl">
                                <tr><th>Top candidati</th></tr>
                                    @for($i = 0; $i < 11; $i++)
                                        <tr><td>
                                        
                                        </tr></td>
                                        @endfor
                              </table>
                        </td>
                      </tr>
                    </table>

        
            @else
                <table>
                  
                  <tr>
                    <td>
                          <table class="dbtbl">
                            <tr><th>Top candidati</th></tr>
                                @for($i = 0; $i < count($data['top_arr']); $i++)
                                    <tr><td>
                                    {{ $i+1 . ". " . $data['top_arr'][$i]->first_name . " " . $data['top_arr'][$i]->second_name }}
                                    {{ " (" . $data['top_arr'][$i]->party . ") " }}
                                    {{ $data['top_arr'][$i]->votes_cnt . " voturi" }}
                                    </tr></td>
                                    @endfor
                          </table>
                    </td>
                  </tr>
                </table>
           @endif
            
        @endif

@endif
@endsection




