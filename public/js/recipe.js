function selectTag         ( site, id, name )   { window.location.href = site.url.setPath( '/api/SelectTag'          ).addQueryParam('tag['        + id + ']', name ).toString(); return false; }
function unselectTag       ( site, id, name )   { window.location.href = site.url.setPath( '/api/UnselectTag'        ).addQueryParam('tag['        + id + ']', name ).toString(); return false; }
function addTag            ( entry_id, tag_id ) { var path = site.url.path(); window.location.href = site.url.setPath( '/api/AddTag').addQueryParam('href', path).addQueryParam('entry_id', entry_id).addQueryParam('tag_id', tag_id ).toString(); return false; }
function delTag            ( entry_id, tag_id ) { var path = site.url.path(); window.location.href = site.url.setPath( '/api/DelTag').addQueryParam('href', path).addQueryParam('entry_id', entry_id).addQueryParam('tag_id', tag_id ).toString(); return false; }

function newTagEdit() { $('#newTagModal').modal('show'); return false; }
function assignTags() { 
	$('#tags_text').val('');
	$('#tags').find('option').remove().end();
	$('#assignTagsModal').modal('show');
	return false;
}
function assingFoundTags(entry_id){

	$('#tags option').prop('selected', true);
	var settings = { 
		entry_id: entry_id,
		tag_ids: $('#tags').val() 
	};
	$.ajax({
    		type: 'POST',
    		url: '/api/AssignTags',
    		data: settings
	}).done(function(responce) {
		$('#assignTagsModal').modal('hide');
		window.location.reload(true);
	}).fail(function(responce) {
		
	});
	return false; 
}
function findTags() {
	var settings = { 
	    tags_text: $('#tags_text').val() 
	};

	$.ajax({
   	    type: 'POST',
    	    url: '/api/FindTags',
    	    data: settings
	}).done(function(responce) {
  	    var obj = $.parseJSON(responce);
	    if (obj.result == 1) {
	        $.each( obj.data.tags, function( key, value ) {
	        
		    $('#tags option[value=' + value.tag_id + ']').remove();
	  	    $('#tags').append($('<option>', { value: value.tag_id, text : value.tag_name }));

		});
		$('#tags').attr('size', obj.length);
	    }
	}).fail(function(responce) {
		
	});

	return false; 
}
function newTag() { 

	$('#newTagModal').modal('hide');

	var settings = { 
		href: site.url.path(), 
		tag_name: $('#new_tag_name').val(), 
		tag_text: $('#new_tag_text').val(), 
		tag_group_id: $('#new_tag_group_id').val()
	};

	$.ajax({
    		type: 'POST',
    		url: '/api/NewTag',
    		data: settings
	}).done(function(responce) {
		window.location.reload(true);
	}).fail(function(responce) {
		
	});

	return false; 
}
$( document ).ready(function() {

	$("#tags").keydown(function(event) {
		if (event.which != 46) { return; }
    		var sel = $(this);
    		var val = sel.val();
    		if (val != "") { sel.find("option[value="+val+"]").remove(); }
	});

});

var Query=function(a){"use strict";var b=function(a){var b=[],c,d,e,f;if(typeof a=="undefined"||a===null||a==="")return b;a.indexOf("?")===0&&(a=a.substring(1)),d=a.toString().split(/[&;]/);for(c=0;c<d.length;c++)e=d[c],f=e.split("="),b.push([f[0],f[1]]);return b},c=b(a),d=function(){var a="",b,d;for(b=0;b<c.length;b++)d=c[b],a.length>0&&(a+="&"),a+=d.join("=");return a.length>0?"?"+a:a},e=function(a){a=decodeURIComponent(a),a=a.replace("+"," ");return a},f=function(a){var b,d;for(d=0;d<c.length;d++){b=c[d];if(e(a)===e(b[0]))return b[1]}},g=function(a){var b=[],d,f;for(d=0;d<c.length;d++)f=c[d],e(a)===e(f[0])&&b.push(f[1]);return b},h=function(a,b){var d=[],f,g,h,i;for(f=0;f<c.length;f++)g=c[f],h=e(g[0])===e(a),i=e(g[1])===e(b),(arguments.length===1&&!h||arguments.length===2&&!h&&!i)&&d.push(g);c=d;return this},i=function(a,b,d){arguments.length===3&&d!==-1?(d=Math.min(d,c.length),c.splice(d,0,[a,b])):arguments.length>0&&c.push([a,b]);return this},j=function(a,b,d){var f=-1,g,j;if(arguments.length===3){for(g=0;g<c.length;g++){j=c[g];if(e(j[0])===e(a)&&decodeURIComponent(j[1])===e(d)){f=g;break}}h(a,d).addParam(a,b,f)}else{for(g=0;g<c.length;g++){j=c[g];if(e(j[0])===e(a)){f=g;break}}h(a),i(a,b,f)}return this};return{getParamValue:f,getParamValues:g,deleteParam:h,addParam:i,replaceParam:j,toString:d}},Uri=function(a){"use strict";var b=!1,c=function(a){var c={strict:/^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,loose:/^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/},d=["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],e={name:"queryKey",parser:/(?:^|&)([^&=]*)=?([^&]*)/g},f=c[b?"strict":"loose"].exec(a),g={},h=14;while(h--)g[d[h]]=f[h]||"";g[e.name]={},g[d[12]].replace(e.parser,function(a,b,c){b&&(g[e.name][b]=c)});return g},d=c(a||""),e=new Query(d.query),f=function(a){typeof a!="undefined"&&(d.protocol=a);return d.protocol},g=null,h=function(a){typeof a!="undefined"&&(g=a);return g===null?d.source.indexOf("//")!==-1:g},i=function(a){typeof a!="undefined"&&(d.userInfo=a);return d.userInfo},j=function(a){typeof a!="undefined"&&(d.host=a);return d.host},k=function(a){typeof a!="undefined"&&(d.port=a);return d.port},l=function(a){typeof a!="undefined"&&(d.path=a);return d.path},m=function(a){typeof a!="undefined"&&(e=new Query(a));return e},n=function(a){typeof a!="undefined"&&(d.anchor=a);return d.anchor},o=function(a){f(a);return this},p=function(a){h(a);return this},q=function(a){i(a);return this},r=function(a){j(a);return this},s=function(a){k(a);return this},t=function(a){l(a);return this},u=function(a){m(a);return this},v=function(a){n(a);return this},w=function(a){return m().getParamValue(a)},x=function(a){return m().getParamValues(a)},y=function(a,b){arguments.length===2?m().deleteParam(a,b):m().deleteParam(a);return this},z=function(a,b,c){arguments.length===3?m().addParam(a,b,c):m().addParam(a,b);return this},A=function(a,b,c){arguments.length===3?m().replaceParam(a,b,c):m().replaceParam(a,b);return this},B=function(){var a="",b=function(a){return a!==null&&a!==""};b(f())?(a+=f(),f().indexOf(":")!==f().length-1&&(a+=":"),a+="//"):h()&&b(j())&&(a+="//"),b(i())&&b(j())&&(a+=i(),i().indexOf("@")!==i().length-1&&(a+="@")),b(j())&&(a+=j(),b(k())&&(a+=":"+k())),b(l())?a+=l():b(j())&&(b(m().toString())||b(n()))&&(a+="/"),b(m().toString())&&(m().toString().indexOf("?")!==0&&(a+="?"),a+=m().toString()),b(n())&&(n().indexOf("#")!==0&&(a+="#"),a+=n());return a},C=function(){return new Uri(B())};return{protocol:f,hasAuthorityPrefix:h,userInfo:i,host:j,port:k,path:l,query:m,anchor:n,setProtocol:o,setHasAuthorityPrefix:p,setUserInfo:q,setHost:r,setPort:s,setPath:t,setQuery:u,setAnchor:v,getQueryParamValue:w,getQueryParamValues:x,deleteQueryParam:y,addQueryParam:z,replaceQueryParam:A,toString:B,clone:C}},jsUri=Uri;

function Util(parent) { this.parent = parent; }
Util.prototype.trim      = function (str) { return this.ltrim(this.rtrim(str)); }
Util.prototype.ltrim     = function (str) { var result = ""; if (str != null) { result = str; }  return result.replace(/^\s+/,""); }
Util.prototype.rtrim     = function (str) { var result = ""; if (str != null) { result = str; }  return result.replace(/\s+$/,""); }
Util.prototype.encode    = function (str) { return escape(str); }
Util.prototype.decode    = function (str) { return unescape(str); }

function Site() { 
	this.url  = new Uri  (window.location.href); 
	this.util = new Util (this); 
}
var site = new Site();
