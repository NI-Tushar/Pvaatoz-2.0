<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | @yield('title', 'This is Default Title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('Frontend')}}/assets/img/logo/pavicon.icon">
  <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('Backend') }}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/summernote/summernote-bs4.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Axios -->
  <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://kit.fontawesome.com/9f57283aa3.js" crossorigin="anonymous"></script>

  <!-- Form Input -->
  <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/bs-stepper/css/bs-stepper.min.css">
  <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/dropzone/min/dropzone.min.css">
  <link rel="stylesheet" href="{{ asset('Backend') }}/dist/css/adminlte.min.css?v=3.2.0">

       
  <!-- for using tailwind -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- ./wrapper -->
    @yield('app-content')
<!-- ./wrapper end-->

<!-- jQuery -->
<script src="{{ asset('Backend') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('Backend') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('Backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('Backend') }}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('Backend') }}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ asset('Backend') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('Backend') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('Backend') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('Backend') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('Backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('Backend') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('Backend') }}/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('Backend') }}/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('Backend') }}/dist/js/demo.js"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('Backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('Backend') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/select2/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#example2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4',
        placeholder: 'Please select',
    });
  // Only use text area---------------------------->

    // $(document).ready(function() {
    //     $('#textArea').summernote({
    //         placeholder: 'Enter a description for your new about section',
    //         tabsize: 2,
    //         height: 300,
    //         callbacks: {
    //             onChange: function(contents) {
    //                 handleCharacterCount(contents, 'textArea');
    //             }
    //         }
    //     });

    //     document.querySelectorAll('.char-count').forEach(element => {
    //         element.addEventListener('input', function () {
    //             const contents = this.value;
    //             handleCharacterCount(contents, this.id);
    //         });
    //     });

    //     function handleCharacterCount(contents, elementId) {
    //         const limit = document.getElementById(elementId).getAttribute('data-limit');
    //         const counterElement = document.getElementById(elementId + 'Counter');
    //         const errorElement = document.getElementById(elementId + 'Error');

    //         const currentLength = contents.length;
    //         counterElement.textContent = `${currentLength}/${limit}`;

    //         if (currentLength > limit) {
    //             errorElement.classList.remove('d-none');
    //             document.getElementById(elementId).classList.add('is-invalid');
    //         } else {
    //             errorElement.classList.add('d-none');
    //             document.getElementById(elementId).classList.remove('is-invalid');
    //         }
    //     }
    // });

      // All Input field---------------------------->

        $(document).ready(function() {
            $('.summernote').each(function() {
                $(this).summernote({
                    // placeholder: 'Enter a description',
                    tabsize: 2,
                    height: 350,
                    callbacks: {
                        onChange: function(contents) {
                            const textContent = extractText(contents);
                            handleCharacterCount(textContent, $(this).closest('.form-group'));
                        },
                        onPaste: function(e) {
                            let bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                            e.preventDefault();
                            document.execCommand('insertText', false, bufferText);
                        }
                    }
                });
            });

            $('.char-count').on('input', function () {
                const contents = $(this).val();
                handleCharacterCount(contents, $(this).closest('.form-group'));
            });

            $('form').on('submit', function(e) {
                let valid = true;
                $('.char-count').each(function() {
                    const contents = $(this).hasClass('summernote') ? extractText($(this).summernote('code')) : $(this).val();
                    const formGroup = $(this).closest('.form-group');
                    const limit = $(this).data('limit');
                    if (contents.length > limit) {
                        valid = false;
                        formGroup.find('.error').removeClass('d-none');
                        $(this).addClass('is-invalid');
                    } else {
                        formGroup.find('.error').addClass('d-none');
                        $(this).removeClass('is-invalid');
                    }
                });
                if (!valid) {
                    e.preventDefault();
                    alert('Please fix the errors before submitting the form.');
                }
            });

            function handleCharacterCount(contents, formGroup) {
                const limit = formGroup.find('.char-count').data('limit');
                const counterElement = formGroup.find('.counter');
                const errorElement = formGroup.find('.error');

                const currentLength = contents.length;
                counterElement.text(`${currentLength}/${limit}`);

                if (currentLength > limit) {
                    errorElement.removeClass('d-none');
                    formGroup.find('.char-count').addClass('is-invalid');
                } else {
                    errorElement.addClass('d-none');
                    formGroup.find('.char-count').removeClass('is-invalid');
                }
            }

            function extractText(html) {
                let doc = new DOMParser().parseFromString(html, 'text/html');
                return doc.body.textContent || "";
            }
        });
</script>
@stack('script')
</body>
</html>
