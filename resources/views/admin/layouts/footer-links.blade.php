<!-- script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.9/js/bootstrap-select.min.js"></script>
<script src="{{ url('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/js/jquery.toast.min.js') }}"></script>
<script src="{{ url('assets/js/app.toast.js') }}"></script>  
<!-- Sweet Alert -->
<script src="{{url('assets/js/sweetalert.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
(function ($) {
    'use strict';
    $.fn.floatingLabel = function (option) {
        var parent = $(this).closest('.focusField');
        if (parent.length) {
            switch (option) {
                case 'ChangeFortText':
                    if (this.val()) {
                        parent.addClass('isFocused');
                    }
                    else {
                        parent.removeClass('isFocused');
                    }
                    break;
                default:
                    $(this).closest('.focusField').addClass('isFocused');
                    break;
            }
        }
        return this;
    };
}($));
$(document).ready(function () {
    'use strict';
    $(document).on('change', function () {
        $('.focusField input').each(function () {
            $(this).floatingLabel('ChangeFortText');
        });
    });
    $('.focusField input').each(function () {
        $(this).floatingLabel('ChangeFortText');
    });
    $(document).on('change', '.focusField input', function () {
        $(this).floatingLabel('ChangeFortText');
    });
})

    //ripple-effect for button
    $('.ripple-effect, .ripple-effect-dark').on('click', function (e) {
        var rippleDiv = $('<span class="ripple-overlay">'),
            rippleOffset = $(this).offset(),
            rippleY = e.pageY - rippleOffset.top,
            rippleX = e.pageX - rippleOffset.left;
        rippleDiv.css({
            top: rippleY - (rippleDiv.height() / 2),
            left: rippleX - (rippleDiv.width() / 2),
            // background: $(this).data("ripple-color");
        }).appendTo($(this));
        window.setTimeout(function () {
            rippleDiv.remove();
        }, 800);
    });

    // bootstrap-select calling function
    $('.selectpicker').selectpicker();

    // side menu 
    $('#sideNavCollapse').click(function() {
        $('.sideMenu').toggleClass('open');
        $('.overlay').toggleClass('active');
    })
    $('.overlay').on('click', function() {
        $('.sideMenu').removeClass('open');
        $('.overlay').removeClass('active');
    });




</script>
    

 