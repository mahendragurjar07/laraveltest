<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/jquery.validate.min.js')}}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="{{ asset('js/bootbox.min.js') }}"></script>

<script>
    function successToaster(message) {
        toastr.remove();
        toastr.options.closeButton = true;
        toastr.success(message, '', {timeOut: 5000});
    }
    function errorToaster(message) {
        toastr.remove();
        toastr.options.closeButton = true;
        toastr.error(message, '', {timeOut: 5000});
    }
</script>
@if(session()->has('success'))
<script>
    $(document).ready(function () {
        successToaster("{!! session('success') !!}");
    });
</script>
@endif
@if(session()->has('error'))
<script>
    $(document).ready(function () {
        errorToaster("{!! session('error') !!}");
    });
</script>
@endif