
$.fn.serializeObject = function() {
	var o = {};
	var a = this.serializeArray();
	$.each(a, function() {
		if (o[this.name]) {
			if (!o[this.name].push) {
				o[this.name] = [o[this.name]];
			}
			o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
	});
	return o;
};

$(function(){
	$("form").submit(function(){
		if ($(this).find("input[name^='monsters']:checked").length === 0)
		{
			createAlert($(this).data("no_monsters"), "error");

			return false;
		}
	});
});
