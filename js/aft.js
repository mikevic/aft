$(".aft-form").change(function() {
	$("#aft-header-form").submit();
});

$(".topten").click(function() {

    var url = "inc/generate_top_ten.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#aft-header-form").serialize(), // serializes the form's elements.
           success: function(data)
           {
               $(".modal-header").html('Top Ten');
               $(".modal-body").html(data);
               $("#myModal").modal('show');
           }
         });

    return false; // avoid to execute the actual submit of the form.
});

function getlclist(label){
	$("#aft-header-form").append( "<input type=\"hidden\" value=\""+label+" \" id=\"setcountry\" name=\"country\" />" );
	var url = 'inc/generate_lc_data.php';
	var country = $("#setcountry").val();
	$.ajax({
           type: "POST",
           url: url,
           data: $("#aft-header-form").serialize(), // serializes the form's elements.
           success: function(data)
           {
               $(".modal-header").html('LC Data for '+label);
               $(".modal-body").html(data);
               $("#myModal").modal('show');
           }
         });

    return false; // avoid to execute the actual submit of the form.

}