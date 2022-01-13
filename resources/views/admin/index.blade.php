@extends('admin')

@section('content')
<script type="text/javascript" src="/admin/js/chart.min.js"></script>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Статистика</h3>
	</div>
</div>

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="kt-portlet">
		<div class="kt-portlet__body  kt-portlet__body--fit">
			<div class="row row-no-padding row-col-separator-xl">

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::Total Profit-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Пополнений на
								</h4>
								<span class="kt-widget24__desc">
									за сегодня
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-success">
								{{$pay_today}}<i class="fas fa-dollar-sign"></i>
							</span>	 
						</div>				   			      
					</div>
					<!--end::Total Profit-->
				</div>

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::New Feedbacks-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Пополнений на
								</h4>
								<span class="kt-widget24__desc">
									за 7 дней
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-success">
							  {{$pay_week}}<i class="fas fa-dollar-sign"></i>
							</span>	 
						</div>			   			      
					</div>				
					<!--end::New Feedbacks--> 
				</div>

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::New Orders-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Пополнений на
								</h4>
								<span class="kt-widget24__desc">
									за месяц
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-success">
								{{$pay_month}}<i class="fas fa-dollar-sign"></i>
							</span>	 
						</div>			   			      
					</div>				
					<!--end::New Orders--> 
				</div>

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::New Users-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Пополнений на
								</h4>
								<span class="kt-widget24__desc">
									за все время
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-success">
								{{$pay_all}}<i class="fas fa-dollar-sign"></i>
							</span>	 
						</div>		   			      
					</div>				
					<!--end::New Users--> 
				</div>

			</div>
		</div>
	</div>
	<div class="kt-portlet">
		<div class="kt-portlet__body  kt-portlet__body--fit">
			<div class="row row-no-padding row-col-separator-xl">

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::Total Profit-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Пользователей
								</h4>
								<span class="kt-widget24__desc">
									всего
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-brand">
								{{$usersCount}}<i class="la la-user"></i>
							</span>	 
						</div>				   			      
					</div>
					<!--end::Total Profit-->
				</div>

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::New Orders-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									На вывод
								</h4>
								<span class="kt-widget24__desc">
									общая сумма
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-danger">
								{{$with_req}}<i class="fas fa-dollar-sign"></i>
							</span>	 
						</div>			   			      
					</div>				
					<!--end::New Orders--> 
				</div>

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::New Users-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Баланс кошелька
								</h4>
								<span class="kt-widget24__desc">
									ePayCore $
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-warning">
								<span id="fkBal"><img src="https://i1.wp.com/caringo.com/wp-content/themes/bootstrap/wwwroot/img/spinning-wheel-1.gif" height="26px"/></span><i class="fas fa-dollar-sign"></i>
							</span>	 
						</div>		   			      
					</div>				
					<!--end::New Users--> 
				</div>

				<div class="col-md-12 col-lg-6 col-xl-3">
					<!--begin::New Users-->
					<div class="kt-widget24">
						<div class="kt-widget24__details">
							<div class="kt-widget24__info">
								<h4 class="kt-widget24__title">
									Баланс кошелька
								</h4>
								<span class="kt-widget24__desc">
									Payeer USD
								</span>
							</div>

							<span class="kt-widget24__stats kt-font-warning">
								<span id="peBal"><img src="https://i1.wp.com/caringo.com/wp-content/themes/bootstrap/wwwroot/img/spinning-wheel-1.gif" height="26px"/></span><i class="fas fa-dollar-sign"></i>
							</span>	 
						</div>		   			      
					</div>				
					<!--end::New Users--> 
				</div>

			</div>
		</div>
	</div>
	<div class="kt-portlet">
		<div class="kt-portlet__body kt-portlet__body--fit">
			<div class="row row-no-padding row-col-separator-xl">

				<div class="col-md-12 col-lg-12 col-xl-4">
					<!--begin:: Widgets/Stats2-3 -->
					<div class="kt-widget1">
						
						<div class="kt-widget1__item">
							<div class="kt-widget1__info">
								<h3 class="kt-widget1__title">Общий профит за день</h3>
							</div>
							<span class="kt-widget1__number kt-font-success">{{$profit}}<i class="fas fa-dollar-sign"></i></span>
						</div>

						<div class="kt-widget1__item">
							<div class="kt-widget1__info">
								<h3 class="kt-widget1__title">Реф. система\Промо (расход)</h3>
							</div>
							<span class="kt-widget1__number kt-font-danger">{{$profit_ref}}<i class="fas fa-dollar-sign"></i></span>
						</div>
					</div>
					<!--end:: Widgets/Stats2-3 -->
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xl-6">
			<div class="kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							График регистраций за текущий месяц
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body kt-portlet__body--fluid">
					<div class="kt-widget12">
						<div class="kt-widget12__chart" style="height:250px;">
							<canvas id="authChart"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="kt-portlet kt-portlet--height-fluid">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							График пополнений за текущий месяц
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body kt-portlet__body--fluid">
					<div class="kt-widget12">
						<div class="kt-widget12__chart" style="height:250px;">
							<canvas id="depsChart"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-4">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Последние пользователи
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget3 kt-scroll" data-scroll="true" data-height="616">
						@foreach($users as $user)
						<div class="kt-widget3__item">
							<div class="kt-widget3__header">
								<div class="kt-widget3__user-img">	
								@if(strlen($user->avatar) <= 2)
                    				<div class="profile_name">
                    				    {{$user->avatar}}
                    				</div>
                    			@else
                    				<img class="kt-widget3__img" style="width: 35px; height: 35px;" src="{{$user->avatar}}" alt="">  
                    			@endif							     
								</div>
								<div class="kt-widget3__info">
									<a href="/admin/user/{{$user->id}}" class="kt-widget3__username">
									{{$user->login}}
									</a><br> 
									<span class="kt-widget3__time">
									Реферал: @if(App\User::findRef($user->code_ref))<a href="/admin/user/{{ App\User::findRef($user->code_ref)->id}}">{{ App\User::findRef($user->code_ref)->login}}</a>@elseНет@endif
									</span>		 
								</div>
								<span class="kt-widget3__status kt-font-success">
									{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
								</span>	
							</div>
						</div>
						@endforeach
					</div>
				</div>		
			</div>
		</div>

		<div class="col-xl-4">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Последние пополнения
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget3 kt-scroll" data-scroll="true" data-height="616">
						@foreach($last_dep as $pay)
						<div class="kt-widget3__item">
							<div class="kt-widget3__header">
								<div class="kt-widget3__user-img">	
								@if(strlen($pay['avatar']) <= 2)
                    				<div class="profile_name">
                    				    {{$pay['avatar']}}
                    				</div>
                    			@else
                    				<img class="kt-widget3__img" style="width: 35px; height: 35px;" src="{{$pay['avatar']}}" alt="">  
                    			@endif				 
									  
								</div>
								<div class="kt-widget3__info">
									<a href="/admin/user/{{$pay['id']}}" class="kt-widget3__username">
									{{$pay['login']}}
									</a><br> 
									<span class="kt-widget3__time">
									{{ Carbon\Carbon::parse($pay['date'])->diffForHumans() }}
									</span>		 
								</div>
								<span class="kt-widget3__status kt-font-success">
									{{$pay['sum']}} <i class="fas fa-dollar-sign"></i>
								</span>	
							</div>
						</div>
						@endforeach
					</div>
				</div>		
			</div>
		</div>

		<div class="col-xl-4">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Последние выводы
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget3 kt-scroll" data-scroll="true" data-height="616">
						@foreach($last_withdraw as $with)
						<div class="kt-widget3__item">
							<div class="kt-widget3__header">
								<div class="kt-widget3__user-img">	
								@if(strlen($with['avatar']) <= 2)
                    				<div class="profile_name">
                    				    {{$with['avatar']}}
                    				</div>
                    			@else
                    				<img class="kt-widget3__img" style="width: 35px; height: 35px;" src="{{$with['avatar']}}" alt="">  
                    			@endif				 
									  
								</div>
								<div class="kt-widget3__info">
									<a href="/admin/user/{{$with['id']}}" class="kt-widget3__username">
									{{$with['login']}}
									</a><br> 
									<span class="kt-widget3__time">
									{{ Carbon\Carbon::parse($with['date'])->diffForHumans() }}
									</span>		 
								</div>
								<span class="kt-widget3__status kt-font-success">
									@if($with['status'] == 1) 
                                		<div>Выполнен</div>
                            		@elseif($with['status'] == 0)
                                		<div style="color: #4269fe;">В обработке</div>
                            		@elseif($with['status'] == 2)
                                		<div style="color: #de7fef;">Ошибка</div>
                                	@elseif($with['status'] == 3)
                                		<div style="color: #de7fef;">Скрыт</div>
                           			@endif
								</span>	
								<span class="kt-widget3__status kt-font-success">
									{{$with['sum']}} <i class="fas fa-dollar-sign"></i>
								</span>	
							</div>
						</div>
						@endforeach
					</div>
				</div>		
			</div>
		</div>

	</div>

	
	<div class="row">

		
		
		<div class="col-xl-4">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Самые богатые
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget3 kt-scroll" data-scroll="true" data-height="616">
						@foreach($userTop as $top)
						<div class="kt-widget3__item">
							<div class="kt-widget3__header">
								<div class="kt-widget3__user-img">	
								@if(strlen($top->avatar) <= 2)
                    				<div class="profile_name">
                    				    {{$top->avatar}}
                    				</div>
                    			@else
                    				<img class="kt-widget3__img" style="width: 35px; height: 35px;" src="{{$top->avatar}}" alt="">  
                    			@endif							   
								</div>
								<div class="kt-widget3__info">
									<a href="/admin/user/{{$top->id}}" class="kt-widget3__username">
									{{$top->login}}
									</a>	 
								</div>
								<span class="kt-widget3__status kt-font-success">
									{{ $top->balance }} <i class="fas fa-dollar-sign"></i>
								</span>	
							</div>
						</div>
						@endforeach
					</div>
				</div>		
			</div>
		</div>
	</div>
	
</div>

<script>
$(document).ready(function() {
	$.ajax({
		method: 'POST',
		url: '/admin/getUserByMonth',
		success: function (res) {
			var authChart = 'authChart';
			if ($('#'+authChart).length > 0) {
				var months = [];
				var users = [];

				$.each(res, function(index, data) {
					months.push(data.date);
					users.push(data.count);
				});

				var lineCh = document.getElementById(authChart).getContext("2d");

				var chart = new Chart(lineCh, {
					type: 'line',
					data: {
						labels: months,
						datasets: [{
							label: "",
							tension:0.4,
							backgroundColor: 'transparent',
							borderColor: '#2c80ff',
							pointBorderColor: "#2c80ff",
							pointBackgroundColor: "#fff",
							pointBorderWidth: 2,
							pointHoverRadius: 6,
							pointHoverBackgroundColor: "#fff",
							pointHoverBorderColor: "#2c80ff",
							pointHoverBorderWidth: 2,
							pointRadius: 6,
							pointHitRadius: 6,
							data: users,
						}]
					},
					options: {
						legend: {
							display: false
						},
						maintainAspectRatio: false,
						tooltips: {
							callbacks: {
								title: function(tooltipItem, data) {
									return 'Дата : ' + data['labels'][tooltipItem[0]['index']];
								},
								label: function(tooltipItem, data) {
									return data['datasets'][0]['data'][tooltipItem['index']] + ' чел.' ;
								}
							},
							backgroundColor: '#eff6ff',
							titleFontSize: 13,
							titleFontColor: '#6783b8',
							titleMarginBottom:10,
							bodyFontColor: '#9eaecf',
							bodyFontSize: 14,
							bodySpacing:4,
							yPadding: 15,
							xPadding: 15,
							footerMarginTop: 5,
							displayColors: false
						},
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: true,
									fontSize:12,
									fontColor:'#9eaecf',
									stepSize: Math.ceil(users/5)
								},
								gridLines: { 
									color: "#e5ecf8",
									tickMarkLength:0,
									zeroLineColor: '#e5ecf8'
								},

							}],
							xAxes: [{
								ticks: {
									beginAtZero: true,
									fontSize:12,
									fontColor:'#9eaecf',
									source: 'auto',
								},
								gridLines: {
									color: "transparent",
									tickMarkLength:20,
									zeroLineColor: '#e5ecf8',
								},
							}]
						}
					}
				});
			}
		}
	});
	$.ajax({
		method: 'POST',
		url: '/admin/getDepsByMonth',
		success: function (res) {
			var depsChart = 'depsChart';
			if ($('#'+depsChart).length > 0) {
				var months = [];
				var deps = [];

				$.each(res, function(index, data) {
					months.push(data.date);
					deps.push(data.sum);
				});

				var lineCh = document.getElementById(depsChart).getContext("2d");

				var chart = new Chart(lineCh, {
					type: 'line',
					data: {
						labels: months,
						datasets: [{
							label: "",
							tension:0.4,
							backgroundColor: 'transparent',
							borderColor: '#2c80ff',
							pointBorderColor: "#2c80ff",
							pointBackgroundColor: "#fff",
							pointBorderWidth: 2,
							pointHoverRadius: 6,
							pointHoverBackgroundColor: "#fff",
							pointHoverBorderColor: "#2c80ff",
							pointHoverBorderWidth: 2,
							pointRadius: 6,
							pointHitRadius: 6,
							data: deps,
						}]
					},
					options: {
						legend: {
							display: false
						},
						maintainAspectRatio: false,
						tooltips: {
							callbacks: {
								title: function(tooltipItem, data) {
									return 'Дата : ' + data['labels'][tooltipItem[0]['index']];
								},
								label: function(tooltipItem, data) {
									return data['datasets'][0]['data'][tooltipItem['index']] + ' руб.' ;
								}
							},
							backgroundColor: '#eff6ff',
							titleFontSize: 13,
							titleFontColor: '#6783b8',
							titleMarginBottom:10,
							bodyFontColor: '#9eaecf',
							bodyFontSize: 14,
							bodySpacing:4,
							yPadding: 15,
							xPadding: 15,
							footerMarginTop: 5,
							displayColors: false
						},
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true,
									fontSize:12,
									fontColor:'#9eaecf',
									stepSize: Math.ceil(deps/5)
								},
								gridLines: { 
									color: "#e5ecf8",
									tickMarkLength:0,
									zeroLineColor: '#e5ecf8'
								},

							}],
							xAxes: [{
								ticks: {
									fontSize:12,
									fontColor:'#9eaecf',
									source: 'auto',
								},
								gridLines: {
									color: "transparent",
									tickMarkLength:20,
									zeroLineColor: '#e5ecf8',
								},
							}]
						}
					}
				});
			}
		}
	});
});
</script>
@endsection