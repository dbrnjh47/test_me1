@extends('admin')

@section('content')

<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Редактирование пользователя</h3>
	</div>
</div>

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="row">
		<div class="col-xl-4">
			<div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay">
				<div class="kt-portlet__head kt-portlet__space-x">
					<div class="kt-portlet__head-label" style="width: 100%;">
						<h3 class="kt-portlet__head-title text-center" style="width: 100%;">
							{{$user->username}}
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget28">
						<div class="kt-widget28__visual" style="background: url(@if(strlen($user->avatar) <= 2 )/temple/img/logo_modal.png) @else {{$user->avatar}}) @endif bottom center no-repeat"></div>
						<div class="kt-widget28__wrapper kt-portlet__space-x">
							<div class="tab-content">
								<div id="menu11" class="tab-pane active">
									<div class="kt-widget28__tab-items">
										<div class="kt-widget12">
											<div class="kt-widget12__content">
												<div class="kt-widget12__item">	
													<div class="kt-widget12__info text-center">				 	 
														<span class="kt-widget12__desc">ID</span> 
														<span class="kt-widget12__value">{{$user->id}}</span>
													</div>
												</div>
												<div class="kt-widget12__item">	
													<div class="kt-widget12__info text-center">				 	 
														<span class="kt-widget12__desc">Cумма пополнений</span> 
														<span class="kt-widget12__value">{{$pay}} $</span>
													</div>

													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Cумма выводов</span> 
														<span class="kt-widget12__value">{{$withdraw}} $</span>	
													</div>		 	 
												</div>
												<div class="kt-widget12__item">	
													<div class="kt-widget12__info text-center">				 	 
														<span class="kt-widget12__desc">Сумма реф. бонуса</span> 
														<span class="kt-widget12__value">{{$user->ref_balance}} $</span>
													</div>
												</div>
											</div>
											
											<div class="kt-widget12__content">
												<h6 class="block capitalize-font text-center">
													Итог
												</h6>
												<div class="kt-widget12__item">	
													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Осталось</span> 
														<span class="kt-widget12__value">{{($user->balance + $user->ref_balance)}} $</span>	
													</div>	
													<div class="kt-widget12__info text-center">
														<span class="kt-widget12__desc">Сумма</span> 
														<span class="kt-widget12__value">{{($pay - $withdraw)}} $</span>	
													</div>		 	 
												</div>
											</div>
											
										</div>
									</div>					      	 		      	
								</div>					     
							</div>
						</div>			 	 
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-8">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Информация о пользователе
						</h3>
					</div>
				</div>
				<!--begin::Form-->
				<form class="kt-form" method="post" action="/admin/user/save">
					@csrf
					<div class="kt-portlet__body">
						<input name="id" value="{{$user->id}}" type="hidden">
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Логин:</label>
								<input type="text" class="form-control" value="{{$user->login}}" disabled>
							</div>
							<div class="col-lg-6">
								<label class="">IP адрес:</label>
								<input type="text" class="form-control" value="" disabled>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Баланс:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="balance" value="{{$user->balance}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="fas fa-dollar-sign"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Реф. баланс:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="ref_balance" value="{{$user->ref_balance}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="fa-dollar-sign"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Всего за реф.:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="all_ref" value="{{$user->all_ref}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="fas fa-dollar-sign"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Реф. код:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="code_ref" value="{{$user->code_ref}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="fas fa-asterisk"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Акт. реф.:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="activated_ref" value="{{$user->activated_ref}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="fas fa-asterisk"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Дата акт. реф.:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="data_ref" value="{{$user->data_ref}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-calendar-o"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Пароль:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="password" value="{{$user->password}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="fas fa-lock"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Дата создания аккаунта:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" disabled name="created_at" value="{{$user->created_at}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-calendar-o"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Привилегии:</label>
								<select class="form-control" name="priv">
									<option value="admin" @if($user->role == 'admin') selected @endif>Администратор</option>
									<option value="moder" @if($user->role == 'moder') selected @endif>Модератор</option>
									<option value="user" @if($user->role == 'user') selected @endif>Пользователь</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label>Email:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" value="{{$user->email}}" disabled>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="far fa-envelope"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label class="">Бан на сайте:</label>
								<select class="form-control" name="ban">
									<option value="0" @if($user->ban == 0) selected @endif>Нет</option>
									<option value="1" @if($user->ban == 1) selected @endif>Да</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label>Причина бана на сайте:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="ban_reason" value="{{$user->ban_reason}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-exclamation-triangle"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label class="">Бан в чате до:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="banchat" value="{{$user->banchat}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-calendar-o"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Причина бана в чате:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" name="banchat_reason" value="{{$user->banchat_reason}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-exclamation-triangle"></i></span></span>
								</div>
							</div>
						</div>
					</div>
					<div class="kt-portlet__foot kt-portlet__foot--solid">
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-12">
									<button type="submit" class="btn btn-brand">Сохранить</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!--end::Form-->
				<div class="kt-portlet__head kt-portlet__head--lg">
					<div class="kt-portlet__head-label">
						<span class="kt-portlet__head-icon">
							<i class="kt-font-brand flaticon-users"></i>
						</span>
						<h3 class="kt-portlet__head-title">
							Список его рефералов
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
	
					<!--begin: Datatable -->
					<table class="table table-striped- table-bordered table-hover table-checkable" id="ajax-users">
						<thead>
							<tr>
								<th>ID</th>
								<th>Аватар</th>
								<th>Пользователь</th>
								<th>Баланс</th>
								<th>Баланс реф.</th>
								<th>ip</th>
								<th>Время активации кода</th>
								<th>Бан</th>
								<th>Время создания аккаунта</th>
								<th>Действия</th>
							</tr>
						</thead>
					</table>
		
					<!--end: Datatable -->
				</div>
			</div>
		</div>
	</div>
</div>
<script>
"use strict";
var KTDatatablesDataSourceAjaxServer = function() {

	var initTable1 = function() {
		var table = $('#ajax-users');

		// begin first table
		table.DataTable({
			responsive: true,
			searchDelay: 500,
			processing: true,
			serverSide: true,
			ajax: {
				url: "/admin/usersRefAjax/{{$user->code_ref}}",
				type: "POST"
			},
			columns: [
				{ data: "id", searchable: true },
				{ data: "login", visible: false, searchable: true },
				{ data: "login", searchable: false,
					render: function (data, type, row) {
						var a; 
						if((row.avatar).length <= 2){
							a = `<div style="display: flex;"><div class="profile_name">`+row.avatar+`</div><span style="padding: 8px;">`+ data + `</span></div>`;
						} else {
							a = '<img src="'+ row.avatar +'" style="width:26px;height: 26px;border-radius:50%;margin-right:10px;vertical-align:middle;">' + data;
						}
                    				
						return a;
					}

				},
				{ data: "balance", searchable: false,
					render: function (data, type, row) {
						return data + ' $';
					}

				},
				{ data: "ref_balance", searchable: false,
					render: function (data, type, row) {
						return data + ' $';
					}

				},
				{ data: "ip", searchable: false,
					render: function (data, type, row) {
						return data;
					}

				},
				{ data: "data_ref", searchable: false,
					render: function (data, type, row) {
						return data;
					}

				},
				{ data: "ban", searchable: false, orderable: true,
					render: function (data, type, row) {
						if(data) return '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Да</span>';
						return '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Нет</span>';
					}

				},
				{ data: null, searchable: false, orderable: false,
					render: function (data, type, row) {
						return row.created_at;
					}

				},
				{ data: null, searchable: false, orderable: false,
					render: function (data, type, row) {
						return '<a href="/admin/user/'+ row.id +'" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Редактировать"><i class="la la-edit"></i></a>';
					}
				}
			],
			"language": {
				  "processing": "Подождите...",
				  "search": "Поиск:",
				  "lengthMenu": "Показать _MENU_ записей",
				  "info": "Записи с _START_ по _END_ из _TOTAL_ записей",
				  "infoEmpty": "Записи с 0 до 0 из 0 записей",
				  "infoFiltered": "(отфильтровано из _MAX_ записей)",
				  "infoPostFix": "",
				  "loadingRecords": "Загрузка записей...",
				  "zeroRecords": "Записи отсутствуют.",
				  "emptyTable": "В таблице отсутствуют данные",
				  "paginate": {
					"first": "Первая",
					"previous": "Предыдущая",
					"next": "Следующая",
					"last": "Последняя"
				  },
				  "aria": {
					"sortAscending": ": активировать для сортировки столбца по возрастанию",
					"sortDescending": ": активировать для сортировки столбца по убыванию"
				  }
			}
		});
	};
	console.log(1);
	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesDataSourceAjaxServer.init();
});
</script>
@endsection