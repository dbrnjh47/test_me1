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
				url: "/admin/usersAjax",
				type: "POST"
			},
			order: [ 0, 'desc' ],
			columns: [
				{ data: "id", searchable: true },
				{ data: "login", visible: false, searchable: true },
				{ data: "login", searchable: false,
					render: function (data, type, row) {
						var a; 
						if((row.avatar).length <= 2){
							a = `<div style="display: flex;"><div class="profile_name">`+row.avatar+`</div><span style="    padding: 8px;">`+ data + `</span></div>`;
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
				{ data: "all_ref", searchable: false,
					render: function (data, type, row) {
						return data;
					}

				},
				{ data: "code_ref", searchable: false,
					render: function (data, type, row) {
						return data;
					}

				},
				{ data: "activated_ref", searchable: false,
					render: function (data, type, row) {
						return data;
					}

				},
				{ data: "data_ref", searchable: false,
					render: function (data, type, row) {
						return data;
					}

				},
				{ data: null, searchable: false, orderable: false,
					render: function (data, type, row) {
						return row.email;
					}

				},
				{ data: null, searchable: false, orderable: false,
					render: function (data, type, row) {
						return row.password;
					}

				},
				{ data: null, searchable: false, orderable: false,
					render: function (data, type, row) {
						if(row.role == 'admin') return '<span class="kt-font-bold kt-font-danger">Администратор</span>';
						if(row.role == 'moder') return '<span class="kt-font-bold kt-font-success">Модератор</span>';

						return row.role;
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