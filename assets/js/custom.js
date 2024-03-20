function checkScroll() {
	var currentScrollPos = $(window).scrollTop();

  if ($('body').hasClass('home')) {
  	if (currentScrollPos > window.innerHeight) {
  		$('.icon, #logo, .menu-toggle').removeClass('white');
    } else {
  		$('.icon, #logo, .menu-toggle').addClass('white');
    }
  }
}

//-----------DOCUMENT.READY----------------

jQuery(document).ready(function($) {

  // scroll events
  var prevScrollPos = $(window).scrollTop();
  $(window).scroll(function() {
    checkScroll();

    var currentScrollPos = $(window).scrollTop();
    if (prevScrollPos > currentScrollPos && prevScrollPos > 0) {
      $('#logo').addClass('visible')
    } else {
      $('#logo').removeClass('visible')
    }

    prevScrollPos = currentScrollPos;
  });

  checkScroll();


  // --- Hamburger menu
  $('.menu-toggle').click(function() {
    $(this).toggleClass('open');
    $('div[class*="menu-1"]').toggleClass('active');
    // check if it's on slider
  	if ( $('body').hasClass('home') && $(window).scrollTop() < window.innerHeight ) {
  		console.log('ei!')
  		$('#logo').addClass('visible').toggleClass('white');
  		$('.icon, .menu-toggle').toggleClass('white');
  	}

    if ($(this).hasClass('open') == true) {
    	// $('.icon, .menu-toggle').removeClass('white');
    	$('#logo').addClass('visible');
    } else {
    	$('#logo').removeClass('visible');
    }
  });

  // --- stacked galleries
  var imgs = $('.stacked_gallery ').find('.stacked_img');
  var timer;
  var j = 0;

  function activeLoop(el) {
    $(el[j]).addClass('active');
    if (j >= el.length) {
      $(el).removeClass('active');
      $(el[0]).addClass('active');
      j = 0;
    }
    j++;
  }

  if (imgs.length > 1) {
    activeLoop(imgs);
    timer = setInterval(function() {
      activeLoop(imgs);
    }, 300);
  }

  // --- Slider
  const swiper = new Swiper('.swiper', {
    // loop: true,
    slidesPerView: 1,
    spaceBetween: 10,
    speed: 2000,
    touchEventsTarget: 'container-fluid',
    grabCursor: true,
    autoplay: {
      delay: 2000,
    },
    breakpoints: {
      768: {
        slidesPerView: "auto",
        centeredSlides: true,
      }
    },
  });

  // ajax filter
  $(document).on('click','.cat-item, .tag-item', function() {
    // var tax = $(this).attr('data-type');

    // $('a[data-type='+ tax + ']').removeClass('active');
    $(this).toggleClass('active');

    var catTerm = $('a[data-type="category"].active');
    var tagTerm = $('a[data-type="main_tag"].active');

    var catTerms = [];
    var tagTerms = [];

    for (var i = 0; i < catTerm.length; i++) {
      catTerms.push($(catTerm[i]).data('id'));
    }

    for (var i = 0; i < tagTerm.length; i++) {
      tagTerms.push($(tagTerm[i]).data('id'));
    }

    console.log(catTerms, tagTerms);


    $.ajax({
      type: 'POST',
      url: wpAjax.ajaxUrl,
      dataType: 'html',
      data: {
        action: 'filterCat',
        category: catTerms,
        tag: tagTerms,
      },
      success: function(results) {
        $('#articles-container > .d-flex').html(results);
        ScrollReveal().sync();
      }
    });
  });

  // --- percorsi articles
  $('.place-title').mouseenter(function() {
    $('.place-img-container').removeClass('visible');
    $(this).parent().parent().parent().find('.place-img-container').addClass('visible');
  }).mouseleave(function() {
    $('.place-img-container').removeClass('visible');
  });

  // --- club benefits
  $('.benefit-title').mouseenter(function() {
    $('.place-img-container').removeClass('visible');
    $(this).parent().parent().find('.benefit-content').addClass('visible');
  }).mouseleave(function() {
    $('.benefit-content').removeClass('visible');
  });

  // --- team tabs
  $('.team-name').click(function() {
    var val = $(this).attr('data-id'); 
    $('.team-name').removeClass('active');
    $(this).addClass('active');

    $('.team-profile').removeClass('active'); 
    $('.team-profile[data-id='+ val +']').addClass('active'); 
  });


  // --- sostienici tabs
  $('.donation-button').click(function() {
    var val = $(this).attr('data-tab');
    $('.donation-button').removeClass('active');
    $(this).addClass('active');

    $('.donation-text[data-tab]').removeClass('visible'); 
    $('.donation-text[data-tab='+ val +']').addClass('visible'); 
  });

  // scroll reveal
  ScrollReveal().reveal('.reveal-module', { 
    interval: 300, 
    duration: 600,
    reset: true,
    afterReveal: ScrollReveal().reveal('.reveal-child', { interval: 200, duration: 300, reset: true, distance: '50px'})
  });





//----------END JQUERY -----------
});
