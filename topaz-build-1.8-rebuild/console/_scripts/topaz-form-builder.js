	//start form builder
	
	$(document).ready(function() {
		var wrapper         = $(".input_fields_wrap");
		var add_button      = $(".add_field_button");
		var add_button_textbox      = $(".add_field_button_textbox");
		var add_button_datetime      = $(".add_field_button_datetime");
		var add_button_date      = $(".add_field_button_date");
		var add_button_time      = $(".add_field_button_time");
		var add_button_section_break      = $(".add_field_section_break");
		var add_button_options      = $(".add_field_button_options");
		var add_options      = $(".add_options");
		var add_button_upload      = $(".add_button_upload");
		var add_button_yes_no_na      = $(".add_field_button_yes_no_na");
		var add_button_yes_no      = $(".add_field_button_yes_no");
		var add_button_true_false      = $(".add_field_button_true_false");
		var add_button_feedback     = $(".add_field_button_feedback");

		
		var x = START_X_VAL - 1; //initial input count
	
		$(add_button).click(function(e){ //on add single line button click
			e.preventDefault();
			x++;
				$(wrapper).append('<div class="buttons" id='+x+'><span class="move">'+x+'</span><input type="hidden" name="myText['+x+']" value="text"/><label>Single Line</label><input type="text" name="myLabel['+x+']"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
		});
		
		$(add_button_textbox).click(function(e){ //on add multiple line button click
			e.preventDefault();
			x++;
				$(wrapper).append('<div class="buttons" id='+x+'><span class="move">'+x+'</span><input type="hidden" name="myText['+x+']" value="textarea"/><label>Multiple Line</label><input type="text" name="myLabel['+x+']"/><a href="#" class="remove_field">Remove</a></div>'); //add input box textbox
		});
		
		$(add_button_datetime).click(function(e){ //on add date button click
			e.preventDefault();
			x++;
				$(wrapper).append('<div class="buttons" id='+x+'><span class="move">'+x+'</span><input type="hidden" name="myText['+x+']" value="datetime"/><label>Date & Time</label><input type="text" name="myLabel['+x+']"/><a href="#" class="remove_field">Remove</a></div>');
		});
		
		$(add_button_date).click(function(e){ //on add date button click
			e.preventDefault();
			x++;
				$(wrapper).append('<div class="buttons" id='+x+'><span class="move">'+x+'</span><input type="hidden" name="myText['+x+']" value="date"/><label>Date</label><input type="text" name="myLabel['+x+']"/><a href="#" class="remove_field">Remove</a></div>');
		});
		
		$(add_button_time).click(function(e){ //on add time button click
			e.preventDefault();
			x++;
				$(wrapper).append('<div class="buttons" id='+x+'><span class="move">'+x+'</span><input type="hidden" name="myText['+x+']" value="time"/><label>Time</label><input type="text" name="myLabel['+x+']"/><a href="#" class="remove_field">Remove</a></div>');
		});
		
		$(add_button_options).click(function(e){ //on add options button click
			e.preventDefault();
			x++;
				$(wrapper).append('<div class="buttons" id='+x+'><span class="move">'+x+'</span>' +
				'<label>Options</label><input type="text" name="myLabel['+x+']"/> <select name="myText['+x+']"><option value="">Please select</option><option value="checkbox">Check boxes</option><option value="radio">Radio</option><option value="singleselect">Dropdown menu</option></select> ' +
				'<a href="#" class="remove_field">Remove</a><br /><a href="#" class="add_options">Add more options</a>' +
				'<div class="options"><label>&nbsp;</label><span class="move">Option</span><input type="text" name="myOptions['+x+'][]"/><a href="#" class="remove_field_options">Remove option</a></div>' +
				'<div class="options"><label>&nbsp;</label><span class="move">Option</span><input type="text" name="myOptions['+x+'][]"/><a href="#" class="remove_field_options">Remove option</a></div>' +
				'</div>'); //add options
		});
		
		$(wrapper).on("click",".add_options", function(e){ //adds options to multiple options
			e.preventDefault(); 
			var bid = $(this).parent('div').attr('id'); //gets parent id for grouping
			$(this).parent('div').append('<div class="options"><label>&nbsp;</label><span class="move">Option</span><input type="text" name="myOptions['+bid+'][]"/><a href="#" class="remove_field_options">Remove option</a></div>');

		});
		
		
		$(add_button_feedback).click(function(e){ //on add feedback button click
			e.preventDefault();
			x++;
				$(wrapper).append('<div class="buttons" id='+x+'><span class="move">'+x+'</span>' +
				'<label>Feedback</label><input type="text" name="myLabel['+x+']"/> <select name="myText['+x+']"><option value="">Please select</option><option value="smileys-5">Smiley 5 Faces</option><option value="smileys-3">Smiley 3 Faces</option><option value="numeric-5">Numeric 5</option><option value="numeric-3">Numeric 3</option><option value="yes-no">Yes/No</option></select> ' +
				'<a href="#" class="remove_field">Remove</a>' +
				'</div>'); //add feedback
		});
		
		$(add_button_upload).click(function(e){ //upload button
			e.preventDefault();
			x++;
				$(wrapper).append('<div class="buttons" id='+x+'><span class="move">'+x+'</span>'+
				'<label>Upload</label><input type="text" name="myLabel['+x+']"/> <select name="myText['+x+']"><option value="">Please select</option><option value="upload">File</option><option value="image">Image</option></select>' +
				'<a href="#" class="remove_field">Remove</a></div>'
				 ); //add input box
		});
		
		$(add_button_section_break).click(function(e){ //on add single line button for section break
			e.preventDefault();
			x++;
				$(wrapper).append('<div class="buttons" id='+x+'><span class="move">'+x+'</span><input type="hidden" name="myText['+x+']" value="sectionbreak"/><label>Section Break</label><input type="text" name="myLabel['+x+']"/><a href="#" class="remove_field">Remove</a></div>'); //add input box section break
		});
		
		$(add_button_yes_no_na).click(function(e){ //on add single line button for yes_no_na
			e.preventDefault();
			x++;
				$(wrapper).append('<div class="buttons" id='+x+'><span class="move">'+x+'</span><input type="hidden" name="myText['+x+']" value="yna"/><label>Yes/No/NA</label><input type="text" name="myLabel['+x+']"/><a href="#" class="remove_field">Remove</a></div>'); //add input box yes_no_na
		});
		
		$(add_button_yes_no).click(function(e){ //on add single line button for yes_no
			e.preventDefault();
			x++;
				$(wrapper).append('<div class="buttons" id='+x+'><span class="move">'+x+'</span><input type="hidden" name="myText['+x+']" value="yn"/><label>Yes/No</label><input type="text" name="myLabel['+x+']"/><a href="#" class="remove_field">Remove</a></div>'); //add input box yes_no
		});
		
		$(add_button_true_false).click(function(e){ //on add single line button for true_false
			e.preventDefault();
			x++;
				$(wrapper).append('<div class="buttons" id='+x+'><span class="move">'+x+'</span><input type="hidden" name="myText['+x+']" value="tf"/><label>True/False</label><input type="text" name="myLabel['+x+']"/><a href="#" class="remove_field">Remove</a></div>'); //add input box true_false
		});
		
		$(wrapper).on("click",".remove_field", function(e){ //removes entire container divs for whole elements
			e.preventDefault(); $(this).parent('div').remove();

		});
		
		$(wrapper).on("click",".remove_field_options", function(e){ //removes options for multiple options containers
			e.preventDefault(); $(this).parent('div').remove();

		});
		
	});
	
	//do sorting of blocks
	$(function(){
		$('#move-buttons').sortable({ 
			placeholder: "ui-state-highlight",
			helper:"clone",
			cursor: "move"
		});
	});
	
	$(function(){
		$('#move-buttons1').sortable({ 
			placeholder: "ui-state-highlight",
			helper:"clone",
			cursor: "move"
		});
	});
	
	//do form submission
	$(document).ready(function()
	{
		$("#simple-post").click(function()
		{
			$("#ajaxform").submit(function(e)
			{
				var postData = $(this).serializeArray();
				var formURL = $(this).attr("action");
				$.ajax(
				{
					url : formURL,
					type: "POST",
					data : postData,
					success:function(data, textStatus, jqXHR) 
					{
						$("#simple-msg").html('<pre>'+data+'</pre>');
						$(".errors").delay(3000).fadeOut("slow", function() {
							$(this).remove();
						});

					},
					error: function(jqXHR, textStatus, errorThrown) 
					{
						$("#simple-msg").html('<pre>AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</pre>');
					}
				});
				e.preventDefault();	//STOP default action
				e.unbind();
			});
				
			$("#ajaxform").submit(); //SUBMIT FORM
		});
	});
	
	
		//do form submission
	$(document).ready(function()
	{
		$("#simple-post1").click(function()
		{
			$("#ajaxform1").submit(function(e)
			{
				var postData = $(this).serializeArray();
				var formURL = $(this).attr("action");
				$.ajax(
				{
					url : formURL,
					type: "POST",
					data : postData,
					success:function(data, textStatus, jqXHR) 
					{
						$("#simple-msg1").html('<pre>'+data+'</pre>');
						$(".errors").delay(3000).fadeOut("slow", function() {
							$(this).remove();
						});

					},
					error: function(jqXHR, textStatus, errorThrown) 
					{
						$("#simple-msg1").html('<pre>AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</pre>');
					}
				});
				e.preventDefault();	//STOP default action
				e.unbind();
			});
				
			$("#ajaxform1").submit(); //SUBMIT FORM
		});
	});