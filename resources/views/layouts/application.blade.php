<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="material-style layout-fixed-offcanvas layout-navbar-fixed">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ isset($title) ? $title . ' - ' : '' }}CPC1 Hà Nội - Tiên phong công nghệ dược phẩm</title>

	<!-- Main font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">

	<!-- Icons. Uncomment required icon fonts -->
	<link rel="stylesheet" href="{{ mix('/vendor/fonts/fontawesome/css/all.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/fonts/ionicons.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/fonts/linearicons.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/fonts/open-iconic.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/fonts/pe-icon-7-stroke.css') }}">

	<!-- Core stylesheets -->
	<link rel="stylesheet" href="{{ mix('/vendor/css/bootstrap-material.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/css/appwork-material.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/css/theme-cotton-material.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/css/colors-material.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/css/uikit.css') }}">
	<link rel="stylesheet" href="{{ mix('/css/thotam.css') }}">

	<!-- Load polyfills -->
	<script src="{{ mix('/vendor/js/polyfills.js') }}"></script>
	<script>
	 document['documentMode'] === 10 && document.write('<script src="https://polyfill.io/v3/polyfill.min.js?features=Intl.~locale.en"><\/script>')
	</script>

	<!-- Material ripple -->
	<script src="{{ mix('/vendor/js/material-ripple.js') }}"></script>
	<script>
	 window.attachMaterialRippleOnLoad();
	</script>

	<!-- Layout helpers -->
	<script src="{{ mix('/vendor/js/layout-helpers.js') }}"></script>

	<!-- PACE.js loader -->
	<script src="{{ mix('/vendor/js/pace.js') }}"></script>

	<!-- Libs -->

	<!-- `perfect-scrollbar` library required by SideNav plugin -->
	<link rel="stylesheet" href="{{ mix('/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/libs/spinkit/spinkit.css') }}">
	<link rel="stylesheet" href="{{ mix('/vendor/libs/toastr/toastr.css') }}">

	@yield('styles')
	@stack('styles')

	@livewireStyles

	<!-- Application stylesheets -->
	<link rel="stylesheet" href="{{ mix('/css/application.css') }}">
</head>

<body @yield('bodyclass')>

	<!-- PACE.js loader -->
	<div class="page-loader">
		<div class="bg-primary"></div>
	</div>

	@yield('layout-content')

	<!-- Core scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/alpinejs@3.2.1/dist/cdn.min.js" defer></script>
	<script src="{{ mix('/vendor/libs/popper/popper.js') }}"></script>
	<script src="{{ mix('/vendor/js/bootstrap.js') }}"></script>
	<script src="{{ mix('/vendor/js/sidenav.js') }}"></script>

	<!-- Libs -->

	<!-- `perfect-scrollbar` library required by SideNav plugin -->
	<script src="{{ mix('/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
	<script src="{{ mix('/vendor/libs/block-ui/block-ui.js') }}"></script>
	<script src="{{ mix('/vendor/libs/toastr/toastr.js') }}"></script>

	@yield('scripts')

	@livewireScripts
	<!-- Application javascripts -->
	<script src="{{ mix('/js/application.js') }}"></script>
	@stack('datatables')
	@stack('livewires')
</body>

</html>
