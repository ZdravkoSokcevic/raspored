// request permission on page load
const registerNotifications = () => {
	if (!Notification) {
		alert('Desktop notifications not available in your browser. Try Chromium.');
		return;
	}

	if (Notification.permission !== 'granted')
		Notification.requestPermission();
	// else
		// notifyMe();
}

const showNotification = async(title, body, icon=false) => {
	let enabled = await(localStorage.getItem('notifications'));
	if(enabled == 'enabled')
	{
		if(icon == false)
			icon = '/favicon.ico';

		var notification = new Notification(title, {
			icon: icon,
			body: body,
		});
		notification.onclick = function() {
			// Notification click here
		};
	}
}

const toggleNotificationsOnOff = (el) => {
	let enabled = el.checked;
	let notifications = enabled? 'enabled' : 'disabled';
	localStorage.setItem('notifications', notifications);
}

const checkIfNotificationsEnabled = () => {
	let el = document.getElementById('notifiactions');
	console.log('checkIfNotificationsEnabled');
	let notificationsEnabled = localStorage.getItem('notifications');
	notificationsEnabled = (notificationsEnabled && notificationsEnabled == 'enabled')? true:false;
	if(notificationsEnabled)
		el.setAttribute('checked', 'checked');
	else el.removeAttibute('checked');
}