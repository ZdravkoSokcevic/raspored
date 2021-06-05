function showToast() {
	var t = toasts[i];
	toastr.options.positionClass = t.css;
	toastr[t.type](t.msg);
	i++;
	delayToasts();
}

function delayToasts() {
	if (i === toasts.length) { return; }
	var delay = i === 0 ? 0 : 2100;
	window.setTimeout(function () { showToast(); }, delay);
	// re-enable the button        
	if (i === toasts.length-1) {
		window.setTimeout(function () {
			$('#tryMe').prop('disabled', false);
			i = 0;
		}, delay + 1000);
	}
}

toastr.options = {
	"closeButton": true,
	"debug": false,
	"newestOnTop": false,
	"progressBar": false,
	"positionClass": "toast-bottom-right",
	"preventDuplicates": false,
	"onclick": null,
	"showDuration": "300",
	"hideDuration": "1000",
	"timeOut": "5000",
	"extendedTimeOut": "1000",
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
}

const displayToast = (title, body, type='success') => {
	// Bootstrap toast
	// let toast = $('.toast');
	// toast.find('.toast-title').html(title);

	// toast.find('.small_title').html(small_title);
	// toast.find('.toast-body').html(body);

	// $('.toast').toast('show');

	// toastr
	if(type == 'success')
		toastr.success(body,title);
	else if(type == 'warning')
		toastr.warning(body,title);
	else if(type == 'info')
		toastr.info(body,title);
	else toastr.error(body,title);
}