<?php
/*
** Build caption from description, source, creator, date
*/
function rhh_file_caption($file){

  $caption=array();

  $description = metadata( $file, array( 'Dublin Core', 'Description' ) );
  if( $description ) {
    $caption[]= $description;
  }

  $source = metadata( $file, array( 'Dublin Core', 'Source' ) );
  if( $source ) {
    $caption[]= __('Source: %s',$source);
  }

  $creator = metadata( $file, array( 'Dublin Core', 'Creator' ) );
  if( $creator ) {
    $caption[]= __('Creator: %s', $creator);
  }

  $date = metadata( $file, array( 'Dublin Core', 'Date' ) );
  if( $date ) {
    $caption[]= __('Date: %s', $date);
  }

  if( count($caption) ){
    return implode(" ", $caption);
  }
}

/*
** Loop through and display image files with PhotoSwipe
** Don's version
*/
function rhh_item_images($item,$index=1){
  $html=null;
  $captionID=1;
  $isFirst = true;
  foreach (loop('files', $item->Files) as $file){
    if ($isFirst) {
        // Skip first/main image.
        $isFirst = false;
        continue;
    }
    $img = array('image/jpeg','image/jpg','image/png','image/jpeg','image/gif');
    $mime = metadata($file,'MIME Type');
    if(in_array($mime,$img)) {

      $title=metadata($file, array('Dublin Core', 'Title')) ? metadata($file, array('Dublin Core', 'Title')) : 'Untitled';

      $title_formatted=link_to($file,'show','<strong>'.$title.'</strong>',array('title'=>'View File Record'));

      $desc=metadata($file, array('Dublin Core', 'Description'));

      $caption=rhh_file_caption($file);

      $src=WEB_ROOT.'/files/fullsize/'.str_replace( array('.JPG','.jpeg','.JPEG','.png','.PNG','.gif','.GIF'), '.jpg', $file->filename );

      $thumbsrc=WEB_ROOT.'/files/square_thumbnails/'.str_replace( array('.JPG','.jpeg','.JPEG','.png','.PNG','.gif','.GIF'), '.jpg', $file->filename );

      $html.= '<figure class="flex-image" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" aria-label="'.$title.'" aria-describedby="caption'.$captionID.'">';

        $html.= '<a href="'.$src.'" title="'.$title.'" class="file flex" style="background-image: url(\''.$src.'\');" data-size="">';

        $html.= '</a>';
        $html.= '<figcaption id="caption'.$captionID.'" class="not-yet-defined;"><h4>'.$title.'</h4>';
        $html.= '<p>'.$caption.'</p></figcaption>';

      $html.= '</figure>';
      $captionID++;
    }   
  }
  if($html): ?>
    <h3><?php echo __('See Also');?></h3>
    <figure id="item-photos" class="flex flex-wrap" itemscope itemtype="http://schema.org/ImageGallery">
      <?php echo $html;?>
    </figure>   
    <!-- PhotoSwipe -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="pswp__bg"></div>
      <div class="pswp__scroll-wrap">
          <div class="pswp__container">
              <div class="pswp__item"></div>
              <div class="pswp__item"></div>
              <div class="pswp__item"></div>
          </div>
          <div class="pswp__ui pswp__ui--hidden">
              <div class="pswp__top-bar">
                  <div class="pswp__counter"></div>
                  <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                  <button class="pswp__button pswp__button--share" title="Share"></button>
                  <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                  <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                  <div class="pswp__preloader">
                      <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                          <div class="pswp__preloader__donut"></div>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                  <div class="pswp__share-tooltip"></div> 
              </div>
              <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
              </button>
              <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
              </button>
              <div class="pswp__caption">
                  <div class="pswp__caption__center"></div>
              </div>
          </div>
      </div>
    </div>    
  <?php endif;
}

function erin_exhibit_builder_display_random_featured_exhibit(){
    $html = '<div id="featured-exhibit">';
    $featuredExhibit = exhibit_builder_random_featured_exhibit();
    $html .= '<h2>' . __('Featured Theme') . '</h2>';
    if ($featuredExhibit) {
        $html .= get_view()->partial('exhibits/single.php', array('exhibit' => $featuredExhibit));
    } else {
        $html .= '<p>' . __('You have no featured themes.') . '</p>';
    }
    $html .= '</div>';
    $html = apply_filters('exhibit_builder_display_random_featured_exhibit', $html);
    return $html;
}

?>
