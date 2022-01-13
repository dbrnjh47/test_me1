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
				url: "/admin/plansAjax",
				type: "POST"
			},
			columns: [
				{ data: "id", searchable: true },
				{ data: "name", searchable: true },
				{ data: "period", searchable: true},
				{ data: "profit", searchable: true },
				{ data: "min_deposit", searchable: true },
				{ data: "max_deposit", searchable: true },
				{
					data: "return_deposit",
					searchable: true,
					render: function (data, type, row) {
						if(row.status == 1) {
							return "Да"
						}
						if(row.status == 0) {
							return "Нет"
						}
					}
				},
				{
					data: "status",
					searchable: true,
					render: function (data, type, row) {
						
						if(row.status == 1) {
							return "Опубликован"
						}
						if(row.status == 0) {
							return "Скрыт"
						}
					}
				},
				{ data: "created_at", searchable: true },
				{ data: null, searchable: false, orderable: false,
					render: function (data, type, row) {
						return `<a href="/admin/plans_editing/`+ row.id +`" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Редактировать"><i class="la la-edit"></i></a>`;
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