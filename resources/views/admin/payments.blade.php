@extends('admin')

@section('content')
<script src="/admin/dash/js/ajax-payments.js?v7" type="text/javascript"></script>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Пополнения</h3>
	</div>
</div>

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-information"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Активные запросы
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="dtable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Пользователь</th>
						<th>Комментарий</th>
						<th>Система</th>
						<th>Сумма</th>

						<th>Действия</th>
					</tr>
				</thead>
				<tbody>
					@foreach($payments as $payment)
					<tr>
						<td>{{$payment['id']}}</td>
						<td>
							@if(iconv_strlen($payment['avatar']) >= 2)
								<a href="/admin/user/{{$payment['user_id']}}"><img src="{{$payment['avatar']}}" style="height: 26px;width:26px;border-radius:50%;margin-right:10px;vertical-align:middle;"> {{$payment['username']}}</a>
							@else
								<div style="display: flex;"><div class="profile_name">{{$payment['avatar']}}</div><span style="padding: 8px;">{{$payment['username']}}</span></div>
							@endif
						</td>
						<td>{{$payment['comment']}}</td> 
						<td>{{$payment['system']}}</td>
						<td>{{$payment['sum']}}$</td>

						<td>
						<div class="row text-center">
								<div class="col-md-4"><a href="/admin/payment/payment/{{$payment['id']}}" class="btn btn-success btn-sm">Подтвердить</a></div>
								<div class="col-md-4"><a href="/admin/payment/return/{{$payment['id']}}" class="btn btn-danger btn-sm">Отменить</a></div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<!--end: Datatable -->
		</div>
	</div>

	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon-users"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Список пополнений
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="ajax-users">
				<thead>
					<tr>
						<th>ID</th>
						<th>Ид пользователя</th>
						<th>Пользователь</th>
						<th>Комментарий</th>
						<th>Сумма</th>
						<th>Статус</th>
						<th>Дата создания</th>
					</tr>
				</thead>
			</table>

			<!--end: Datatable -->
		</div>
	</div>
</div>
@endsection