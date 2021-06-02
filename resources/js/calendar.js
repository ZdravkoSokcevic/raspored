const refreshPageIfNeeded = () => {
	let timeSpan = document.getElementsByClassName('time-span')[0];
	if(timeSpan)
	{
		timeSpan = timeSpan.innerHTML;
		let time = moment(new Date()).format('DD.MM.YYYY');
		if(time.trim() != timeSpan.trim())
			window.location.reload();
	}
}

const markAsUndrinked = () => {
	
}

document.addEventListener('DOMContentLoaded', function(){
	let element = document.getElementById('current-time');
	console.log(element);
	if(element)
		$('#' + element.getAttribute('id'))[0].scrollIntoView();

	setInterval(() => {
		// refreshPageIfNeeded();
		// markAsUndrinked();
	}, 10000)
})