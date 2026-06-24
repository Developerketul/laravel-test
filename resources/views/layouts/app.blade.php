<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">

<head>

    <meta charset="utf-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Invoice Management
    </title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @if($isRtl)

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">

    @else

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    @endif


    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    @if($isRtl)
    <style>
        body.sidebar-mini.layout-fixed .main-sidebar {
            right: 0 !important;
            left: auto !important;
        }

        body.sidebar-mini.layout-fixed .content-wrapper,
        body.sidebar-mini.layout-fixed .main-header,
        body.sidebar-mini.layout-fixed .main-footer {
            margin-right: 250px !important;
            margin-left: 0 !important;
        }

        body.sidebar-mini.layout-fixed.sidebar-collapse .main-sidebar {
            margin-right: -250px !important;
            margin-left: 0 !important;
        }

        body.sidebar-mini.layout-fixed.sidebar-collapse .content-wrapper,
        body.sidebar-mini.layout-fixed.sidebar-collapse .main-header,
        body.sidebar-mini.layout-fixed.sidebar-collapse .main-footer {
            margin-right: 0 !important;
            margin-left: 0 !important;
        }

        .content-wrapper,
        .content-wrapper p,
        .content-wrapper h1,
        .content-wrapper h2,
        .content-wrapper h3,
        .content-wrapper h4,
        .content-wrapper h5,
        .content-wrapper h6,
        .content-wrapper th,
        .content-wrapper td,
        .content-wrapper label,
        .content-wrapper .text-muted {
            color: #212529 !important;
        }

        .main-sidebar {
            right: 0;
            left: auto;
        }

        .content-wrapper,
        .main-header,
        .main-footer {
            margin-right: 250px;
            margin-left: 0;
        }

        body.sidebar-collapse .main-sidebar {
            margin-right: -250px;
            margin-left: 0;
        }

        body.sidebar-collapse .content-wrapper,
        body.sidebar-collapse .main-header,
        body.sidebar-collapse .main-footer {
            margin-right: 0;
            margin-left: 0;
        }

        @media (max-width: 991.98px) {
            body.sidebar-mini.layout-fixed .content-wrapper,
            body.sidebar-mini.layout-fixed .main-header,
            body.sidebar-mini.layout-fixed .main-footer {
                margin-right: 0 !important;
                margin-left: 0 !important;
            }

            body.sidebar-mini.layout-fixed.sidebar-open .main-sidebar {
                margin-right: 0 !important;
            }
        }
    </style>
    @endif

</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        @include('layouts.navbar')

        @include('layouts.sidebar')

        <div class="content-wrapper">

            @yield('content')

        </div>

    </div>

    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.jQuery && $.fn.DataTable) {
                $('.js-datatable').each(function () {
                    if ($.fn.DataTable.isDataTable(this)) {
                        return;
                    }

                    $(this).DataTable({
                        paging: false,
                        searching: false,
                        info: false,
                        order: [],
                    });
                });
            }

            document.querySelectorAll('.js-preview-popup').forEach(function (link) {
                link.addEventListener('click', function (event) {
                    event.preventDefault();

                    window.open(
                        link.href,
                        'quotationPreview',
                        'width=1280,height=800,scrollbars=yes,resizable=yes'
                    );
                });
            });
        });
    </script>

    @stack('scripts')

</body>

</html>