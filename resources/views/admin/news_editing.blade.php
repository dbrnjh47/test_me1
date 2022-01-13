@extends('admin')

@section('content')
<style>
	textarea{
		    min-height: 200px;
	}
</style>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Редактирование новости</h3>
	</div>
</div>

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="row">
		<div class="col-xl-4">
			<div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay">
				<div class="kt-portlet__head kt-portlet__space-x">
					<div class="kt-portlet__head-label" style="width: 100%;">
						<h3 class="kt-portlet__head-title text-center" style="width: 100%;">
							{{$news->name}}
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">
					<div class="kt-widget28">
						<div class="kt-widget28__visual" style="background: url({{$news->img}}) bottom center no-repeat"></div>
								 	 
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-8">
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Информация о новости
						</h3>
					</div>
				</div>
				<!--begin::Form-->
				<form class="kt-form" method="post" action="/admin/news/save" enctype="multipart/form-data">
					@csrf
					<div class="kt-portlet__body">
						<input name="id" value="{{$news->id}}" type="hidden">
						<input name="img_save" value="{{$news->img}}" type="hidden">
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Название:</label>
								<input type="text" class="form-control" name="name" value="{{$news->name}}" >
							</div>
							<div class="col-lg-6">
								<label class="">Картинка:</label>
								<input class="form-control" type="file" accept="image/*" name="img">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Краткое описание:</label>
								<div class="kt-input-icon">
									<textarea type="text" class="form-control" name="description">{{$news->description}}</textarea>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="fas fa-book-open"></i></span></span>
								</div>
							</div>
							<div class="col-lg-6">
								<label>Описание:</label>
								<div class="kt-input-icon">
									<textarea type="text" class="form-control" name="text">{{$news->text}}</textarea>
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="fas fa-book-open"></i></span></span>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Дата новости:</label>
								<div class="kt-input-icon">
									<input type="datetime" class="form-control" name="date" value="{{$news->date}}">
									<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-calendar-o"></i></span></span>
								</div>
							</div>
							
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<label>Статус:</label>
								<select class="form-control" name="status">
									<option value="1" @if($news->status) selected @endif>Опубликован</option>
									<option value="0" @if(!$news->status) selected @endif>Скрыт</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label>Дата создания:</label>
								<div class="kt-input-icon">
									<input type="text" class="form-control" disabled="" value="{{$news->created_at}}">
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