    <h2><?php echo __('Related Items'); ?></h2>
    <?php if (!$subjectRelations && !$objectRelations): ?>
    <p><?php echo __('This item has no relations.'); ?></p>
    <?php else: ?>
    <table>
        <?php foreach ($subjectRelations as $subjectRelation): ?>
		<?php
		set_current_record('item', get_record_by_id('item', $subjectRelation['object_item_id']));
		$related_item_title = metadata('item',array('Dublin Core','Title'));
		$related_item_image = item_image('square_thumbnail', array('alt' => 'Image of ' . $related_item_title, 'class'=>'related-item-image'));
		?>
        <tr>
            <td> 
	        <?php echo link_to_item($related_item_image,array()); ?>
            <?php echo link_to_item($related_item_title,array());?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php foreach ($objectRelations as $objectRelation): ?>
        <tr>
            <td><?php echo __('This Item'); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
