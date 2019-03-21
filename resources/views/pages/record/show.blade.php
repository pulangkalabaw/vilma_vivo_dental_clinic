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
                                                <h5>{{ $record['name'] }}</h5>
                                                <div class="div" hidden>
                                                    <input type="text" name="name" id="" class="form-control" value="{{ old('name') }}" required>
                                                </div>
											</div>
										</div>
										<div class="clearfix"></div><br />
										<div class="row">
											<div class="col-md-3">
												<h5>Contact</h5>
											</div>
											<div class="col-md-9">
                                                <h5>{{ $record['contact'] }}</h5>
                                                <div class="div" hidden>
    												<input type="text" name="contact" id="" class="form-control" value="{{ old('contact') }}" required>
                                                </div>
											</div>
										</div>
										<div class="clearfix"></div><br />
										<div class="row">
											<div class="col-md-3">
												<h5>Address</h5>
											</div>
											<div class="col-md-9">
                                                <h5>{{ $record['address'] }}</h5>
                                                <div class="div" hidden>
    												<input type="text" name="address" id="" class="form-control" value="{{ old('address') }}" required>
                                                </div>
											</div>
										</div>
										<div class="clearfix"></div><br />
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
													<th>Symptom</th>
													<th>Description</th>
													<th class="text-center">Date</th>
												</tr>
											</thead>
											<tbody>
												@foreach($tooth_activity as $activity)
												<tr>
													<td>{{ $activity['tooth'] }}</td>
													<td>{{ $activity['symptom'] }}</td>
													<td>{{ $activity['description'] }}</td>
													<td class="text-center">{{ Carbon\Carbon::parse($activity['created-at'])->toDateString('Y') }}</td>
												</tr>
												@endforeach
											</tbody>
										</table>
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
																<div style="background: white; border: 1px solid black !important; width: 50px; height: 25px; position: absolute; margin-left: 70px;" >
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
																<th class="th-container cursor-hand"
																@if(!empty($record->tooth))
																	@foreach($record->tooth as $tooth_infos)
																		@if($tooth_infos->tooth == $tooth)
																			data-toggle="modal" data-target="#tooth-modal"
                                                                            onclick="showToothInfo('{{ $tooth }}', '{{ $tooth_infos['symptom'] }}', '{{ $tooth_infos['description'] }}');"
																		@endif
																	@endforeach
																@endif
																>
																	<input type="hidden" name="tooth[{{ $index }}][tooth]" id="tooth_{{ $tooth }}" value="{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index }}][symptom]" id="tooth_symptom_{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index }}][description]" id="tooth_description_{{ $tooth }}">
																	<img src="{{ asset('public/assets/images/tooths/' . $tooth . '.png')}}" alt="{{ $tooth }}" style="width: 100%">
																	<div class="overlay
                                                                    @if(!empty($record->tooth))
                                                                        @foreach($record->tooth as $tooth_infos)
                                                                            @if($tooth_infos->tooth == $tooth)
                                                                                {{ $tooth_infos->symptom }}
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                    " id="tooth-display-{{ $tooth }}">
																	</div>
																</th>
																@endforeach
															</tr>
														</thead>
														<tfoot>
															<tr>
																@foreach(array_reverse($bottomTooths) as $index => $tooth)
																<th class="th-container cursor-hand" id="th-container-{{ $tooth }}"

																@if(!empty($record->tooth))
																	@foreach($record->tooth as $tooth_infos)
																		@if($tooth_infos->tooth == $tooth)
																			data-toggle="modal" data-target="#tooth-modal"
                                                                            onclick="showToothInfo('{{ $tooth }}','{{ $tooth_infos['symptom'] }}', '{{ $tooth_infos['description'] }}');"
																		@endif
																	@endforeach
																@endif
																>
																	<input type="hidden" name="tooth[{{ $index + 16 }}][tooth]" id="tooth_{{ $tooth }}" value="{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index + 16 }}][symptom]" id="tooth_symptom_{{ $tooth }}">
																	<input type="hidden" name="tooth[{{ $index + 16 }}][description]" id="tooth_description_{{ $tooth }}">
																	<img src="{{ asset('public/assets/images/tooths/' . $tooth . '.png' )}}" alt="{{ $tooth }}" style="width: 100%">
																	<div class="overlay
                                                                    @if(!empty($record->tooth))
                                                                        @foreach($record->tooth as $tooth_infos)
                                                                            @if($tooth_infos->tooth == $tooth)
                                                                                {{ $tooth_infos->symptom }}
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                    " id="tooth-display-{{ $tooth }}">
																	</div>
																</th>
																@endforeach
															</tr>
														</tfoot>
													</table>
												</center>
	                                        </div>
	                                    </div>
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
								<label>Status: <h5 id="tooth-symptom" class="margin-top-0">Gum Problem</h5></label>
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
    function showToothInfo(tooth, symptom = 'normal', description = 'No description were found'){
		// alert(tooth);
		$thisSymptom = 'N/A';
		if(symptom == 'cavities'){
			$thisSymptom = 'Cavities';
		} else if(symptom == 'chipped'){
			$thisSymptom = 'Chipped Tooth';
		} else if(symptom == 'cracked'){
			$thisSymptom = 'Cracked Tooth';
		} else if(symptom == 'gum_problem'){
			$thisSymptom = 'Gum Problem';
		}
		$('#tooth-image').attr('src', '{{ asset('public/assets/images/tooths/' ) }}/' + tooth + '.png');
		$('#tooth-description').text(description);
		$('#tooth-symptom').text($thisSymptom);
		$('#tooth-overlay').attr('class', '').attr('class', 'overlay-modal ' + symptom);
    }
</script>
