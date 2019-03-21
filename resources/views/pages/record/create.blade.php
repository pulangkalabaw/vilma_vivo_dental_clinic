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
						<form class="" action="{{ route('app.record.store') }}" method="post">
							<div class="row">
								<div class="col-md-6">

									{{ csrf_field() }}
									<div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<h4>Customer Information</h4>
											</div>
										</div>

										<div class="row">
											<div class="col-md-3">
											</div>
											<div class="col-md-9">
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<div class="radio radio-default">
																<input id="chooseWalkin" type="radio" name="choose-option" value="0" checked="checked" onclick="$('#tracking_no_container').hide(); $('input').val('');">
																<label for="chooseWalkin" onclick="$('#tracking_no_container').hide(); $('#trackingNo').val(''); $('#trackMessage').hide();">Walk-In</label>
															</div>
														</div>
														<div class="col-md-9">
															<div class="radio radio-default">
																<input id="chooseExisting" type="radio" name="choose-option" value="1" onclick="$('#tracking_no_container').show();">
																<label for="chooseExisting" onclick="$('#tracking_no_container').show();">Existing</label>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group">
												</div>
											</div>
										</div>

										<div class="row" id="tracking_no_container" hidden>
											<div class="col-md-3">
												<label class="pull-right">Tracking No</label>
											</div>
											<div class="col-md-5">
												<input type="text" id="trackingNo" name="trackingNo" class="form-control" value="{{ old('name') }}">
												<button type="button" class="btn btn-sm btn-info" onclick="searchTrackingNo()">Search</button>
												<label class="text-danger" id="trackMessage" hidden>Invalid Tracking No!</label>
											</div>
										</div>
										<div class="clearfix"></div><br />
										<div class="row">
											<div class="col-md-3">
												Name
											</div>
											<div class="col-md-9">
												<input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
											</div>
										</div>
										<div class="clearfix"></div><br />
										<div class="row">
											<div class="col-md-3">
												Contact
											</div>
											<div class="col-md-9">
												<input type="text" name="contact" id="contact" class="form-control" value="{{ old('contact') }}" required>
											</div>
										</div>
										<div class="clearfix"></div><br />
										<div class="row">
											<div class="col-md-3">
												Address
											</div>
											<div class="col-md-9">
												<input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
											</div>
										</div>
										<div class="clearfix"></div><br />
									</div>
								</div>
							</div>
	                        <div class="row">
	                            <div class="col-md-12">
	                                <div class="form-group">
	                                    <h4>Schedule Details</h4>
	                                    <div class="panel">
	                                        <div class="panel-body">
												<div class="form-group">
													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<div style="background: red; width: 50px; height: 25px; position: absolute; margin-left: 70px;" >
																</div>
																<label class="font-size-15" style="">Normal</label>
															</div>
															<div class="form-group">
																<div style="background: #99CC99; width: 50px; height: 25px; position: absolute; margin-left: 70px;" >
																</div>
																<label class="font-size-15">Cavities</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<div style="background: #9999FF; width: 50px; height: 25px; position: absolute; margin-left: 120px;" >
																</div>
																<label class="font-size-15" style="">Chipped Tooth</label>
															</div>
															<div class="form-group">
																<div style="background: #F9DEB8; width: 50px; height: 25px; position: absolute; margin-left: 120px;" >
																</div>
																<label class="font-size-15">Cracked Tooth</label>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<div style="background: #FF9999; width: 50px; height: 25px; position: absolute; margin-left: 120px;" >
																</div>
																<label class="font-size-15">Gum Problem</label>
															</div>
														</div>
													</div>
												</div>
												@php
													$topTooths = [];
													for($x = 1; $x <= 16; $x++){
														$topTooths []= 'tooth-' . $x;
													}
													$bottomTooths = [];
													for($x = 17; $x <= 32; $x++){
														$bottomTooths []= 'tooth-' . $x;
													}
													// dd($topTooths);
												@endphp
												<center>
													<table>
														<thead>
															<tr>
																@foreach($topTooths as $index => $tooth)
																<th class="th-container cursor-hand" data-toggle="modal" data-target="#tooth-modal" onclick="getToothInfo('{{ $tooth }}')">
																	<input type="hidden" name="tooth[{{ $index }}][tooth]" id="tooth_{{ $tooth }}" value="{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index }}][symptom]" id="tooth_symptom_{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index }}][description]" id="tooth_description_{{ $tooth }}">
																	<img src="{{ asset('public/assets/images/tooths/' . $tooth . '.png')}}" alt="{{ $tooth }}" style="width: 100%">
																	<div class="overlay" id="tooth-display-{{ $tooth }}">
																	</div>
																</th>
																@endforeach
															</tr>
														</thead>
														<tfoot>
															<tr>
																@foreach(array_reverse($bottomTooths) as $index => $tooth)
																<th class="th-container cursor-hand" data-toggle="modal" data-target="#tooth-modal" onclick="getToothInfo('{{ $tooth }}')">
																	<input type="hidden" name="tooth[{{ $index + 16 }}][tooth]" id="tooth_{{ $tooth }}" value="{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index + 16 }}][symptom]" id="tooth_symptom_{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index + 16 }}][description]" id="tooth_description_{{ $tooth }}">
																	<img src="{{ asset('public/assets/images/tooths/' . $tooth . '.png' )}}" alt="{{ $tooth }}" style="width: 100%">
																	<div class="overlay" id="tooth-display-{{ $tooth }}">
																	</div>
																</th>
																@endforeach
															</tr>
														</tfoot>
													</table>
												</center>
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
						</form>
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
					<div class="row vertical-align">
						<div class="col-sm-4">
							<center>
								<img src="" alt="" id="tooth-image">
								<div class="overlay-modal" id="tooth-overlay">
								</div>
							</center>
						</div>
						<div class="col-sm-8">
							<div class="form-group">
								<label for="">Mark tooth as</label>
								<div class="radio radio-default">
									<input id="select_normal" type="radio" name="symptom" value="Normal" checked="checked" id="default-symptom" class="choose-symptom" onclick="changeSymptom('normal'); $('#modal-tooth-description').val('');">
									<label for="select_normal" onclick="changeSymptom('normal'); $('#modal-tooth-description').val('');">Normal</label>
								</div>
								<div class="radio radio-success">
									<input id="select_cavities" type="radio" name="symptom" value="Cavities" class="choose-symptom" onclick="changeSymptom('cavities');">
									<label for="select_cavities" onclick="changeSymptom('cavities');">Cavities</label>
								</div>
								<div class="radio radio-info">
									<input id="select_chipped" type="radio" name="symptom" value="Chipped Tooth" class="choose-symptom" onclick="changeSymptom('chipped');">
									<label for="select_chipped" onclick="changeSymptom('chipped');">Chipped Tooth</label>
								</div>
								<div class="radio radio-warning">
									<input id="select_cracked" type="radio" name="symptom" value="Cracked Tooth" class="choose-symptom" onclick="changeSymptom('cracked');">
									<label for="select_cracked" onclick="changeSymptom('cracked');">Cracked Tooth</label>
								</div>
								<div class="radio radio-danger">
									<input id="select_gum" type="radio" name="symptom" value="Gum Problems" class="choose-symptom" onclick="changeSymptom('gum_problem');">
									<label for="select_gum" onclick="changeSymptom('gum_problem');">Gum Problems</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Description:</label>
								<input type="hidden" id="tooth-hidden">
								<input type="hidden" id="tooth-symptom-hidden">
								<textarea name="description" rows="3" class="form-control" id="modal-tooth-description"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button class="btn btn-primary" onclick="getRecord()" data-dismiss="modal" aria-label="Close">Record</button>
				</div>
			</div>
		</div>
	</div>
@endsection
<script>
	function searchTrackingNo(){
		tracking_no = $('#trackingNo').val();
		$.ajax({
			url: '{{ url('record/get-tracking-no/') }}/' + tracking_no,
			method: 'GET',
			success:function(response){
				// console.log(response);
				if(response != "invalid"){
					$('#name').val(response.name);
					$('#address').val(response.address);
					$('#contact').val(response.contact);
					$('#trackMessage').hide();
				} else {
					$('#trackMessage').show();
				}
			}
		});
	}

	function changeSymptom(symptom){
		$('#tooth-symptom-hidden').val(symptom);
		$('#tooth-overlay').attr('class', '').attr('class', 'overlay-modal ' + symptom);
	}
	function getToothInfo(tooth){

        var thisSymptom = $.trim($('#tooth_symptom_' + tooth).val()).length != 0 ? $.trim($('#tooth_symptom_' + tooth).val()) : 'normal';
        var thisDescription = $('#tooth_description_' + tooth).val() != null ? $('#tooth_description_' + tooth).val() : 'normal';
        var select_tooth = 'select_normal';
		if(thisSymptom == 'cavities'){
			select_tooth = 'select_cavities';
		} else if(thisSymptom == 'chipped'){
			select_tooth = 'select_chipped';
		} else if(thisSymptom == 'cracked'){
			select_tooth = 'select_cracked';
		} else if(thisSymptom == 'gum_problem'){
			select_tooth = 'select_gum';
		}
        // alert(thisSymptom);
        // alert(select_tooth);
		console.log(thisSymptom);

        $("#" + select_tooth).prop('checked', true).click();
		// $('#tooth-overlay').attr('class', '').attr('class', 'overlay-modal ' + symptom);
		$('#tooth-overlay').attr('class', 'overlay-modal ' + thisSymptom);
        $("#" + select_tooth).prop('checked', true).click();
		$('#tooth-image').attr('src', '{{ asset('public/assets/images/tooths/' ) }}/' + tooth + '.png');
		$('#tooth-hidden').val(tooth);
        $('#modal-tooth-description').val(thisDescription);
        $('#tooth-symptom-hidden').val(thisSymptom);
	}
	function getRecord(){
		$('#tooth-display-' + $('#tooth-hidden').val()).attr('class', 'overlay ' + $('#tooth-symptom-hidden').val());
		$('#tooth_symptom_' + $('#tooth-hidden').val()).val($('#tooth-symptom-hidden').val());
		$('#tooth_description_' + $('#tooth-hidden').val()).val($('#modal-tooth-description').val());
	}
</script>
