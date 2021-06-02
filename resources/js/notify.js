console.log('##NOTIFY##');
console.log(Notification.permission);
// request permission on page load
document.addEventListener('DOMContentLoaded', function() {
	if (!Notification) {
		alert('Desktop notifications not available in your browser. Try Chromium.');
		return;
	}

	if (Notification.permission !== 'granted')
		Notification.requestPermission();
	else
		notifyMe();
});

const showNotification = (title, body, icon=false) => {
	if(icon == false)
		icon = '/favicon.ico';

	var notification = new Notification(title, {
		icon: icon,
		body: body,
	});
	notification.onclick = function() {
		// window.open('http://stackoverflow.com/a/13328397/1269037');
	};
}

const getInfoFromApi = () => {
	$.ajax({
		url: '/calendar/check',
		type: 'GET',
		dataType: 'json',
		data: {},
	})
	.done(function(data) {
		console.log(data);
	})
	.fail(function() {
		displayToast('Greska na serveru', 'Prije 26 sekundi', 'Server je vratio gresku 500');
	})
	
}


function notifyMe() {
	if (Notification.permission !== 'granted')
		Notification.requestPermission();
	else {
		displayToast('Greska na serveru', 'Prije 26 sekundi', '<B>Server je vratio gresku 500, probajte opet kasnije</B><br>');
	}
}