<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Simple CRM | @yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{asset('/resources/')}}/assets/img/icon.ico" type="image/x-icon"/>
    <!-- csrf token for ajax request -->
    <meta name="csrf_token" content="{{ csrf_token() }}" />

    <!-- Fonts and icons -->
    <script src="{{asset('/resources/')}}/js//plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../resources/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('/resources/')}}/css//bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/resources/')}}/css//atlantis.min.css">

    <!--datatable-->
    <link href="//cdn.datatables.net/2.1.2/css/dataTables.bootstrap5.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/buttons/3.1.2/css/buttons.bootstrap.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/buttons/3.1.2/css/buttons.bootstrap5.min.css" rel="stylesheet">

    <!--datatable-->
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="{{asset('/resources/')}}/js/plugin/sweetalert2/sweetalert2.min.css">

    <!-- select2 -->
    <link rel="stylesheet" href="{{asset('/resources/')}}/js/plugin/select2/css/select2.min.css">

    <!--datetimepicker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{asset('/resources/')}}/css//demo.css">
    {{--@vite('resources/css/app.css')--}}
    @stack('css')
</head>
<body>
<div class="wrapper">
    <!-- header -->
    @include('layouts.partials.header')
    <!-- header ends -->


    <!-- Sidebar -->
    @include('layouts.partials.sidebar')
    <!-- End Sidebar -->

    <div class="main-panel">
        <!-- content starts here -->
        @yield('content')
        <!-- content ends here -->


        <!-- footer starts-->
        @include('layouts.partials.footer')
        <!-- footer ends -->
    </div>

    <!-- toast -->
  <!--  <div data-notify="container" id="liveToast" class="toast-container col-10 col-xs-11 col-sm-4 alert alert-success" role="alert" data-notify-position="top-right" style="display: inline-block; margin: 0px auto; padding-left: 65px; position: fixed; transition: 0.5s ease-in-out; z-index: 1031; top: 107px; right: 20px;">
        <button type="button" aria-hidden="true" class="close" data-notify="dismiss" style="position: absolute; right: 10px; top: 5px; z-index: 1033;">×</button><span data-notify="icon" class="fa fa-bell"></span>
        <div class="toast-body">

        </div>
        <span data-notify="title" class="toast-title">Bootstrap notify</span>
        <span data-notify="message" class="toast-msg">Turning standard Bootstrap alerts into "notify" like notifications</span>
        <p  data-notify="url" style="background-image: url(&quot;data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7&quot;); height: 100%; left: 0px; position: absolute; top: 0px; width: 100%; z-index: 1032;"></p></div>-->

    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
        <div class="title">Settings</div>
        <div class="custom-content">
            <div class="switcher">
                <div class="switch-block">
                    <h4>Logo Header</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
                        <button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                        <br/>
                        <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Navbar Header</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeTopBarColor" data-color="dark"></button>
                        <button type="button" class="changeTopBarColor" data-color="blue"></button>
                        <button type="button" class="changeTopBarColor" data-color="purple"></button>
                        <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                        <button type="button" class="changeTopBarColor" data-color="green"></button>
                        <button type="button" class="changeTopBarColor" data-color="orange"></button>
                        <button type="button" class="changeTopBarColor" data-color="red"></button>
                        <button type="button" class="changeTopBarColor" data-color="white"></button>
                        <br/>
                        <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                        <button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
                        <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                        <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                        <button type="button" class="changeTopBarColor" data-color="green2"></button>
                        <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                        <button type="button" class="changeTopBarColor" data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Sidebar</h4>
                    <div class="btnSwitch">
                        <button type="button" class="selected changeSideBarColor" data-color="white"></button>
                        <button type="button" class="changeSideBarColor" data-color="dark"></button>
                        <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Background</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeBackgroundColor" data-color="bg2"></button>
                        <button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
                        <button type="button" class="changeBackgroundColor" data-color="bg3"></button>
                        <button type="button" class="changeBackgroundColor" data-color="dark"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-toggle">
            <i class="flaticon-settings"></i>
        </div>
    </div>
    <!-- End Custom template -->
</div>
<!--   Core JS Files   -->
<script src="{{asset('/resources/')}}/js//core/jquery.3.2.1.min.js"></script>
<script src="{{asset('/resources/')}}/js//core/popper.min.js"></script>
<script src="{{asset('/resources/')}}/js//core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="{{asset('/resources/')}}/js//plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{asset('/resources/')}}/js//plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('/resources/')}}/js//plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


<!-- Chart JS -->
<script src="{{asset('/resources/')}}/js//plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="{{asset('/resources/')}}/js//plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="{{asset('/resources/')}}/js//plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="{{asset('/resources/')}}/js//plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="{{asset('/resources/')}}/js//plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="{{asset('/resources/')}}/js//plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('/resources/')}}/js//plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!--datatable-->
<script type="application/javascript" src="//cdn.datatables.net/2.1.2/js/dataTables.js" ></script>
<script type="application/javascript" src="//cdn.datatables.net/2.1.2/js/dataTables.bootstrap5.js" ></script>
<script type="application/javascript" src="//cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.min.js"></script>
<script type="application/javascript" src="//cdn.datatables.net/buttons/3.1.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<!--datatable-->

<!-- Sweet Alert -->
<script src="{{asset('/resources/')}}/js//plugin/sweetalert2/sweetalert2.min.js"></script>

<!-- Select2 -->
<script src="{{asset('/resources/')}}/js//plugin/select2/js/select2.js"></script>

<!-- datetimepicker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Atlantis JS -->
<script src="{{asset('/resources/')}}/js//atlantis.min.js"></script>
@vite('resources/js/app.js')
<!-- Atlantis DEMO methods, don't include it in your project! -->
{{--<script src="{{asset('/resources/')}}/js//setting-demo.js"></script>
<script src="{{asset('/resources/')}}/js//demo.js"></script>--}}
<script>
    var $reload = 'false';
    /* front end toast function */
    function toast(type='info',msg='')
    {
        let icon = "window-close";
        if(type == "info" || type == "success")
        {
            icon = "check";
        }
        if(type == "error")
        {
            icon = "window-close";
        }

        $.notify({
            title: type.toUpperCase(),
            message: msg,
            icon: 'fas fa-'+icon,
        }, {
            type: (type == "error") ? "danger" : type, // 'success', 'info', 'warning', 'danger'
            placement: {
                from: "top",
                align: "right"
            },
            time: 10000, // Duration in milliseconds
            delay: 100, // Delay before showing the notification
            z_index: 1031, // Z-index for the notification
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            }
        });

    }

    /* datatable initiation */
    let table = new DataTable('.dataTable');
    /* select2 */
    $('.select2').select2();

    // ajax modal
    $(document).on('click', '[data-request="ajaxModal"]',
        function(e) {
            e.preventDefault();
            $('#ajaxModal').remove();
            var $this = $(this)
                , size = $this.data('size') || 'modal-md'
                , $remote = $this.data('remote')
                , $modal = $('<div class="modal fade" id="ajaxModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true"><div class="modal-dialog ' + size + '"></div></div>');
            $('body').append($modal);

            $reload = $this.data('reload') || 'false';

            axios.get($remote).then(function (response) {
                $('#ajaxModal .modal-dialog').html(response.data);
                $('#ajaxModal').modal('show');

                // re-initialize select on modal open
                $('.select2').select2({
                    dropdownParent: $("#ajaxModal")
                });

            })
                .catch(function (error) {
                    Swal.fire(
                        'Failed!',
                        'Oops! Request failed to complete.',
                        'error'
                    )
                });

        }
    );

    $(document).on('submit', '.ajaxFormSubmit', function (event) {
        event.preventDefault();

        $('.formSaving').html('Processing..<i class="fas fa-spin fa-spinner"></i>');

        let data = new FormData(this);

        axios.post($(this).attr("action"), data)
            .then(function (response) {
                if (response.data.alertClass && response.data.alertClass != '') {
                    toast(response.data.alertClass, response.data.message);
                } else {
                    toast('success', response.data.message);
                }

                $('.formSaving').html('<i class="fas fa-check"></i> Save </span>');
                $('#ajaxModal').modal('toggle');
                if ($reload === true) {
                    setTimeout(function(){
                        window.location.reload();
                    },2000);

                }

            })
            .catch(function (error) {
                if (error.response && error.response.data && error.response.data.errors) {
                    let errors = error.response.data.errors;
                    let oldValues = error.response.data.old || {};

                    // Clear previous errors
                    $('.form-control').removeClass('is-invalid');
                    // $('.invalid-feedback').html('');
                    $('.invalid-feedback').remove();

                    // Show new errors and manage old values
                    $.each(errors, function (key, value) {
                        let currentElement = $('[name="'+ key +'"]');
                        if(currentElement.hasClass('select2') && currentElement.next('.select2-container').length) {
                            currentElement.insertAfter(currentElement.next('.select2-container'));
                        }
                        currentElement.addClass('is-invalid');
                        currentElement.after('<div class="invalid-feedback" id="">' + value[0] + '</div>')
                    });
                    // Set old values
                    $.each(oldValues, function (key, value) {
                        $('[name="'+ key +'"]').val(value);
                    });
                } else {

                    if (error.response.data.alertClass && error.response.data.alertClass != '') {
                        toast(error.response.data.alertClass, error.response.data.message);
                    }
                }
                $('.formSaving').html('<i class="fas fa-sync"></i> Try Again</span>');
            });
    });

    // Delete with sweet alert
    $(document).on('click', '.delete-data', function(event) {
        event.preventDefault(); // Prevent default link behavior

        let url = $(this).data("url");
        Swal.fire({
            title: 'Are you sure you want to delete this record?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post(url, { '_method': 'delete'})
                    .then(function (response) {
                        if(response.data.status === 'success') {
                            Swal.fire(
                                'Deleted!',
                                // 'The Item has been deleted successfully.',
                                response.data.message,
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    // The user clicked "OK"
                                    window.location.reload();
                                }
                            });

                            // Set a timeout to reload the page after 2 seconds
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        }

                    })
                    .catch(function(error){
                        //alert(error);
                        Swal.fire(
                            'Error!',
                            error.response.data.message,
                            'error'
                        );
                    });
            }
        });
    });

    //front end validation sweet alert 2
    function displayAlert(icon="warning",title="Warning!",msg="Something went wrong!",timer=3000)
    {
        Swal.fire({
            icon: icon,
            title: title,
            text: msg,
            timer: timer,
        });
    }
</script>
@stack('js')
</body>
</html>
