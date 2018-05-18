function getEntryObject(entry_id) {
	var entry_text_content = $("#entry_text").val();
	var entry_name_content = $("#entry_name").val();
	return { entry_id: entry_id, entry_name: entry_name_content, entry_text: entry_text_content };
}
function saveNewEntry() {
	var obj = getEntryObject('');
	$.ajax({
        	type: "POST",
	        url: "/api/SaveNewEntry/",
        	data: obj
	}).fail(function(data) {
		alert("New entry saving error!");
	}).done(function(data) {
		location.href = '/entry/edit/'+ data;
	});
}

function saveEntry( entry_id ) {
	var obj = getEntryObject(entry_id);
	$.ajax({
        	type: "POST",
	        url: "/api/SaveEntry/" + entry_id,
        	data: obj
	}).fail(function(data) {
		alert("Entry saving error!");
	}).done(function(data) {
		location.reload(true);
	});
}
