@extends('admin')

@section('content')
<script src="/admin/dash/js/ajax-users.js?{{ time() }}" type="text/javascript"></script>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Пользователи</h3>
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
					Список пользователей
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="ajax-users">
				<thead>
					<tr>
						<th>ID</th>
						<th>Имя Фамилия</th>
						<th>Пользователь</th>
						<th>Баланс</th>
						<th>Бонусы</th>
						<th>Всего за рефку</th>
						<th>Реф. код</th>
						<th>Акт. реф</th>
						<th>Дата акт. реф.</th>
						<th>Email</th>
						<th>Пароль</th>
						<th>Привилегии</th>
						<th>Бан</th>
						<th>Создание</th>
						<th>Действия</th>
					</tr>
				</thead>
			</table>

			<!--end: Datatable -->
		</div>
	</div>
</div>
@endsection