@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-6">
								<span class="fa fa-book"></span>
								Scheduling Management
							</div>
							<div class="col-md-6 text-right">
								{{-- <button onclick="window.location = '{{ route('app.schedule.create') }}' " {{ $total_today >= 5 ? 'disabled' : '' }} class="btn btn-sm btn-primary"> --}}
								<button onclick="window.location = '{{ route('app.schedule.create') }}' " class="btn btn-sm btn-primary">
									<span class="fa fa-plus-circle"></span>
									Add new schedule
								</button>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							{{--
							@if (
							!empty(Request::get('search_string'))
							|| !empty(Request::get('show'))
							|| (!empty(Request::get('sort_in'))
							&& !empty(Request::get('sort_by')))
							)
							<div class="breadcrumb">
							<b><span class='fa fa-filter'></span> Filtered ({{ $total }})</b><br>
							{!! filteredBy(request()) !!}
						</div>
					@endif
					--}}

					@include('includes.notif')

					<div class="col-md-4 col-xs-4">
						<div class="form-inline">
							<div class="form-group">
								<label>Number of rows: </label>
								<select name="" id="" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)" class="form-control">
									<option {{ !empty(request()->get('show') && request()->get('show') == 10) ? 'selected' : ''  }}
										value="{{ request()->fullUrlWithQuery(['show' => '10']) }}">10
									</option>
									<option {{ !empty(request()->get('show') && request()->get('show') == 25) ? 'selected' : ''  }}
										value="{{ request()->fullUrlWithQuery(['show' => '25']) }}">25
									</option>
									<option {{ !empty(request()->get('show') && request()->get('show') == 50) ? 'selected' : ''  }}
										value="{{ request()->fullUrlWithQuery(['show' => '50']) }}">50
									</option>
									<option {{ !empty(request()->get('show') && request()->get('show') == 100) ? 'selected' : ''  }}
										value="{{ request()->fullUrlWithQuery(['show' => '100']) }}">100
									</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-3"></div>
					<div class="col-md-5 col-xs-5">
						<form action="{{ request()->fullUrl() }}" method="GET">
							<div class="input-group">
								<input type="search" name="search_string" id="" value="{{ !empty(request()->get('search_string')) ? request()->get('search_string') : '' }}" class="form-control" placeholder="Search for Name, Contact, or address">
								<span class="input-group-btn">
									<button class="btn btn-primary"><span class='fa fa-search'></span> </button>
								</span>
							</div>
						</form>
					</div>
				</div>
				<div class="clearfix"></div><br>

				<table class="table table-hovered">
					<thead>
						<tr>
							<th>
								ID No.
								<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'tracking_no', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
									<span class='fa fa-sort'></span>
								</a>
							</th>
							<th>
								First Name
								<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'first_name', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
									<span class='fa fa-sort'></span>
								</a>
							</th>
							<th>
								Last Name
								<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'last_name', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
									<span class='fa fa-sort'></span>
								</a>
							</th>
							<th>
								Contact
								<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'contact', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
									<span class='fa fa-sort'></span>
								</a>
							</th>
							<th>
								Address
								<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'address', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
									<span class='fa fa-sort'></span>
								</a>
							</th>
							<th>
								Date
								<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'date', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
									<span class='fa fa-sort'></span>
								</a>
							</th>
							<th>
								Time
								<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'time', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
									<span class='fa fa-sort'></span>
								</a>
							</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($schedules as $schedule)
							<tr>
								<td>{{ $schedule->tracking_no ? $schedule->tracking_no : '-' }}</td>
								<td>{{ $schedule->first_name }}</td>
								<td>{{ $schedule->last_name }}</td>
								<td>{{ $schedule->contact }}</td>
								<td>{{ $schedule->address }}</td>
								@php
									$scheduled_date = $schedule->date;
									if($scheduled_date == Carbon\Carbon::now()->toDateString()){
										$scheduled_date = "Today";
									} else if($scheduled_date == Carbon\Carbon::now()->addDay(1)->toDateString()){
										$scheduled_date = "Tomorrow";
									}
								@endphp
								<td>{{ $scheduled_date }}</td>
								<td>{{ date('h:i A', strtotime($schedule->time)) }}</td>
								<td>
									<a href="{{ route('app.schedule.edit', $schedule->id) }}" class="btn btn-xs btn-success">
										<span class="fa fa-edit"></span> Edit
									</a>
									<button class="btn btn-xs btn-danger" for="submit-form" tabindex="0" form="{{ $schedule->id }}myform"><span class='fa fa-trash'></span> Cancel
										<form class="delete" method="POST" action="{{ route('app.schedule.destroy', $schedule->id) }}" id="{{ $schedule->id }}myform">
											{{ method_field('DELETE') }}
											{{ csrf_field() }}
										</form>
									</button>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<br>
				<div class="row">
					<div class="col-md-10">
						{{ $schedules->appends(request()->input())->links() }}
					</div>
					<div class="col-md-2 text-right">
						Total <b>{{ $total_schedule }}</b> result(s)
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script
src="{{ asset('js/jquery.min.js') }}"></script>
<script>
$(document).ready(function() {
	$(".delete").on("submit", function(){
		return confirm("Are you sure?");
	});
});
</script>
@endsection
