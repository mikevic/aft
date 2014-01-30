$(".aft-form").change(function() {
	$("#aft-header-form").submit();
});

$(".topten").click(function() {
    $("#loading").show();
    var url = "inc/generate_top_ten.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#aft-header-form").serialize(), // serializes the form's elements.
           success: function(data)
           {
               $(".modal-header").html('Top Twenty');
               $(".modal-body").html(data);
               $("#myModal").modal('show');
               $("#loading").hide();
           },
           complete : function(){

           }
         });

    return false; // avoid to execute the actual submit of the form.
});



function getlclist(label){
	$("#aft-header-form").append( "<input type=\"hidden\" value=\""+label+" \" id=\"setcountry\" name=\"country\" />" );
	var url = 'inc/generate_lc_data.php';
	var country = $("#setcountry").val();
  $("#loading").show();
	$.ajax({
           type: "POST",
           url: url,
           data: $("#aft-header-form").serialize(), // serializes the form's elements.
           success: function(data)
           {
               $(".modal-header").html('LC Data for '+label);
               $(".modal-body").html(data);
               $("#myModal").modal('show');
               $("#loading").hide();
           }
         });

    return false; // avoid to execute the actual submit of the form.

}

$(document).ready(function() { 
  $("#loading").hide();
  $( "#enddate" ).datepicker({
      onSelect : function(){
        $("#aft-header-form").submit();

         }
       });
    $( "#startdate" ).datepicker();
});
    