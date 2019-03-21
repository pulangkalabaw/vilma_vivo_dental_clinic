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
	</div>
</div>
@endsection
