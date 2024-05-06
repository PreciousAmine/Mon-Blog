@extends('layouts.admin_v2.template')

@section('page_css')
  <link rel="stylesheet" href="{{ asset('admin_v2/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Features</h3>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav
          aria-label="breadcrumb"
          class="breadcrumb-header float-start float-lg-end"
        >
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Likes List
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<section class="section">
  @include('includes.admin_v2.alerts')
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Likes List</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table" id="list-table">
          <thead>
            <tr>
              <th>#</th>
							<th>Username</th>
							<th>Email</th>
							<th>Poem</th>
							<th>Likes</th>
            </tr>
          </thead>
          <tbody>
            {{-- render datatable here --}}
          </tbody>
        </table>
      </div>
    </div>
  </div>


</section>
@endsection

@section('page_scripts')
	@include('includes.admin_v2.plugin-script')

	<script type="text/javascript">
		$(function () {
			var table = $('#list-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: '{!! route('comment.index') !!}',
				columns: [
					{
						data: null,
						searchable: false,
						orderable: false,
						render: function (data, type, row, meta) {
							var start = meta.settings._iDisplayStart;
							var length = meta.settings._iDisplayLength;
							return start + meta.row + 1;
						}
					},
					{data: 'username', name: 'username'},
					{data: 'email', name: 'email'},
					{data: 'post', name: 'post'},
					{data: 'content', name: 'content'},
					{data: 'status', name: 'status'},
					{data: 'actions', name: 'actions', orderable: false, searchable: false}
				],
				responsive: true,
				lengthChange: false,
				autoWidth: false,
				paging: true,
				pageLength: 5,
				drawCallback: function (settings) {
					var api = this.api();
					var startIndex = api.context[0]._iDisplayStart;
					api.column(0, {order: 'applied', search: 'applied'}).nodes().each(function (cell, i) {
							cell.innerHTML = startIndex + i + 1;
					});
				}
			});
		});
	</script>
@endsection
