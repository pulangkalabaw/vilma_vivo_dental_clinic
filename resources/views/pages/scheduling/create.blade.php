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
								Scheduling Management / Create
							</div>
							<div class="col-md-6 text-right">
								<a href="{{ route('app.schedule.index') }}" class="btn btn-sm btn-default">
									<span class="fa fa-book"></span>
									List of Schedules
								</a>
							</div>
						</div>
					</div>
					<div class="panel-body">

						@include('includes.notif')
						<div class="row">
							<div class="col-md-6">
								<form class="" action="{{ route('app.schedule.store') }}" method="post">

									{{ csrf_field() }}
									<div class="row">
										<div class="col-md-3">
											name
										</div>
										<div class="col-md-9">
											<input type="text" name="name" id="" class="form-control" value="{{ old('name') }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Date
										</div>
										<div class="col-md-9">
											<input type="date" name="date" id="" class="form-control" value="{{ old('date') }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Time
										</div>
										<div class="col-md-9">
											<input type="time" name="time" id="" class="form-control" value="{{ old('time') }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-9">
											<button class="btn btn-primary btn-sm pull-right">
												<span class="fa fa-plus-circle"></span>
												Submit
											</button>
										</div>
									</div>
									<div class="clearfix"></div><br />
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
