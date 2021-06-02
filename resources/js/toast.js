const displayToast = (title,small_title='', body) => {
  let toast = $('.toast');
  toast.find('.toast-title').html(title);

  toast.find('.small_title').html(small_title);
  toast.find('.toast-body').html(body);

  $('.toast').toast('show');
}