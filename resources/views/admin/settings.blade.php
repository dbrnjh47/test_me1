@extends('admin')

@section('content')
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Настройки</h3>
	</div>
</div>

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="kt-portlet kt-portlet--tabs">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-toolbar">
				<ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#site" role="tab" aria-selected="true">
							Настройки сайта
						</a>
					</li>
				</ul>
			</div>
		</div>
		<form class="kt-form" method="post" action="/admin/setting/save">
			<div class="kt-portlet__body">
				<div class="tab-content">
					<div class="tab-pane active" id="site" role="tabpanel">
						<div class="kt-section">
							@csrf
							<h3 class="kt-section__title">
								Общие настройки:
							</h3>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Автоматические выводы: </label>
									<select class="form-control" name="withdraw">
										<option value="0" {{ ($settings->withdraw == 0) ? 'selected' : '' }}>Выключены</option>
										<option value="1" {{ ($settings->withdraw == 1) ? 'selected' : '' }}>Включены</option>
									</select>
								</div>
								<div class="col-lg-4">
									<label>Технические работы:</label>
									<select class="form-control" name="teh_work">
										<option value="0" {{ ($settings->teh_work == 0) ? 'selected' : '' }}>Выключены</option>
										<option value="1" {{ ($settings->teh_work == 1) ? 'selected' : '' }}>Включены</option>
									</select>
								</div>
								<div class="col-lg-4">
									<label>Скрыть отзывы пользователей:</label>
									<select class="form-control" name="show_review">
										<option value="0" {{ ($settings->show_review == 0) ? 'selected' : '' }}>Не скрыты</option>
										<option value="1" {{ ($settings->show_review == 1) ? 'selected' : '' }}>Скрыты</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Имя сайта:</label>
									<input type="text" class="form-control" placeholder="SiteName" value="{{$settings->project_name}}" name="project_name">
								</div>
								<div class="col-lg-4">
									<label>Дней работы сайта:</label>
									<input type="text" class="form-control" placeholder="5" value="{{$settings->days_working}}" name="days_working">
								</div>
								<div class="col-lg-4">
									<label>Фейк добавление суммы пополнения:</label>
									<input type="text" class="form-control" placeholder="150" value="{{$settings->sum_payments}}" name="sum_payments">
								</div>
								<div class="col-lg-4">
									<label>Фейк добавление суммы выводов:</label>
									<input type="text" class="form-control" placeholder="160" value="{{$settings->sum_withdraw}}" name="sum_withdraw">
								</div>
								<div class="col-lg-4">
									<label>Фейк добавление партнёров на главной:</label>
									<input type="text" class="form-control" placeholder="16" value="{{$settings->partners}}" name="partners">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Телефон сайта:</label>
									<input type="text" class="form-control" placeholder="+79323000000" value="{{$settings->telephone}}" name="telephone">
								</div>
								<div class="col-lg-4">
									<label>Почта сайта:</label>
									<input type="text" class="form-control" placeholder="email@mail.ru" value="{{$settings->email}}" name="email">
								</div>
								<div class="col-lg-4">
									<label>Адрес сайта:</label>
									<input type="text" class="form-control" placeholder="Адрес 94а" value="{{$settings->address}}" name="address">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Youtube:</label>
									<input type="text" class="form-control" placeholder="https://www.youtube.com/" value="{{$settings->youtube}}" name="youtube">
								</div>
								<div class="col-lg-4">
									<label>Instagram:</label>
									<input type="text" class="form-control" placeholder="https://www.instagram.com/" value="{{$settings->instagram}}" name="instagram">
								</div>
								<div class="col-lg-4">
									<label>Facebook:</label>
									<input type="text" class="form-control" placeholder="https://www.facebook.com/" value="{{$settings->facebook}}" name="facebook">
								</div>
								
							</div>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Twitter:</label>
									<input type="text" class="form-control" placeholder="https://twitter.com/" value="{{$settings->twitter}}" name="twitter">
								</div>
								<div class="col-lg-4">
									<label>ID видео:</label>
									<input type="text" class="form-control" placeholder="tEJgdgQJj7Q" value="{{$settings->id_video_home}}" name="id_video_home">
								</div>
								<div class="col-lg-4">
									<label>Токен сапорта:</label>
									<input type="text" class="form-control" placeholder="29ce110f40a407a1e2de4e9a085ba5feaf8a5987" value="{{$settings->support_chat}}" name="support_chat">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Сумма пополнения 1 уровня:</label>
									<input type="text" class="form-control" placeholder="400" value="{{$settings->lvl0}}" name="lvl0">
								</div>
								<div class="col-lg-4">
									<label>Сумма пополнения 2 уровня:</label>
									<input type="text" class="form-control" placeholder="700" value="{{$settings->lvl1}}" name="lvl1">
								</div>
								<div class="col-lg-4">
									<label>Сумма пополнения 3 уровня:</label>
									<input type="text" class="form-control" placeholder="1000" value="{{$settings->lvl2}}" name="lvl2">
								</div>
								<div class="col-lg-4">
									<label>Сумма пополнения 4 уровня:</label>
									<input type="text" class="form-control" placeholder="1400" value="{{$settings->lvl3}}" name="lvl3">
								</div>
							</div>

						</div>
						<div class="kt-section">
							<h3 class="kt-section__title">
								Настройки реферальной системы:
							</h3>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Какой процент от пополнения получает пригласивший:</label>
									<input type="text" class="form-control" placeholder="Введите процент" value="{{$settings->ref_conclusion}}" name="ref_conclusion">
								</div>
								<div class="col-lg-4">
									<label>Доп. %:</label>
									<input type="text" class="form-control" placeholder="Введите сумму" value="{{$settings->ref_given}}" name="ref_given">
								</div>
							</div>
						</div>
						
						<div class="kt-section">
							<h3 class="kt-section__title">
								Настройки канкулятора:
							</h3>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Litecoin:</label>
									<input type="text" class="form-control" placeholder="Введите сумму доллара в Litecoin" value="{{$calc_plan[0]->cost}}" name="cost_1">
								</div>
								<div class="col-lg-4">
									<label>Ethereum:</label>
									<input type="text" class="form-control" placeholder="Введите сумму доллара в Ethereum" value="{{$calc_plan[1]->cost}}" name="cost_2">
								</div>
								<div class="col-lg-4">
									<label>Bitcoin:</label>
									<input type="text" class="form-control" placeholder="Введите сумму доллара в Bitcoin" value="{{$calc_plan[2]->cost}}" name="cost_3">
								</div>
							</div>
						</div>

						<div class="kt-section">
							<h3 class="kt-section__title">
								Остальные настройки:
							</h3>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Минимальная сумма пополнения:</label>
									<input type="text" class="form-control" placeholder="Введите сумму" value="{{$settings->min_refill}}" name="min_refill">
								</div>
								<div class="col-lg-4">
									<label>Максимальная сумма пополнения:</label>
									<input type="text" class="form-control" placeholder="Введите сумму" value="{{$settings->max_refill}}" name="max_refill">
								</div>
								<div class="col-lg-4">
									<label>Минимальная сумма вывода:</label>
									<input type="text" class="form-control" placeholder="Введите сумму" value="{{$settings->withdrawal_min}}" name="withdrawal_min">
								</div>
								<div class="col-lg-4">
									<label>Максимальная сумма вывода:</label>
									<input type="text" class="form-control" placeholder="Введите сумму" value="{{$settings->withdrawal_max}}" name="withdrawal_max">
								</div>
							</div>
						</div>
						<!-- <div class="kt-section">
							<h3 class="kt-section__title">
								Настройки платежной системы ePayCore:
							</h3>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>ID Магазина FK:</label>
									<input type="text" class="form-control" placeholder="Fxxxxxx" value="{{$settings->fk_mrh_ID}}" name="fk_mrh_ID">
								</div>
								<div class="col-lg-4">
									<label>FK Secret 1:</label>
									<input type="text" class="form-control" placeholder="xxxxxxx" value="{{$settings->fk_secret1}}" name="fk_secret1">
								</div>
								<div class="col-lg-4">
									<label>FK Secret 2:</label>
									<input type="text" class="form-control" placeholder="xxxxxxx" value="{{$settings->fk_secret2}}" name="fk_secret2">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-6">
									<label>FK Кошелек:</label>
									<input type="text" class="form-control" placeholder="Pxxxxxx" value="{{$settings->fk_wallet}}" name="fk_wallet">
								</div>
								<div class="col-lg-6">
									<label>FK API Key:</label>
									<input type="text" class="form-control" placeholder="xxxxxxx" value="{{$settings->fk_api}}" name="fk_api">
								</div>
							</div> 
						</div>
						<div class="kt-section">
							<h3 class="kt-section__title">
								Настройки платежной системы Payeer:
							</h3>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>No. счета Payeer:</label>
									<input type="text" class="form-control" placeholder="Pxxxxxx" value="{{$settings->payeer_account_ID}}" name="payeer_account_ID">
								</div>
								<div class="col-lg-4">
									<label>ID мерчанта Payeer:</label>
									<input type="text" class="form-control" placeholder="xxxxxxx" value="{{$settings->payeer_mrh_ID}}" name="payeer_mrh_ID">
								</div>
								<div class="col-lg-4">
									<label>Секретный ключ мерчанта Payeer:</label>
									<input type="text" class="form-control" placeholder="xxxxxxx" value="{{$settings->payeer_secret1}}" name="payeer_secret1">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-lg-4">
									<label>Ключ для шифрования мерчанта Payeer:</label>
									<input type="text" class="form-control" placeholder="xxxxxxx" value="{{$settings->payeer_secret2}}" name="payeer_secret2">
								</div>
								<div class="col-lg-4">
									<label>ID API пользователя Payeer:</label>
									<input type="text" class="form-control" placeholder="xxxxxxx" value="{{$settings->payeer_api_ID}}" name="payeer_api_ID">
								</div>
								<div class="col-lg-4">
									<label>Секретный ключ API пользователя Payeer:</label>
									<input type="text" class="form-control" placeholder="xxxxxxx" value="{{$settings->payeer_api_pass}}" name="payeer_api_pass">
								</div>
							</div>
						</div> -->
						
					</div>


				</div>
			</div>
			<div class="kt-portlet__foot">
				<div class="kt-form__actions">
					<button type="submit" class="btn btn-primary">Сохранить</button>
					<button type="reset" class="btn btn-secondary">Сбросить</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection