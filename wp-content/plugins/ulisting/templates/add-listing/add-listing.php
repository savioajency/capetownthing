<?php
/**
 * Add listing
 *
 * Template can be modified by copying it to yourtheme/ulisting/add-listing/add-listing.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0
 */
use uListing\Classes\StmUser;
use uListing\Classes\StmListingTemplate;
use uListing\Classes\StmListingSettings;

$user = null;
$view = 'add-listing/add';

if(is_user_logged_in())
	$user  = new StmUser(get_current_user_id());

if(isset($_GET['edit']))
	$view  = 'add-listing/edit';

$user_plans  = $user->getPlanList();
$check_limit = $user->checkLimitForAddListing();
?>

<?php if( !$check_limit ):?>
	<?php
		wp_add_inline_script( 'stm-form-listing', "window.location.replace('".get_page_link( StmListingSettings::getPages(StmListingSettings::PAGE_PRICING_PLAN) )."');", 'before');
	?>
<?php else:?>
	<div class="ulisting-main">
		<?php echo StmListingTemplate::load_template( $view, array( 'user' => $user,'user_plans' => $user_plans), true );?>
	</div>
<?php endif;?>

