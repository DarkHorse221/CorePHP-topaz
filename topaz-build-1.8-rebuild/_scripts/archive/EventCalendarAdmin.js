$(document).ready(function() {
	$('#calendar').fullCalendar({
		
		theme: true,
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		
		selectable: true,
		selectHelper: true,
		select: function(start, end, allDay) {
			location.href=MEDIA_URL+"console/index.php?t=education-tracker&o=add-event&sdate="+start+"&edate="+end;
		},
		editable: false,		
		events: {
			url:  MEDIA_URL+"_functions/jqueryEventCalendarAdmin.php",
			type: 'GET',
			data: {
				uid: 1
			},
			error: function() {
				/*Could do alert function here*/
			}
		},
		timeFormat: 'h:mm{ - h:mm}',
		loading: function(bool) {
			if (bool) $('#loading').show();
			else $('#loading').hide();
		}	
	});	
});