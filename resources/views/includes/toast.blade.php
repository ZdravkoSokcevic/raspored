<div class="toast" data-autohide="false" style="z-index:10000; right: 0; bottom: 0; position:absolute;">
  <div class="toast-header">
    <strong class="mr-auto text-primary toast-title">Toast Header</strong>
    <small class="text-muted small-title">5 mins ago</small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
  </div>
  <div class="toast-body">
    Some text inside the toast body
  </div>
</div>

@if($errors && false)
  <div class="toast bg-danger" style="z-index:10000; right: 0; bottom: 0; position:absolute;">
    <div class="toast-header">
      Error
    </div>
    <div class="toast-body">
      To je error
    </div>
  </div>
@endif