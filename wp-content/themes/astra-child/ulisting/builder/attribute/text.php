<?php
/**
 * Builder attribute text
 *
 * Template can be modified by copying it to yourtheme/ulisting/builder/attribute/text.php.
 *
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
use uListing\Classes\StmListingAttribute;

?>
<?php if(StmListingAttribute::render_attribute($args['model'], $element)): ?>
    <div <?php echo \uListing\Classes\Builder\UListingBuilder::generation_html_attribute($element) ?>>
        <?php if($element['title'] == 'website_link'){ 
            $website_link = $args['model']->attribute_elements['website_link']['attribute_value'];
            if(!empty($website_link)){
                ?>
                    <div class="ulisting-attribute-template attribute_website_link">
                        <button onclick="window.open('<?php echo $website_link; ?>');">Go to site</button>
                    </div>    
                <?php   
            }
        }else{
             echo StmListingAttribute::render_attribute($args['model'], $element);
        }
?>
    </div>
<?php endif;
