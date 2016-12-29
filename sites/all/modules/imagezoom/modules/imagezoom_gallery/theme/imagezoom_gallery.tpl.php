<?php

/**
 * @file
 * Template for an Image Zoom gallery.
 *
 * Available variables:
 * - $image: The display image.
 * - $thumbs: An array of thumbnail images.
 */
?>
<!--
<?php print $image; ?>

<div id="imagezoom-thumb-wrapper">
  <ul class="imagezoom-thumbs">
    <?php foreach ($thumbs as $thumb): ?>
      <li class="imagezoom-thumb"><?php print $thumb; ?></li>
    <?php endforeach; ?>
  </ul>
</div>
-->
<div style="height:274.4px;width:411.4px;" class="zoomWrapper"><img style="border: 1px solid rgb(232, 232, 230); position: absolute; width: 411.4px; height: 274.4px;" id="zoom_03" src="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image2.png" data-zoom-image="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/large/image3.jpg"><div style="background: transparent url(&quot;http://www.elevateweb.co.uk/spinner.gif&quot;) no-repeat scroll center center; height: 274.4px; width: 411.4px; z-index: 2000; position: absolute; display: none;"></div><div style="background: transparent url(&quot;http://www.elevateweb.co.uk/spinner.gif&quot;) no-repeat scroll center center; height: 274.4px; width: 411.4px; z-index: 2000; position: absolute; display: none;"></div></div>

<div id="gallery_01" style="width= 500px float:left;">

<a href="#" class="elevatezoom-gallery" data-update="" data-image="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image1.png" data-zoom-image="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/large/image1.jpg">
    <img src="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image1.png" width="100"></a>

<a href="#" class="elevatezoom-gallery active" data-image="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image2.png" data-zoom-image="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/large/image2.jpg"><img src="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image2.png" width="100"></a>

<a href="tester" class="elevatezoom-gallery" data-image="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image3.png" data-zoom-image="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/large/image3.jpg">
    <img src="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image3.png" width="100">
</a>

<a href="tester" class="elevatezoom-gallery" data-image="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image4.png" data-zoom-image="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/large/image4.jpg"><img src="http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image4.png" width="100"></a>

</div>

