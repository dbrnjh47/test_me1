@extends('admin')

@section('content')
<style>
	.btn.btn_del i{
		color: #d220617a;
	}
	.btn.btn_del:hover i {
    	color: #d22061;
	}
</style>
<script src="/admin/dash/js/ajax-plans.js?v=<?php echo time() ?>" type="text/javascript"></script>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Планы</h3>
	</div>
</div>

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-users"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Список планов
				</h3>
			</div>
		</div>
		
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="ajax-users">
				<thead>
					<tr>
						<th>ID</th>
						<th>Название</th>
						<th>Период в днях</th>
						<th>Профит % в день</th>
						<th>Минимальный депозит</th>
						<th>Максимальный депозит</th>
						<th>Возврат депозита</th>
						<th>Статус</th>
						<th>Время создания</th>
						<th>Действие</th>
					</tr>
				</thead>
			</table>

			<!--end: Datatable -->
		</div>
	</div>
</div>




@endsection