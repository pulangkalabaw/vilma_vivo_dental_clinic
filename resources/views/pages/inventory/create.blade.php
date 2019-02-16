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
								Inventory Management / Create
							</div>
							<div class="col-md-6 text-right">
								<a href="{{ route('app.inventory.index') }}" class="btn btn-sm btn-default">
									<span class="fa fa-book"></span>
									List of inventories
								</a>
							</div>
						</div>
					</div>
					<div class="panel-body">

						@include('includes.notif')
						<div class="row">
							<div class="col-md-6">
								<form class="" action="{{ route('app.inventory.store') }}" method="post">

									{{ csrf_field() }}
									<div class="row">
										<div class="col-md-3">
											Item #
										</div>
										<div class="col-md-9">
											<input type="text" name="item_id" id="" class="form-control" value="{{ old('item_id') }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Item name
										</div>
										<div class="col-md-9">
											<input type="text" name="item_name" id="" class="form-control" value="{{ old('item_name') }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Quantity
										</div>
										<div class="col-md-9">
											<input type="number" name="quantity" id="" class="form-control" value="{{ old('quantity') }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Item date
										</div>
										<div class="col-md-9">
											<input type="date" name="item_date" id="" class="form-control" value="{{ old('item_date') }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />


									<div class="row">
										<div class="col-md-3">
											Description
										</div>
										<div class="col-md-9">
											<textarea name="description" maxlength="150" id="" class="form-control" required>{{ old('description') }}</textarea>
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
