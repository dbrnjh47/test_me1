$(document).ready(function() {

	JackpotHistoryInit();
	function JackpotHistoryInit(room) {
		$.ajax({
            url: '/battle/initHistory',
            type: 'post',
            data: {
                room: room
            },
            success: r => {
                if(r.success) {
					var html = '';
					r.history.forEach(game => {
						html += "<tr><td>"+ game.game_id +"</td><td>  <span class='sanitize-name'>"+ game.winner_color +"</span> </td><td><div class='bet-number rtl'> <span class='bet-wrap'> <span>"+ game.winner_ticket +"</span> <svg class='icon'> <use xlink:href='/img/symbols.svg#icon-ticket'></use> </svg> </span></div></td><td><form action="+ game.urlcheck +" method='post' target='_blank'><input type='hidden' name='format' value='json'/><input type='hidden' name='random' value='"+ game.random +"'/><input type='hidden' name='signature' value='"+ game.signature +"' /><button class='btn btn-primary' type='submit'>Проверить</button></form></td></tr>";
					});
					$('#history').html(html);
				}
            },
            error: e => console.log(e.responseText)
        });
	}
});