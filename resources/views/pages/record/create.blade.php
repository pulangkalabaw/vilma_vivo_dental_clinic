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
												<label class="pull-right">ID Number</label>
											</div>
											<div class="col-md-5">
												<input type="text" id="trackingNo" name="trackingNo" class="form-control" value="{{ old('tracking_no') }}">
												<button type="button" id="btn_search" class="btn btn-sm btn-info" onclick="searchTrackingNo()">Search</button>
												<label class="text-danger" id="trackMessage" hidden>Invalid Tracking No!</label>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-3">
												First Name
											</div>
											<div class="col-md-9">
												<input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-3">
												Last Name
											</div>
											<div class="col-md-9">
												<input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" required>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-3">
												Initial Name
											</div>
											<div class="col-md-9">
												<input type="text" name="initial_name" id="initial_name" class="form-control" value="{{ old('initial_name') }}" required>
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
	                                    <h4>Tooth Details</h4>
	                                    <div class="panel">
	                                        <div class="panel-body">
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
														<thead style="border-bottom: 1px solid black;">
															<tr>
																<th colspan="8">
																	<h3 class="text-center">Upper Left</h3>
																</th>
																<th colspan="8">
																	<h3 class="text-center">Upper Right</h3>
																</th>
															</tr>
															<tr>
																<th colspan="4"></th>
																<th colspan="3" style=""><h5 class="text-center" style="padding-left: 10%; padding-bottom: 0px; height: 0px">Canines</h5></th>
																<th colspan="2"></th>
																<th colspan="3" style=""><h5 class="text-center" style="padding-left: 0%; padding-bottom: 0px; height: 0px">Canines</h5></th>
															</tr>
															<tr>
																<th colspan="3"></th>
																<th colspan="2"></th>
																{{-- <th rowspan="3" style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; height: 20px;"></th> --}}
																<th rowspan="3" style="padding-top: 0px;"><div style="margin-bottom: -8px; margin-left: 50%; height: 50px; width: 1px;border-left: 1px solid black;"></div></th>
																<th colspan="4"></th>
																<th rowspan="3" style="padding-top: 0px;"><div style="margin-bottom: -8px; margin-left: 50%; height: 50px; width: 1px;border-left: 1px solid black;"></div></th>
															</tr>
															<tr>
																<th colspan="3"><h5 class="text-center">Molars</h5></th>
																<th colspan="2"><h5 class="text-center">Premolars</h5></th>
																<th colspan="4"><h5 class="text-center">Incisors</h5></th>
																<th colspan="2"><h5 class="text-center">Premolars</h5></th>
																<th colspan="3"><h5 class="text-center">Molars</h5></th>
															</tr>
															<tr style="padding: 10px;">
																<th colspan="3" style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; height: 20px;"></th>
																<th colspan="2" style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; height: 20px;"></th>
																<th colspan="4" style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; height: 20px;"></th>
																<th colspan="2" style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; height: 20px;"></th>
																<th colspan="3" style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; height: 20px;"></th>
															</tr>
															<tr>
																@foreach($topTooths as $index => $tooth)
																<th class="th-container cursor-hand" data-toggle="modal" data-target="#tooth-modal" onclick="getToothInfo('{{ $tooth }}')">
																	<input type="hidden" name="tooth[{{ $index }}][tooth]" id="tooth_{{ $tooth }}" value="{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index }}][symptom]" id="tooth_symptom_{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index }}][color]" id="tooth_color_{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index }}][description]" id="tooth_description_{{ $tooth }}">
																	<img src="{{ asset('public/assets/images/tooths/' . $tooth . '.png')}}" alt="{{ $tooth }}" style="width: 100%">
																	<div class="overlay" id="tooth-display-{{ $tooth }}">
																	</div>
																</th>
																@endforeach
															</tr>
														</thead>
														<tfoot style="border-top: 1px solid black;">
															<tr>
																@foreach(array_reverse($bottomTooths) as $index => $tooth)
																<th class="th-container cursor-hand" data-toggle="modal" data-target="#tooth-modal" onclick="getToothInfo('{{ $tooth }}')">
																	<input type="hidden" name="tooth[{{ $index + 16 }}][tooth]" id="tooth_{{ $tooth }}" value="{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index + 16 }}][symptom]" id="tooth_symptom_{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index + 16 }}][color]" id="tooth_color_{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index + 16 }}][description]" id="tooth_description_{{ $tooth }}">
																	<img src="{{ asset('public/assets/images/tooths/' . $tooth . '.png' )}}" alt="{{ $tooth }}" style="width: 100%">
																	<div class="overlay" id="tooth-display-{{ $tooth }}">
																	</div>
																</th>
																@endforeach
															</tr>
															<tr>
																<th colspan="8">
																	<h3 class="text-center">Lower Left</h3>
																</th>
																<th colspan="8">
																	<h3 class="text-center">Lower Right</h3>
																</th>
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
						<div class="col-md-4 col-sm-5 col-5">
							<center>
								<img src="" alt="" id="tooth-image">
								<div class="overlay-modal" id="tooth-overlay">
								</div>
							</center>
						</div>
						<div class="col-md-8 col-sm-7 col-7">
							<div class="form-group">
								<label for="">Choose Treatment</label>
								<div class="row">
									<div class="col-md-6">
										<div class="checkbox">
											<input id="root" type="checkbox" name="symptom" value="root" class="choose-symptom">
											<label for="root">Root Canal Treatment</label>
										</div>
										<div class="checkbox">
											<input id="cosmetic_dentistry" type="checkbox" name="symptom" value="cosmetic_dentistry" class="choose-symptom">
											<label for="cosmetic_dentistry">Cosmetic Dentistry</label>
										</div>
										<div class="checkbox">
											<input id="dental_crown" type="checkbox" name="symptom" value="dental_crown" class="choose-symptom">
											<label for="dental_crown">Dental Crown</label>
										</div>
										<div class="checkbox">
											<input id="tooth_whitening" type="checkbox" name="symptom" value="tooth_whitening" class="choose-symptom">
											<label for="tooth_whitening">Tooth Whitening</label>
										</div>
										<div class="checkbox">
											<input id="dental_implants" type="checkbox" name="symptom" value="dental_implants" class="choose-symptom">
											<label for="dental_implants">Dental Implants</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkbox">
											<input id="dental_bridge" type="checkbox" name="symptom" value="dental_bridge" class="choose-symptom">
											<label for="dental_bridge">Dental Bridge</label>
										</div>
										<div class="checkbox">
											<input id="periodontics" type="checkbox" name="symptom" value="periodontics" class="choose-symptom">
											<label for="periodontics">Periodontics</label>
										</div>
										<div class="checkbox">
											<input id="orthodontics" type="checkbox" name="symptom" value="orthodontics" class="choose-symptom">
											<label for="orthodontics">Orthodontics</label>
										</div>
										<div class="checkbox">
											<input id="dentures" type="checkbox" name="symptom" value="dentures" class="choose-symptom">
											<label for="dentures">Dentures</label>
										</div>
										<div class="checkbox">
											<input id="maxillofacial" type="checkbox" name="symptom" value="maxillofacial" class="choose-symptom">
											<label for="maxillofacial">Maxillofacial Prosthesis</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Choose Color</label>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group vertical-align">
											<div style="background: fff; border: 1px solid black; width: 50px; height: 25px; position: absolute; margin-left: 25px;" class="cursor-hand" onclick="chooseColor('color0')"></div>
											<div class="radio">
												<input type="radio" name="color" id="color0" value="color0" class="choose-color cursor-hand" onclick="chooseColor('color0')">
												<label></label>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group vertical-align">
											<div style="background: #C60820; width: 50px; height: 25px; position: absolute; margin-left: 25px;" class="cursor-hand" onclick="chooseColor('color1')"></div>
											<div class="radio">
												<input type="radio" name="color" id="color1" value="color1" class="choose-color cursor-hand" onclick="chooseColor('color1')">
												<label></label>
											</div>
										</div>
										<div class="form-group vertical-align">
											<div style="background: #FAE596; width: 50px; height: 25px; position: absolute; margin-left: 25px;" class="cursor-hand" onclick="chooseColor('color2')"></div>
											<div class="radio">
												<input type="radio" name="color" id="color2" value="color2" onclick="chooseColor('color2')">
												<label></label>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group vertical-align">
											<div style="background: #3FB0AC; width: 50px; height: 25px; position: absolute; margin-left: 25px;" class="cursor-hand" onclick="chooseColor('color3')"></div>
											<div class="radio">
												<input type="radio" name="color" id="color3" value="color3" onclick="chooseColor('color3')">
												<label></label>
											</div>
										</div>
										<div class="form-group vertical-align">
											<div style="background: #C19434; width: 50px; height: 25px; position: absolute; margin-left: 25px; cursor: pointer;" class="cursor-hand" onclick="chooseColor('color4')"></div>
											<div class="radio">
												<input type="radio" name="color" id="color4" value="color4" onclick="chooseColor('color4')">
												<label></label>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group vertical-align">
											<div style="background: #CDD423; width: 50px; height: 25px; position: absolute; margin-left: 25px;" class="cursor-hand" onclick="chooseColor('color5')"></div>
											<div class="radio">
												<input type="radio" name="color" id="color5" value="color5" onclick="chooseColor('color5')">
												<label></label>
											</div>
										</div>
										<div class="form-group vertical-align">
											<div style="background: #E05916; width: 50px; height: 25px; position: absolute; margin-left: 25px;" class="cursor-hand" onclick="chooseColor('color6')"></div>
											<div class="radio">
												<input type="radio" name="color" id="color6" value="color6"onclick="chooseColor('color6')">
												<label></label>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group vertical-align">
											<div style="background: #431C5D; width: 50px; height: 25px; position: absolute; margin-left: 25px;" class="cursor-hand" onclick="chooseColor('color7')"></div>
											<div class="radio">
												<input type="radio" name="color" id="color7" value="color7"onclick="chooseColor('color7')">
												<label></label>
											</div>
										</div>
										<div class="form-group vertical-align">
											<div style="background: #000000; width: 50px; height: 25px; position: absolute; margin-left: 25px;" class="cursor-hand" onclick="chooseColor('color8')"></div>
											<div class="radio">
												<input type="radio" name="color" id="color8" value="color8"onclick="chooseColor('color8')">
												<label></label>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group vertical-align">
											<div style="background: #F8E5E5; width: 50px; height: 25px; position: absolute; margin-left: 25px;" class="cursor-hand" onclick="chooseColor('color9')"></div>
											<div class="radio">
												<input type="radio" name="color" id="color9" value="color9"onclick="chooseColor('color9')">
												<label></label>
											</div>
										</div>
										<div class="form-group vertical-align">
											<div style="background: #3CA956; width: 50px; height: 25px; position: absolute; margin-left: 25px;" class="cursor-hand" onclick="chooseColor('color10')"></div>
											<div class="radio">
												<input type="radio" name="color" id="color10" value="color10"onclick="chooseColor('color10')">
												<label></label>
											</div>
										</div>
									</div>
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
		$('#btn_search').attr('disabled', true);
		$.ajax({
			url: '{{ url('record/get-tracking-no/') }}/' + tracking_no,
			method: 'GET',
			success:function(response){
				console.log(response);
				$('#btn_search').attr('disabled', false);
				if(response != "invalid"){
					$('#first_name').val(response.first_name);
					$('#last_name').val(response.last_name);
					$('#initial_name').val(response.initial_name);
					$('#address').val(response.address);
					$('#contact').val(response.contact);
					$('#trackMessage').hide();
				} else {
					$('#trackMessage').show();
				}
			}
		});
	}

	function getToothInfo(tooth){
		// var thisSymptom = $('#tooth_color_' + tooth).val() == null ? "color1" : $('#tooth_color_' + tooth).val();
        var thisSymptom = $.trim($('#tooth_color_' + tooth).val()).length != 0 ? $.trim($('#tooth_color_' + tooth).val()) : 'color0';
        var thisDescription = $('#tooth_description_' + tooth).val() != null ? $('#tooth_description_' + tooth).val() : 'normal';

		$('input[type="checkbox"]').prop('checked', false);

		// alert(thisSymptom);
		// alert(tooth);
		$('#tooth-image').attr('src', '{{ asset('public/assets/images/tooths/' ) }}/' + tooth + '.png');
		$('#tooth-hidden').val(tooth);
        $('#modal-tooth-description').val(thisDescription);
        $('#tooth-symptom-hidden').val(thisSymptom);
		var treatment = $('#tooth_symptom_' + tooth).val().split(',');
		// alert($.trim(treatment).length);
		if($.trim(treatment).length != 0){
			$.each(treatment, function(index, value){
				$('#' + $.trim(value)).prop('checked', true);
			});
		}
		if($.trim(treatment).length == 0){
		}
		$("#" + thisSymptom).prop('checked', true).click();
	}
	function getRecord(){
		$treatments = "";
		$.each($("input[name='symptom']:checked"), function(){
			$treatments += $treatments == "" ? $(this).val() : ', ' + $(this).val();
        });
		$('#tooth-display-' + $('#tooth-hidden').val()).attr('class', 'overlay ' + $('#tooth-symptom-hidden').val());
		$('#tooth_symptom_' + $('#tooth-hidden').val()).val($treatments);
		$('#tooth_color_' + $('#tooth-hidden').val()).val($("input[name='color']:checked").val());
		$('#tooth_description_' + $('#tooth-hidden').val()).val($('#modal-tooth-description').val());
	}

	function chooseColor(color){
		// alert(color);
		$('#tooth-symptom-hidden').val(color);
		$('#tooth-overlay').attr('class', '').attr('class', 'overlay-modal ' + color);
		$('#' + color).prop('checked', true).click();
	}
</script>
