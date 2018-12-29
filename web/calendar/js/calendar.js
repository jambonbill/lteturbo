$(function(){

	// INIT Calendar //

	$('#calendar').fullCalendar({
    	//https://fullcalendar.io/docs/initialization
    	// put your options and callbacks here

		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},

		buttonText: {
	        today: 'today',
	        month: 'month',
	        week : 'week',
	        day  : 'day'
	    },

    	//weekends: false, // will hide Saturdays and Sundays
    	default: 'bootstrap4',

    	editable: true,
      	selectable: true,
      	eventLimit: true, // allow "more" link when too many events

    	dayClick: function(mom) {
    		if ( mom < new moment()) {
          		//console.warn('moment in the past');
          		return false;
          	}
          	//console.log('day has been clicked!',mom);
        },

        eventClick: function(e) {
          	console.log('clicked', e.data);
          	$('#modalBooking').modal('show');
          	$('#b_id').val(e.id);
          	$('#b_date').val(e.data.date);
          	$('#b_time').val(e.data.time);
          	$('#b_duration').val(e.data.duration);
          	$('#b_student_id').val(e.data.b_student_user_id);
          	$('#b_student_confirmed').val(e.data.b_teacher_confirmed);
        },



        defaultView:'month',
        //defaultView: 'agendaWeek',
        firstDay:1,
        nowIndicator: true,
        viewRender: function(currentView){
			//console.log('viewRender', currentView);
			let minDate = moment();
			let maxDate = moment().add(5, 'weeks');
			// Past
			if (minDate >= currentView.start && minDate <= currentView.end) {
				$(".fc-prev-button").prop('disabled', true);
				$(".fc-prev-button").addClass('fc-state-disabled');
			} else {
				$(".fc-prev-button").removeClass('fc-state-disabled');
				$(".fc-prev-button").prop('disabled', false);
			}
			// Future
			if (maxDate >= currentView.start && maxDate <= currentView.end) {
				$(".fc-next-button").prop('disabled', true);
				$(".fc-next-button").addClass('fc-state-disabled');
			} else {
				$(".fc-next-button").removeClass('fc-state-disabled');
				$(".fc-next-button").prop('disabled', false);
			}
		},

        events:[]

  	});

  	$('.overlay').hide();

});