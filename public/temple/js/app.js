(function() {
  'use strict';
  
  // poppup

 //  $('.popup-frame').magnificPopup({
	// 	disableOn: 700,
	// 	type: 'iframe',
	// 	mainClass: 'mfp-fade',
	// 	removalDelay: 160,
	// 	preloader: false,
	// 	fixedContentPos: false
	// });

	// $('.popup-img').magnificPopup({
	// 	type: 'image',
	// 	closeOnContentClick: true,
	// 	mainClass: 'mfp-img-mobile',
	// 	image: {
	// 		verticalFit: true
	// 	}
		
 //  });

 //  $('.popup').magnificPopup({
	// 	type: 'inline',
 //    preloader: false,
 //    closeOnContentClick: false,
 //    fixedContentPos: true,
 //    mainClass: 'mfp-zoom-in',

 //    callbacks: {
 //      open: function() {

 //      },
 //    }
 //  });

  //

  svg4everybody();
  

  //table
  
  if($('table.responsive').length > 0){
    $('table.responsive').ngResponsiveTables();
  }
	
  //select styler

  $('select').styler();

  //datepicker

  // $( ".datepicker" ).datepicker();

  // $("#weeklyDatePicker").datetimepicker({
  //   format: 'DD-MM-YYYY'
  // });

  // //Get the value of Start and End of Week
  // $('#weeklyDatePicker').on('dp.change', function (e) {
  //     var value = $("#weeklyDatePicker").val();
  //     var firstDate = moment(value, "DD-MM-YYYY").day(0).format("DD-MM-YYYY");
  //     var lastDate =  moment(value, "DD-MM-YYYY").day(6).format("DD-MM-YYYY");
  //     $("#weeklyDatePicker").val(firstDate + " - " + lastDate);
  // });
   
  //tabs

  $('.tabs__wrap').each(function() {
    $(this).find('.tab').each(function(i) {
      $(this).parents('.tabs__wrap').find('.tab_content').children().not(':first').hide();
      $(this).click(function(){
        $(this).addClass('active').siblings().removeClass('active')
        $(this).parents('.tabs__wrap').find('.tab_content').children().eq(i).fadeIn(0).siblings('.tab_item').hide();
      
        // $(".nicescroll-box").getNiceScroll().resize();
      });
    });
  });

  //tabs
  $('[data-tabs-btn]').click(function() {
    let tabsName = $(this).parent().attr('data-tabs-btns');
    let tabNo = $(this).attr('data-tabs-btn');
    let tabsWrapper = $('[data-tabs-wrapper='+tabsName+']');

    $(this).siblings().removeClass('active');
    $(this).addClass('active');

    tabsWrapper.children().each(function(i, item) {
      $(item).hide();
      if ($(item).attr('data-tabs-item') === tabNo) {
        $(item).show();
      }
    });
  });

  function tabsInitialization() {
    let btns = $('[data-tabs-btns]');
    let wrapper = $('[data-tabs-wrapper]');

    $(wrapper).children().not(function() {
      if ($(this).attr('data-tabs-item') === '1') {
        return true;
      }
    }).hide();

    $(btns).children().not(function() {
      if ($(this).attr('data-tabs-btn') === '1') {
        return false;
      } else {
        return true;
      }
    }).addClass('active');
  }
  
  tabsInitialization();

  //accordion

  var Accordion = function(el, multiple) {
    this.el = el || {};
    this.multiple = multiple || false;

    // Variables privadas
    var links = this.el.find('.accordion__head');
    // Evento
    links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
  }

  Accordion.prototype.dropdown = function(e) {
    var $el = e.data.el,
        $this = $(this),
        $next = $this.next();

    $next.slideToggle();
    $this.parent().toggleClass('active');

    if($('.nicescroll-box').length !== 0){
      setTimeout(() => {
        $(".nicescroll-box").getNiceScroll().resize();
      }, 1000);
    }

    if (!e.data.multiple) {
      $el.find('.accordion__body').not($next).slideUp().parent().removeClass('active');
    };
  }	

  var accordion = new Accordion($('.accordion'), false);
  
  //nicescroll

  $(".nicescroll-box").niceScroll(".wrap",{
    cursorcolor:"#092abb",
    cursorwidth:"0px",
    cursorborder: "0px solid #fff",
    zindex: 20,
    emulatetouch: true,
    autohidemode: false,
    cursorborderradius: "0px",
    railalign: 'right',
  });

  $(window).on('resize', function(){
    setTimeout(() => {
      $(".nicescroll-box").getNiceScroll().resize();
    }, 1000);
  })


  
  
  // aos

  AOS.init(
    {
      // Global settings
      disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
      startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
      initClassName: 'aos-init', // class applied after initialization
      animatedClassName: 'aos-animate', // class applied on animation
      useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
      // Settings that can be overriden on per-element basis, by `data-aos-*` attributes:
      offset: 0, // offset (in px) from the original trigger point
      delay: 0, // values from 0 to 3000, with step 50ms
      duration: 700, // values from 0 to 3000, with step 50ms
      easing: 'ease-in-out', // default easing for AOS animations
      once: false, // whether animation should happen only once - while scrolling down
      mirror: false, // whether elements should animate out while scrolling past them
      anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
    }
  );

  setTimeout(AOS.refreshHard, 1000);
	
	//clipboard

  var affil1 = new Clipboard('#affil');
  var banners = new Clipboard('.cab-banners__copy');

  function affiliatelink(id) {
    id.on('success', function (e) {
      // swal({
      //   title: "Your referral link copied!",
      //   text: "You can paste text that has been copied by pressing Ctrl + V. The text that was copied last will be pasted.",
      //   type: "success",
      //   showCancelButton: false,
      //   confirmButtonClass: "btn-success",
      //   confirmButtonText: "OK!",
      //   closeOnConfirm: false,
      //   closeOnCancel: false
      // });

      // Lobibox.notify('success', {
      //   title: true,
      //   size: 'normal',
      //   icon: false,
      //   sound: false,
      //   iconSource: "bootstrap",
      //   msg: 'Your referral link copied!'
      // });

      $('.copy-success').fadeIn();
      $('.copy-success').delay(3000).fadeOut();
    });
  }

  affiliatelink(affil1);
  affiliatelink(banners);

  $('.header-burger').on('click', function(){
    $(this).toggleClass('active');
    $('.header-mob').toggleClass('active');
  })



  function togglePlay() {
    return mp3.paused ? mp3.play() : mp3.pause();
  };

  $('.header-sound').on('click', function(){
    togglePlay()
    mp3.loop = true;
    $(this).toggleClass('active');

    if(mp3.paused){
      $('.header-sound__anim div').remove()
    }else{
      for(let i = 0; i < 10; i++){
  
        const left = (i * 2) + 1;
        const anim = Math.floor(Math.random() * 75 + 400);
        const height = Math.floor(Math.random() * 25 + 3);
        
        document.querySelector('.header-sound__anim').innerHTML += `<div class="bar" style="left:${left}px;animation-duration:${anim}ms;height:${height}px"></div>`;//`<div class="bar" style="left:${left}px">Hello</div>`;
      }
    }

    
  })

  
  setInterval(function(){
    var date = moment(new Date());
    date = date.tz('Europe/London').format('HH:mm:ss');
    
    var currentDay = moment(new Date());
    currentDay = currentDay.tz('Europe/London').format('DD MMM YYYY');

    $('.header-time p').html(date)
    $('.header-time span').html(currentDay)
  }, 1000)

  if($('.refs-scene').length !== 0){
    let refsHead = $('.refs-scene__item-anim_1 div');
    let refsLogo = $('.refs-scene__item-anim_2 div');
    setInterval(function(){
      refsHead.removeAttr('style').addClass('animate__animated animate__bounceInRight');

      setTimeout(function(){
        refsHead.removeClass('animate__animated animate__bounceInRight').fadeOut();
      }, 5000)
    }, 6000)

    setInterval(function(){
      refsLogo.removeAttr('style').addClass('animate__animated animate__bounceInLeft');

      setTimeout(function(){
        refsLogo.removeClass('animate__animated animate__bounceInLeft').fadeOut();
      }, 5000)
    }, 6000)
  }


  

  if($('#smoke').length !== 0){
    var canvas = document.getElementById('smoke')
    var ctx = canvas.getContext('2d')
    canvas.width = innerWidth
    canvas.height = innerHeight
    
    var party = smokemachine(ctx, [255, 255, 255])
    party.start() // start animating
    party.setPreDrawCallback(function(dt){
      party.addSmoke(innerWidth/2, innerHeight, .3)
      canvas.width = innerWidth
      canvas.height = innerHeight
    })
  }

  // sliders

  var startSlider = new Swiper('.start-slider .swiper-container', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 0,
    direction: 'vertical',
    centeredSlides: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: true,
    },
    navigation: {
      nextEl: '.start-slider__nav .swiper-button-next',
      prevEl: '.start-slider__nav .swiper-button-prev',
    },
    breakpoints:{
      480: {
        slidesPerView: 3
      }
    }
  });

  var newsThumbsSlider = new Swiper('.news-thumbs .swiper-container', {
    speed: 400,
    spaceBetween: 25,
    slidesPerView: 1,
    loop: false,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    //simulateTouch: false,
    // slideToClickedSlide: true,
    // autoplay: {
    //   delay: 3000,
    // },
    
    breakpoints: {
      1200: {
        slidesPerView: 3,
      },
      992: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 2,
      },
    }
  });
  
  var newsContentSlider = new Swiper('.news-content .swiper-container', {
    speed: 400,
    slidesPerView: 1,
    simulateTouch: false,
    loop: false,
    effect: 'fade',
    navigation: {
      nextEl: '.news-nav .swiper-button-next',
      prevEl: '.news-nav .swiper-button-prev',
    },
    pagination: {
      el: '.news-nav .swiper-pagination',
      type: 'bullets',
      clickable: true,
    },
    fadeEffect: {
      crossFade: true
    },
    thumbs: {
      swiper: newsThumbsSlider,
      autoScrollOffset: 1
    }
  });

  // parallax

  if($('#header-scene').length !== 0){
    var scene = document.getElementById('header-scene');
    var parallaxInstance = new Parallax(scene);
  }
  if($('#invest-scene').length !== 0){
    var scene = document.getElementById('invest-scene');
    var parallaxInstance = new Parallax(scene);
  }
  if($('#refs-scene').length !== 0){
    var scene = document.getElementById('refs-scene');
    var parallaxInstance = new Parallax(scene, {
      limitY: 1
    });
  }

  //menu fix mobile

  let vh = window.innerHeight * 0.01;
  // Then we set the value in the --vh custom property to the root of the document
  document.documentElement.style.setProperty('--vh', `${vh}px`);

  window.addEventListener('resize', () => {
    // We execute the same script as before
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
  });


  // setTimeout(() => {
  //   $('.marquee').marquee({
  //     //speed in milliseconds of the marquee
  //     duration: 8000,
  //     //gap in pixels between the tickers
  //     gap: 0,
  //     //time in milliseconds before the marquee will start animating
  //     delayBeforeStart: 0,
  //     //'left' or 'right'
  //     direction: 'left',
  //     //true or false - should the marquee be duplicated to show an effect of continues flow
  //     duplicated: true
  //   });
  // }, 1000);

  //cabinet-Settings

  // $('.cabinet-table__settings-btn').on('click', function(e){
  //   e.preventDefault();
  
    
  
  //   $(this).siblings('.cabinet-table__settings-hide').fadeIn(300);
  //   $(this).parent().addClass('active');
  //   let trueH = ($(document).outerHeight(true) - $(this).siblings('.cabinet-table__settings-hide').offset().top - $(this).siblings('.cabinet-table__settings-hide').outerHeight(true));
  
  //   if(trueH <= 0){
  //     $(this).siblings('.cabinet-table__settings-hide').addClass('top');
  //   }
  // });
  
  // $(document).mouseup(function (e){ 
  //   var block = $(".cabinet-table__settings.active .cabinet-table__settings-hide"); 
  //   if (!block.is(e.target) 
  //       && block.has(e.target).length === 0) { 
  //       block.hide(); 
  
  //       block.parent().removeClass('active');
  
  //       if( block.hasClass('top')){
  //         block.removeClass('top');
  //       }
  //   }
  // });
 
  
})();

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImFwcC5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsImZpbGUiOiJhcHAuanMiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKSB7XHJcbiAgJ3VzZSBzdHJpY3QnO1xyXG4gIFxyXG4gIC8vIHBvcHB1cFxyXG5cclxuICAkKCcucG9wdXAtZnJhbWUnKS5tYWduaWZpY1BvcHVwKHtcclxuXHRcdGRpc2FibGVPbjogNzAwLFxyXG5cdFx0dHlwZTogJ2lmcmFtZScsXHJcblx0XHRtYWluQ2xhc3M6ICdtZnAtZmFkZScsXHJcblx0XHRyZW1vdmFsRGVsYXk6IDE2MCxcclxuXHRcdHByZWxvYWRlcjogZmFsc2UsXHJcblx0XHRmaXhlZENvbnRlbnRQb3M6IGZhbHNlXHJcblx0fSk7XHJcblxyXG5cdCQoJy5wb3B1cC1pbWcnKS5tYWduaWZpY1BvcHVwKHtcclxuXHRcdHR5cGU6ICdpbWFnZScsXHJcblx0XHRjbG9zZU9uQ29udGVudENsaWNrOiB0cnVlLFxyXG5cdFx0bWFpbkNsYXNzOiAnbWZwLWltZy1tb2JpbGUnLFxyXG5cdFx0aW1hZ2U6IHtcclxuXHRcdFx0dmVydGljYWxGaXQ6IHRydWVcclxuXHRcdH1cclxuXHRcdFxyXG4gIH0pO1xyXG5cclxuICAkKCcucG9wdXAnKS5tYWduaWZpY1BvcHVwKHtcclxuXHRcdHR5cGU6ICdpbmxpbmUnLFxyXG4gICAgcHJlbG9hZGVyOiBmYWxzZSxcclxuICAgIGNsb3NlT25Db250ZW50Q2xpY2s6IGZhbHNlLFxyXG4gICAgZml4ZWRDb250ZW50UG9zOiB0cnVlLFxyXG4gICAgbWFpbkNsYXNzOiAnbWZwLXpvb20taW4nLFxyXG5cclxuICAgIGNhbGxiYWNrczoge1xyXG4gICAgICBvcGVuOiBmdW5jdGlvbigpIHtcclxuXHJcbiAgICAgIH0sXHJcbiAgICB9XHJcbiAgfSk7XHJcblxyXG4gIC8vXHJcblxyXG4gIHN2ZzRldmVyeWJvZHkoKTtcclxuICBcclxuXHJcbiAgLy90YWJsZVxyXG4gIFxyXG4gIGlmKCQoJ3RhYmxlLnJlc3BvbnNpdmUnKS5sZW5ndGggPiAwKXtcclxuICAgICQoJ3RhYmxlLnJlc3BvbnNpdmUnKS5uZ1Jlc3BvbnNpdmVUYWJsZXMoKTtcclxuICB9XHJcblx0XHJcbiAgLy9zZWxlY3Qgc3R5bGVyXHJcblxyXG4gICQoJ3NlbGVjdCcpLnN0eWxlcigpO1xyXG5cclxuICAvL2RhdGVwaWNrZXJcclxuXHJcbiAgLy8gJCggXCIuZGF0ZXBpY2tlclwiICkuZGF0ZXBpY2tlcigpO1xyXG5cclxuICAvLyAkKFwiI3dlZWtseURhdGVQaWNrZXJcIikuZGF0ZXRpbWVwaWNrZXIoe1xyXG4gIC8vICAgZm9ybWF0OiAnREQtTU0tWVlZWSdcclxuICAvLyB9KTtcclxuXHJcbiAgLy8gLy9HZXQgdGhlIHZhbHVlIG9mIFN0YXJ0IGFuZCBFbmQgb2YgV2Vla1xyXG4gIC8vICQoJyN3ZWVrbHlEYXRlUGlja2VyJykub24oJ2RwLmNoYW5nZScsIGZ1bmN0aW9uIChlKSB7XHJcbiAgLy8gICAgIHZhciB2YWx1ZSA9ICQoXCIjd2Vla2x5RGF0ZVBpY2tlclwiKS52YWwoKTtcclxuICAvLyAgICAgdmFyIGZpcnN0RGF0ZSA9IG1vbWVudCh2YWx1ZSwgXCJERC1NTS1ZWVlZXCIpLmRheSgwKS5mb3JtYXQoXCJERC1NTS1ZWVlZXCIpO1xyXG4gIC8vICAgICB2YXIgbGFzdERhdGUgPSAgbW9tZW50KHZhbHVlLCBcIkRELU1NLVlZWVlcIikuZGF5KDYpLmZvcm1hdChcIkRELU1NLVlZWVlcIik7XHJcbiAgLy8gICAgICQoXCIjd2Vla2x5RGF0ZVBpY2tlclwiKS52YWwoZmlyc3REYXRlICsgXCIgLSBcIiArIGxhc3REYXRlKTtcclxuICAvLyB9KTtcclxuICAgXHJcbiAgLy90YWJzXHJcblxyXG4gICQoJy50YWJzX193cmFwJykuZWFjaChmdW5jdGlvbigpIHtcclxuICAgICQodGhpcykuZmluZCgnLnRhYicpLmVhY2goZnVuY3Rpb24oaSkge1xyXG4gICAgICAkKHRoaXMpLnBhcmVudHMoJy50YWJzX193cmFwJykuZmluZCgnLnRhYl9jb250ZW50JykuY2hpbGRyZW4oKS5ub3QoJzpmaXJzdCcpLmhpZGUoKTtcclxuICAgICAgJCh0aGlzKS5jbGljayhmdW5jdGlvbigpe1xyXG4gICAgICAgICQodGhpcykuYWRkQ2xhc3MoJ2FjdGl2ZScpLnNpYmxpbmdzKCkucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpXHJcbiAgICAgICAgJCh0aGlzKS5wYXJlbnRzKCcudGFic19fd3JhcCcpLmZpbmQoJy50YWJfY29udGVudCcpLmNoaWxkcmVuKCkuZXEoaSkuZmFkZUluKDApLnNpYmxpbmdzKCcudGFiX2l0ZW0nKS5oaWRlKCk7XHJcbiAgICAgIFxyXG4gICAgICAgIC8vICQoXCIubmljZXNjcm9sbC1ib3hcIikuZ2V0TmljZVNjcm9sbCgpLnJlc2l6ZSgpO1xyXG4gICAgICB9KTtcclxuICAgIH0pO1xyXG4gIH0pO1xyXG5cclxuICAvL3RhYnNcclxuICAkKCdbZGF0YS10YWJzLWJ0bl0nKS5jbGljayhmdW5jdGlvbigpIHtcclxuICAgIGxldCB0YWJzTmFtZSA9ICQodGhpcykucGFyZW50KCkuYXR0cignZGF0YS10YWJzLWJ0bnMnKTtcclxuICAgIGxldCB0YWJObyA9ICQodGhpcykuYXR0cignZGF0YS10YWJzLWJ0bicpO1xyXG4gICAgbGV0IHRhYnNXcmFwcGVyID0gJCgnW2RhdGEtdGFicy13cmFwcGVyPScrdGFic05hbWUrJ10nKTtcclxuXHJcbiAgICAkKHRoaXMpLnNpYmxpbmdzKCkucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgJCh0aGlzKS5hZGRDbGFzcygnYWN0aXZlJyk7XHJcblxyXG4gICAgdGFic1dyYXBwZXIuY2hpbGRyZW4oKS5lYWNoKGZ1bmN0aW9uKGksIGl0ZW0pIHtcclxuICAgICAgJChpdGVtKS5oaWRlKCk7XHJcbiAgICAgIGlmICgkKGl0ZW0pLmF0dHIoJ2RhdGEtdGFicy1pdGVtJykgPT09IHRhYk5vKSB7XHJcbiAgICAgICAgJChpdGVtKS5zaG93KCk7XHJcbiAgICAgIH1cclxuICAgIH0pO1xyXG4gIH0pO1xyXG5cclxuICBmdW5jdGlvbiB0YWJzSW5pdGlhbGl6YXRpb24oKSB7XHJcbiAgICBsZXQgYnRucyA9ICQoJ1tkYXRhLXRhYnMtYnRuc10nKTtcclxuICAgIGxldCB3cmFwcGVyID0gJCgnW2RhdGEtdGFicy13cmFwcGVyXScpO1xyXG5cclxuICAgICQod3JhcHBlcikuY2hpbGRyZW4oKS5ub3QoZnVuY3Rpb24oKSB7XHJcbiAgICAgIGlmICgkKHRoaXMpLmF0dHIoJ2RhdGEtdGFicy1pdGVtJykgPT09ICcxJykge1xyXG4gICAgICAgIHJldHVybiB0cnVlO1xyXG4gICAgICB9XHJcbiAgICB9KS5oaWRlKCk7XHJcblxyXG4gICAgJChidG5zKS5jaGlsZHJlbigpLm5vdChmdW5jdGlvbigpIHtcclxuICAgICAgaWYgKCQodGhpcykuYXR0cignZGF0YS10YWJzLWJ0bicpID09PSAnMScpIHtcclxuICAgICAgICByZXR1cm4gZmFsc2U7XHJcbiAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgcmV0dXJuIHRydWU7XHJcbiAgICAgIH1cclxuICAgIH0pLmFkZENsYXNzKCdhY3RpdmUnKTtcclxuICB9XHJcbiAgXHJcbiAgdGFic0luaXRpYWxpemF0aW9uKCk7XHJcblxyXG4gIC8vYWNjb3JkaW9uXHJcblxyXG4gIHZhciBBY2NvcmRpb24gPSBmdW5jdGlvbihlbCwgbXVsdGlwbGUpIHtcclxuICAgIHRoaXMuZWwgPSBlbCB8fCB7fTtcclxuICAgIHRoaXMubXVsdGlwbGUgPSBtdWx0aXBsZSB8fCBmYWxzZTtcclxuXHJcbiAgICAvLyBWYXJpYWJsZXMgcHJpdmFkYXNcclxuICAgIHZhciBsaW5rcyA9IHRoaXMuZWwuZmluZCgnLmFjY29yZGlvbl9faGVhZCcpO1xyXG4gICAgLy8gRXZlbnRvXHJcbiAgICBsaW5rcy5vbignY2xpY2snLCB7ZWw6IHRoaXMuZWwsIG11bHRpcGxlOiB0aGlzLm11bHRpcGxlfSwgdGhpcy5kcm9wZG93bilcclxuICB9XHJcblxyXG4gIEFjY29yZGlvbi5wcm90b3R5cGUuZHJvcGRvd24gPSBmdW5jdGlvbihlKSB7XHJcbiAgICB2YXIgJGVsID0gZS5kYXRhLmVsLFxyXG4gICAgICAgICR0aGlzID0gJCh0aGlzKSxcclxuICAgICAgICAkbmV4dCA9ICR0aGlzLm5leHQoKTtcclxuXHJcbiAgICAkbmV4dC5zbGlkZVRvZ2dsZSgpO1xyXG4gICAgJHRoaXMucGFyZW50KCkudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xyXG5cclxuICAgIGlmKCQoJy5uaWNlc2Nyb2xsLWJveCcpLmxlbmd0aCAhPT0gMCl7XHJcbiAgICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgICQoXCIubmljZXNjcm9sbC1ib3hcIikuZ2V0TmljZVNjcm9sbCgpLnJlc2l6ZSgpO1xyXG4gICAgICB9LCAxMDAwKTtcclxuICAgIH1cclxuXHJcbiAgICBpZiAoIWUuZGF0YS5tdWx0aXBsZSkge1xyXG4gICAgICAkZWwuZmluZCgnLmFjY29yZGlvbl9fYm9keScpLm5vdCgkbmV4dCkuc2xpZGVVcCgpLnBhcmVudCgpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcclxuICAgIH07XHJcbiAgfVx0XHJcblxyXG4gIHZhciBhY2NvcmRpb24gPSBuZXcgQWNjb3JkaW9uKCQoJy5hY2NvcmRpb24nKSwgZmFsc2UpO1xyXG4gIFxyXG4gIC8vbmljZXNjcm9sbFxyXG5cclxuICAkKFwiLm5pY2VzY3JvbGwtYm94XCIpLm5pY2VTY3JvbGwoXCIud3JhcFwiLHtcclxuICAgIGN1cnNvcmNvbG9yOlwiIzA5MmFiYlwiLFxyXG4gICAgY3Vyc29yd2lkdGg6XCIwcHhcIixcclxuICAgIGN1cnNvcmJvcmRlcjogXCIwcHggc29saWQgI2ZmZlwiLFxyXG4gICAgemluZGV4OiAyMCxcclxuICAgIGVtdWxhdGV0b3VjaDogdHJ1ZSxcclxuICAgIGF1dG9oaWRlbW9kZTogZmFsc2UsXHJcbiAgICBjdXJzb3Jib3JkZXJyYWRpdXM6IFwiMHB4XCIsXHJcbiAgICByYWlsYWxpZ246ICdyaWdodCcsXHJcbiAgfSk7XHJcblxyXG4gICQod2luZG93KS5vbigncmVzaXplJywgZnVuY3Rpb24oKXtcclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAkKFwiLm5pY2VzY3JvbGwtYm94XCIpLmdldE5pY2VTY3JvbGwoKS5yZXNpemUoKTtcclxuICAgIH0sIDEwMDApO1xyXG4gIH0pXHJcblxyXG5cclxuICBcclxuICBcclxuICAvLyBhb3NcclxuXHJcbiAgQU9TLmluaXQoXHJcbiAgICB7XHJcbiAgICAgIC8vIEdsb2JhbCBzZXR0aW5nc1xyXG4gICAgICBkaXNhYmxlOiBmYWxzZSwgLy8gYWNjZXB0cyBmb2xsb3dpbmcgdmFsdWVzOiAncGhvbmUnLCAndGFibGV0JywgJ21vYmlsZScsIGJvb2xlYW4sIGV4cHJlc3Npb24gb3IgZnVuY3Rpb25cclxuICAgICAgc3RhcnRFdmVudDogJ0RPTUNvbnRlbnRMb2FkZWQnLCAvLyBuYW1lIG9mIHRoZSBldmVudCBkaXNwYXRjaGVkIG9uIHRoZSBkb2N1bWVudCwgdGhhdCBBT1Mgc2hvdWxkIGluaXRpYWxpemUgb25cclxuICAgICAgaW5pdENsYXNzTmFtZTogJ2Fvcy1pbml0JywgLy8gY2xhc3MgYXBwbGllZCBhZnRlciBpbml0aWFsaXphdGlvblxyXG4gICAgICBhbmltYXRlZENsYXNzTmFtZTogJ2Fvcy1hbmltYXRlJywgLy8gY2xhc3MgYXBwbGllZCBvbiBhbmltYXRpb25cclxuICAgICAgdXNlQ2xhc3NOYW1lczogZmFsc2UsIC8vIGlmIHRydWUsIHdpbGwgYWRkIGNvbnRlbnQgb2YgYGRhdGEtYW9zYCBhcyBjbGFzc2VzIG9uIHNjcm9sbFxyXG4gICAgICAvLyBTZXR0aW5ncyB0aGF0IGNhbiBiZSBvdmVycmlkZW4gb24gcGVyLWVsZW1lbnQgYmFzaXMsIGJ5IGBkYXRhLWFvcy0qYCBhdHRyaWJ1dGVzOlxyXG4gICAgICBvZmZzZXQ6IDAsIC8vIG9mZnNldCAoaW4gcHgpIGZyb20gdGhlIG9yaWdpbmFsIHRyaWdnZXIgcG9pbnRcclxuICAgICAgZGVsYXk6IDAsIC8vIHZhbHVlcyBmcm9tIDAgdG8gMzAwMCwgd2l0aCBzdGVwIDUwbXNcclxuICAgICAgZHVyYXRpb246IDcwMCwgLy8gdmFsdWVzIGZyb20gMCB0byAzMDAwLCB3aXRoIHN0ZXAgNTBtc1xyXG4gICAgICBlYXNpbmc6ICdlYXNlLWluLW91dCcsIC8vIGRlZmF1bHQgZWFzaW5nIGZvciBBT1MgYW5pbWF0aW9uc1xyXG4gICAgICBvbmNlOiBmYWxzZSwgLy8gd2hldGhlciBhbmltYXRpb24gc2hvdWxkIGhhcHBlbiBvbmx5IG9uY2UgLSB3aGlsZSBzY3JvbGxpbmcgZG93blxyXG4gICAgICBtaXJyb3I6IGZhbHNlLCAvLyB3aGV0aGVyIGVsZW1lbnRzIHNob3VsZCBhbmltYXRlIG91dCB3aGlsZSBzY3JvbGxpbmcgcGFzdCB0aGVtXHJcbiAgICAgIGFuY2hvclBsYWNlbWVudDogJ3RvcC1ib3R0b20nLCAvLyBkZWZpbmVzIHdoaWNoIHBvc2l0aW9uIG9mIHRoZSBlbGVtZW50IHJlZ2FyZGluZyB0byB3aW5kb3cgc2hvdWxkIHRyaWdnZXIgdGhlIGFuaW1hdGlvblxyXG4gICAgfVxyXG4gICk7XHJcblxyXG4gIHNldFRpbWVvdXQoQU9TLnJlZnJlc2hIYXJkLCAxMDAwKTtcclxuXHRcclxuXHQvL2NsaXBib2FyZFxyXG5cclxuICB2YXIgYWZmaWwxID0gbmV3IENsaXBib2FyZCgnI2FmZmlsJyk7XHJcbiAgdmFyIGJhbm5lcnMgPSBuZXcgQ2xpcGJvYXJkKCcuY2FiLWJhbm5lcnNfX2NvcHknKTtcclxuXHJcbiAgZnVuY3Rpb24gYWZmaWxpYXRlbGluayhpZCkge1xyXG4gICAgaWQub24oJ3N1Y2Nlc3MnLCBmdW5jdGlvbiAoZSkge1xyXG4gICAgICAvLyBzd2FsKHtcclxuICAgICAgLy8gICB0aXRsZTogXCJZb3VyIHJlZmVycmFsIGxpbmsgY29waWVkIVwiLFxyXG4gICAgICAvLyAgIHRleHQ6IFwiWW91IGNhbiBwYXN0ZSB0ZXh0IHRoYXQgaGFzIGJlZW4gY29waWVkIGJ5IHByZXNzaW5nIEN0cmwgKyBWLiBUaGUgdGV4dCB0aGF0IHdhcyBjb3BpZWQgbGFzdCB3aWxsIGJlIHBhc3RlZC5cIixcclxuICAgICAgLy8gICB0eXBlOiBcInN1Y2Nlc3NcIixcclxuICAgICAgLy8gICBzaG93Q2FuY2VsQnV0dG9uOiBmYWxzZSxcclxuICAgICAgLy8gICBjb25maXJtQnV0dG9uQ2xhc3M6IFwiYnRuLXN1Y2Nlc3NcIixcclxuICAgICAgLy8gICBjb25maXJtQnV0dG9uVGV4dDogXCJPSyFcIixcclxuICAgICAgLy8gICBjbG9zZU9uQ29uZmlybTogZmFsc2UsXHJcbiAgICAgIC8vICAgY2xvc2VPbkNhbmNlbDogZmFsc2VcclxuICAgICAgLy8gfSk7XHJcblxyXG4gICAgICAvLyBMb2JpYm94Lm5vdGlmeSgnc3VjY2VzcycsIHtcclxuICAgICAgLy8gICB0aXRsZTogdHJ1ZSxcclxuICAgICAgLy8gICBzaXplOiAnbm9ybWFsJyxcclxuICAgICAgLy8gICBpY29uOiBmYWxzZSxcclxuICAgICAgLy8gICBzb3VuZDogZmFsc2UsXHJcbiAgICAgIC8vICAgaWNvblNvdXJjZTogXCJib290c3RyYXBcIixcclxuICAgICAgLy8gICBtc2c6ICdZb3VyIHJlZmVycmFsIGxpbmsgY29waWVkISdcclxuICAgICAgLy8gfSk7XHJcblxyXG4gICAgICAkKCcuY29weS1zdWNjZXNzJykuZmFkZUluKCk7XHJcbiAgICAgICQoJy5jb3B5LXN1Y2Nlc3MnKS5kZWxheSgzMDAwKS5mYWRlT3V0KCk7XHJcbiAgICB9KTtcclxuICB9XHJcblxyXG4gIGFmZmlsaWF0ZWxpbmsoYWZmaWwxKTtcclxuICBhZmZpbGlhdGVsaW5rKGJhbm5lcnMpO1xyXG5cclxuICAkKCcuaGVhZGVyLWJ1cmdlcicpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XHJcbiAgICAkKHRoaXMpLnRvZ2dsZUNsYXNzKCdhY3RpdmUnKTtcclxuICAgICQoJy5oZWFkZXItbW9iJykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gIH0pXHJcblxyXG4gIHZhciBtcDMgPSBuZXcgQXVkaW8oKTtcclxuICBtcDMuc3JjID0gJ2Fzc2V0cy9pbWcvbXVzaWMubXAzJztcclxuXHJcbiAgZnVuY3Rpb24gdG9nZ2xlUGxheSgpIHtcclxuICAgIHJldHVybiBtcDMucGF1c2VkID8gbXAzLnBsYXkoKSA6IG1wMy5wYXVzZSgpO1xyXG4gIH07XHJcblxyXG4gICQoJy5oZWFkZXItc291bmQnKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgdG9nZ2xlUGxheSgpXHJcbiAgICBtcDMubG9vcCA9IHRydWU7XHJcbiAgICAkKHRoaXMpLnRvZ2dsZUNsYXNzKCdhY3RpdmUnKTtcclxuXHJcbiAgICBpZihtcDMucGF1c2VkKXtcclxuICAgICAgJCgnLmhlYWRlci1zb3VuZF9fYW5pbSBkaXYnKS5yZW1vdmUoKVxyXG4gICAgfWVsc2V7XHJcbiAgICAgIGZvcihsZXQgaSA9IDA7IGkgPCAxMDsgaSsrKXtcclxuICBcclxuICAgICAgICBjb25zdCBsZWZ0ID0gKGkgKiAyKSArIDE7XHJcbiAgICAgICAgY29uc3QgYW5pbSA9IE1hdGguZmxvb3IoTWF0aC5yYW5kb20oKSAqIDc1ICsgNDAwKTtcclxuICAgICAgICBjb25zdCBoZWlnaHQgPSBNYXRoLmZsb29yKE1hdGgucmFuZG9tKCkgKiAyNSArIDMpO1xyXG4gICAgICAgIFxyXG4gICAgICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5oZWFkZXItc291bmRfX2FuaW0nKS5pbm5lckhUTUwgKz0gYDxkaXYgY2xhc3M9XCJiYXJcIiBzdHlsZT1cImxlZnQ6JHtsZWZ0fXB4O2FuaW1hdGlvbi1kdXJhdGlvbjoke2FuaW19bXM7aGVpZ2h0OiR7aGVpZ2h0fXB4XCI+PC9kaXY+YDsvL2A8ZGl2IGNsYXNzPVwiYmFyXCIgc3R5bGU9XCJsZWZ0OiR7bGVmdH1weFwiPkhlbGxvPC9kaXY+YDtcclxuICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIFxyXG4gIH0pXHJcblxyXG4gIFxyXG4gIHNldEludGVydmFsKGZ1bmN0aW9uKCl7XHJcbiAgICB2YXIgZGF0ZSA9IG1vbWVudChuZXcgRGF0ZSgpKTtcclxuICAgIGRhdGUgPSBkYXRlLnR6KCdFdXJvcGUvTG9uZG9uJykuZm9ybWF0KCdISDptbTpzcycpO1xyXG4gICAgXHJcbiAgICB2YXIgY3VycmVudERheSA9IG1vbWVudChuZXcgRGF0ZSgpKTtcclxuICAgIGN1cnJlbnREYXkgPSBjdXJyZW50RGF5LnR6KCdFdXJvcGUvTG9uZG9uJykuZm9ybWF0KCdERCBNTU0gWVlZWScpO1xyXG5cclxuICAgICQoJy5oZWFkZXItdGltZSBwJykuaHRtbChkYXRlKVxyXG4gICAgJCgnLmhlYWRlci10aW1lIHNwYW4nKS5odG1sKGN1cnJlbnREYXkpXHJcbiAgfSwgMTAwMClcclxuXHJcbiAgaWYoJCgnLnJlZnMtc2NlbmUnKS5sZW5ndGggIT09IDApe1xyXG4gICAgbGV0IHJlZnNIZWFkID0gJCgnLnJlZnMtc2NlbmVfX2l0ZW0tYW5pbV8xIGRpdicpO1xyXG4gICAgbGV0IHJlZnNMb2dvID0gJCgnLnJlZnMtc2NlbmVfX2l0ZW0tYW5pbV8yIGRpdicpO1xyXG4gICAgc2V0SW50ZXJ2YWwoZnVuY3Rpb24oKXtcclxuICAgICAgcmVmc0hlYWQucmVtb3ZlQXR0cignc3R5bGUnKS5hZGRDbGFzcygnYW5pbWF0ZV9fYW5pbWF0ZWQgYW5pbWF0ZV9fYm91bmNlSW5SaWdodCcpO1xyXG5cclxuICAgICAgc2V0VGltZW91dChmdW5jdGlvbigpe1xyXG4gICAgICAgIHJlZnNIZWFkLnJlbW92ZUNsYXNzKCdhbmltYXRlX19hbmltYXRlZCBhbmltYXRlX19ib3VuY2VJblJpZ2h0JykuZmFkZU91dCgpO1xyXG4gICAgICB9LCA1MDAwKVxyXG4gICAgfSwgNjAwMClcclxuXHJcbiAgICBzZXRJbnRlcnZhbChmdW5jdGlvbigpe1xyXG4gICAgICByZWZzTG9nby5yZW1vdmVBdHRyKCdzdHlsZScpLmFkZENsYXNzKCdhbmltYXRlX19hbmltYXRlZCBhbmltYXRlX19ib3VuY2VJbkxlZnQnKTtcclxuXHJcbiAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24oKXtcclxuICAgICAgICByZWZzTG9nby5yZW1vdmVDbGFzcygnYW5pbWF0ZV9fYW5pbWF0ZWQgYW5pbWF0ZV9fYm91bmNlSW5MZWZ0JykuZmFkZU91dCgpO1xyXG4gICAgICB9LCA1MDAwKVxyXG4gICAgfSwgNjAwMClcclxuICB9XHJcblxyXG5cclxuICBcclxuXHJcbiAgaWYoJCgnI3Ntb2tlJykubGVuZ3RoICE9PSAwKXtcclxuICAgIHZhciBjYW52YXMgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnc21va2UnKVxyXG4gICAgdmFyIGN0eCA9IGNhbnZhcy5nZXRDb250ZXh0KCcyZCcpXHJcbiAgICBjYW52YXMud2lkdGggPSBpbm5lcldpZHRoXHJcbiAgICBjYW52YXMuaGVpZ2h0ID0gaW5uZXJIZWlnaHRcclxuICAgIFxyXG4gICAgdmFyIHBhcnR5ID0gc21va2VtYWNoaW5lKGN0eCwgWzI1NSwgMjU1LCAyNTVdKVxyXG4gICAgcGFydHkuc3RhcnQoKSAvLyBzdGFydCBhbmltYXRpbmdcclxuICAgIHBhcnR5LnNldFByZURyYXdDYWxsYmFjayhmdW5jdGlvbihkdCl7XHJcbiAgICAgIHBhcnR5LmFkZFNtb2tlKGlubmVyV2lkdGgvMiwgaW5uZXJIZWlnaHQsIC4zKVxyXG4gICAgICBjYW52YXMud2lkdGggPSBpbm5lcldpZHRoXHJcbiAgICAgIGNhbnZhcy5oZWlnaHQgPSBpbm5lckhlaWdodFxyXG4gICAgfSlcclxuICB9XHJcblxyXG4gIC8vIHNsaWRlcnNcclxuXHJcbiAgdmFyIHN0YXJ0U2xpZGVyID0gbmV3IFN3aXBlcignLnN0YXJ0LXNsaWRlciAuc3dpcGVyLWNvbnRhaW5lcicsIHtcclxuICAgIGxvb3A6IHRydWUsXHJcbiAgICBzbGlkZXNQZXJWaWV3OiAxLFxyXG4gICAgc3BhY2VCZXR3ZWVuOiAwLFxyXG4gICAgZGlyZWN0aW9uOiAndmVydGljYWwnLFxyXG4gICAgY2VudGVyZWRTbGlkZXM6IHRydWUsXHJcbiAgICBhdXRvcGxheToge1xyXG4gICAgICBkZWxheTogMzAwMCxcclxuICAgICAgZGlzYWJsZU9uSW50ZXJhY3Rpb246IHRydWUsXHJcbiAgICB9LFxyXG4gICAgbmF2aWdhdGlvbjoge1xyXG4gICAgICBuZXh0RWw6ICcuc3RhcnQtc2xpZGVyX19uYXYgLnN3aXBlci1idXR0b24tbmV4dCcsXHJcbiAgICAgIHByZXZFbDogJy5zdGFydC1zbGlkZXJfX25hdiAuc3dpcGVyLWJ1dHRvbi1wcmV2JyxcclxuICAgIH0sXHJcbiAgICBicmVha3BvaW50czp7XHJcbiAgICAgIDQ4MDoge1xyXG4gICAgICAgIHNsaWRlc1BlclZpZXc6IDNcclxuICAgICAgfVxyXG4gICAgfVxyXG4gIH0pO1xyXG5cclxuICB2YXIgbmV3c1RodW1ic1NsaWRlciA9IG5ldyBTd2lwZXIoJy5uZXdzLXRodW1icyAuc3dpcGVyLWNvbnRhaW5lcicsIHtcclxuICAgIHNwZWVkOiA0MDAsXHJcbiAgICBzcGFjZUJldHdlZW46IDI1LFxyXG4gICAgc2xpZGVzUGVyVmlldzogMSxcclxuICAgIGxvb3A6IGZhbHNlLFxyXG4gICAgZnJlZU1vZGU6IHRydWUsXHJcbiAgICB3YXRjaFNsaWRlc1Zpc2liaWxpdHk6IHRydWUsXHJcbiAgICB3YXRjaFNsaWRlc1Byb2dyZXNzOiB0cnVlLFxyXG4gICAgLy9zaW11bGF0ZVRvdWNoOiBmYWxzZSxcclxuICAgIC8vIHNsaWRlVG9DbGlja2VkU2xpZGU6IHRydWUsXHJcbiAgICAvLyBhdXRvcGxheToge1xyXG4gICAgLy8gICBkZWxheTogMzAwMCxcclxuICAgIC8vIH0sXHJcbiAgICBcclxuICAgIGJyZWFrcG9pbnRzOiB7XHJcbiAgICAgIDEyMDA6IHtcclxuICAgICAgICBzbGlkZXNQZXJWaWV3OiAzLFxyXG4gICAgICB9LFxyXG4gICAgICA5OTI6IHtcclxuICAgICAgICBzbGlkZXNQZXJWaWV3OiAzLFxyXG4gICAgICB9LFxyXG4gICAgICA3Njg6IHtcclxuICAgICAgICBzbGlkZXNQZXJWaWV3OiAyLFxyXG4gICAgICB9LFxyXG4gICAgfVxyXG4gIH0pO1xyXG4gIFxyXG4gIHZhciBuZXdzQ29udGVudFNsaWRlciA9IG5ldyBTd2lwZXIoJy5uZXdzLWNvbnRlbnQgLnN3aXBlci1jb250YWluZXInLCB7XHJcbiAgICBzcGVlZDogNDAwLFxyXG4gICAgc2xpZGVzUGVyVmlldzogMSxcclxuICAgIHNpbXVsYXRlVG91Y2g6IGZhbHNlLFxyXG4gICAgbG9vcDogZmFsc2UsXHJcbiAgICBlZmZlY3Q6ICdmYWRlJyxcclxuICAgIG5hdmlnYXRpb246IHtcclxuICAgICAgbmV4dEVsOiAnLm5ld3MtbmF2IC5zd2lwZXItYnV0dG9uLW5leHQnLFxyXG4gICAgICBwcmV2RWw6ICcubmV3cy1uYXYgLnN3aXBlci1idXR0b24tcHJldicsXHJcbiAgICB9LFxyXG4gICAgcGFnaW5hdGlvbjoge1xyXG4gICAgICBlbDogJy5uZXdzLW5hdiAuc3dpcGVyLXBhZ2luYXRpb24nLFxyXG4gICAgICB0eXBlOiAnYnVsbGV0cycsXHJcbiAgICAgIGNsaWNrYWJsZTogdHJ1ZSxcclxuICAgIH0sXHJcbiAgICBmYWRlRWZmZWN0OiB7XHJcbiAgICAgIGNyb3NzRmFkZTogdHJ1ZVxyXG4gICAgfSxcclxuICAgIHRodW1iczoge1xyXG4gICAgICBzd2lwZXI6IG5ld3NUaHVtYnNTbGlkZXIsXHJcbiAgICAgIGF1dG9TY3JvbGxPZmZzZXQ6IDFcclxuICAgIH1cclxuICB9KTtcclxuXHJcbiAgLy8gcGFyYWxsYXhcclxuXHJcbiAgaWYoJCgnI2hlYWRlci1zY2VuZScpLmxlbmd0aCAhPT0gMCl7XHJcbiAgICB2YXIgc2NlbmUgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnaGVhZGVyLXNjZW5lJyk7XHJcbiAgICB2YXIgcGFyYWxsYXhJbnN0YW5jZSA9IG5ldyBQYXJhbGxheChzY2VuZSk7XHJcbiAgfVxyXG4gIGlmKCQoJyNpbnZlc3Qtc2NlbmUnKS5sZW5ndGggIT09IDApe1xyXG4gICAgdmFyIHNjZW5lID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2ludmVzdC1zY2VuZScpO1xyXG4gICAgdmFyIHBhcmFsbGF4SW5zdGFuY2UgPSBuZXcgUGFyYWxsYXgoc2NlbmUpO1xyXG4gIH1cclxuICBpZigkKCcjcmVmcy1zY2VuZScpLmxlbmd0aCAhPT0gMCl7XHJcbiAgICB2YXIgc2NlbmUgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgncmVmcy1zY2VuZScpO1xyXG4gICAgdmFyIHBhcmFsbGF4SW5zdGFuY2UgPSBuZXcgUGFyYWxsYXgoc2NlbmUsIHtcclxuICAgICAgbGltaXRZOiAxXHJcbiAgICB9KTtcclxuICB9XHJcblxyXG4gIC8vbWVudSBmaXggbW9iaWxlXHJcblxyXG4gIGxldCB2aCA9IHdpbmRvdy5pbm5lckhlaWdodCAqIDAuMDE7XHJcbiAgLy8gVGhlbiB3ZSBzZXQgdGhlIHZhbHVlIGluIHRoZSAtLXZoIGN1c3RvbSBwcm9wZXJ0eSB0byB0aGUgcm9vdCBvZiB0aGUgZG9jdW1lbnRcclxuICBkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc3R5bGUuc2V0UHJvcGVydHkoJy0tdmgnLCBgJHt2aH1weGApO1xyXG5cclxuICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcigncmVzaXplJywgKCkgPT4ge1xyXG4gICAgLy8gV2UgZXhlY3V0ZSB0aGUgc2FtZSBzY3JpcHQgYXMgYmVmb3JlXHJcbiAgICBsZXQgdmggPSB3aW5kb3cuaW5uZXJIZWlnaHQgKiAwLjAxO1xyXG4gICAgZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LnN0eWxlLnNldFByb3BlcnR5KCctLXZoJywgYCR7dmh9cHhgKTtcclxuICB9KTtcclxuXHJcblxyXG4gIC8vIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gIC8vICAgJCgnLm1hcnF1ZWUnKS5tYXJxdWVlKHtcclxuICAvLyAgICAgLy9zcGVlZCBpbiBtaWxsaXNlY29uZHMgb2YgdGhlIG1hcnF1ZWVcclxuICAvLyAgICAgZHVyYXRpb246IDgwMDAsXHJcbiAgLy8gICAgIC8vZ2FwIGluIHBpeGVscyBiZXR3ZWVuIHRoZSB0aWNrZXJzXHJcbiAgLy8gICAgIGdhcDogMCxcclxuICAvLyAgICAgLy90aW1lIGluIG1pbGxpc2Vjb25kcyBiZWZvcmUgdGhlIG1hcnF1ZWUgd2lsbCBzdGFydCBhbmltYXRpbmdcclxuICAvLyAgICAgZGVsYXlCZWZvcmVTdGFydDogMCxcclxuICAvLyAgICAgLy8nbGVmdCcgb3IgJ3JpZ2h0J1xyXG4gIC8vICAgICBkaXJlY3Rpb246ICdsZWZ0JyxcclxuICAvLyAgICAgLy90cnVlIG9yIGZhbHNlIC0gc2hvdWxkIHRoZSBtYXJxdWVlIGJlIGR1cGxpY2F0ZWQgdG8gc2hvdyBhbiBlZmZlY3Qgb2YgY29udGludWVzIGZsb3dcclxuICAvLyAgICAgZHVwbGljYXRlZDogdHJ1ZVxyXG4gIC8vICAgfSk7XHJcbiAgLy8gfSwgMTAwMCk7XHJcblxyXG4gIC8vY2FiaW5ldC1TZXR0aW5nc1xyXG5cclxuICAvLyAkKCcuY2FiaW5ldC10YWJsZV9fc2V0dGluZ3MtYnRuJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZSl7XHJcbiAgLy8gICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgXHJcbiAgICBcclxuICBcclxuICAvLyAgICQodGhpcykuc2libGluZ3MoJy5jYWJpbmV0LXRhYmxlX19zZXR0aW5ncy1oaWRlJykuZmFkZUluKDMwMCk7XHJcbiAgLy8gICAkKHRoaXMpLnBhcmVudCgpLmFkZENsYXNzKCdhY3RpdmUnKTtcclxuICAvLyAgIGxldCB0cnVlSCA9ICgkKGRvY3VtZW50KS5vdXRlckhlaWdodCh0cnVlKSAtICQodGhpcykuc2libGluZ3MoJy5jYWJpbmV0LXRhYmxlX19zZXR0aW5ncy1oaWRlJykub2Zmc2V0KCkudG9wIC0gJCh0aGlzKS5zaWJsaW5ncygnLmNhYmluZXQtdGFibGVfX3NldHRpbmdzLWhpZGUnKS5vdXRlckhlaWdodCh0cnVlKSk7XHJcbiAgXHJcbiAgLy8gICBpZih0cnVlSCA8PSAwKXtcclxuICAvLyAgICAgJCh0aGlzKS5zaWJsaW5ncygnLmNhYmluZXQtdGFibGVfX3NldHRpbmdzLWhpZGUnKS5hZGRDbGFzcygndG9wJyk7XHJcbiAgLy8gICB9XHJcbiAgLy8gfSk7XHJcbiAgXHJcbiAgLy8gJChkb2N1bWVudCkubW91c2V1cChmdW5jdGlvbiAoZSl7IFxyXG4gIC8vICAgdmFyIGJsb2NrID0gJChcIi5jYWJpbmV0LXRhYmxlX19zZXR0aW5ncy5hY3RpdmUgLmNhYmluZXQtdGFibGVfX3NldHRpbmdzLWhpZGVcIik7IFxyXG4gIC8vICAgaWYgKCFibG9jay5pcyhlLnRhcmdldCkgXHJcbiAgLy8gICAgICAgJiYgYmxvY2suaGFzKGUudGFyZ2V0KS5sZW5ndGggPT09IDApIHsgXHJcbiAgLy8gICAgICAgYmxvY2suaGlkZSgpOyBcclxuICBcclxuICAvLyAgICAgICBibG9jay5wYXJlbnQoKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgXHJcbiAgLy8gICAgICAgaWYoIGJsb2NrLmhhc0NsYXNzKCd0b3AnKSl7XHJcbiAgLy8gICAgICAgICBibG9jay5yZW1vdmVDbGFzcygndG9wJyk7XHJcbiAgLy8gICAgICAgfVxyXG4gIC8vICAgfVxyXG4gIC8vIH0pO1xyXG4gXHJcbiAgXHJcbn0pKCk7XHJcbiJdfQ==
