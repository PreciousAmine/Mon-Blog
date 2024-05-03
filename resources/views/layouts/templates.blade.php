<!DOCTYPE html>
<html lang="en">
	<head>

		@include('includes.head')
		@yield('page_css')
	</head>
	<body class="page-blog">
		<!--start-header-->
		@if (!isset($hideNavbar) || !$hideNavbar)
			@include('includes.header')
		@endif
		<!--End-header-->
		<main id="main">
			<!--Main-Content-->
			@yield('content-id')
			<!--Main-Content-end-->
		</main>
		<!--footer-starts-->
		 @include('includes.footer')
		<!--global-Js-->
		@include('includes.scripts')

		@yield('page_scripts')
		<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
    <script>
        var botmanWidget = {
            aboutText: 'Botman',
            introMessage: "Heyy! What assistance can we provide for you?"
        };
    </script>
	</body>
</html>
