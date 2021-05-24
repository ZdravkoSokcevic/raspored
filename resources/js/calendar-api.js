const string_title_tea_used = 'Potvrda uzimanja caja';
const string_title_drops_used = 'Potvrda uzimanja kapi';
const string_tea_used = `<p>Popili ste caj <span>{$tea}</span> u vrijeme <span>{$time}</span>.</p>
        <p>Zelite li da potvrdite?</p>`;
const string_drops = `<p>Popili ste kapi <span>{$tea}</span> u vrijeme <span>{$time}</span>.</p>
        <p>Zelite li da potvrdite?</p>`;

const usedTeaElement = '<i class="fa fa-check text-primary"></i>';
const unusedTeaElement = '<i class="fa fa-times text-danger"></i>';

const calendarApi = (element, data) => {
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
				$('#calendar-modal').modal('hide');
				console.log('True');
			}else {
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
}

const openModal = element => {
	let tea = element.getAttribute('data-tea');
	let time = element.getAttribute('data-time');
	let date = element.getAttribute('data-date');
	// status - 1 used, 2,3,4 not used
	let status = element.getAttribute('data-used-status');
	let date_timestamp = element.getAttribute('data-date-timestamp');
	let modal_content = '';
	let modal_title_text = '';
	switch(tea)
	{
		case 'I':
		case 'II':
		{
			modal_content = string_drops;
			modal_title_text = string_title_tea_used;
			break;
		}
		case '143':
		case '11':
		case '55':
		{
			modal_content = string_tea_used;
			modal_title_text = string_title_tea_used;
			break;
		}
	}

	// For tea type
	modal_content = modal_content.replace('{$tea}', tea);
	modal_content = modal_content.replace('{$time}', time);
	console.log(tea, time, date);
	let modal = $('#calendar-modal');
	let modal_body = modal.find('.modal-body');
	let modal_title = modal.find('.modal-title');
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
			calendarApi(element, data);
		else calendarDeleteApi(element,data);
		
	})
	// .always(function() {
	// 	console.log("complete");
	// });
}

