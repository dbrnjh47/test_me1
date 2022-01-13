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
				url: "/admin/paymentsAjax",
				type: "POST"
			},
			order: [ 0, 'desc' ],
			columns: [
				{ data: "id", searchable: true},
				{ data: "user_id", searchable: true },
				{ data: "name_user", searchable: true},
				{ data: "comment", searchable: true },
				{ data: "sum", searchable: true },
				{
					data: "status",
					searchable: true,
					render: function (data, type, row) {
						
						if(row.status == 1) {
							return "Выполнен"
						}
						if(row.status == 0) {
							return "В обработке"
						}
						if(row.status == 2) {
							return "Отказ"
						}
						if(row.status == 3) {
							return "В обработке"
						}
					}
				},
				{ data: "created_at", searchable: true }
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


