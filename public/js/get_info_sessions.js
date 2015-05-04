
function get_info_click(button)
{
	var db_id = $(button).attr("db_id");
	var url = $("#UserInfoSessionsCreate").val();
	var jqxhr = $.get( url, {stock: "1", fk_user_access_profiles: db_id.toString()}, function(data) {
		refresh_info_session_request();
	})
	.fail(function(data) {
		alert( data );
	});
}

function remove_info_click(button)
{
	$(button).hide();
	var unique_key = $(button).attr("unique_key");
	var url = $("#UserInfoSessionsDestroy").val() + "/2343234";
	var csrf_token = $("#csrf_token").val();
	var jqxhr = $.ajax({url: url, data: {unique_key: unique_key, _token: csrf_token}, type: 'DELETE',
	success: function(data) {
		refresh_info_session_request();
	}})
	.fail(function(data) {
		alert( data );
	});
}

function refresh_info_session_request(evt)
{
	//var db_id = $(evt.target).attr("db_id");
	var url = $("#UserInfoSessionsShow").val() + "/";
	var jqxhr = $.get( url, {}, function(data) {
		var data = jQuery.parseJSON(data);
		refresh_info_session(data);
	})
	.fail(function(data) {
		alert( data );
	});
}

function add_data(data)
{
	var qr_div_template = document.getElementById('qr_code_invdividual_template');

	for (var i = 0; i < data.length; i++)
	{
		var profile = data[i].fk_user_access_profiles;
		var unique_key = data[i].unique_key;
		var profile_DOM = $('#profile'+profile);
		if (profile_DOM.length > 0)
		{
			var qr_div_id = "qr_div"+unique_key;
			var qr_div = $("#"+qr_div_id);
			if (!qr_div.length > 0)
			{
				var cloned_div = qr_div_template.cloneNode(true);
				$(cloned_div).attr("id",qr_div_id);
				$(cloned_div).attr("unique_key",unique_key);
				$(cloned_div).addClass("qr_div_showing");
				$(cloned_div).find("button").attr("id","qr_button"+unique_key);
				$(cloned_div).find("button").attr("unique_key",unique_key);
				$(cloned_div).find(".qr_code_individual_img").attr("id","qr_img"+unique_key);
				$(cloned_div).find(".qr_code_individual_img").attr("src","https://api.qrserver.com/v1/create-qr-code/?size=300x300&data="+unique_key);
				$(cloned_div).find(".qr_code_individual_img").attr("alt",unique_key);
				$(cloned_div).find(".p_unique_key").html(unique_key);
				$(cloned_div).css("display","inline-block");

				profile_DOM.append(cloned_div);
			}
		}
	}
}

function key_exists(data, key)
{
	for (var i = 0; i < data.length; i++)
		if (data[i].unique_key == key) return true;
	return false;
}

function remove_data(data)
{
	$(".qr_div_showing").each(function(key, value)
	{
		var unique_key = $(value).attr("unique_key");
		var exists = key_exists(data, unique_key);
		if (!exists)
		{
			$(value).remove();
		}
		var ikid;
	});
}

function refresh_info_session(data)
{
	add_data(data);
	remove_data(data);
}

$(document).ready(refresh_info_session_request)
