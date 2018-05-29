function createAlert(message, type)
{
	if (typeof(type) === "undefined" ||
		type === "default")
		type = "primary";
	else if (type === "error")
		type = "danger";

	alertHtml =
		'<div class="alert alert-' + type + ' alert-icon-block alert-dismissible" role="alert" data-dismiss="alert">\n' +
		'\t<div class="alert-icon">\n' +
		'\t\t<span class="icon-menu-circle fa fa-warning"></span>\n' +
		'\t</div>\n' +
		'\t<strong>Ooops...</strong> ' + message + '\n' +
		'\t<div class="close" aria-label="Close">\n' +
		'\t\t<span class="fa fa-times"></span>\n' +
		'\t</div>\n' +
		'</div>';

	$(".alerts").append(alertHtml);
}

$(function(){
	// Include All Checkbox Action
	$("#include-all").change(function(){
		var checked = $(this).is(":checked");

		$("form")
			.find("input[type=checkbox]")
			.prop("checked", checked);
	}).change();

	// Fix checked checkboxes
	$("input[type=checkbox]").each(function(){
		if ($(this).attr("checked"))
		{
			var id = $(this).attr("id");
			$("label[for='" + id + "']").click();
		}
	});
});
