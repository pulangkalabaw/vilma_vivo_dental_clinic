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
								Record Management
							</div>
							<div class="col-md-6 text-right">
								<a href="{{ route('app.record.create') }}" class="btn btn-sm btn-primary">
									<span class="fa fa-plus-circle"></span>
									Add new record
								</a>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							{{--
							@if (
							!empty(Request::get('search_string'))
							|| !empty(Request::get('show'))
							|| (!empty(Request::get('sort_in'))
							&& !empty(Request::get('sort_by')))
							)
							<div class="breadcrumb">
							<b><span class='fa fa-filter'></span> Filtered ({{ $total }})</b><br>
							{!! filteredBy(request()) !!}
						</div>
					@endif
					--}}

					@include('includes.notif')

					<div class="col-md-4 col-xs-4">
						<div class="form-inline">
							<div class="form-group">
								<label>Number of rows: </label>
								<select name="" id="" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)" class="form-control">
									<option {{ !empty(request()->get('show') && request()->get('show') == 10) ? 'selected' : ''  }}
										value="{{ request()->fullUrlWithQuery(['show' => '10']) }}">10
									</option>
									<option {{ !empty(request()->get('show') && request()->get('show') == 25) ? 'selected' : ''  }}
										value="{{ request()->fullUrlWithQuery(['show' => '25']) }}">25
									</option>
									<option {{ !empty(request()->get('show') && request()->get('show') == 50) ? 'selected' : ''  }}
										value="{{ request()->fullUrlWithQuery(['show' => '50']) }}">50
									</option>
									<option {{ !empty(request()->get('show') && request()->get('show') == 100) ? 'selected' : ''  }}
										value="{{ request()->fullUrlWithQuery(['show' => '100']) }}">100
									</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-3"></div>
					<div class="col-md-5 col-xs-5">
						<form action="{{ request()->fullUrl() }}" method="GET">
							<div class="input-group">
								<input type="search" name="search_string" id="" value="{{ !empty(request()->get('search_string')) ? request()->get('search_string') : '' }}" class="form-control" placeholder="Search for Name, Email, or address">
								<span class="input-group-btn">
									<button class="btn btn-primary"><span class='fa fa-search'></span> </button>
								</span>
							</div>
						</form>
					</div>
				</div>
				<div class="clearfix"></div><br>

				<table class="table table-hovered">
					<thead>
						<tr>
							<th>
								First Name
								<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'first_name', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
									<span class='fa fa-sort'></span>
								</a>
							</th>
								<th>
									Last Name
									<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'last_name', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
										<span class='fa fa-sort'></span>
									</a>
								</th>
							<th>
								Contact
								<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'contact', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
									<span class='fa fa-sort'></span>
								</a>
							</th>
							<th>
								Address
								<a data-toggle="tooltip" title="Sort" href="{{ request()->fullUrlWithQuery(['sort_in' => 'address', 'sort_by' => (Request::get('sort_by') == "asc") ? 'desc' : 'asc']) }}">
									<span class='fa fa-sort'></span>
								</a>
							</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($records as $record)
							<tr>
								<td>{{ $record->first_name }}</td>
								<td>{{ $record->last_name }}</td>
								<td>{{ $record->contact }}</td>
								<td>{{ $record->address }}</td>
								<td>
									<a href="{{ route('app.record.show', $record->id) }}" class="btn btn-xs btn-warning">
										<span class="fa fa-eye"></span> show
									</a>
									<a href="{{ route('app.record.edit', $record->id) }}" class="btn btn-xs btn-success">
										<span class="fa fa-edit"></span> Edit
									</a>
									<button class="btn btn-xs btn-danger" for="submit-form" tabindex="0" form="{{ $record->id }}myform"><span class='fa fa-trash'></span> Delete
										<form class="delete" method="POST" action="{{ route('app.record.destroy', $record->id) }}" id="{{ $record->id }}myform">
											{{ method_field('DELETE') }}
											{{ csrf_field() }}
										</form>
									</button>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<br>
				<div class="row">
					<div class="col-md-10">
						{{ $records->appends(request()->input())->links() }}
					</div>
					<div class="col-md-2 text-right">
						Total <b>{{ $total_record }}</b> result(s)
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script
src="{{ asset('js/jquery.min.js') }}"></script>
<script>
$(document).ready(function() {
	$(".delete").on("submit", function(){
		return confirm("Are you sure?");
	});
});
</script>
@endsection
