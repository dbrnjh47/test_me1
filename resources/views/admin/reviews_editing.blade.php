@extends('admin')

@section('content')
<style>
	textarea{
		    min-height: 200px;
	}
</style>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Редактирование отзыва</h3>
	</div>
</div>

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="row">

		<div class="col-xl-12">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Информация о отзыве
						</h3>
					</div>
				</div>
				<!--begin::Form-->
				<form class="kt-form" method="post" action="/admin/reviews/save">
					@csrf
					<div class="kt-portlet__body">
						<input name="id" value="{{$reviews->id}}" type="hidden">
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Имя пользователя:</label>
								<input type="text" class="form-control" name="name" value="{{$reviews->name}}" >
							</div>
							<div class="col-lg-6">
								<label class="">Ид пользователя:</label>
								<input class="form-control" type="text" name="user_id" value="{{$reviews->user_id}}">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Отзыв:</label>
								<div class="kt-input-icon">
									<textarea type="text" class="form-control" name="review">{{$reviews->review}}</textarea>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="fas fa-book-open"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Язык:</label>
								<select class="form-control" name="language">
									<option value="en" @if($reviews->language == 'en') selected @endif>en</option>
									<option value="es" @if($reviews->language == 'es') selected @endif>es</option>
									<option value="id" @if($reviews->language == 'id') selected @endif>id</option>
									<option value="in" @if($reviews->language == 'in') selected @endif>in</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Статус:</label>
								<select class="form-control" name="status">
									<option value="1" @if($reviews->status) selected @endif>Фейк</option>
									<option value="0" @if(!$reviews->status) selected @endif>Пользовательский</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label>Дата создания:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" disabled="" value="{{$reviews->created_at}}">
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