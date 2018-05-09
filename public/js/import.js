function dstConnectionNone(){ $('.destination-settings-' + $('#destinationType').val() ).removeClass("is-valid"); $('.destination-settings-' + $('#destinationType').val() ).removeClass("is-invalid"); }
function dstConnectionOk(){ dstConnectionNone(); $('.destination-settings-' + $('#destinationType').val() ).addClass("is-valid"); }
function dstConnectionFailed(){ dstConnectionNone(); $('.destination-settings-' + $('#destinationType').val() ).addClass("is-invalid"); }
function updateDestinationSettings(){
	$('.destination-settings-line').hide(); 
	var type = $('#destinationType').val();
	$('.destination-settings-' + type + "-line" ).show(); 
	if ("sql" == type ) {
		loadDestinationTableList();
	}
}

function dstTestConnection(){
	dstConnectionNone();
	var settings = { 
		type : $('#destinationType').val(),
		host : $('#destinationHost').val(),
		user : $('#destinationUser').val(),
		pass : $('#destinationPass').val(),
		name : $('#destinationDB').val(),
		table: $('#destinationTable').val(),
		code : $('#destinationEncoding').val(),
		url  : $('#destinationUrl').val()
	};
	$.ajax({
    		type: 'POST',
    		url: '/import/test/connection',
    		data: settings
	}).done(function(responce) {
		if ( "1" == responce ) { dstConnectionOk(); } else { dstConnectionFailed(); }
	}).fail(function(responce) {
		dstConnectionFailed();
	});
}


function srcConnectionNone(){ $('.source-settings-' + $('#sourceType').val() ).removeClass("is-valid"); $('.source-settings-' + $('#sourceType').val() ).removeClass("is-invalid"); }
function srcConnectionOk(){ srcConnectionNone(); $('.source-settings-' + $('#sourceType').val() ).addClass("is-valid"); }
function srcConnectionFailed(){ srcConnectionNone(); $('.source-settings-' + $('#sourceType').val() ).addClass("is-invalid"); }
function updateSourceSettings(){
	$('.source-settings-line').hide(); 
	var type = $('#sourceType').val();
	$('.source-settings-' + type + "-line" ).show(); 
}

function srcTestConnection(){
	srcConnectionNone();
	var settings = { 
		type : $('#sourceType').val(),
		host : $('#sourceHost').val(),
		user : $('#sourceUser').val(),
		pass : $('#sourcePass').val(),
		name : $('#sourceDB').val(),
		table: $('#sourceTable').val(),
		code : $('#sourceEncoding').val(),
		url  : $('#sourceUrl').val()
	};
	$.ajax({
    		type: 'POST',
    		url: '/import/test/connection',
    		data: settings
	}).done(function(responce) {
		if ( "1" == responce ) { srcConnectionOk(); } else { srcConnectionFailed(); }
	}).fail(function(responce) {
		srcConnectionFailed();
	});
}


$( document ).ready(function() {
	updateSourceSettings();	
	srcConnectionNone();

	updateDestinationSettings();
	dstConnectionNone();

	$('.destination-settings').mousedown(function() {
		dstConnectionNone();
	});
	$('.source-settings').mousedown(function() {
		srcConnectionNone();
	});
});
function loadDestinationTableList(){
	var type = $('#destinationType').val();
	if ("sql" == type) {
		var settings = { 
			type : $('#destinationType').val(),
			host : $('#destinationHost').val(),
			user : $('#destinationUser').val(),
			pass : $('#destinationPass').val(),
			name : $('#destinationDB').val(),
			table: $('#destinationTable').val(),
			code : $('#destinationEncoding').val()
		};
		$.ajax({
    	    		type: 'POST',
    	    		url: '/import/tablelist',
    	    		data: settings
		}).done(function(responce) {
			updateDestinationTableList(responce);
		}).fail(function(responce) {
			
		});
	}
}
function updateDestinationTableList(json_data){
	var tables = $.parseJSON(json_data);
	$.each(tables, function(key, value) {   
     		$('#destinationTable').append($("<option></option>").attr("value",value['table_name']).text(value['table_name'])); 
	});
	loadDestinationTable();
}
function loadDestinationTable(){
	var type = $('#destinationType').val();
	if ("sql" == type) {
		var settings = { 
			type : $('#destinationType').val(),
			host : $('#destinationHost').val(),
			user : $('#destinationUser').val(),
			pass : $('#destinationPass').val(),
			name : $('#destinationDB').val(),
			table: $('#destinationTable').val(),
			code : $('#destinationEncoding').val()
		};
		$.ajax({
    	    		type: 'POST',
    	    		url: '/import/table',
    	    		data: settings
		}).done(function(responce) {
			updateDestinationTable(responce);
		}).fail(function(responce) {
			
		});
	}
}
function updateDestinationTable(json_data){
	var tables = $.parseJSON(json_data);
	$.each(tables, function(key, value) {   
     		$('#destinationTable').append($("<option></option>").attr("value",value['table_name']).text(value['table_name'])); 

// "COLUMN_NAME":"entry_id",
// "ORDINAL_POSITION":"1",
// "COLUMN_DEFAULT":null,
// "IS_NULLABLE":"NO",
// "DATA_TYPE":"int",
// "CHARACTER_MAXIMUM_LENGTH":null,
// "CHARACTER_OCTET_LENGTH":null,
// "NUMERIC_PRECISION":"10",
// "NUMERIC_SCALE":"0",
// "DATETIME_PRECISION":null,
// "CHARACTER_SET_NAME":null,
// "COLLATION_NAME":null,
// "COLUMN_TYPE":"int(11)",
// "COLUMN_KEY":"PRI",
// "EXTRA":"auto_increment",
// "PRIVILEGES":"select,insert,update,references",
// "COLUMN_COMMENT":""

		var column_name = value['COLUMN_NAME']; var column_name_element = '<td class="rule rule_field rule_name" id="rule_name_'+column_name+'">'+column_name+'</td>';
		var column_type = value['COLUMN_TYPE']; var column_type_element = '<td class="rule rule_field rule_type" id="rule_type_'+column_name+'">'+column_type+'</td>';
		

		var column_key_element  = '<td class="rule rule_field rule_key"  id="rule_key_' +column_name+'"><input class="rule rule_key_value form-check-input" type="checkbox"  onclick="setKey(\'' +column_name+ '\');"  id="key_'+column_name+'"/></td>';
		var column_code_element = '<td class="rule rule_field rule_code" id="rule_code_'+column_name+'"><textarea onmouseup="openModalEditor(\'' +column_name+ '\');" cols="100" rows="2" class="rule rule_field_value form-control form-control-sm" data-for="'+column_name+'" id="'+column_name+'"/></td>';
		var row = '<tr class="rule rule_line" id="rule_line_'+column_name+'">'+column_name_element + column_type_element + column_key_element + column_code_element + '</tr>';
		$('#importTableRule > tbody:last-child').append(row);
	});
}



function cleanSettings(){
	$('.source-settings').val('');
	$('.destination-settings').val('');
	$('.rule_field_value').val('');
	$('.general-settings').val('');
}

function saveImportSettings(){

	var settings = { src:{}, dst:{}, rule:{}, key:{}, settings:{} };
	$('.source-settings').each( function( i, field ) {
      		settings['src'][field.id] = field.value;
    	});
	$('.destination-settings').each( function( i, field ) {
      		settings['dst'][field.id] = field.value;
    	});
	$('.rule_key_value').each( function( i, field ) {
      		settings['key'][field.id] = field.checked;
    	});
	$('.rule_field_value').each( function( i, field ) {
      		settings['rule'][field.id] = field.value;
    	});
	$('.general-settings').each( function( i, field ) {
      		settings['settings'][field.id] = field.value;
    	});
	//settings['settings']['ruleTitle'] = $('#ruleTitle').val();

	$.ajax({
    		type: 'POST',
    		url: '/import/save/settings',
    		data: settings
	}).done(function(responce) {

	}).fail(function(responce) {
		
	});
}
function loadImportSettings(rule_file_name){

	var settings = {rule_file_name: rule_file_name};

	$.ajax({
    		type: 'POST',
    		url: '/import/load/settings',
    		data: settings
	}).done(function(json_data) {
		applySettings(json_data);
	}).fail(function(responce) {
		
	});
}
function applySettings(json_data){
	cleanSettings();
	var root = $.parseJSON(json_data);
	$.each(root, function(key, value) {   
		$.each(value, function(key, value) {   
			if (key == 'key') { 
				$.each(value, function(key, value) {   
					$('#' + key).removeAttr('checked');
					if ( value['@cdata'] == 'true' ) { $('#' + key).attr('checked','checked'); };
				});	
			} else {
				$.each(value, function(key, value) {   
					$('#' + key).val(value['@cdata']);
				});	
			}
		});	
	});	

	$('.destination-settings-line').hide(); 
	var type = $('#destinationType').val();
	$('.destination-settings-' + type + "-line" ).show(); 

	$('.source-settings-line').hide(); 
	var type = $('#sourceType').val();
	$('.source-settings-' + type + "-line" ).show(); 

}
function startImport(){

	var settings = { src:{}, dst:{}, rule:{}, key:{}, settings:{} };
	settings['settings']['ruleTitle'] = $('#ruleTitle').val();

	$.ajax({
    		type: 'POST',
    		url: '/import/start',
    		data: settings
	}).done(function(responce) {
		alert(responce);
	}).fail(function(responce) {
		
	});
}

function openModalEditor(column_name) {
	$('#'+ column_name).focusout(function() {
    		$('#'+ column_name).attr('rows',2);
  	});
	$('#'+ column_name).attr('rows',50);
}
function setKey(column_name) {
	$('.rule_key_value').prop('checked', false);
	$('#key_'+column_name).prop('checked', true);
}