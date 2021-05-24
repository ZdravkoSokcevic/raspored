document.addEventListener('DOMContentLoaded', function(){
	let element = document.getElementById('current-time');
	$('#' + element.getAttribute('id'))[0].scrollIntoView();
})