$(document).ready(function() {
	$.post('/admin/getBalanceFK', function(data) {
		$('#fkBal').text(data);
	});
	$.post('/admin/getBalancePE', function(data) {
		$('#peBal').text(data);
	});
	
    $(document).on('keyup', '.bgColor', function() {
		var bg = $(this).val();
		$(this).parent().parent().find('.exBg').css({background: bg});
    });
    $(document).on('keyup', '.textColor', function() {
		var color = $(this).val();
		$(this).parent().parent().find('.exText').css({color: color});
    });
	
});