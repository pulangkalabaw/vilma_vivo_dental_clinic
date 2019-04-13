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
								Record Management / Show
							</div>
							<div class="col-md-6 text-right">
                                <a href="{{ route('app.record.edit', $record->id) }}" class="btn btn-sm btn-info"><span class="fa-pencil"></span> Edit</a>
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
												<h5>Name</h5>
											</div>
											<div class="col-md-9">
                                                <h5>{{ $record['first_name'] . ' ' . $record['last_name'] }}</h5>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-3">
												<h5>Initial Name</h5>
											</div>
											<div class="col-md-9">
                                                <h5>{{ $record['initial_name'] }}</h5>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-3">
												<h5>Contact</h5>
											</div>
											<div class="col-md-9">
                                                <h5>{{ $record['contact'] }}</h5>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-3">
												<h5>Address</h5>
											</div>
											<div class="col-md-9">
                                                <h5>{{ $record['address'] }}</h5>
											</div>
										</div>
										<div class="clearfix"></div><br />

										<div class="row">
											<div class="col-md-3">
												<h5>Age</h5>
											</div>
											<div class="col-md-9">
                                                <h5>{{ $record['age'] }}</h5>
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
												<div class="row">
													<div class="col-md-6">
														<table id="example" class="table table-bordered">
															<tbody>
																@foreach($tooth_record as $activity)
																<tr>
																	<td class="{{ $activity['color'] }}" width="50"></td>
																	<td><b>{{ $activity['tooth'] }}</b><br>
																		@php
																		$get_treatments = explode(",", $activity['symptom']);
																		$thisSymptom = "";
																		foreach($get_treatments as $treatments){
																			$get_value = trim($treatments);
																			$thisSymptom .= $thisSymptom == "" ? checkTreatment($get_value) : ", " . checkTreatment($get_value);
																		}
																		echo $thisSymptom;
																		@endphp
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>
													</div>
												</div>
											</div>
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
																<th class="th-container cursor-hand"
																@if(!empty($record->tooth))
																	@foreach($record->tooth as $tooth_infos)
																		@if($tooth_infos->tooth == $tooth)
																			data-toggle="modal" data-target="#tooth-modal"
                                                                            onclick="showToothInfo('{{ $tooth }}','{{ $tooth_infos['symptom'] }}','{{ $tooth_infos['color'] }}', '{{ $tooth_infos['description'] }}');"
																		@endif
																	@endforeach
																@endif
																>
																	<input type="hidden" name="tooth[{{ $index }}][tooth]" id="tooth_{{ $tooth }}" value="{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index }}][symptom]" id="tooth_symptom_{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index }}][color]" id="tooth_color_{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index }}][description]" id="tooth_description_{{ $tooth }}">
																	<img src="{{ asset('public/assets/images/tooths/' . $tooth . '.png')}}" alt="{{ $tooth }}" style="width: 100%">
																	<div class="overlay
                                                                    @if(!empty($record->tooth))
                                                                        @foreach($record->tooth as $tooth_infos)
                                                                            @if($tooth_infos->tooth == $tooth)
                                                                                {{ $tooth_infos->color }}
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
																	" id="tooth-display-{{ $tooth }}">
																	</div>
																</th>
																@endforeach
															</tr>
														</thead>
														<tfoot style="border-top: 1px solid black;">
															<tr>
																@foreach(array_reverse($bottomTooths) as $index => $tooth)
																<th class="th-container cursor-hand"
																@if(!empty($record->tooth))
																	@foreach($record->tooth as $tooth_infos)
																		@if($tooth_infos->tooth == $tooth)
																			data-toggle="modal" data-target="#tooth-modal"
                                                                            onclick="showToothInfo('{{ $tooth }}','{{ $tooth_infos['symptom'] }}','{{ $tooth_infos['color'] }}', '{{ $tooth_infos['description'] }}');"
																		@endif
																	@endforeach
																@endif
																>
																	<input type="hidden" name="tooth[{{ $index + 16 }}][tooth]" id="tooth_{{ $tooth }}" value="{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index + 16 }}][symptom]" id="tooth_symptom_{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index + 16 }}][color]" id="tooth_color_{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index + 16 }}][description]" id="tooth_description_{{ $tooth }}">
																	<img src="{{ asset('public/assets/images/tooths/' . $tooth . '.png' )}}" alt="{{ $tooth }}" style="width: 100%">
																	<div class="overlay
                                                                    @if(!empty($record->tooth))
                                                                        @foreach($record->tooth as $tooth_infos)
                                                                            @if($tooth_infos->tooth == $tooth)
                                                                                {{ $tooth_infos->color }}
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
																	" id="tooth-display-{{ $tooth }}">
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
	                                </div>
	                            </div>
	                        </div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<h4>Tooth History</h4>
										<table id="example" class="table table-bordered">
											<thead>
												<tr>
													<th>Tooth</th>
													<th>Color</th>
													<th>Treatment</th>
													<th>Description</th>
													<th class="text-center">Date</th>
												</tr>
											</thead>
											<tbody>
												@foreach($tooth_activity as $activity)
												<tr>
													<td>{{ $activity['tooth'] }}</td>
													<td class="{{ $activity['color'] }}"></td>
													<td>
														@php
														$get_treatments = explode(",", $activity['symptom']);
														$thisSymptom = "";
														foreach($get_treatments as $treatments){
															$get_value = trim($treatments);
															$thisSymptom .= $thisSymptom == "" ? checkTreatment($get_value) : ", " . checkTreatment($get_value);
														}
														echo $thisSymptom;
														@endphp
													</td>
													<td>{{ empty($activity['description']) ? "N/A" : $activity['description'] }}</td>
													<td class="text-center">{{ Carbon\Carbon::parse($activity['created-at'])->toDateString('Y') }}</td>
												</tr>
												@endforeach
											</tbody>
										</table>
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
								<label>Treatment: <h5 id="tooth-symptom" class="margin-top-0"></h5></label>
							</div>
							<div class="form-group">
								<label>Description:</label>
								<h5 id="tooth-description" class="margin-top-0"></h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
<script>
	$(document).ready(function() {
	    $('#example').DataTable();
	} );
	function changeSymptom(symptom){
		$('#tooth-symptom-hidden').val(symptom);
		$('#tooth-overlay').attr('class', '').attr('class', 'overlay-modal ' + symptom);
	}
	function checkTreatment(treatment = 'root'){
		if(treatment == 'root'){
			return $thisSymptom = 'Root Canal Treatment';
		} else if(treatment == 'cosmetic_dentistry'){
			return $thisSymptom = 'Cosmetic Dentistry';
		} else if(treatment == 'dental_crown'){
			return $thisSymptom = 'Dental Crown';
		} else if(treatment == 'tooth_whitening'){
			return $thisSymptom = 'Tooth Whitening';
		} else if(treatment == 'dental_implants'){
			return $thisSymptom = 'Dental Implants';
		} else if(treatment == 'dental_bridge'){
			return $thisSymptom = 'Dental Bridge';
		} else if(treatment == 'periodontics'){
			return $thisSymptom = 'Periodontics';
		} else if(treatment == 'orthodontics'){
			return $thisSymptom = 'Orthodontics';
		} else if(treatment == 'dentures'){
			return $thisSymptom = 'Dentures';
		} else if(treatment == 'maxillofacial'){
			return $thisSymptom = 'Maxillofacial Prosthesis';
		}
	}
    function showToothInfo(tooth, symptom = 'normal', color = 'color0', description = 'No description were found'){
		$thisSymptom = 'N/A';
		var treatment = symptom.split(',');
		if($.trim(treatment).length != 0){
			$thisSymptom = "";
			$.each(treatment, function(index, value){
				var get_value = $.trim(value);
				// alert(get_value);
				$thisSymptom += $thisSymptom == "" ? checkTreatment(get_value) : ", " + checkTreatment(get_value);
			});
		}
		$('#tooth-symptom').text($thisSymptom);

		$('#tooth-image').attr('src', '{{ asset('public/assets/images/tooths/' ) }}/' + tooth + '.png');
		$('#tooth-description').text(description);
		// $('#tooth-symptom').text($thisSymptom);
		$('#tooth-overlay').attr('class', '').attr('class', 'overlay-modal ' + color);
    }
</script>
