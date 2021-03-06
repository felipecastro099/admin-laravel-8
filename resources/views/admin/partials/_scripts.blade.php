<!-- JAVASCRIPT -->
<script src="{{ URL::asset('/admin/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('/admin/libs/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('/admin/libs/metismenu/metismenu.min.js')}}"></script>
<script src="{{ URL::asset('/admin/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ URL::asset('/admin/libs/node-waves/node-waves.min.js')}}"></script>

@yield('script')

<script src="{{ URL::asset('/admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('/admin/js/pages/sweet-alerts.init.js') }}"></script>

<script src="{{ URL::asset('/admin/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('/admin/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/admin/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>
<script src="{{ URL::asset('/admin/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ URL::asset('/admin/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
<script src="{{ URL::asset('/admin/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ URL::asset('/admin/libs/datepicker/datepicker.min.js') }}"></script>

<!-- form advanced init -->
<script src="{{ URL::asset('/admin/js/pages/form-advanced.init.js') }}"></script>

<script src="{{ URL::asset('/admin/libs/parsleyjs/parsleyjs.min.js') }}"></script>

<script src="{{ URL::asset('/admin/js/pages/form-validation.init.js') }}"></script>

<!-- toastr plugin -->
<script src="{{ URL::asset('/admin/libs/toastr/toastr.min.js') }}"></script>

<!-- toastr init -->
<script src="{{ URL::asset('/admin/js/pages/toastr.init.js') }}"></script>

@yield('script-bottom')

<!-- App js -->
<script src="{{ URL::asset('admin/js/app.min.js')}}"></script>

<script>
    $('.delete-data').click(function (event){
        event.preventDefault();

        var me = $(this),
            url = me.attr('href'),
            title = me.attr('title'),
            csrf_token = $('meta[name="csrf-token"]').attr('content');
        id = me.attr('data-target')

        Swal.fire({
            title: title,
            text: 'Essa a????o n??o poder?? ser revertida!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: 'Deletar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if(result.value) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        '_method': 'DELETE',
                        '_token': csrf_token
                    },
                    success: function (response) {

                        if (response.success === true) {
                            Swal.fire("Done!", response.message, "success");

                            $(id).fadeOut(1000);
                            setTimeout(function(){
                                $(id).remove()
                            }, 1000);

                        } else {
                            Swal.fire("Error!", response.message, "error");
                        }
                    },
                    error: function (response) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops..',
                            text: 'Erro ao excluir',
                        });
                    }
                });
            }
        });
    });
</script>
