<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>OnlineClothing</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="
    background-image: url({{ asset('storage/background-images/bg.jpg') }}) !important; 
    background-size: cover !important;
    ">
	@yield('auth-content')

	@session('success')
	{{ $message }}
	@endsession
	@livewireScripts
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<x-livewire-alert::scripts />
	<script src="./node_modules/preline/dist/preline.js"></script>
</body>
</html>