var id;
var row;
function addFormField() {
	if(!id) { id = INITIAL_COUNT; } else { id++; }
	
	$("#divTxt").append("<div id='item_'><div id='row" + id + "' class='row'>"+	
	"<label for='input_name" + id + "'>Question " + id + ":&nbsp;&nbsp;</label>" +
	'<div class="col_label">' +
	"<input type='text' size='20' name='input_label["+id+"]' id='input_label" + id + "'>&nbsp;&nbsp" +
	'</div>' +
	'<div class="col_input_type">' +
	'<select name="input_type['+id+']" id="input_type' + id + '" class="input_type" >'+
	'  <option value="0">Please Select</option> '+
	'  <option value="chkbox">Check Box</option> '+
	'  <option value="num">Numeric Field</option>'+
	'</select>'+
	'</div>' +
	'<div class="col_reqd">' +
	'<select name="reqd['+id+']" id="reqd' + id + '" class="input_type" >'+
	'  <option value="1">Yes</option>'+
	'  <option value="0">No</option> '+
	'</select>'+
	'</div>' +
	'<div class="col_remove">' +
	"<a href='#' onClick='removeFormField(\"#row" + id + "\"); return false;'><img src='"+ MEDIA_URL +"console/_images/delete.gif'  alt='Remove' title='Remove' /></a>" +
	'</div>' +
	'<div class="clear"></div>' +
	'<div class="col_extra_values" id="col_extra_values'+id+'">'+
	'<span class="text_black_bold">Range Lower</span> ' +
	"<input type='text' size='10' name='extra_values["+id+"][0]' value='' class='sm'> " +
	'&nbsp;&nbsp;<span class="text_black_bold">Range Upper</span> '
	+ "<input type='text' size='10' name='extra_values["+id+"][1]' value='' class='sm'> " +
	'</div>' +
	'<div class="clear"></div>' +
	'</div>');
}

function removeFormField(id) {
	$(id).remove();
	var current_inputs_count = $("#input_counter").val();
	var new_inputs_count = parseFloat(current_inputs_count) - 1;
	$("#input_counter").val(new_inputs_count);
	$("#remove_id".id).val("remove");
}