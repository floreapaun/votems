console.log("change functions added");
function getValue(bttn_id){
  var helpdat;
  if(bttn_id === "BttnGenAvgAge")
      helpdat = $("#party").val();

  console.log(helpdat);
  $.ajax({
     type:'POST',
     url :'/getvalue',
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
