// Mike Guillory
// Credo Web Development
// 20160403

var venue = "";
var address = "";
var time = "";
var am_pm = "";
var clicked_am_pm ="";
var details = "";
var date = "";
var dateForDatabase = '';
var city = "";
var detailsDate = "";
var detailsCity = "";

$(document).ready(function(){

	displayDetails();

	$("#date, #datepicker, #input_release_date").datepicker({
		dateFormat: 'yy/mm/dd',
		minDate: 0,
		onClose: function(e){
			if($(this).attr("id") == "datepicker"){
				$('input[name="performance_city"]').focus();
			}
		}
	});

	$(".listing").click(function(){
		$('#updated').css('color', '#fff');
		$('.showDetails').removeClass('showDetails');
		$(this).addClass('showDetails');
		var id = $('.showDetails').attr('id');
		displayDetails(id);
	});

	$('input[type="radio"]').click(function(){

		clicked_am_pm = $(this).val();
	});
});

function displayDetails(id){
		
	if(!id){
		id = $('.showDetails').attr('id');
	}

	venue = $('#venue' + id).val();
	address = $('#address'+ id).val();
	time = $('#time' + id).val();
	am_pm = $('#hidden_am_pm' + id).val();
	details = $('#details' + id).val();
	date = $('#date' + id).text();
	dateForDatabase = $('#hidden-date' + id).val();
	city = $('#city' + id).text();
	detailsDate = date.substr(0, date.indexOf(','));
	detailsCity = city.substr(0, city.indexOf(','));

	$('#city').val(city);
	$('#date').val(date);
	$('#venue').val(venue);
	$('#address').val(address);
	$('.address').text(address);
	$('#time').val(time);
	if(time){
		$('.time').text(time + " " + am_pm);		
	}
	$('#edit_am_pm:checked').prop('checked', false);
	$('#' + am_pm).prop('checked', true);
	$('#details').val(details);
	$('.details').text(details);

		if(venue){
		$('.details-date').html(venue);	
	}
	$('#hiddenId').val(id);
};

function updateSchedule(e){

	if (confirm("Are you sure you want to edit this performance?")) {
        var userDate = $('#date').val();
		var newDate = new Date(userDate);
		var day = newDate.getDate();
		var month = newDate.getMonth() + 1;
		var year = newDate.getFullYear();

		databaseDate = year + '/' + month + '/' + day;

		var performanceData = {
			post_id: $('.showDetails').attr('id'),
			post_date: databaseDate,
			post_time: $('#time').val(),
			post_am_pm: clicked_am_pm,
			post_details: $('#details').val(),
			post_venue: $('#venue').val(), 
			post_address: $('#address').val(),
			post_city_province: $('#city').val()
		};

		$.ajax({
			url: 		'http://www.credowebdev.com/bdm/edit_schedule/update_performance',
			type: 		'POST',
			data: 		performanceData,
			dataType: 	'json',
			context: 	'',
			success: 	function(data){
				
							alert("Update Successful");
							window.location.reload();
						}
          				
		    error: 		function(){
		       				console.log('something went wrong');
		    			}			
		
		});
		
    }
    else
    {
	    displayDetails();
	    return false;
    }

};

function deletePerformance(){

	if (confirm("Are you sure you want to delete this performance?")) {
		

		var id = $('#hiddenId').val();
		alert(id);

		$.ajax({
		url: 		'http://www.credowebdev.com/bdm/edit_schedule/delete_performance',
		type: 		'POST',
		data: 		'id=' + id,
		context: 	'',
		success: 	function(data){

						location.reload();
			
            		},
		 error: function(){
		                console.log('something went wrong');
		            }			
		});
	}
	return false;
};

function reloadStylesheets() { // http://stackoverflow.com/questions/2024486/is-there-an-easy-way-to-reload-css-without-reloading-the-page
    var queryString = '?reload=' + new Date().getTime();
    $('link[rel="stylesheet"]').each(function () {
        this.href = this.href.replace(/\?.*|$/, queryString);
    });
}