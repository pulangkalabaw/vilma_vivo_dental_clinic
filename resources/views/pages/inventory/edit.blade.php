@extends('layouts.app')

@section('content')


	<div id="myin" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width: 950px;">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Stock in History</h4>
				</div>
				<div class="modal-body">
					<div style="background: transparent; height: 400px; overflow:auto">
					<table class="table table-hovered">
						<thead>
							<tr>
								<th>
									Inventory
								</th>
								<th>
									Quantity in
								</th>
								<th>
									Current quantity
								</th>
								<th>
									Item Date
								</th>
								<th>Remarks</th>
								<th>User</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($inventory->in as $in)
								<tr>
									<td>
										{{ $in->inventory->item_name }}
									</td>
									<td>
										{{ $in->quantity }}
									</td>
									<td>
										{{ $in->remaining_quantity }}
									</td>
									<td>
										{{ $in->created_at }}
									</td>
									<td>
										{{ $in->remarks }}
									</td>
									<td>
										{{ $in->added->name }}
									</td>
									<td>
										{{ $in->created_at->diffForHumans() }}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>


	<div id="myout" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width: 950px;">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Stock out History</h4>
				</div>
				<div class="modal-body">
					<div style="background: transparent; height: 400px; overflow:auto">
					<table class="table table-hovered">
						<thead>
							<tr>
								<th>
									Inventory
								</th>
								<th>
									Quantity out
								</th>
								<th>
									Remaining quantity
								</th>
								<th>
									Item Date
								</th>
								<th>Remarks</th>
								<th>User</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($inventory->out as $out)
								<tr>
									<td>
										{{ $out->inventory->item_name }}
									</td>
									<td>
										{{ $out->quantity }}
									</td>
									<td>
										{{ $out->remaining_quantity }}
									</td>
									<td>
										{{ $out->created_at }}
									</td>
									<td>
										{{ $out->remarks }}
									</td>
									<td>
										{{ $out->added->name }}
									</td>
									<td>
										{{ $out->created_at->diffForHumans() }}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>


	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Inventory History</h4>
				</div>
				<div class="modal-body">
					<table class="table table-hovered">
						<thead>
							<tr>
								<th>
									Item #
									<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'item_id', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
										<span class='fa fa-sort'></span>
									</a>
								</th>
								<th>
									Name
									<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'item_name', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
										<span class='fa fa-sort'></span>
									</a>
								</th>
								<th>
									Quantity
									<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'quantity', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
										<span class='fa fa-sort'></span>
									</a>
								</th>
								<th>
									Item Date
									<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'item_date', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
										<span class='fa fa-sort'></span>
									</a>
								</th>
								<th>Description</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($inventory->history as $inventory1)
								<tr>
									<td>
										{{ $inventory1->item_id }}
									</td>
									<td>
										{{ $inventory1->item_name }}
									</td>
									<td>
										{{ $inventory1->quantity }}
									</td>
									<td>
										{{ $inventory1->item_date }}
									</td>
									<td>
										{{ str_limit($inventory1->description, 20) }}
									</td>
									<td>
										{{ $inventory1->created_at->diffForHumans() }}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>



	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-6">
								<span class="fa fa-book"></span>
								Inventory Management / {{ $inventory->item_name }}
							</div>
							<div class="col-md-6 text-right">
								<a href="{{ route('app.inventory.create') }}" class="btn btn-sm btn-primary">
									<span class="fa fa-plus-circle"></span>
									Add new item
								</a>
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
								<form class="" action="{{ route('app.inventory.update', $inventory->id) }}" method="post">

									{{ csrf_field() }}
									{{ method_field('PUT') }}

									<div class="row">
										<div class="col-md-3">
											Item #
										</div>
										<div class="col-md-9">
											<input type="text" name="item_id" id="" class="form-control" value="{{ $inventory->item_id }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Item name
										</div>
										<div class="col-md-9">
											<input type="text" name="item_name" id="" class="form-control" value="{{ $inventory->item_name }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Quantity
										</div>
										<div class="col-md-9">
											{{ $inventory->quantity }}
											{{-- <input type="number" name="quantity" id="" class="form-control" value="{{ $inventory->quantity }}" required> --}}
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Item date
										</div>
										<div class="col-md-9">
											<input type="date" name="item_date" id="" class="form-control" value="{{ $inventory->item_date }}" required>
										</div>
									</div>
									<div class="clearfix"></div><br />


									<div class="row">
										<div class="col-md-3">
											Description
										</div>
										<div class="col-md-9">
											<textarea name="description" maxlength="150" id="" class="form-control" required>{{ $inventory->description }}</textarea>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-9">
											<button class="btn btn-success btn-sm pull-right">
												<span class="fa fa-edit"></span>
												Update changes
											</button>
										</div>
									</div>
									<div class="clearfix"></div><br />

								</form>

								<hr>
								{{-- <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal">View inventory history</button> --}}
								<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myout">View stock out history</button>
								<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myin">View stock in history</button>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
