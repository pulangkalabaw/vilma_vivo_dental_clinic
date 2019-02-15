@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-6">
								<span class="fa fa-users"></span>
								User Management / {{ $user->name }}
							</div>
							<div class="col-md-6 text-right">
								<a href="{{ route('app.users.create') }}" class="btn btn-sm btn-primary">
									<span class="fa fa-plus-circle"></span>
									Add new user
								</a>
								<a href="{{ route('app.users.index') }}" class="btn btn-sm btn-default">
									<span class="fa fa-th-list"></span>
									List of users
								</a>
							</div>
						</div>
					</div>
					<div class="panel-body">
						@include('includes.notif')
						<div class="row">
							<div class="col-md-6">
								<form class="" action="{{ route('app.users.update', $user->id) }}" method="post">

									{{ csrf_field() }}
									{{ method_field('PUT') }}
									<div class="row">
										<div class="col-md-3">
											Name
										</div>
										<div class="col-md-9">
											<input type="text" name="name" id="" class="form-control" value="{{ $user->name }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Email
										</div>
										<div class="col-md-9">
											<input type="email" name="email" id="" class="form-control" value="{{ $user->email }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Password
										</div>
										<div class="col-md-9">
											<input type="password" name="password" id="" class="form-control">
											<small>if no change, leave it blank </small>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Confirm password
										</div>
										<div class="col-md-9">
											<input type="password" name="password_confirmation" id="" class="form-control">
											<small>if no change, leave it blank </small>
										</div>
									</div>
									<div class="clearfix"></div><br />


									<div class="row">
										<div class="col-md-3">
											Role
										</div>
										<div class="col-md-9">
											<select name="role" id="" class="form-control" required>
												<option value="admin">Admin</option>
												<option value="staff">Staff</option>
											</select>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-9">
											<button class="btn btn-sm btn-success pull-right">
												<span class="fa fa-edit"></span>
												Update changes
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
