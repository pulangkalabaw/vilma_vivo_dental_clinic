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
								Inventory Management
							</div>
							<div class="col-md-6 text-right">
								<a href="{{ route('app.inventory.create') }}" class="btn btn-sm btn-primary">
									<span class="fa fa-plus-circle"></span>
									Add new item
								</a>
							</div>
						</div>
					</div>
					<div class="panel-body">

						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6"></div>

								<div class="col-md-6 pull-right">
									<div class="col-md-10">
										<input type="text" name="" id="" class="form-control">
									</div>
									<div class="col-md-2">
										<button class="btn btn-default">
											<span class="fa fa-search"></span>
										</button>
									</div>
								</div>
							</div>
						</div>

						<table class="table table-hovered">
							<thead>
								<tr>
									<th>Item #</th>
									<th>Name</th>
									<th>Quantity</th>
									<th>Item Date</th>
									<th>Added by</th>
									<th>Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($inventories as $inventory)
									<tr>
										<td>
											{{ $inventory->item_id }}
										</td>
										<td>
											{{ $inventory->item_name }}
										</td>
										<td>
											{{ $inventory->quantity }}
										</td>
										<td>
											{{ $inventory->item_date }}
										</td>
										<td>
											{{ $inventory->added_by }}
										</td>
										<td>
											{{ $inventory->description }}
										</td>
										<td>
											<a href="{{ route('app.users.edit', $inventory->id) }}" class="btn btn-xs btn-success">
												<span class="fa fa-edit"></span> Edit
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
