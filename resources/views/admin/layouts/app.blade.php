<!DOCTYPE html>
<html>

<head>
    <?php error_reporting(E_ALL ^ E_DEPRECATED); ?>
    <!-- css links & meta datas -->    
    @include('admin.layouts.header-links')
    @include('layouts.script')   
    @yield('head')
    <style>
        .focusField label{
            font-size: 12px;
            color: #EF384C;
            font-family: "Muli-SemiBold";
            background-color: #F7F8F9;
            top: -8px;
            left: 16px;
            padding: 0 5px;
        }
        .focusField input{
            border-color: #EF384C !important;
        }
    </style>
</head>

<body class="adminBg">
    <div id="app">
        <!-- header -->
        @include('admin.layouts.sidebar.index')
        @include('admin.layouts.header')
        <!-- sidebar -->
       
        @yield('content')
    </div>

    <!-- js links -->
    @include('admin.layouts.footer-links')

    @yield('js')
</body>

</html>