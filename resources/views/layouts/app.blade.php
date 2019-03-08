<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('public/assets/css/custom.css') }}" rel="stylesheet">
	<link href="{{ asset('public/assets/css/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('public/assets/css/font-awesome-animation.css')}}">

</head>
<body>
	<div id="app">
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">

					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<!-- Branding Image -->
					<a class="navbar-brand" href="{{ url('/') }}">
						{{ config('app.name', 'Laravel') }}
					</a>
				</div>

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Left Side Of Navbar -->
					<ul class="nav navbar-nav">
						&nbsp;
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@guest
							<li><a href="{{ route('login') }}">Login</a></li>
							<li><a href="{{ route('register') }}">Register</a></li>
						@else
							<li>
								<a href="{{ route('app.home') }}">Home</a>
							</li>
							<li><a href="{{ route('app.schedule.index') }}">Schedule</a></li>
							<li><a href="{{ route('app.record.index') }}">Record</a></li>
							<li><a href="{{ route('app.inventory.index') }}">Inventory</a></li>
							<li><a href="{{ route('app.users.index') }}">Users</a></li>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
									@php
										$dateNow = Carbon\Carbon::now()->setTimeZone('Asia/Manila')->toDateString();
										$unread = App\Schedule_Notification::where('user_id', auth()->user()->id)->where('read_at', 0)->whereDate('created_at', $dateNow)->orderBy('id', 'desc')->get();
										$read = App\Schedule_Notification::where('user_id', auth()->user()->id)->where('read_at', 1)->whereDate('created_at', $dateNow)->orderBy('id', 'desc')->get();
						                $animate = count($unread) != 0 ? 'faa-ring animated' : '';
									@endphp
									<span class="fa fa-bell {{ $animate }} font-size-20"></span>
									@if(count($unread) != 0)
						                <span class="badge badge-success" style="font-size: 10px !important; background:red; position:relative; top: -10px; left: -7px;">{{ count($unread) }}</span>
									@endif
								</a>

								<ul class="dropdown-menu">
									<li>
										<li><a href="#">Notifications</a></li>
										<li class="divider"></li>
										@if (!empty($unread))
											@foreach($unread as $notification)
												{{-- {{ dd($notification->schedule_id) }} --}}
												<li style="background: lightgray !important;">
													<a href="{{ url('schedule') . '?schedule_id=' . json_encode($notification->id) }}">
														<h5 class="margin-bottom-0">{{ $notification->message }}</h5>
														<label>{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</label>
													</a>
												</li>
											@endforeach
										@endif
										@if (!empty($read))
											@foreach($read as $notification)
												<li>
													<a href="{{ url('schedule') . '?schedule_id=' . json_encode($notification->id) }}">
														<h5 class="margin-bottom-0">{{ $notification->message }}</h5>
														<label>{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</label>
													</a>
												</li>
											@endforeach
										@endif
									</li>
								</ul>
							</li>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
									{{ Auth::user()->name }} <span class="caret"></span>
								</a>

								<ul class="dropdown-menu">
									<li>
										<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
											Logout
										</a>

										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
									</li>
								</ul>
							</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>

		@yield('content')
	</div>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
