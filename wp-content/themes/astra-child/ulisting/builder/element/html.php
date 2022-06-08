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
         if(strpos($element['params']['title'],"book_btn")){
            
            $id = $args['model']->ID;
            $title = $args['model']->post_title;
            $email = $args['model']->attribute_elements['contact_email']['attribute_value'];

            if(!empty($title)){
                $title = sanitize_title($title);
            }else{
                $title = "";
            }
            
            if(!empty($email)){
                echo html_entity_decode(str_replace('u0022', '"', $element['params']['title'] ));
             ?>
                <input type="hidden" name="list_post_id" value="<?php echo $id; ?>"/> 
                <input type="hidden" name="list_post_name" value="<?php echo $title; ?>"/>  
                <input type="hidden" name="list_contact_email" value="<?php echo $email; ?>"/>
        <?php  
            }            

        }else{
            echo html_entity_decode(str_replace('u0022', '"', $element['params']['title'] ));
        }
        ?>
</div>

