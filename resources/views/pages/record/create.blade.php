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
								Record Management / Create
							</div>
							<div class="col-md-6 text-right">
								<a href="{{ route('app.record.index') }}" class="btn btn-sm btn-default">
									<span class="fa fa-book"></span>
									List of Records
								</a>
							</div>
						</div>
					</div>
					<div class="panel-body">

						@include('includes.notif')
						<div class="row">
							<div class="col-md-6">
								<form class="" action="{{ route('app.record.store') }}" method="post">

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
								</form>
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4>Schedule Details</h4>
                                    <div class="panel">
                                        <div class="panel-body">
											@php
												$topTooths = [];
												for($x = 1; $x <= 16; $x++){
													$topTooths []= 'tooth-' . $x . '.png';
												}
												$bottomTooths = [];
												for($x = 17; $x <= 32; $x++){
													$bottomTooths []= 'tooth-' . $x . '.png';
												}
												// dd($topTooths);
											@endphp
											<table>
												<thead>
													<tr>
														@foreach($topTooths as $tooth)
														<th>
															<div id="image-overlay2" class="cursor-hand">
																<img src="{{ asset('public/assets/images/tooths/' . $tooth )}}" alt="{{ $tooth }}" style="width: 100%">
																{{-- <img src="http://lorempixel.com/100/100/food" height="100" width="100" /> --}}
															</div>
														</th>
														@endforeach
													</tr>
												</thead>
												<tfoot>
													<tr>
														@foreach(array_reverse($bottomTooths) as $tooth)
														<th class="th-container cursor-hand" data-toggle="modal" data-target="#tooth-modal" onclick="getToothInfo('{{ $tooth }}')">
															<img src="{{ asset('public/assets/images/tooths/' . $tooth )}}" alt="{{ $tooth }}" style="width: 100%">
															<div class="overlay cracked">
															</div>
														</th>
														@endforeach
													</tr>
												</tfoot>
											</table>
                                        </div>
                                    </div>
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
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
<div class="modal fade" id="tooth-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tooth Description</h4>
      </div>
      <div class="modal-body">
        <div class="row ">
        	<div class="col-sm-3">
				<center>
					<img src="" alt="" id="tooth-image">
				</center>
        	</div>
        	<div class="col-sm-9">
        		<div class="form-group">
        			<label for="">Select Symptoms: </label>
					<div class="checkbox checkbox-primary">
						<input id="ch1" type="checkbox" checked="checked">
						<label for="ch1">Primary</label>
					</div>
        		</div>
				<div class="form-group">
					<label>Description:</label>
					<textarea name="description" rows="3" class="form-control"></textarea>
					{{-- <input type="text" class="form-control"> --}}
				</div>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection
<script>
	function getToothInfo(tooth){
		$('#tooth-image').attr('src', '{{ asset('public/assets/images/tooths/' ) }}/' + tooth);
	}
</script>
