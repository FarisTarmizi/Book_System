<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BOOK SYSTEM | DETAILS FORM</title>
    <link rel="icon" href="{{asset('img/logo2.png')}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('lte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('lte/dist/css/adminlte.min.css')}}">
    {{-- sweet alert   --}}
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css
" rel="stylesheet">
</head>
<body class="dark-mode">
<div class="container mt-5">
    <div class="card card-primary ">
        <div class="card-header">
            <h3 class="card-title">BORROWER DETAILS FORM</h3>
        </div>
        <form id="dForm" action="{{route('borrower.fp')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="matrix">ID</label>
                    <input type="text" name="matrix" class="form-control" id="matrix" placeholder="Enter ID"
                           minlength="12" maxlength="12" value="{{old('matrix')}}">
                </div>
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" name="fullName" class="form-control" id="fullName" placeholder="Enter Full Name"
                           value="{{old('fullName')}}">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email"
                           value="{{$user->email}}" readonly>
                </div>
                <div class="form-group">
                    <label for="department">Department</label>
                    <input type="text" name="department" class="form-control" id="department"
                           placeholder="Enter Department Name" value="{{old('department')}}">
                </div>
                <div class="form-group">
                    <label for="img">Profile Picture</label>
                    <input type="file" name="img" class="form-control" id="img">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('lte/plugins/jquery/jquery.min.js')}}"></script>
<!-- jquery-validation -->
<script src="{{asset('lte/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('lte/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('lte/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- DataTables  & Plugins -->
<script src="{{asset('lte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('lte/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('lte/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('lte/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('lte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('lte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- jQuery Mapael -->
<script src="{{asset('lte/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('lte/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('lte/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('lte/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('lte/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Page specific script -->
<script>
    $(function () {
        $.validator.addMethod("imageTypeAndSize", function (value, element) {
            // Check if the element has files
            if (element.files && element.files[0]) {
                // Get the file extension
                var extension = element.files[0].name.split('.').pop().toLowerCase();
                // Check if the file extension is allowed (png, jpeg, jpg)
                if ($.inArray(extension, ['png', 'jpeg', 'jpg']) === -1) {
                    return false; // Invalid file type
                }
                // Check if the file size is less than or equal to 5MB
                if (element.files[0].size > 5 * 1024 * 1024) {
                    return false; // File size exceeds 5MB
                }
            }
            return true; // Valid image type and size
        }, "Valid image type: PNG, JPEG, or JPG. Maximum size: 5MB");
        $('#dForm').validate({
            rules: {
                matrix: {
                    required: true,
                    minlength: 12,
                    maxlength: 12
                },
                fullName: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                department: {
                    required: true
                },
                img: {
                    imageTypeAndSize: true
                },
            },
            messages: {
                matrix: {
                    required: "Please enter an ID",
                    minlength: "ID must be at least 12 characters",
                    maxlength: "ID cannot exceed 12 characters"
                },
                fullName: "Please enter your full name",
                email: {
                    required: "Please enter an email address",
                    email: "Please enter a valid email address"
                },
                department: "Please enter your department",
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
</body>
</html>
