<?php
/**
 * Builder element html
 *
 * Template can be modified by copying it to yourtheme/ulisting/builder/element/html.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.3.8
 */

?>
<div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element) ?> >
	<?php
        $id = $args['model']->ID;
        $title = $args['model']->post_title;
        if(!empty($title)){
            $title = sanitize_title($title);
        }else{
            $title = "";
        }
        echo html_entity_decode(str_replace('u0022', '"', $element['params']['title'] ));
        if(strpos($element['params']['title'],"book_btn")){?>
            <input type="hidden" name="list_post_id" value="<?php echo $id; ?>"/> 
            <input type="hidden" name="list_post_name" value="<?php echo $title; ?>"/>       
        <?php  
        }
        ?>
</div>

