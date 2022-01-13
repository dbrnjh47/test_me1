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
<script src="/admin/dash/js/ajax-news.js?v=<?php echo time() ?>" type="text/javascript"></script>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
	<div class="kt-subheader__main">
		<h3 class="kt-subheader__title">Новости</h3>
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
					Список новостей
				</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<div class="kt-portlet__head-wrapper">
					<div class="kt-portlet__head-actions">
						<a data-toggle="modal" href="#new" class="btn btn-success btn-elevate btn-icon-sm">
							<i class="la la-plus"></i>
							Добавить новость
						</a>
					</div>	
				</div>
			</div>
		</div>
		
		<div class="kt-portlet__body">

			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="ajax-users">
				<thead>
					<tr>
						<th>ID</th>
						<th>Название</th>
						<th>Картинка</th>
						<th>Краткое описание</th>
						<th>Описание</th>
						<th>Время</th>
						<th>Статус</th>
						<th>Время создания</th>
						<th>Действия</th>
					</tr>
				</thead>
			</table>

			<!--end: Datatable -->
		</div>
	</div>
</div>

<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="newLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Новая новость</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="kt-form-new" method="post" enctype="multipart/form-data" action="/admin/news/add">
            	@csrf
				<div class="modal-body">
					<div class="form-group">
						<label for="name">Название:</label>
						<input type="text" class="form-control" required placeholder="Название" name="name">
					</div>
					<div class="form-group">
						<label for="img">Картинка:</label>
						<input type="file" class="form-control"  name="img" accept="image/*">
					</div>
					<div class="form-group">
						<label for="status">Статус:</label>
						<select class="form-control" name="status">
							<option value="0">Скрыт</option>
							<option value="1" selected="">Опубликован</option>
						</select>
					</div>
					<div class="form-group">
						<label for="description">Краткое описание:</label>
						<input type="text" class="form-control" required placeholder="text" name="description">
					</div>
					<div class="form-group">
						<label for="text">Описание:</label>
						<input type="text" class="form-control" required placeholder="text" name="text">
					</div>
					<div class="form-group">
						<label for="date">Дата новости:</label>
						<input type="date" class="form-control" required name="date">
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
					<button type="submit" class="btn btn-primary">Добавить</button>
				</div>
            </form>
        </div>
    </div>
</div>


@endsection