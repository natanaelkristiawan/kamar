<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>Kamartamu - Admin Panel</title>
<meta content="Admin Dashboard" name="description" />
<meta content="Themesbrand" name="author" />
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">


<!-- DataTables -->
<link href="{{ asset('themes') }}/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('themes') }}/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('themes') }}/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<link href="{{ asset('themes') }}/additionals/dropzone/basic.min.css" rel="stylesheet">
<link href="{{ asset('themes') }}/additionals/dropzone/dropzone.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('themes') }}/additionals/chosen/bootstrap-chosen.css">
<link rel="stylesheet" href="{{ asset('themes') }}/additionals/switchery/switchery.css">
<link rel="stylesheet" href="{{ asset('themes') }}/additionals/toastr/toastr.min.css">
<link rel="stylesheet" href="{{ asset('themes') }}/additionals/bootstrap-tagsinput/bootstrap-tagsinput.css">
<link rel="stylesheet" href="{{ asset('themes') }}/additionals/summernote/summernote-bs4.css">
<link rel="stylesheet" href="{{ asset('themes') }}/additionals/style/additional.css">

<link href="{{ asset('themes') }}/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

<link href="{{ asset('themes/vertical') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="{{ asset('themes/vertical') }}/assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
<link href="{{ asset('themes/vertical') }}/assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="{{ asset('themes/vertical') }}/assets/css/style.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="{{ asset('themes/additionals') }}/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.min.css">

<script type="text/javascript">
    var TOKEN = {'_token' : "{{ csrf_token() }}"};
</script>
