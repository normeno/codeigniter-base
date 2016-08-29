<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/app.min.js" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->

<script src="assets/bower/alertify.js/lib/alertify.min.js" type="text/javascript"></script>

<script>
    <?php $notify = $ci->session->userdata('notify'); ?>

    @if (isset($notify) && $notify['status'] === 'success' )
        alertify.success("{{ $notify['msg'] }}");
    @elseif (isset($notify) && $notify['status'] === 'error' )
        alertify.error("{{ $notify['msg'] }}");
    @endif

    <?php $ci->session->unset_userdata('notify'); ?>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100%';
                $(".container-"+input.id).append(img);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@stack('scripts')