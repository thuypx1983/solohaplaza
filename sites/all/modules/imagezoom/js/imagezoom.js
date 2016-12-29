(function($) {

  /**
   * Initialize image zoom functionality.

  Drupal.behaviors.imagezoom = {
    attach: function(context, settings) {
      $('.imagezoom-image', context).elevateZoom(settings.imagezoom);
      console.log(settings.imagezoom);
    }
  }
   */
  //initiate the plugin and pass the id of the div containing gallery images
  $(".imagezoom-image").elevateZoom({gallery:'imagezoom-thumbs', cursor: 'pointer', galleryActiveClass: "active", imageCrossfade: true, loadingIcon: "http://www.elevateweb.co.uk/spinner.gif"});

})(jQuery);
