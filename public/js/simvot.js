console.log("change functions added");

function getValue(bttn_id){
  var helpdat;
  if(bttn_id === "BttnGenAvgAge")
      helpdat = $("#party").val();

  console.log(helpdat);
  $.ajax({
     type:'POST',
     url :'/get_avg_age',
     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     data:{ 'bttn_id' : bttn_id, 'helpdat' : helpdat },
     dataType: 'json', 
     success:function(data){
         $("#AvgAge").empty();
         if(data.bttn_id === "BttnGenAvgAge")
              $("#AvgAge").append("<p class='green_message'>" + data.value + ' ani </p>');
         else
              $("#AvgAge").append("<p class='green_message'>" + data.bttn_id + " " + data.value + ' ani </p>');
     }
  });
}

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
    
    function Capitalize(str) {
        //console.log(str);
        var newstr = '';
        if(str === "restul_partidelor") {
            newstr = "Restul";
            return newstr;
        }
        for(var i = 0; i < str.length; i++) {
            if(str[i] == str[i].toUpperCase()) {
                newstr += str[i];
                //console.log(str[i]);
            }
        }
        //console.log(newstr);
        return newstr;
    }

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
                 }
    });
    
});

$("#BttnGenTopYng").click(function() {
    console.log("#BttnGenTopYng button has been pressed");

    function Capitalize(str) {
        //console.log(str);
        var newstr = '';
        if(str === "restul_partidelor") {
            newstr = "Restul";
            return newstr;
        }
        for(var i = 0; i < str.length; i++) {
            if(str[i] == str[i].toUpperCase()) {
                newstr += str[i];
                //console.log(str[i]);
            }
        }
        //console.log(newstr);
        return newstr;
    }

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
                 }
    });
    
});

$("#BttnGenTopHgh").click(function() {
    console.log("#BttnGenTopHgh button has been pressed");

    function Capitalize(str) {
        //console.log(str);
        var newstr = '';
        if(str === "restul_partidelor") {
            newstr = "Restul";
            return newstr;
        }
        for(var i = 0; i < str.length; i++) {
            if(str[i] == str[i].toUpperCase()) {
                newstr += str[i];
                //console.log(str[i]);
            }
        }
        //console.log(newstr);
        return newstr;
    }

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
