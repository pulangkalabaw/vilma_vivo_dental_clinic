@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						Inventory total
					</div>

					<div class="panel-body text-left">
						<h1>
							<span class="fa fa-book"></span>
							{{ 	$inventory_count }}
						</h1>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						Scheduled Today
					</div>

					<div class="panel-body text-left">
						<h1>
							<span class="fa fa-book"></span>
							{{ 	$sched_today }}
						</h1>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						Scheduled Pending
					</div>

					<div class="panel-body text-left">
						<h1>
							<span class="fa fa-book"></span>
							{{ 	$sched_pending }}
						</h1>
						<small>
							(including today's)
						</small>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						All Records
					</div>

					<div class="panel-body text-left">
						<h1>
							<span class="fa fa-book"></span>
							{{ 	$record_count }}
						</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div><br />

		<div class="panel panel-default">
			<div class="panel-heading">
				User Roles Count
			</div>
			<div class="panel-body">
				<div class="row">
					@foreach($count_user_roles as $role)
						<div class="col-md-3">
							<div class="panel panel-default">
								<div class="panel-heading">
									Role: <b>{{ ucfirst($role->role) }}</b>
								</div>

								<div class="panel-body">
									<h1>
										<span class="fa fa-users"></span>
										{{ $role->count }} / {{ $role->total }}
									</h1>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="clearfix"></div><br />

		<div class="panel panel-default">
			<div class="panel-heading">
				Record Summary
			</div>
			<div class="panel-body" style="margin-left: 0% !important;">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{{ csrf_field() }}
							{{ method_field('GET') }}
							<div class="row">
								<form action="{{ request()->fullUrl() }}" method="GET">
									<div class="col-md-4">
										<select name="year" id="selectYear" class="form-control">
											@for($x = 2000; $x <= Carbon\Carbon::now()->year; $x++)
												<option value="{{ $x }}"
												@if(!empty(request()->year))
													@if(request()->year == $x)
														{{-- {{ dd(request()->year) }} --}}
														selected
													@endif
												@else
													@if(Carbon\Carbon::now()->year == $x)
														selected
													@endif
												@endif
												>{{ $x }}</option>
											@endfor
										</select>
									</div>
									<div class="col-md-5">
										<select name="month" id="" class="form-control">
											@php
											$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',];
											@endphp
											@foreach($months as $month)
												<option value="{{ $month }}"
												@if(!empty(request()->month))
													@if(request()->month == $month)
														selected
													@endif
												@else
													@if(Carbon\Carbon::now()->format('F') == $month)
														selected
													@endif
												@endif
												>{{ $month }}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-3">
										<button type="submit" class="btn btn-info">Go</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					{{-- <div class="col-md-1"></div>
					<div class="col-md-10"> --}}
						<center>
						@php
						$count = 1;
						@endphp
						@foreach($record_summary as $index => $rs_count)
								{{-- {{ dd($index) }} --}}
							@if($count == 1)
							<div class="row">
							@endif
								<div class="col-md-2">
									<div class="panel panel-default">
										<div class="panel-heading">
											<label class="text-center">{{ checkTreatment($index) }}</label>
										</div>

										<div class="panel-body">
											<h1 class="text-center">{{ $rs_count }}</h1>
										</div>
									</div>
								</div>
							@if($count == 5)
							</div>
							@endif
							@php
								if($count == 5) {
									$count = 1;
								}else{
									$count++;
								}
							@endphp
						@endforeach
						</center>
					{{-- </div>
					<div class="col-md-"></div> --}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
{{-- <script src=""></script> --}}
<script>
	$('#selectYear').append($('<option>', {
	    value: 1,
	    text: 'My option'
	}));
</script>
