<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
            @if(Session::has('notification'))
    var type = "{{ Session::get('notification.alert-type') }}";
    var positionClass = "{{Session::get('notification.positionClass')}}";
    var closeButton = "{{ Session ::get('notification.closeButton') }}";
    var tapToDismiss = "{{Session::get('notification.rapToDismiss')}}";

    switch (type) {
        case 'confirm':
            toastr.options.positionClass = positionClass;
            toastr.options.tapToDismiss = tapToDismiss;
            toastr.info("{{ Session::get('notification.message')}}");
            break;
        case 'warning':
            toastr.options.positionClass = positionClass;
            toastr.options.tapToDismiss = tapToDismiss;
            toastr.warning("{{ Session::get('notification.message') }}");
            break;
        case 'success':
            toastr.options.positionClass = positionClass;
            toastr.options.tapToDismiss = tapToDismiss;
            toastr.success("{{ Session::get('notification.message') }}");
            break;
        case 'error':
            toastr.options.positionClass = positionClass;
            toastr.options.tapToDismiss = tapToDismiss;
            toastr.error("{{ Session::get('notification.message') }}");
            break;
    }
    @endif
</script>