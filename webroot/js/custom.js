Math.clamp = function (value, min, max) {

	if (value > max) {
		return max;
	}
	else if (value < min) {
		return min;
	}

	return value;
};

Math.lerp = function (value1, value2, amount) {
	amount = amount < 0 ? 0 : amount;
	amount = amount > 1 ? 1 : amount;
	return Math.clamp((value1 + Math.max(1, (value2 - value1) * amount)), value1, value2);
};

function updateNumbersHome()
{
	var numbers = $("#numbers");

	if (numbers.length > 0)
	{
		var items = numbers.find(".item");

		items.find("p").each(function(){
			var min = 100;
			var max = 1000;

			var generatedNumber = Math.max(min, Math.floor((Math.random() * max)));

			animateNumber($(this), generatedNumber);
		});
	}
}

function animateNumber(element, numberMax)
{
	var value = parseInt(element.text());
	var newValue = Math.floor(Math.lerp(value, numberMax, 0.1));

	function getAnimationTime(newValue, numberMax) {
		return 50 + ((newValue * 100) / numberMax) * 2;
	}

	element.text(newValue);

	if (value !== numberMax)
	{
		var animationTime = getAnimationTime(newValue, numberMax);
		setTimeout(animateNumber, animationTime, element, numberMax);
	}
}

$(function(){
	updateNumbersHome();
});
