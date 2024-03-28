function viewportToPixels(value) {
  var parts = value.match(/([0-9\.]+)(vh|vw)/)
  var q = Number(parts[1])
  var side = window[['innerHeight', 'innerWidth'][['vh', 'vw'].indexOf(parts[2])]]
  return side * (q/100)
}

function imageZoom(img, perc) {
  var h = window.innerHeight;
}

function createRemap(inMin, inMax, outMin, outMax) {
  return function remaper(x) {
      return (x - inMin) * (outMax - outMin) / (inMax - inMin) + outMin;
  };
}

function scrollEvents() {
  var scr = $(window).scrollTop();
  var vh = Math.round(window.innerHeight / 100);
  var h = window.innerHeight;

  var tunnelimgs = $('.img-container').length;
  var tempH = 100*tunnelimgs + 'vh';
  var tunnelEnd = viewportToPixels(tempH);
  console.log(tunnelEnd + h, scr);

  if (scr >= (tunnelEnd)) {
    $('#logo-landing').addClass('scroll-up');
    $('#club-thats, #site-menu').removeClass('hidden');
    $('.img-container').css('opacity', 0);
  } else if (scr < (tunnelEnd)) {
    $('#logo-landing').removeClass('scroll-up');
    $('#club-thats, #site-menu').addClass('hidden');
  }

  if (scr >= (tunnelEnd + h)) {
    $('#header-container, #content-home').addClass('p-fixed');
    $('.cta-container').addClass('snap');
    // $('body').addClass('blocked');
    
  } else if (scr < (tunnelEnd + h) ) {
    $('#header-container, #content-home').removeClass('p-fixed');
    $('.cta-container').removeClass('snap');
  }

  $('.img-container').each(function(i, el) {
    var start = h*i;
    var step = (h/2)*i;
    var perc = createRemap(start, start + h, 0, 1.5); 
    var perc0 = createRemap(start, start + h, 0, 1.5); 
    var percB = createRemap(start, start + h, 15,-5); 
    if (scr >= start && scr < tunnelEnd) {
      
      $(el).css('transform', 'scale('+perc(scr)+')');
      $(el).css('opacity', perc0(scr));
      $(el).css('filter', 'blur('+percB(scr)+'px)');

      if (perc(scr) > 2) {
        $(el).css('opacity', 0);
      }

    } else if (scr == 0) {
      $(el).css('opacity', 0);
    } 
  })

}

//-----------DOCUMENT.READY----------------

jQuery(document).ready(function($) {

  $('body').removeClass('loading');

  // tunnel effect slider home
  if ($('body').hasClass('home')) {
    var tunnelimgs = ($('.img-container').length)+1;
    var tempH = (100*tunnelimgs) + 'vh';
    $('#landing').css('height', tempH );

    // scroll events
    $(window).scroll(function() {
      scrollEvents();

      $('.snap').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
          // $(this).removeClass('snap');
        }
      })
    });

    scrollEvents();
  }

  // window.scrollTo({ top: $(window).innerHeight(), behavior: 'smooth' });

  // --- Hamburger menu
  $('.menu-toggle').click(function() {
    $(this).toggleClass('open');
    $('div[class*="menu-1"]').toggleClass('active');

    // if ($(this).hasClass('open') == true) {
    // 	$('#logo').addClass('visible');
    // } else {
    // 	$('#logo').removeClass('visible');
    // }
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
