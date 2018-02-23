<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
            @if(Session::has('notification'))
    var type = "{{ Session::get('notification.alert-type') }}";
    var closeButton = "{{ Session ::get('notification.closeButton') }}";

    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('notification.message') }}");
            toastr.options = [$closeButton = true]
            break;
        case 'warning':
            toastr.warning("{{ Session::get('notification.message') }}");
            toastr.options = [$closeButton = true];
            break;
        case 'success':
            toastr.success("{{ Session::get('notification.message') }}");
            toastr.options = [$closeButton = true];
            break;
        case 'error':
            toastr.error("{{ Session::get('notification.message') }}");
            toastr.options = [$closeButton = true];
            break;
    }
    {{Session::forget('notification')}}
    @endif
</script>