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
						<input id="normal" type="radio" name="symptom" value="Normal" checked="checked" id="default-symptom" class="choose-symptom" onclick="changeSymptom('normal');">
						<label for="normal" onclick="changeSymptom('normal');">Normal</label>
					</div>
					<div class="radio radio-success">
						<input id="Cavities" type="radio" name="symptom" value="Cavities"class="choose-symptom" onclick="changeSymptom('cavities');">
						<label for="Cavities" onclick="changeSymptom('cavities');">Cavities</label>
					</div>
					<div class="radio radio-info">
						<input id="Chipped" type="radio" name="symptom" value="Chipped Tooth" class="choose-symptom" onclick="changeSymptom('chipped');">
						<label for="Chipped" onclick="changeSymptom('chipped');">Chipped Tooth</label>
					</div>
					<div class="radio radio-warning">
						<input id="Cracked" type="radio" name="symptom" value="Cracked Tooth" class="choose-symptom" onclick="changeSymptom('cracked');">
						<label for="Cracked" onclick="changeSymptom('cracked');">Cracked Tooth</label>
					</div>
					<div class="radio radio-danger">
						<input id="Gum" type="radio" name="symptom" value="Gum Problems" class="choose-symptom" onclick="changeSymptom('gum_problem');">
						<label for="Gum" onclick="changeSymptom('gum_problem');">Gum Problems</label>
					</div>
        		</div>
        	</div>
        </div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Description:</label>
					<input type="text" id="tooth-hidden">
					<input type="text" id="tooth-symptom-hidden">
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
	function changeSymptom(symptom){
		$('#tooth-symptom-hidden').val(symptom);
		$('#tooth-overlay').attr('class', '').attr('class', 'overlay-modal ' + symptom);
	}
	function getToothInfo(tooth){
		$('#tooth-image').attr('src', '{{ asset('public/assets/images/tooths/' ) }}/' + tooth + '.png');
		$('#tooth-hidden').val(tooth);
		$('#modal-tooth-description').val('');
		$('#default-symptom').click();
		$('#tooth-symptom-hidden').val('normal');
	}
	function getRecord(){
		$('#tooth-display-' + $('#tooth-hidden').val()).attr('class', 'overlay-modal ' + $('#tooth-symptom-hidden').val());
		$('#tooth_symptom_' + $('#tooth-hidden').val()).val($('#tooth-symptom-hidden').val());
		$('#tooth_description_' + $('#tooth-hidden').val()).val($('#modal-tooth-description').val());
	}
</script>
