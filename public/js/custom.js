// Content slide open
$(function(){
  $('.menu-button').click(function(){
      $('.navbar-mobile .nav-item').slideToggle( "300" );
  });
});

// owl carousel
$(document).ready(function() {
  $('.default-slider').owlCarousel({
    items: 4,
    loop: false,
    center: false,
    margin: 0,
    nav:true,
    mouseDrag: true,
    touchDrag: true,
    callbacks: true,
    autoHeight:false,
    URLhashListener: true,
    autoplayHoverPause: false,
    startPosition: 'URLHash',
    autoplay:false,
    autoplayTimeout:6000,
    autoplaySpeed:1500,
    autoplayHoverPause:false,
    smartSpeed:800,
    responsiveClass:true,
    responsive:{
      0:{
          items:1,
          nav:true
      },
      600:{
          items:3,
          nav:true
      },
      1000:{
          items:4,
          nav:true
      },
    }
  });
})
$(document).ready(function() {
  $('.slider-two-item').owlCarousel({
    items: 2,
    loop: false,
    center: false,
    margin: 20,
    nav:true,
    mouseDrag: true,
    touchDrag: true,
    callbacks: true,
    autoHeight:false,
    URLhashListener: true,
    autoplayHoverPause: false,
    startPosition: 'URLHash',
    autoplay:false,
    autoplayTimeout:6000,
    autoplaySpeed:1500,
    autoplayHoverPause:false,
    smartSpeed:800,
    responsiveClass:true,
    responsive:{
      0:{
          items:1,
          nav:true
      },
      600:{
          items:2,
          nav:true
      },
      1000:{
          items:2,
          nav:true
      },
    }
  });
})
// Content slide open
$(document).ready(function () {
  $('#close-search').click(function(){
      $('#search-result').slideUp(400, 'easeOutSine');
      $('#close-search').fadeOut('fast');
  });
  $('.showMore').click(function(){
      $('.longValue').toggleClass('open');
  });
  $('.toggle-title').click(function(){
      $(this).siblings('.toggle-content').slideToggle(300, 'easeOutSine');
  });
})

// Dropdown
$(document).on('click', '.dropdown-menu', function (e) {
  e.stopPropagation();
});

// add class
$(document).ready(function(){
  $(".sidebar-toggle.open").click(function(){
      $(".right-sidebar").removeClass("shrink");
      $(".section-content-toggle").removeClass("col-md-offset-3");
  });
})

// smooth scroll
$(document).ready(function() {
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
});

// select
$(document).ready(function() {
  [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
    new SelectFx(el);
  } );
});

// Date picker
$( function() {
  $( "#datepicker" ).datepicker();
} );

// tooltips
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

// selection-option
$(document).on('change', '.analysis-mode', function() {
  var target = $(this).data('target');
  var show = $("option:selected", this).data('show');
  $(target).children().addClass('hide');
  $(show).removeClass('hide');
});
$(document).ready(function(){
  $('.analysis-mode').trigger('change');
});
$(document).ready(function(){
$( '.company-table' ).on( 'mousewheel DOMMouseScroll', function ( e ) {
    var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;

    this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
    e.preventDefault();
});
});

// section-tab
$(document).ready(function() {
    $('.section-tab .col').on('click', function() {
        $(this).addClass('active').siblings().removeClass('active');
    });
});

$(document).ready(function(){
  if( jQuery(".toggle .title-name").hasClass('active') ){
      jQuery(".toggle .title-name.active").closest('.toggle').find('.toggle-inner').show();
    }
    jQuery(".toggle .title-name").click(function(){
      if( jQuery(this).hasClass('active') ){
        jQuery(this).removeClass("active").closest('.toggle').find('.toggle-inner').slideUp(200);
      }
      else{ jQuery(this).addClass("active").closest('.toggle').find('.toggle-inner').slideDown(200);
      }
    });
});
$(document).ready(function(){
  if(document.getElementById('investor_newproperty_name') != null){
    document.getElementById("investor_newproperty_name").value = getSavedValue("investor_newproperty_name");
  }
  if(document.getElementById("investor_newproperty_address")!=null){
    document.getElementById("investor_newproperty_address").value = getSavedValue("investor_newproperty_address");
  }
  if(document.getElementById("investor_newproperty_city")!=null){
    document.getElementById("investor_newproperty_city").value = getSavedValue("investor_newproperty_city");
  }
  if(document.getElementById("investor_newproperty_state")){
    document.getElementById("investor_newproperty_state").value = getSavedValue("investor_newproperty_state");
  }
  if(document.getElementById("investor_newproperty_zipcode")!=null){
    document.getElementById("investor_newproperty_zipcode").value = getSavedValue("investor_newproperty_zipcode");
  }
  if(document.getElementById("investor_newproperty_country")!=null){
    document.getElementById("investor_newproperty_country").value = getSavedValue("investor_newproperty_country");
  }
  if(document.getElementById("investor_newproperty_banktransfer")){
    document.getElementById("investor_newproperty_banktransfer").value = getSavedValue("investor_newproperty_banktransfer")
  }

    function getSavedValue  (v){
        if (!localStorage.getItem(v)) {
            return "";
        }
        return localStorage.getItem(v);
    }
});


$(document).ready(function(){
  $('#pdflink').on('click', function(){
    var url = "/view-oldreports/"; // Get current url
    var reporty_type = $('#report_type').children("option:selected").val();
    var report_id = $('#report_id').children("option:selected").val();
    if ( report_id )
      window.location = url + report_id + `/${reporty_type}`;
  })
})

$(document).ready(function() {
  $('#is-sponsor').on('change', function() {
    var companyField = $('#company-field');
    var type = $(this).val();
    
    if (type === '0') {
      companyField.removeClass('d-none');
    } else {
      companyField.addClass('d-none');
    }
  })
})

$(document).ready(function() {
  $('.content-collapsible').on('click', function() {
    var icon = $(this).find('i');
    var content = $(this).closest('.card').find('.card-content');

    if (icon.hasClass('fa-caret-down')) {
      icon.removeClass('fa-caret-down');
      icon.addClass('fa-caret-right');
      content.hide();
    } else {
      icon.removeClass('fa-caret-right');
      icon.addClass('fa-caret-down');
      content.show();
    }
  })
  
  $('#csvlink').on('click', function() {
    var url = "/view-oldreports-csv/"; // Get current url
    var report_id = $('#report_id').children("option:selected").val();
    if ( report_id )
      window.location = url + report_id;

  })
})
