{{--
@auth
    @extends('layouts.app-login')
@else
    @extends('layouts.app')
@endauth
--}}

@extends('layouts.app-login')

@section('content')


@if ($data['user_voted']==0)
    <form id='voteform' method="post" action='/makevote'>
      @csrf

        <div class="form-group row justify-content-center">
          <label for='county' class='col-sm-2 col-form-label text-sm-left'>Judet resedinta</label>
          <div class="col-sm-2">
            <select id='county' name='county_name' class="form-control">
                  @for($i = 0; $i < count($data['countyname_arr']); $i++)
                      <option value='{{ $data['countyname_arr'][$i]->county_name }}'>
                                      {{ $data['countyname_arr'][$i]->county_name }}    
                      </option>
                  @endfor
            </select>
          </div>
        </div>
        <div class='form-group row justify-content-center'>
          <label for='candidate' class='col-sm-2 col-form-label text-sm-left'>Candidat</label></td>
          <div class="col-sm-2">
            <select id='candidate' name='candidate_id' class='form-control'>
                  @for($i = 0; $i < count($data['candidate_arr']); $i++)
                      <option value='{{ $data['candidate_arr'][$i]->candidate_id }}'>
                         {{ $data['candidate_arr'][$i]->first_name . " " . 
                            $data['candidate_arr'][$i]->second_name  }}    
                      </option>
                  @endfor
            </select>
          </div>
         </div>
        <div class='form-group row justify-content-center'>
          <label for='party' class='col-sm-1 col-form-label text-sm-left'>Partid</label></td>
          <div class="col-sm-3">
            <select id='party' name='party_name' class='form-control'>
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
        <div class="form-group row justify-content-center">
          <div class="col-sm-4 text-sm-center">
            <button type='submit' class="btn btn-primary">Voteaza</button>
          </div>
        </div>
    </form>


    {{--
    @php
    <!-- start of voter user page, vote not submited yet --> 
    <form id='voteform' method="post">
      <table>
        <tr>
          <td><label for='county'>Judet resedinta</label></td>
          <td><select id='county' name='county'>
            <?php 
                $query = "SELECT nume_judet FROM judet";
                if($stmt = $mysqli->prepare($query)) {
                    $stmt->bind_result($county);
                    $stmt->execute();
                    while($stmt->fetch())
                        echo "<option value='{$county}'>$county</option>";
                    $stmt->close();
                }
            ?>
          </td>
        </tr>
        <tr>
          <td><label for='candidate'>Candidat</label></td>
          <td><select id='candidate' name='candidate'>
            <?php
                $query = "SELECT id_candidat, nume, prenume FROM candidat";
                if($stmt = $mysqli->prepare($query)) {
                    $stmt->bind_result($candidate_id, $candidate_sname, $candidate_fname);
                    $stmt->execute();
                    while($stmt->fetch())
                        echo "<option value='{$candidate_id}'>$candidate_sname" . 
                             " $candidate_fname</option>"; 
                    $stmt->close();
                }
             ?>
           <div id="addp"></div>
           </td>
        </tr>
        <tr>
          <td><label for='party'>Partid</label></td>
          <td>
            <select id='party' name='party'>
            <?php
                $query = "SELECT nume_partid FROM partid";
                if($stmt = $mysqli->prepare($query)) {
                    $stmt->bind_result($partyname);
                    $stmt->execute();
                    while($stmt->fetch())
                        echo "<option value='{$partyname}'>$partyname</option>";
                    $stmt->close();
                }
            ?>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan='2'>
            <input type='hidden' name='platform' id='platform' value=''>
              <script>
                document.getElementById("platform").value = navigator.platform;
              </script>
          </td>
        <tr>
          <td colspan='2'>
            <button type='submit' name='btn-vote'>Voteaza</button>
          </td>
        </tr>
      </table>
    </form>
    <!-- end of voter user page, vote not submited yet --> 
    @endphp 
   --}} 
  
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
@endif

@endsection
