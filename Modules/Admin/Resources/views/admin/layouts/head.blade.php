
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!--begin::Fonts-->
    <link rel="stylesheet" href="{{url('admin/plugins/global/fonts/cairo-font.css')}}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!--end::Fonts-->
    <!--end::Page Vendors Styles-->
@if(Auth::user()->user_lang == 'ar')
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{url('admin/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('admin/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('admin/plugins/custom/prismjs/prismjs.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <?php  if(isset($script_datatables)){ ?>
        <link href="{{ url('admin/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <?php  } if(isset($script_wizard)){ ?>
        <link href="{{ url('admin/css/pages/wizard/wizard-1.rtl.css') }}" rel="stylesheet" type="text/css" />
    <?php  }else{ ?>
        <link href="{{ url('admin/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <?php  } ?>
    {{-- <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{url('admin/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('admin/plugins/custom/prismjs/prismjs.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('admin/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
		<link href="{{url('admin/plugins/custom/vis-timeline/vis-timeline.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Vendor Stylesheets-->

    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{url('admin/css/themes/layout/header/base/light.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('admin/css/themes/layout/header/menu/lightblue.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('admin/css/themes/layout/brand/dark.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('admin/css/themes/layout/aside/dark.rtl.css')}}" rel="stylesheet" type="text/css" /> --}}
    <style>
        *{font-family: 'Cairo', sans-serif;}
        html{font-size: 14px !important;}
        .center{text-align: center;}
        .check{direction: initial;}
        table td:not([align]), table th:not([align]){ text-align: right !important;}
        .b-checkbox.checkbox .control-label{padding-right: 0.5em !important;}
    </style>
    <!-- Theme style -->
@else
        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{url('admin/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('admin/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('admin/plugins/custom/prismjs/prismjs.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
        <!--begin::Vendor Stylesheets(used for this page only)-->
        <link href="{{url('admin/plugins/custom/vis-timeline/vis-timeline.bundle.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
        <?php  if(isset($script_datatables)){ ?>
            <link href="{{ url('admin/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
        <?php  } if(isset($script_wizard)){ ?>
            <link href="{{ url('admin/css/pages/wizard/wizard-1.css') }}" rel="stylesheet" type="text/css" />
        <?php  } if(isset($script_calendar)){ ?>
            <link href="{{ url('admin/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
        <?php  } ?>
    {{-- <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{url('admin/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('admin/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('admin/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{url('admin/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('admin/css/themes/layout/header/menu/lightblue.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('admin/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('admin/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style --> --}}
    <style>
        *{font-family: 'Cairo', sans-serif;}
        html{font-size: 14px !important;}
        .center{text-align: center;}
        .check{direction: initial;}
        table td:not([align]), table th:not([align]){ text-align: left !important;}
        .b-checkbox.checkbox .control-label{padding-right: 0.5em !important;}
    </style>
  @endif
  <style>
    .image-input-placeholder {
        background-image: url('{{ url("admin/media/svg/files/blank-image.svg") }}');
    }
    [data-bs-theme="dark"] .image-input-placeholder {
        background-image: url('{{ url("admin/media/svg/files/blank-image-dark.svg") }}');
    }
</style>




