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
								Inventory Management / In
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
								<form class="" action="{{ route('app.inventory.in.process') }}" method="post">

									{{ csrf_field() }}
									<div class="row">
										<div class="col-md-3">
											Select item
										</div>
										<div class="col-md-9">
											<select name="inventory_id" id="inventory_id" class="form-control" required>
												<option value="" disabled selected>-- Please select --</option>
												@foreach ($inventories as $inventory)
												<option value="{{ $inventory->id }}">
													{{ $inventory->item_name }}
												</option>
											@endforeach
											</select>
										</div>
									</div>
									<div class="clearfix"></div><br />


									<div class="row">
										<div class="col-md-3">
											Quantity out
										</div>
										<div class="col-md-9">
											<input type="number" name="quantity" id="" class="form-control" required>
										</div>
									</div>
									<div class="clearfix"></div><br />

									<div class="row">
										<div class="col-md-3">
											Remarks
										</div>
										<div class="col-md-9">
											<textarea name="remarks" maxlength="150" id="" class="form-control" >{{ old('remarks') }}</textarea>
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

<script>
	function getQuantity(){

		$('#quantity').html('Loading please wait..');

		$.ajax({
			url: '{{ url('inventory') }}/' + $('#inventory_id').val(),
			method: 'GET',
			success: function(response){
				$('#quantity').html('');

				if (response.status == 200) {
					$('#quantity').append('<select name="quantity" class="form-control" id="quantity_select">');
					for (var i = 1; i <= parseInt(response.data.quantity); i++) {
						$('#quantity_select').append('<option value="'+i+'">'+i+'</option>');
					}
					$('#quantity_select').append('</select>');
				}
				console.log(response)
			}
		});
	}
</script>
