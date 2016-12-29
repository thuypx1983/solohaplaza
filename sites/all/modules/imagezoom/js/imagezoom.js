(function($) {

  /**
   * Initialize image zoom functionality.

  Drupal.behaviors.imagezoom = {
    attach: function(context, settings) {
      $('.imagezoom-image', context).elevateZoom(settings.imagezoom);
      console.log(settings.imagezoom);
    }
  }*/
  $(document).ready(function(){
    $("#zoom_03").elevateZoom({gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: "active", imageCrossfade: true, loadingIcon: "http://www.elevateweb.co.uk/spinner.gif"});

  })
})(jQuery);
