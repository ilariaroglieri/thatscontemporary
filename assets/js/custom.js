function viewportToPixels(value) {
  var parts = value.match(/([0-9\.]+)(vh|vw)/)
  var q = Number(parts[1])
  var side = window[['innerHeight', 'innerWidth'][['vh', 'vw'].indexOf(parts[2])]]
  return side * (q/100)
}

function checkScroll() {
  var scr = $(window).scrollTop();
  var vh = Math.round(window.innerHeight / 100);

  var tunnelimgs = $('.img-container').length;
  var tempH = 100*tunnelimgs + 'vh';
  var tunnelEnd = viewportToPixels(tempH);
 
  if(scr >= (tunnelEnd - 200)) {
    $('#logo-landing').addClass('scroll-up');
    $('#landing').addClass('scroll-up');
  } else {
    $('#logo-landing').removeClass('scroll-up');
    $('#landing').removeClass('scroll-up');
  }

}

//-----------DOCUMENT.READY----------------

jQuery(document).ready(function($) {

  // scroll events
  $(window).scroll(function() {

    checkScroll();

  });

  checkScroll();

  // tunnel effect slider home
  if ($('body').hasClass('home')) {
    var tunnelimgs = $('.img-container').length;
    var tempH = (100*tunnelimgs) + 'vh';
    $('.content').css('margin-top', tempH );
  }



  // --- Hamburger menu
  $('.menu-toggle').click(function() {
    $(this).toggleClass('open');
    $('div[class*="menu-1"]').toggleClass('active');
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
