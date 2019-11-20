console.log("change functions added");

function Capitalize(str) {
  //console.log(str);
  var newstr = '';
  if(str === "restul_partidelor") {
      newstr = "Restul";
      return newstr;
  }

  if(str === "Partidul Sabia Disciplinei")
      return "PSA";
  for(var i = 0; i < str.length; i++) {
      if(str[i] == str[i].toUpperCase()) {
          newstr += str[i];
          //console.log(str[i]);
      }
  }
  //console.log(newstr);
  return newstr;
}

$("#BttnGenAvgAge").click(function() {
    party = $("#party").val();
    $.ajax({
       type:'POST',
       url :'/get_avg_age',
       headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       data:{ 'party' : party },
       dataType: 'json', 
       success:function(data){
           $("#AvgAge").empty();
           $("#AvgAge").append("<p class='green_message'>" + parseFloat(data.value).toFixed(1) + ' ani </p>');
       }
    });
});

$("#BttnGenTopCorrupt").click(function() {
    $.ajax({
       type:'POST',
       url :'/get_win_corrupt',
       headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       dataType: 'json', 
       success:function(data){
           $("#TopCorrupt").empty();
           $("#TopCorrupt").append("<p class='green_message'>" + data[1] + " a invins in " + data[0] + '!</p>');
       }
    });
});

$("#candidate").change(function() {
    console.log("am schimbat candidt");
    var candid_id = $("#candidate").val();
    $.ajax({ 
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/getparty',
        data: { "candid_id" : candid_id },
        dataType: "json",
        type: 'post',
        success: function(result) {
                    //$("#party option[value='" + result.party + "']").prop("selected", true);
                    $("#party").val(result[0].party);
                 }
    });
                
});

$("#BttnGenCntPoor").click(function() {
  console.log("#BttnGenCntPoor button has been pressed!");
  $.ajax({
     type:'POST',
     url :'/get_cnt_poor',
     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     dataType: 'json', 
     success:function(data){
         $("#CntPoor").empty();
         $("#CntPoor").append("<p class='green_message'>" + data[1] + ' voturi din ' + data[0] + 
                 ', cel mai sarac judet</p>');
     }
  });
});

$("#BttnGenTopRegion").click(function() {
    console.log("BttnGenTopRegion button pressed");
    console.log(this);
    var id_select = $(this).prev().attr('id');
    console.log(id_select);
    var region = $('#' + id_select).val();
    console.log(region);
    

    $.ajax({ 
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/get_image_data_TopReg',
        data: { "region" : region },
        dataType: "json",
        type: 'post',
        success: function(result) {
                    var urlvars = "?nr=" + result.length + "&" + "region=" + region + "&";
                    for(var i = 0; i < result.length; i++) {
                        urlvars = urlvars + "votes_cnt" + i + "=" + result[i].votes_cnt;
                        urlvars += "&";
                    }
                    for(var i = 0; i < result.length; i++) {
                        urlvars = urlvars + "party_name" + i + "=" + Capitalize(result[i].party);
                        urlvars += "&";
                    }
                    urlvars = urlvars.substring(0, urlvars.length-1);
                    console.log(urlvars);
                    $("#img_div").empty();
                    $("#img_div").append("<img src='http://localhost/pollvot/jpgraph-4.2.6/src/piegraph_TopReg.php" + urlvars +  "'>");
                    $("#img_div").append("<h5>" + region + "</h5>");
                 }
    });
    
});

$("#BttnGenTopYng").click(function() {
    console.log("#BttnGenTopYng button has been pressed");
    var img_title = "Tineri";

    $.ajax({ 
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/get_image_data_TopYng',
        dataType: "json",
        type: 'post',
        success: function(result) {
                    var urlvars = "?nr=" + result.length + "&" + "img_title=" + img_title + "&";
                    for(var i = 0; i < result.length; i++) {
                        urlvars = urlvars + "votes_cnt" + i + "=" + result[i].votes_cnt;
                        urlvars += "&";
                    }
                    for(var i = 0; i < result.length; i++) {
                        urlvars = urlvars + "party_name" + i + "=" + Capitalize(result[i].party);
                        urlvars += "&";
                    }
                    urlvars = urlvars.substring(0, urlvars.length-1);
                    console.log(urlvars);
                    $("#img_div").empty();
                    $("#img_div").append("<img src='http://localhost/pollvot/jpgraph-4.2.6/src/piegraph_TopYng.php" + urlvars +  "'>");
                    $("#img_div").append("<h5>Sub 30 ani</h5>");
                 }
    });
    
});

$("#BttnGenTopHgh").click(function() {
    console.log("#BttnGenTopHgh button has been pressed");

    var img_title = "Studii superioare";
    $.ajax({ 
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/get_image_data_TopHgh',
        dataType: "json",
        type: 'post',
        success: function(result) {
                    var urlvars = "?nr=" + result.length + "&" + "img_title=" + img_title + "&";
                    for(var i = 0; i < result.length; i++) {
                        urlvars = urlvars + "votes_cnt" + i + "=" + result[i].votes_cnt;
                        urlvars += "&";
                    }
                    for(var i = 0; i < result.length; i++) {
                        urlvars = urlvars + "party_name" + i + "=" + Capitalize(result[i].party);
                        urlvars += "&";
                    }
                    urlvars = urlvars.substring(0, urlvars.length-1);
                    console.log(urlvars);
                    $("#img_div").empty();
                    $("#img_div").append("<img src='http://localhost/pollvot/jpgraph-4.2.6/src/piegraph_TopYng.php" + urlvars +  "'>");
                    $("#img_div").append("<h5>Studii superioare</h5>");
                 }
    });
    
});

$('#party').change(function() {
    console.log("am schimbat partid");
    var party = $("#party").val();
    $.ajax({ 
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/getcandid',
        data: { "party" : party },
        type: 'post',
        dataType: "json",
        success: function(result) {
                    //$("#candidate option[value=" + result.candid_id + "]").prop("selected", true);
                    $('#candidate').val(result[0].candidate_id);
                 }
    });
});

$('#area').on('change', function(){

    var education = parseInt($("#user_education").val());
    var income = parseInt($("#user_income").val());
    var family = parseInt($("#user_family").val());
    var region = $("#county").find(':selected').data('regid');
    var county = parseInt($("#county").val());
    var age = parseInt($("#user_age").val());
    var area = parseInt($("#area").val());

    var user_data = { 'education': education,
                'income': income,
                'family' : family,
                'region' : region,
                'county' : county,
                'age' : age,
                'area':  area };
    
    //console.log(user_data);

    $("#div_bar").removeClass('hidden');   

    $.ajax({
        url: "http://pollvot/cgi-bin/predict_script.py",
        type: "post",
        dataType:"json",
        data: user_data ,
        success: function(response){
                    $("#div_bar").removeClass('hidden');   
                    $('#candidate').val(response.pred);

                    var candid_id = response.pred;
                    $.ajax({ 
                        type: 'POST',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '/getparty',
                        data: { "candid_id" : candid_id },
                        dataType: "json",
                        type: 'post',
                        success: function(result) {
                                    $("#party").val(result[0].party);
                                 }
                    });

                    $("#div_cand").removeClass('hidden');   
                    $("#div_party").removeClass('hidden');   
                    $("div.loader").addClass('hidden');
                    $("span.green_message").text('Daca nu am ghicit alege-ti din lista...');
                    $("#div_VoteBttn").removeClass('hidden');
                 }
    });


});

$('#county').on('change', function(){
    console.log('Im going to start python script processing ');
    $("#div_area").removeClass('hidden');   
});

$("#gdp_county").on('change', function() {
    
    var nowgdp = $("#gdp_county").find(':selected').data('gdp')

    $("#gdp_label").empty();
    $("#gdp_input").empty();
    $("#gdp_button").empty();

    $("#gdp_label").append("<label for='gdp_up_input'>Introdu valoarea:</label>");
    $("#gdp_input").append("<input type='text' id='gdp_up_input'" + 
                              "name='gdp_up_input' value='" + nowgdp + "'></div>");
    $("#gdp_button").append("<button type='submit' class='btn btn-success' id='BttnSendGdp'>Trimite</button>");
}); 

$("#corr_county").on('change', function() {
    
    var nowcorr = $("#corr_county").find(':selected').data('corr')

    $("#corr_label").empty();
    $("#corr_input").empty();
    $("#corr_button").empty();
    $("#gdp_ans").empty();

    $("#corr_label").append("<label for='corr_up_input'>Introdu valoarea:</label>");
    $("#corr_input").append("<input type='text' id='corr_up_input'" + 
                              "name='corr_up_input' value='" + nowcorr + "'></div>");
    $("#corr_button").append("<button type='submit' class='btn btn-success' id='BttnSendCorr'>Trimite</button>");
}); 

$(document).on('click', '#BttnSendGdp', function() {
  console.log("aaa");

  var newgdp = $("#gdp_up_input").val();
  console.log(newgdp);
  var county = $("#gdp_county").val();
    $.ajax({ 
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/update_gdp',
        data: { "gdp" : newgdp, "county" : county },
        type: 'post',
        dataType: "json",
        success: function(result) {
                    $('#gdp_ans').append("<span class='green_message'>Am modificat cu success!</span>");
                    location.reload();
                 }
    });
});

$(document).on('click', '#BttnSendCorr', function() {
  console.log("aaa");

  var newcorr = $("#corr_up_input").val();
  var county = $("#corr_county").val();
    $.ajax({ 
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/update_corr',
        data: { "corr" : newcorr, "county" : county },
        type: 'post',
        dataType: "json",
        success: function(result) {
                    $('#corr_ans').append("<span class='green_message'>Am modificat cu success!</span>");
                    location.reload();
                 }
    });
});

$("#voting_state").on('change', function() {
    console.log("checkbox changed!");
    var stop_vote;
    if(this.checked)
      stop_vote = 1;
    else
      stop_vote = 0;
    $.ajax({ 
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '/write_voting_state',
        data: { "stop_vote" : stop_vote },
        type: 'post',
        dataType: "json",
        success: function(result) {
                      console.log("wrote successfuly!");
                 }
    });

});
