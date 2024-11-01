jQuery(function(){
  // vars for testimonials carousel
  var $txtcarousel = jQuery('#testimonial-list');
  var txtcount = $txtcarousel.children().length;
  //var wrapwidth = (txtcount * 415) + 415; // 400px width for each testimonial item
  $txtcarousel.css('width','100%');
  var animtime = 750; // milliseconds for clients carousel
 
  // prev & next btns for testimonials
  jQuery('#prv-testimonial').on('click', function(){
    rotateClients();
  });
  
  jQuery('#nxt-testimonial').on('click', function(){
    rotateClients();
  });
  
  var rotating = true;
  var clientspeed = 3600;
  var seeclients = setInterval(rotateClients, clientspeed);
  
  jQuery(document).on({
    mouseenter: function(){
      rotating = false; // turn off rotation when hovering
    },
    mouseleave: function(){
      rotating = true;
    }
  }, '#testimonial-list');
  
  function rotateClients() {
    if(rotating != false) {
      var $first = jQuery('#testimonial-list li:first');
      $first.animate({ 'margin-left': '-100%' }, 600, function() {
        $first.remove().css({ 'margin-left': '0px' });
        jQuery('#testimonial-list li').css({ 'display': 'none' });
        $first.css({ 'display': 'block' });
        jQuery('#testimonial-list li:last').after($first);
      });
    }
  }

});