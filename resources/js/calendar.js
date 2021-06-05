const processUndrinkedTees = (data) => {
	for(prop in data) {
		console.log(prop, data);
		data[prop].forEach(time => {
			showNotification('Caj '+ prop + ' niste popili u ' + time, '');
		})
	}
}
const checkUndrinkedTees = () => {
	$.ajax({
		url: '/calendar/check',
		type: 'GET',
		dataType: 'json',
		data: {},
	})
	.done(function(response) {
		if(response && response.data) {
			processUndrinkedTees(response.data);
		}else {
			displayToast('Greska na serveru', 'Server nije dostupan', 'error');
		}
	})
	.fail(function(error) {
		displayToast('Greska na serveru', 'Server nije dostupan', 'error');
	});
	
}
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

document.addEventListener('DOMContentLoaded', function(){
	registerNotifications();
	let element = document.getElementById('current-time');
	if(element)
		$('#' + element.getAttribute('id'))[0].scrollIntoView();
	checkUndrinkedTees();
	setInterval(() => {
		// refreshPageIfNeeded();
		checkUndrinkedTees();
	}, 1000*60);
})