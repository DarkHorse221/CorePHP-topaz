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
			var title = prompt('Event Title:');
			if (title) {
				calendar.fullCalendar('renderEvent',
					{
						title: title,
						start: start,
						end: end,
						allDay: allDay
					},
					true // make the event "stick"
				);
			}
			calendar.fullCalendar('unselect');
		},
		editable: false,		
		events: {
			url:  MEDIA_URL+"_functions/jqueryEventCalendar.php",
			type: 'GET',
			data: {
				uid: user_id
			}
		},
		timeFormat: 'h:mm{ - h:mm}',
		loading: function(bool) {
			if (bool) $('#loading').show();
			else $('#loading').hide();
		}	
	});	
});