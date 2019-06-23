<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('common.front.header')
<body>
	@yield('content')
	@include('front.widgets.scripts.' . config('0-developer.theme'))
	@include('common.front.scripts')
	@stack('scripts')
</body>
</html>
