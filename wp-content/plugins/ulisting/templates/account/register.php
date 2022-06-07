<?php
/**
 * Account register
 *
 * Template can be modified by copying it to yourtheme/ulisting/account/register.php.
 **
 * @see     #
 * @package uListing/Templates
 * @version 1.0.2
 */
use uListing\Classes\UlistingUserRole;

$register_data = [];
$user_role_list = [];
$userRole = new UlistingUserRole();
foreach ($userRole->roles as $key => $role){
	$user_role_list[] = [
		"id" => $key,
		"text" => $role['name'],
	];
}
$register_data['user_role_list'] = $user_role_list;
wp_enqueue_script('stm-register', ULISTING_URL . '/assets/js/frontend/stm-register.js', array('vue'), ULISTING_VERSION, true);
wp_add_inline_script('stm-register', "var ulisting_user_register_data = json_parse('". ulisting_convert_content(json_encode($register_data)) ."');", 'before');
?>

<div id="stm-listing-register">

	<? if(!empty($_GET['verified']) && $_GET['verified'] == 1) { ?>
        <div class="alert alert-success"><span class="property-icon-like-up alert-icon"></span> <? esc_html_e('Registration completed successfully. Now you can log in to the site using your username and password', 'ulisting'); ?></div>
	<? } ?>

	<div class="ulisting-form-gruop">
		<label> <?php echo  esc_html__('Login', "ulisting"); ?></label>
		<input type="text"
			data-v-model="login"
			class="form-control"
			placeholder="<?php esc_html_e('Enter login', "ulisting"); ?>"/>
		<span data-v-if="errors['login']" style="color: red">{{errors['login']}}</span>
	</div>

	<div class="ulisting-form-gruop">
		<label> <?php echo  esc_html__('First name', "ulisting"); ?></label>
		<input type="text"
			data-v-model="first_name"
			class="form-control"
			placeholder="<?php esc_html_e('Enter first name', "ulisting"); ?>"/>
		<span data-v-if="errors['first_name']" style="color: red">{{errors['first_name']}}</span>
	</div>

	<div class="ulisting-form-gruop">
		<label> <?php echo  esc_html__('Last name', "ulisting"); ?></label>
		<input type="text"
			data-v-model="last_name"
			class="form-control"
			placeholder="<?php esc_html_e('Enter last name', "ulisting"); ?>"/>
		<span data-v-if="errors['last_name']" style="color: red">{{errors['last_name']}}</span>
	</div>

	<div class="ulisting-form-gruop">
		<label> <?php echo  esc_html__('Email', "ulisting"); ?></label>
		<input type="email"
			data-v-model="email"
			class="form-control"
			placeholder="<?php esc_html_e('Enter email', "ulisting"); ?>"/>
		    <span data-v-if="errors['email']" style="color: red">{{errors['email']}}</span>
	</div>

	<div class="ulisting-form-gruop">
		<label> <?php echo  esc_html__('Role', "ulisting"); ?></label>
		<ulisting-select2 :options='user_role_list' data-v-model='role' theme='bootstrap4'></ulisting-select2>
		<span data-v-if="errors['role']" style="color: red">{{errors['role']}}</span>
	</div>

	<div class="ulisting-form-gruop">
		<label> <?php echo  esc_html__('Password', "ulisting"); ?></label>
		<input type="password"
			data-v-model="password"
			class="form-control"
			placeholder="<?php esc_html_e('Enter password', "ulisting"); ?>"/>
			<span data-v-if="errors['password']" style="color: red">{{errors['password']}}</span>
	</div>

	<div class="ulisting-form-gruop">
		<label> <?php echo  esc_html__('Password repeat', "ulisting"); ?></label>
		<input type="password"
			data-v-model="password_repeat"
			class="form-control"
			placeholder="<?php esc_html_e('Enter password repeat', "ulisting"); ?>"/>
			<span data-v-if="errors['password_repeat']" style="color: red">{{errors['password_repeat']}}</span>
	</div>

	<div class="ulisting-form-gruop">
		<button data-v-on_click="register" type="button" class="btn btn-primary w-full"><?php echo  esc_html__('Register', "ulisting"); ?></button>
	</div>

	<div data-v-if="loading">Loading...</div>

	<div data-v-if="message"  data-v-bind_class="status" >{{message}}</div>

</div>






