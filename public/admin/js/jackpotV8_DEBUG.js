$(document).ready(function() {
    const socket = io.connect(':2053');

	// var canvas = document.getElementById('circle').getContext('2d');
    // canvas.canvas.width = 100;
    // canvas.canvas.height = 100;
    let soundStatus = localStorage.getItem('sound')||true;


    let chips = {
        easy: [1, 5, 10, 25, 50, 100],
        medium: [50, 100, 150, 300, 400, 500],
        hard: [500, 750, 1000, 1500, 3500, 5000]
    };

    if(soundStatus === "true")
        $("#sound_toggle").addClass('active');

    $("#sound_toggle").click(function() {
        if(soundStatus === "true") {
            $("#sound_toggle").removeClass('active');
            soundStatus = "false";
        } else {
            $("#sound_toggle").addClass('active');
            soundStatus = "true";
        }
        localStorage.setItem("sound", soundStatus);
    });

    function sound_startgame(path) {
        if(soundStatus === "false") return;
        document.querySelector("#"+path).play();
        return;
        var sound_startg1  = new Audio();
        sound_startg1.src = '/sounds/'+ path +'.mp3';
        sound_startg1.volume = 0.6;
        sound_startg1.play();
    }

    var room = null,
		cldn = 0,
		spin = 0,
		cords = 0,
        rotate = [];
        
    let ngtimerStatus = true;

    $('.rooms .btn').click(function(e) {
        room = localStorage.setItem('room', $(this).attr('data-room'));

        $('.rooms .btn').removeClass('isActive');
        $(this).addClass('isActive');

        getCurrentRoom();

        e.preventDefault();
    });

    function getCurrentRoom() {
        room = localStorage.getItem('room') || 'easy';
        $('.rooms .btn.' + room).addClass('isActive');
        JackpotInit(room);
		if(typeof rotate[room] == 'undefined') {
			rotate[room] = {spin: 0, time: 0};
		}
    }

    getCurrentRoom();

    

    function initGame(room) {
        socket.emit("jackpot init", room, (data) => {
            if(data.status == 1) {
                
                $('#gameCarousel').removeClass('hidden');
                let users = data.users,
                    seconds = +new Date(data.started_at- +new Date())/1000,
                    html = "";
                users[25] = data.winner_avatar;
                users[96] = data.winner_avatar;
                $('#RuletkaSkrita').addClass('animated bounceInRight');    
                users.forEach(avatar => {
                    html += '<li><img src="' + avatar + '"></li>';	
                });
                $('.roulette1').html(html);
    
                $('.roulette1').css('transform', 'translate3d(-750px, 0px, 0px)');
                $('.roulette1').css('-webkit-transform', 'translate3d(-750px, 0px, 0px)');
                $('.roulette1').css('-moz-transform', 'translate3d(-750px, 0px, 0px)');
    
                setTimeout(function () {
                    $('.roulette1').css({
                        'transform': 'translate3d(-'+ data.deg +'px, 0px, 0px)',
                        "transition": "all "+seconds+"s cubic-bezier(0.165, 0.50, 0.1, 1)"
                    });
                }, 500);
                
                        
                sound_startgame('startthisgame');
                $("#winner-name").html(`<span style="position: relative;" ><div id="escapingBallG"><div id="escapingBall_1" class="escapingBallG"></div></div></span>`);
                $("#winner-ticket").html(`<span style="position: relative;"><div id="escapingBallG"><div id="escapingBall_1" class="escapingBallG"></div></div></span>`);
    
                setTimeout(function () {
    
                    $("#winner-name").html(data.winner_name);
                    $("#winner-ticket").html(data.ticket);
    
                    setTimeout(function () { $('.game-tooltip.won.'+room).addClass('isActive'); }, 1000);
                }, seconds*1000);
            }
        });
    }

    initGame(room);

    socket.on('jackpot', r => {
        if(r.type == 'timer') {
            var sec = r.data.sec,
                min = r.data.min;
            if(sec < 10) sec = '0' + sec;
            if(min < 10) min = '0' + min;
            $("#timer_"+ r.room).html(`${min}:${sec}`);
 
            if(room == r.room) {
                if(sec == 2 && r.data.nginxTime) {
                    $('#animHide').addClass('animated fadeOutUp');
                
                    setTimeout(function(){
                        $('#animHide').removeClass('animated fadeOutUp');
                        $('#RuletkaSkrita').removeClass('animated bounceInRight');
                        $('.end-game').addClass('hidden'); 
                    }, 1000);
                }
                $('#timer').text(sec);
            }
		}
        if(r.type == 'update' && r.data.success && room == r.room) {
            sound_startgame('common-bet');
            JackpotParse(r.data.data);
        }
        if(r.type == 'slider' && room == r.room) {

            if(r.data.sec == 2) {
                $('#animHide').addClass('animated fadeOutUp');
               
                setTimeout(function(){
                    $('#animHide').removeClass('animated fadeOutUp');
                    $('#RuletkaSkrita').removeClass('animated bounceInRight');
                    $('.end-game').addClass('hidden'); 
                        $('.roulette1').css({
                            'transform': 'translate3d(-750px, 0px, 0px)',
                            '-webkit-transform': 'translate3d(-750px, 0px, 0px)',
                            '-moz-transform': 'translate3d(-750px, 0px, 0px)',
                        });
                    
                }, 1000);
            }
            $('#timer').text(r.data.sec < 10 ? '0'+r.data.sec : r.data.sec);

            if(ngtimerStatus&&r.data.users) { 

                $('.end-game').removeClass('hidden');
                ngtimerStatus = false;
            // let users = mulAndShuffle(r.data.users, 1.21),
                let users = r.data.users,
                    html = "";
                users[25] = r.data.winner_avatar;
                users[96] = r.data.winner_avatar;
                
                $('#RuletkaSkrita').addClass('animated bounceInRight');    
                users.forEach(avatar => { 
                    html += '<li><img src="' + avatar + '"></li>';	
                });
                $('.roulette1').html(html);
                $("#winner-name").html(`<span style="position: relative;" ><div id="escapingBallG"><div id="escapingBall_1" class="escapingBallG"></div></div></span>`);
                $("#winner-ticket").html(`<span style="position: relative;"><div id="escapingBallG"><div id="escapingBall_1" class="escapingBallG"></div></div></span>`);
                setTimeout(function () {
                    document.querySelector(".roulette1").style.transform = 'translate3d(-'+ r.data.deg +'px, 0px, 0px)';
                    sound_startgame('startthisgame');
                    // $('.roulette1').css({
                    //     // 'transform': 'translate3d(-750px, 0px, 0px)',
                    //     // '-webkit-transform': 'translate3d(-750px, 0px, 0px)',
                    //     // '-moz-transform': 'translate3d(-750px, 0px, 0px)',
                    //     'transform': 'translate3d(-'+ r.data.deg +'px, 0px, 0px)'
                    // });
                }, 500);
                
                // cldn = 0;
                // cords = r.data.cords;
                // let timer = setInterval(() => {
                //     if(cldn >= 6) {
                //         rotate[r.room] = {spin: cords, time: 0};
                //         clearInterval(timer);
                //         return;
                //     }
                //     cldn++;
                //     spin = (cords/6)*cldn;
                //     rotate[r.room] = {spin: spin, time: (6-cldn)*1000};
                // }, 1*1000)

                setTimeout(function () {
                    var wbl = '';
                    if(r.data.winner_balance > 0) wbl += '<div class="payout">'+ r.data.winner_balance +' <svg class="icon icon-coin balance"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></div>';
                    var wbn = '';
                    if(r.data.winner_bonus > 0) wbn += '<div class="payout">'+ r.data.winner_bonus +' <svg class="icon icon-coin bonus"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></div>';
                    $("#winner-name").html(r.data.winner_name);
                    $("#winner-ticket").html(r.data.ticket);
                    
                
                    // var html = '';
                    // 	html += '<div style="z-index:99999;" class="game-tooltip isTransparent won '+ r.room +'"><div class="wrap"><div class="user"><button type="button" class="btn btn-link" data-id="'+ r.data.winner_id +'"><span class="sanitize-user"><div class="sanitize-avatar"><img src="'+ r.data.winner_avatar +'" alt=""></div><span class="sanitize-name">'+ r.data.winner_name +'</span></span></button></div>'+ wbl + wbn +'<div class="badge"><div class="text">Победитель</div></div><div class="status"><span>Счастливый билет <span class="profit">'+ r.data.ticket +'</span> <svg class="icon"><use xlink:href="/img/symbols.svg#icon-ticket"></use></svg></span></div></div></div>';
                    // $('.game-area-content').append(html);
                    setTimeout(function () { $('.game-tooltip.won.'+r.room).addClass('isActive'); }, 1000);
                }, 14000);
            }
		}
        if(r.type == 'newGame') {
            var min = Math.floor(r.data.data.time/60),
                sec = r.data.data.time-(Math.floor(r.data.data.time/60)*60);
            if(sec < 10) sec = '0' + sec;
            if(min < 10) min = '0' + min;
            $("#timer_"+ r.room).html(`${min}:${sec}`);
            $("#bank_"+ r.room).html(`0.00`);
            bank_easy
			if(room == r.room) {
                ngtimerStatus = true;
                if(r.data.data.game.bonus > 0)
                    updateBonus(parseFloat(r.data.data.game.bonus),r.data.data.game.bonusType);
                $('#RuletkaSkrita').removeClass('animated bounceInRight');
                $('.end-game').addClass('hidden');
                $('.main-block-table ul').html('');
                $("#winner-name").html(`<span style="position: relative;" ><div id="escapingBallG"><div id="escapingBall_1" class="escapingBallG"></div></div></span>`);
                $("#winner-ticket").html(`<span style="position: relative;"><div id="escapingBallG"><div id="escapingBall_1" class="escapingBallG"></div></div></span>`);
				$('#chances').html('');
				$('.n_progressbar_main_banksum').html(`<span class="animated flash" id="value">0.00</span>`);
        		$('#gameId').text(r.data.data.game.game_id);
				$('#hash').text(r.data.data.game.hash);
				$('#timer').html(sec);

				// chart.options.plugins.labels.images = [];
				// chart.data.datasets[0].data = [100];
				// chart.data.datasets[0].backgroundColor = ['#2c323f'];
				// chart.update();
			}
			$('.game-tooltip.won').removeClass('isActive');
			setTimeout(function () { $('.game-tooltip.won.'+r.room).remove(); }, 2000);
		}
    });

    function updateBonus(bonus, bonusType) {
        let days = {
            morning: "Утренний",
            day: "Дневной",
            evening: "Вечерний",
            night: "Ночной"
        };
        let bet =  `
            <li style="background: #12161e;    height: 94px !important;
            align-items: center;
            display: flex;justify-content: space-between;">
                <div class="avatar">
                    <img
                        src="/img/bonus-bet.png"
                    />
                </div>
                <div class="namentickets">
                    <!--<h2 style="margin-top: 9px;line-height: normal;">${days[bonusType[0]]} бонус: с ${bonusType[1]} до ${bonusType[2]} MSK. Ставит максимум ${bonusType[4]} монеты в 1 игру</h2>-->
                    <h2 style="margin-top: 9px;line-height: normal;">Бонусный бот ставит 2% от комиссии игры</h2>
                    
                </div>
                <div style="    margin-top: 5px;" class="sumnchance">
                    <h2 style="color: ${bonusType[5] == 1 ? '#ffde2f;' : '#00e612'};">
                    ${bonus}
                       
                    </h2>
                
                </div>
            </li>
        `;
        $('.main-block-table ul').html(bet);
    }

    function JackpotParse(res) {
        let data = [], avatars = [], colors = [];

        let bets = '';
        if(res.bonus > 0)  {
            let bonusType = JSON.parse(res.bonusType),
                days = {
                    morning: "Утренний",
                    day: "Дневной",
                    evening: "Вечерний",
                    night: "Ночной",
                    rushhour: "Горящий"
                };

            bets += `
                <li style="background: #12161e;    height: 94px !important;
                align-items: center;
                display: flex;justify-content: space-between;">
                    <div class="avatar">
                        <img
                            src="/img/bonus-bet.png"
                        />
                    </div>
                    <div class="namentickets">
                        <!--<h2 style="margin-top: 9px;line-height: normal;">${days[bonusType[0]]} бонус: с ${bonusType[1]} до ${bonusType[2]} MSK. Ставит максимум ${bonusType[4]} монеты в 1 игру</h2>-->
                        <h2 style="margin-top: 9px;line-height: normal;">Бонусный бот ставит 2% от комиссии игры</h2>
                    </div>
                    <div style="    margin-top: 5px;" class="sumnchance">
                        <h2 style="color: ${bonusType[5] == 1 ? '#ffde2f;' : '#00e612'};">
                        ${res.bonus}
                           
                        </h2>
                       
                    </div>
                </li>
            `;
        }
        $('.end-game').addClass('hidden'); 
        $("#winner-name").html(`<span style="position: relative;" ><div id="escapingBallG"><div id="escapingBall_1" class="escapingBallG"></div></div></span>`);
        $("#winner-ticket").html(`<span style="position: relative;"><div id="escapingBallG"><div id="escapingBall_1" class="escapingBallG"></div></div></span>`);
        $('#chances').html('');
        res.bets.reverse();
        res.bets.forEach(bet => {
            bets += `<li >
                <div class="avatar">
                    <img
                        
                        src="${bet.user.avatar}"
                    />
                </div>
                <div class="namentickets">
                    <h2 >${bet.user.username}</h2>
                    <h4 >
                        Билеты: ${bet.bet.from} - ${bet.bet.to}
                    </h4>
                </div>
                <div class="sumnchance">
                    <h2 style="color: ${bet.bet.balance == "bonus" ? '#ffde2f;' : '#00e612'};">
                       ${bet.bet.amount}
                       
                    </h2>
                    <h4 >
                        шанс: ${bet.bet.chance}%
                    </h4>
                </div>
            </li>`;
            // bets += '<tr><td class="username"> <button type="button" class="btn btn-link" data-id="'+bet.user.id+'"> <span class="sanitize-user"><div class="sanitize-avatar"><img src="'+bet.user.avatar+'" alt="" style="border: 1px solid #'+bet.bet.color+';"></div> <span class="sanitize-name">'+bet.user.username+'</span> </span> </button></td><td><div class="bet-number"> <span class="bet-wrap"> <span>'+bet.bet.amount+'</span> <svg class="icon icon-coin '+bet.bet.balance+'"> <use xlink:href="/img/symbols.svg#icon-coin"></use> </svg> </span></div></td><td>'+bet.bet.chance+'%</td><td><div class="bet-number rtl"> <span class="bet-wrap"> <span>'+bet.bet.from+' - '+bet.bet.to+'</span> <svg class="icon"> <use xlink:href="/img/symbols.svg#icon-ticket"></use> </svg> </span></div></td></tr>';
        });
        
        $('.main-block-table ul').html(bets);

        let chances = '';
        res.chances.sort((a, b) => b.chance-a.chance).forEach(chance => {
            chances += `
                <div class="avatarsblock_avatar">
                    <div class="avatarsblock_chance">
                        <span class="animated flash">${chance.chance == "100.00" ? 100 : chance.chance}%</span>
                    </div>
                    <img
                        src="${chance.user.avatar}"
                        style="width:100px; border-radius: 50%;"
                    />
                </div>
            `;
            // chances += '<div class="item" data-toggle="tooltip" data-placement="top" title="'+chance.user.username+'"><div class="user"><img src="'+chance.user.avatar+'" alt="" style="border: 1px solid #'+chance.color+';"></div><div class="hit">'+chance.chance+'%</div></div>';

            data.push(parseFloat(chance.chance));
            colors.push('#' + chance.color);
            avatars.push((parseFloat(chance.chance) >= 5) ? {
                src: chance.user.avatar,
                width: 35,
                height: 35
            } : {
                src: '/img/blank.png',
                width: 0,
                height: 0
            });
        });
        $('#chances').html(chances);
		
		// $('.spinner').css({
		// 	transition: 'all '+ rotate[res.room].time +'ms ease',
		// 	transform: 'rotate('+ rotate[res.room].spin +'deg)'
		// });
        $('.n_progressbar_main_banksum').html(`<span class="animated flash" id="value">${(res.amount).toFixed(2)}</span>`);
        $('#hash').text(res.hash);
        $('#minBet').text(res.min);
        $('#maxBet').text(res.max);
        $('#gameId').text(res.game_id);

        $("#bank_"+ res.room).html(`${(res.amount).toFixed(2)}`);
        
		let min = Math.floor(res.time/60),
			sec = res.time-(Math.floor(res.time/60)*60);
		if(sec < 10) sec = '0' + sec;
		if(min < 10) min = '0' + min;
		if(res.bets.length <= 2) $('#timer').text(sec);
		
		if($('.game-tooltip.won').length != 0) {
			$('.game-tooltip.won').removeClass('isActive');
			$('.game-tooltip.won.'+res.room).addClass('isActive');
		}
		
		// chart.options.plugins.labels.images = avatars;
		// if(data.length == 0) {
		// 	chart.data.datasets[0].data = [100];
		// 	chart.data.datasets[0].backgroundColor = ['#2c323f'];
		// 	chart.update();
		// } else {
		// 	chart.data.datasets[0].data = data;
		// 	chart.data.datasets[0].backgroundColor = colors;
		// 	chart.update();
		// }
    }

    $('.vs-button__btn').click(function() {
        $.ajax({
            url: '/jackpot/newBet',
            type: 'post',
            data: {
                amount: parseFloat($('#sum').val()),
                balance: localStorage.getItem('balance') || 'balance',
                room: room
            },
            success: r => nAlert(r),
            error: e => console.log(e.responseText)
        });
    });

    $('.chances').kinetic({
        filterTarget: function(target, e) {
            if (!/down|start/.test(e.type)){
                return !(/area|a|input/i.test(target.tagName));
            }
        }
    });
	$('.btn-next').click(function() {
		 $('.chances').kinetic('start', { velocity: 5 });
	});
	$('.btn-prev').click(function() {
		 $('.chances').kinetic('start', { velocity: -5 });
    });


    function JackpotInit() {
        $("#chipsRoom").html(chips[room].map(x => `<div data-sum="${x}" class="chip-room" style=" background: url(/img/${room}/${room}${x}.png) center center no-repeat;"></div>`).join(" "))
        $(".chip-room").click(function() {
            $.ajax({
                url: '/jackpot/newBet',
                type: 'post',
                data: {
                    amount: $(this).data('sum'),
                    balance: localStorage.getItem('balance') || 'balance',
                    room: room
                },
                success: r => nAlert(r),
                error: e => console.log(e.responseText)
            });
        }); 
        ngtimerStatus = true;
        $.ajax({
            url: '/jackpot/init',
            type: 'post',
            data: {
                room: room
            },
            success: r => {
                console.log(r); 
                if(r.success) JackpotParse(r.data);
            },
            error: e => console.log(e.responseText)
        });
        initGame(room);
      
    }
	
    // window.chart = new Chart(canvas, {
    //     type: 'doughnut',
    //     data: {
    //         datasets: [{
    //             label: '',
    //             data: [1],
    //             backgroundColor: ['#2c323f'],
    //             borderWidth: 0
    //         }]
    //     },
    //     options: {
    //         responsive: 1,
    //         cutoutPercentage: 65,
    //         legend: {
    //             display: 0
    //         },
    //         tooltips: {
    //             enabled: 0
    //         },
    //         hover: {
    //             mode: null
    //         },
    //         plugins: {
    //             labels: {
    //                 render: 'image',
    //                 images: [],
    //             },
    //         }
    //     }
    // });


    function nAlert(message, type) {
        if(typeof message == 'object') {
            type = (message.success) ? 'success' : 'error';
            message = message.msg;
        }

        $.notify({
            type: type,
            message: message
        });
    }
});