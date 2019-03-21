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
								<form class="" action="{{ route('app.schedule.update', $schedule->id) }}" method="post">
									{{ csrf_field() }}
									{{ method_field('PUT') }}
									<div class="row">
										<div class="col-md-3">
											name
										</div>
										<div class="col-md-9">
											<input type="text" name="name" id="" class="form-control" value="{{ $schedule->name }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Date
										</div>
										<div class="col-md-9">
											<input type="date" name="date" id="scheduleDate" class="form-control" value="{{ $schedule->date }}" min="{{ Carbon\Carbon::now()->toDateString() }}" required onchange="checkScheduleCount()">
											<label style="color: red;" hidden id="date_message">You can only add 5 schedules on every date</label>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Time
										</div>
										<div class="col-md-9">
											<input type="time" name="time" id="" class="form-control" value="{{ $schedule->time }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-9">
											<button id="schedule_submit" class="btn btn-primary btn-sm pull-right">
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


	<script>
		function checkScheduleCount(){
			// alert('{{ url('schedule/check-date') }}');
			$.ajax({
				url: '{{ url('schedule/check-date') }}?date=' + $('#scheduleDate').val(),
				method: 'GET',
				success: function(response){
					// alert(response);
					if(response >= 5){
						$('#schedule_submit').attr('disabled', true);
						$('#date_message').show();
					} else {
						$('#schedule_submit').attr('disabled', false);
						$('#date_message').hide();
					}
				}
			});
		}
	</script>

@endsection
