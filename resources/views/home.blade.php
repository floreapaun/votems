{{--
@auth
    @extends('layouts.app-login')
@else
    @extends('layouts.app')
@endauth
--}}

@extends('layouts.app-login')

@section('content')
<link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css"/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">




        </div>
</div>
</div>
    
</div>

<table>
  <tr>
    <td>
          <table class="dbtbl">
            <tr><th>Top candidati</th></tr>
                @for($i = 0; $i < count($data['top_arr']); $i++)
                    <tr><td>
                    {{ $data['top_arr'][$i]->first_name . " " . $data['top_arr'][$i]->second_name }}
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
                    {{ $data['last_arr'][$i]->cfirst_name . " " . $data['last_arr'][$i]->csecond_name }}
                    </tr></td>
                    @endfor
          </table>
    </td>
  </tr>
</table>

@endsection
