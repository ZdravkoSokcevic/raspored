const string_title_tea_used = 'Potvrda uzimanja caja';
const string_title_tea_not_used = 'Otkazivanje caja';
const string_title_drops_used = 'Potvrda uzimanja kapi';
const string_title_drops_not_used = 'Otkazivanje uzimanja kapi';
const string_tea_used = `<p>Popili ste caj <span>{$tea}</span> u vrijeme <span>{$time}</span>.</p>
        <p>Zelite li da potvrdite?</p>`;
const string_tea_not_used = `<p>Ipak niste popili caj <span>{$tea}</span> u vrijeme <span>{$time}</span>.</p>
        <p>Zelite li da obriste da ste popili?</p>`;
const string_drops = `<p>Popili ste kapi <span>{$tea}</span> u vrijeme <span>{$time}</span>.</p>
        <p>Zelite li da potvrdite?</p>`;
const string_drops_not_used = `<p>Ipak niste popili kapi <span>{$tea}</span> u vrijeme <span>{$time}</span>.</p>
        <p>Zelite li da potvrdite?</p>`;

const usedTeaElement = '<i class="fa fa-check text-primary"></i>';
const unusedTeaElement = '<i class="fa fa-times text-danger"></i>';
var isRequestInProcess = false;

const calendarApi = (element, data, modal) => {
	if(!isRequestInProcess)
	{
		isRequestInProcess = true;
		$.ajax({
			url: '/calendar',
			type: 'POST',
			dataType: 'json',
			data: data,
			headers: {

			},
			success: function(response) {
				console.log('Response');
				console.log(response)
				console.log(element);
				if(response && response.success && response.success == 'true') {
					element.innerHTML = usedTeaElement;
					element.setAttribute('data-used-status', 1);
					modal.modal('hide');
					console.log('True');
					isRequestInProcess = false;
				}else {
					isRequestInProcess = false;
					console.log('false');
				}
			}
		})
		.done(function(data) {
		})
		.fail(function(error) {
			console.log("fail")
			console.log(error);
		})
	}else {
		setTimeout(calendarApi(element,data, modal), 250);
	}
}

const calendarDeleteApi = (element, data, modal) => {
	console.log('tu si');
	if(!isRequestInProcess)
	{
		isRequestInProcess = true;
		$.ajax({
			url: '/calendar',
			type: 'DELETE',
			dataType: 'json',
			data: data,
			success: function(response) {
				if(Response && response.success && response.success == 'true') {
					element.innerHTML = unusedTeaElement;
					element.setAttribute('data-used-status', 2);
					modal.modal('hide');
				}
				isRequestInProcess = false;
			}
		})
		.fail(function() {
			console.log("error");
		})
		
	}else {
		setTimeout(calendarDeleteApi(element, data, modal), 250);
	}
}

const openModal = element => {

	let modal = $('#calendar-modal').clone();
	let modal_body = modal.find('.modal-body');
	let modal_title = modal.find('.modal-title');

	let tea = element.getAttribute('data-tea');
	let time = element.getAttribute('data-time');
	let date = element.getAttribute('data-date');
	// status - 1 used, 2,3,4 not used
	let status = element.getAttribute('data-used-status');
	let date_timestamp = element.getAttribute('data-date-timestamp');
	let modal_content = '';
	let modal_title_text = '';
	let used = ((status != '1'));
	console.log(used);
	if(status == '1') {
		modal.find('.submit-btn').removeClass('btn-primary');
		modal.find('.submit-btn').addClass('btn-danger');
	}
	console.log(status);
	switch(tea)
	{
		case 'I':
		case 'II':
		{
			if(used)
			{
				modal_content = string_drops;
				modal_title_text = string_title_tea_used;
				break;
			}else {
				modal_content = string_drops_not_used;
				modal_title_text = string_title_tea_not_used;
			}
		}
		case '143':
		case '11':
		case '55':
		{
			if(used)
			{
				modal_content = string_tea_used;
				modal_title_text = string_title_tea_used;
				break;
			}else {
				modal_content = string_tea_not_used;
				modal_title_text = string_title_tea_not_used;
			}
		}
	}

	// For tea type
	modal_content = modal_content.replace('{$tea}', tea);
	modal_content = modal_content.replace('{$time}', time);
	console.log(tea, time, date);
	modal.modal();
	modal_title.html(modal_title_text);
	modal_body.html(modal_content);
	modal_title = modal_title_text;
	let data = {
		tea: tea,
		date: date,
		time: time,
		date_timestamp: date_timestamp,
		_token: csrf,
		status: status
	}


	modal.find('.submit-btn').click(function () {
		if(status != '1')
			calendarApi(element, data, modal);
		else calendarDeleteApi(element,data, modal);
		
	})
	// .always(function() {
	// 	console.log("complete");
	// });
}

