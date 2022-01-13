@extends('admin')

@section('content')

<script src="/dash/js/dtables.js" type="text/javascript"></script>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Выводы</h3>
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
						<th>Сумма</th>
						<th>Система</th>
						<th>Кошелек</th>
						<th>Действия</th>
					</tr>
				</thead>
				<tbody>
					@foreach($withdraws as $withdraw)
					<tr>
						<td>{{$withdraw['id']}}</td>
						<td>
							@if(iconv_strlen($withdraw['avatar']) >= 2)
								<a href="/admin/user/{{$withdraw['user_id']}}"><img src="{{$withdraw['avatar']}}" style="    height: 26px;width:26px;border-radius:50%;margin-right:10px;vertical-align:middle;"> {{$withdraw['username']}}</a>
							@else
								<div style="display: flex;"><div class="profile_name">{{$withdraw['avatar']}}</div><span style="padding: 8px;">{{$withdraw['username']}}</span></div>
							@endif
						</td>
						<td>{{$withdraw['value']}}$</td> 
						<td>{{$withdraw['system']}}  (Вывод:  @if($withdraw['system'] == 'qiwi'){{ 'Qiwi Wallet' }}@elseif(in_array($withdraw['system'], ["visa", "yandex", "payeer"])) {{ 'Payeer' }} @else {{ 'Free-Kassa' }} @endif)</td>
						<td>{{$withdraw['wallet']}}</td>
						<td>
						<div class="row text-center">
								<div class="col-md-4"><a href="/admin/withdraw/withdraw/{{$withdraw['id']}}" class="btn btn-success btn-sm">Подтвердить</a></div>
								<div class="col-md-4"><a href="/admin/withdraw/return/{{$withdraw['id']}}" class="btn btn-danger btn-sm">Отменить</a></div>
								<div class="col-md-4"><a href="/admin/withdraw/hide/{{$withdraw['id']}}" class="btn btn-danger btn-sm">Скрыть</a></div>
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
					<i class="kt-font-brand flaticon2-checkmark"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Обработанные запросы
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="dtable2">
				<thead>
					<tr>
						<th>ID</th>
						<th>Пользователь</th>
						<th>Сумма</th>
						<th>Система</th>
						<th>Кошелек</th>
						<th>Статус</th>
					</tr>
				</thead>
				<tbody>
					@foreach($finished as $finish)
					<tr>
						<td>{{$finish['id']}}</td>
						<td>
							@if(iconv_strlen($finish['avatar']) >= 2)
								<a href="/admin/user/{{$finish['user_id']}}"><img src="{{$finish['avatar']}}" style="    height: 26px;width:26px;border-radius:50%;margin-right:10px;vertical-align:middle;"> {{$finish['username']}}</a>
							@else
								<div style="display: flex;"><div class="profile_name">{{$finish['avatar']}}</div><span style="padding: 8px;">{{$finish['username']}}</span></div>
							@endif
						</td>
						<td>{{$finish['value']}}$</td>
						<td>{{$finish['system']}} (Вывод: {{($finish['system'] == 'payeer') ? 'Payeer' : 'EpayCore'}})</td>
						<td>{{$finish['wallet']}}</td>
						<td>@if($finish['status'] == 1) Выполнен @elseif($finish['status'] == 2) Отказ
						@elseif($finish['status'] == 3) Скрыт
						@endif</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<!--end: Datatable -->
		</div>
	</div>
</div>
@endsection