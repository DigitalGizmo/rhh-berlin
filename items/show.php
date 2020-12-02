<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>
<div id="primary">
    
    <div class="item-story">
    
        <!-- Item Title -->
        <h1 class="item-title"><?php echo metadata('item', array('Dublin Core','Title')); ?></h1>

        <?php if ((get_theme_option('Item FileDisplay') == 1) && metadata('item', 'has files')): ?>
        <?php echo files_for_item(array('imageSize' => 'fullsize')); ?>
        <?php endif; ?>

        <!-- Items metadata - echo all_element_texts removed -->
        
        <!-- Item FileDisplay -->
        <?php if ((get_theme_option('Item FileDisplay') == 0) && metadata('item', 'has files')): ?>
          <h3><?php echo __('Files'); ?></h3>
          <div id="item-images">
               <?php echo files_for_item(); ?>
          </div>
        <?php endif; ?>

       <!--<?php if(metadata('item','Collection Name')): ?>
          <div id="collection" class="element">
            <h3><?php echo __('Collection'); ?></h3>
            <div class="element-text"><?php echo link_to_collection_for_item(); ?></div>
          </div>
       <?php endif; ?>-->

         <div class="element story">
            <!-- <h3>Story</h3> -->
            <div class="element-text">
                <?php echo metadata('item', array('Item Type Metadata','Story')) ?>
            </div>
        </div>

    </div><!-- end item-story -->

    <hr>

    <!--JJ added to make 2 column layout-->
    <div class="item-info">

        <!-- Curatorial Fields -->
        <div class="about-item">
            <h2>About This Item</h2>

            <div class="element">
                <h3>Date</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Date')) ?></div>
            </div>

            <div class="element">
                <h3>Description</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Description')) ?></div>
            </div>

            <div class="element">
                <h3>Type</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Type')) ?></div>
            </div>

            <div class="element">
                <h3>Identifier</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Identifier')) ?></div>
            </div>

            <div class="element">
                <h3>Topic</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Subject')) ?></div>
            </div>

            <div class="element">
                <h3>Collection</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Source')) ?></div>
            </div>

            <div class="element">
                <h3>Contributor</h3>
                <div class="element-text"><?php echo metadata('item', array('Dublin Core','Contributor')) ?></div>
            </div>

            <!-- The following prints a list of all tags associated with the item -->
            <?php if (metadata('item','has tags')): ?>
            <div id="item-tags" class="element">
                <h3><?php echo __('Tags'); ?></h3>
                <div class="element-text"><?php echo tag_string('item'); ?></div>
            </div>
            <?php endif;?>

            <!-- The following prints a citation for this item -->
            <div id="item-citation" class="element">
                <h3><?php echo __('Citation'); ?></h3>
                <div class="element-text"><?php echo metadata('item','citation',array('no_escape'=>true)); ?></div>
            </div>
        </div><!-- end about-item -->

        <!-- JJ added related-items div, recent-items id included for styles -->
<div id="item-relations-display-item-relations">
    <h2><?php echo __('Item Relations'); ?></h2>
    <?php if (!$subjectRelations && !$objectRelations): ?>
    <p><?php echo __('This item has no relations.'); ?></p>
    <?php else: ?>
    <table>
        <?php foreach ($subjectRelations as $subjectRelation): ?>
        <tr>
            <td><?php echo __('This Item'); ?></td>
            <td><span title="<?php echo html_escape($subjectRelation['relation_description']); ?>"><?php echo $subjectRelation['relation_text']; ?></span></td>
            <td>Item: <a href="<?php echo url('items/show/' . $subjectRelation['object_item_id']); ?>"><?php echo $subjectRelation['object_item_title']; ?></a></td>
        </tr>
        <?php endforeach; ?>
        <?php foreach ($objectRelations as $objectRelation): ?>
        <tr>
            <td>Item: <a href="<?php echo url('items/show/' . $objectRelation['subject_item_id']); ?>"><?php echo $objectRelation['subject_item_title']; ?></a></td>
            <td><span title="<?php echo html_escape($objectRelation['relation_description']); ?>"><?php echo $objectRelation['relation_text']; ?></span></td>
            <td><?php echo __('This Item'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>



<!-- 
        <div class="related-items" id="recent-items">
            <h2>Related Items</h2>
            <div class="item record">
                <h3><a href="/items/show/26">A Loyalist Childhood: Sampler Made by Anna Stoddard, 1782</a></h3>
                <a href="/items/show/26" class="image">
                    <img src="https://revolutionhappenedhere.org/files/square_thumbnails/72297738fc6a931da79a5189e2f67867.jpg" alt="68.465_Anna_Stoddar_sampler.jpg" title="68.465_Anna_Stoddar_sampler.jpg">
                </a>
                <p class="item-description">Sampler, cross-stitch on linen, approximately 7.5&quot; H x 5.75&quot; W</p>
            </div>
            <div class="item record">
                <h3><a href="/items/show/25">Captain Daniel Pomeroy&#039;s Payroll</a></h3>
                <a href="/items/show/25" class="image">
                    <img src="https://revolutionhappenedhere.org/files/square_thumbnails/f12cff3db9a9325a40e50df8909cf0a9.jpg" alt="A_R_W_17_9_side1.jpg" title="A_R_W_17_9_side1.jpg"></a>
                <p class="item-description">document, approximately 14 3/4&quot; (37.6 cm) x 9 5/8&quot; (24.6 cm)</p>
            </div> 
        </div>end related-items-->

    </div><!--end item-info-->-->

    <hr>

    <!-- if item is a manuscript, show transcription -->
    <?php if(metadata('item', array('Item Type Metadata','Text'))): ?>
      <div class="element">
        <h2>Transcription</h2>
        <div class="element-text transcription"><?php echo metadata('item', array('Item Type Metadata','Text')) ?></div>
      </div>
    <?php endif; ?>
    <!-- map -->
    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

    <ul class="item-pagination navigation">
        <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
        <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
    </ul>

</div> <!-- End of Primary. -->

 <?php echo foot(); ?>
