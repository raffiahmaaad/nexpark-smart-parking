<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard - NexPark</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{ asset('frontend/images/icon.png') }}" type="image/x-icon">
    

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="{{  asset("backend/plugins/bootstrap/dist/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{  asset("backend/plugins/fontawesome-free/css/all.min.css")}}">
    <link rel="stylesheet" href="{{  asset("backend/plugins/icon-kit/dist/css/iconkit.min.css")}}">
    <link rel="stylesheet" href="{{  asset("backend/plugins/ionicons/dist/css/ionicons.min.css")}}">
    <link rel="stylesheet" href="{{  asset("backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css")}}">
    <link rel="stylesheet" href="{{  asset("backend/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{  asset("backend/plugins/jvectormap/jquery-jvectormap.css")}}">
    <link rel="stylesheet"
        href="{{  asset("backend/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css")}}">
    <link rel="stylesheet" href="{{  asset("backend/plugins/weather-icons/css/weather-icons.min.css")}}">
    <link rel="stylesheet" href="{{  asset("backend/plugins/c3/c3.min.css")}}">
    <link rel="stylesheet" href="{{  asset("backend/plugins/owl.carousel/dist/assets/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{  asset("backend/plugins/owl.carousel/dist/assets/owl.theme.default.min.css")}}">
    <link rel="stylesheet" href="{{  asset("backend/dist/css/theme.min.css")}}">
    <script src="{{  asset("backend/src/js/vendor/modernizr-2.8.3.min.js")}}"></script>

    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        a,
        div,
        .btn,
        .form-control,
        .nav-item,
        .dropdown-item,
        .card-title,
        .table {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Table Action Styling */
        .table-action {
            white-space: nowrap;
            padding: 8px 15px !important;
        }

        .table-action a {
            display: inline-block;
            margin: 0 5px;
            font-size: 16px;
            color: inherit;
        }

        .table-action a:hover {
            text-decoration: none;
            opacity: 0.8;
        }

        .table-action .text-primary {
            color: #0bb2d4 !important;
        }

        .table-action .text-warning {
            color: #faa64b !important;
        }

        .table-action .text-danger {
            color: #fb434a !important;
        }

        /* Operator Actions Styling */
        #data_table .table-actions {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 15px !important;
        }

        #data_table .table-actions a {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 25px !important;
            height: 25px !important;
            text-decoration: none !important;
            border-radius: 4px !important;
            transition: all 0.2s !important;
        }

        #data_table .table-actions a i {
            font-size: 16px !important;
        }

        #data_table .table-actions a:hover {
            background-color: rgba(0, 0, 0, 0.05) !important;
            transform: translateY(-1px) !important;
        }

        #data_table .table-actions a i.ik-eye {
            color: #0bb2d4 !important;
        }

        #data_table .table-actions a i.ik-edit-2 {
            color: #faa64b !important;
        }

        #data_table .table-actions a i.ik-trash-2 {
            color: #fb434a !important;
        }

        /* Custom File Upload Styling */
        .file-upload-default {
            display: none !important;
        }

        .file-upload-info {
            background: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 4px 0 0 4px !important;
            padding: 8px 15px !important;
            width: 100% !important;
            height: calc(2.25rem + 2px) !important;
        }

        .input-group .file-upload-browse {
            border: 1px solid #ced4da;
            border-left: none;
            padding: 8px 15px;
            border-radius: 0 4px 4px 0 !important;
            height: calc(2.25rem + 2px) !important;
            display: flex;
            align-items: center;
            background-color: #e9ecef;
            color: #333;
        }

        .input-group .file-upload-browse:hover {
            background-color: #dde0e3;
            cursor: pointer;
        }

        #preview {
            margin-top: 15px;
            text-align: center;
        }

        #preview img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
        }

        .img-thumbnail {
            padding: 0.25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            max-width: 100%;
            height: auto;
        }

        /* Modal Styling */
        .modal-dialog {
            margin: 1.75rem auto;
        }

        .modal-content {
            border: none !important;
            border-radius: 15px !important;
            background-color: #00d084 !important;
            overflow: hidden !important;
        }

        .modal-content,
        .stylish-modal-delete {
            background: #fff;
            border: none;
            border-radius: 15px !important;
            box-shadow: 0 8px 40px 0 rgba(44, 62, 80, 0.18), 0 1.5px 6px 0 rgba(229, 57, 53, 0.08);
            overflow: hidden;
            padding: 0;
            position: relative;
        }

        .modal-body {
            background-color: white !important;
            margin: 0 !important;
            padding: 1.5rem !important;
        }

        .modal-body .info-group {
            margin-bottom: 1rem;
        }

        .modal-body .info-group label {
            display: block;
            color: #4c5667;
            margin-bottom: 0.25rem;
        }

        .modal-body .info-group p {
            margin-bottom: 0.5rem;
            padding: 0.5rem;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .modal-body img.img-thumbnail {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            border: none !important;
            padding: 1rem 1.5rem !important;
            background: none !important;
        }

        .modal-delete-header-custom {
            background: linear-gradient(90deg, #ff5858 0%, #ff7e5f 100%) !important;
            color: #fff;
            border-top-left-radius: 15px !important;
            border-top-right-radius: 15px !important;
            border-bottom: none;
            padding: 1.2rem 2rem 1.2rem 1.5rem;
            display: flex;
            align-items: center;
        }

        .modal-header h4 {
            color: white !important;
            font-weight: 500 !important;
            margin: 0 !important;
        }

        .modal-header .close {
            color: white !important;
            opacity: 1 !important;
            text-shadow: none !important;
            background: none !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 30px !important;
            height: 30px !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: background-color 0.2s !important;
        }

        .modal-header .close:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }

        .modal-footer {
            background-color: white !important;
            border: none !important;
            padding: 1rem 1.5rem !important;
            margin: 0 !important;
            border-bottom-left-radius: 15px !important;
            border-bottom-right-radius: 15px !important;
        }

        .modal-body:last-child {
            border-bottom-left-radius: 15px !important;
            border-bottom-right-radius: 15px !important;
        }

        /* Table Styling */
        #data_table {
            width: 100% !important;
            margin: 0 !important;
            border-collapse: collapse !important;
        }

        #data_table thead th:first-child,
        #data_table tbody td:first-child {
            width: 50px !important;
            text-align: center !important;
            background-color: #f8f9fa !important;
            border-right: 2px solid #dee2e6 !important;
        }

        #data_table thead th:last-child,
        #data_table tbody td:last-child {
            width: 100px !important;
            text-align: center !important;
            padding-right: 15px !important;
        }

        #data_table thead th,
        #data_table tbody td {
            padding: 8px 10px !important;
            vertical-align: middle !important;
            border: 1px solid #dee2e6 !important;
        }

        /* Hide extra column */
        #data_table thead th:empty,
        #data_table tbody td:empty {
            display: none !important;
            width: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
            border: none !important;
        }

        .modal-header .modal-title,
        .modal-header h5 {
            color: #fff !important;
        }
    </style>
</head>