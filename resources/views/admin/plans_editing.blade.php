@extends('admin')

@section('content')
<style>
	textarea{
		    min-height: 200px;
	}
</style>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Редактирование плана</h3>
	</div>
</div>

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="row">
		<div class="col-xl-12">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Информация о плане
						</h3>
					</div>
				</div>
				<!--begin::Form-->
				<form class="kt-form" method="post" action="/admin/plans/save">
					@csrf
					<div class="kt-portlet__body">
						<input name="id" value="{{$plans->id}}" type="hidden">
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Название:</label>
								<input type="text" class="form-control" name="name" value="{{$plans->name}}">
							</div>
							<div class="col-lg-6">
								<label class="">Период в днях:</label>
								<input type="text" class="form-control" name="period" value="{{$plans->period}}">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Профит % в день:</label>
								<input type="text" class="form-control" name="profit" value="{{$plans->profit}}">
							</div>
							<div class="col-lg-6">
								<label>Минимальный депозит:</label>
								<input type="text" class="form-control" name="min_deposit" value="{{$plans->min_deposit}}">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Максимальный депозит:</label>
								<input type="text" class="form-control" name="max_deposit" value="{{$plans->max_deposit}}">
							</div>
							
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Возврат депозита:</label>
								<select class="form-control" name="return_deposit">
									<option value="1" @if($plans->return_deposit) selected @endif>Да</option>
									<option value="0" @if(!$plans->return_deposit) selected @endif>Нет</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label>Статус:</label>
								<select class="form-control" name="status">
									<option value="1" @if($plans->status) selected @endif>Опубликован</option>
									<option value="0" @if(!$plans->status) selected @endif>Скрыт</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label>Дата создания:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" disabled="" value="{{$plans->created_at}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-calendar-o"></i></span></span>
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

			</div>
		</div>
	</div>
</div>

@endsection