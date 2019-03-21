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
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<h4>Customer Information</h4>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												Name
											</div>
											<div class="col-md-9">
												<input type="text" name="name" id="" class="form-control" value="{{ old('name') }}" required>
											</div>
										</div>
										<div class="clearfix"></div><br />
										<div class="row">
											<div class="col-md-3">
												Contact
											</div>
											<div class="col-md-9">
												<input type="text" name="contact" id="" class="form-control" value="{{ old('contact') }}" required>
											</div>
										</div>
										<div class="clearfix"></div><br />
										<div class="row">
											<div class="col-md-3">
												Address
											</div>
											<div class="col-md-9">
												<input type="text" name="address" id="" class="form-control" value="{{ old('address') }}" required>
											</div>
										</div>
										<div class="clearfix"></div><br />
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<h4>Schedule Details</h4>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												Date
											</div>
											<div class="col-md-9">
												<input type="date" name="date" id="scheduleDate" class="form-control" value="{{ old('date') }}" min="{{ Carbon\Carbon::now()->toDateString() }}" required onchange="checkScheduleCount()">
												<label style="color: red;" hidden id="date_message">You can only add 5 schedules on every date</label>
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
									</div>
									<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-9">
											{{-- <button class="btn btn-primary btn-sm pull-right" {{ $total_today >= 5 ? 'disabled' : '' }}> --}}
											<button class="btn btn-primary btn-sm pull-right" id="schedule_submit">
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
