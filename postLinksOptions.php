<?php

add_action( 'admin_menu', 'postLinksOptions_Init' );

function postLinksOptions_Init()
{
	register_setting(
		'postlinks-group',					// same as what you used in the settings_fields function call
		'postlinks_options'					// name of the options
	);

	add_settings_section(
		'section_id',						// unique id
		'Setup',							// a title shown on page
		'postLinks_displaySectionContent',	// a callback to display content
		'postlinks-group'					// page name (must match do_settings_sections function call)
	);

	add_settings_field(
		'idPostCount',						// unique id
		'Post Count',						// title of field
		'postLinks_displayPostCount',		// callback to display the input box
		'postlinks-group',					// page name (same as the do_settings_sections function call)
		'section_id'						// id of the settings section, same as the first argument to add_settings_section
	);

	////////////////////////////////////////////////
	// create a menu option in the settings menu
	////////////////////////////////////////////////
	$mypage = add_options_page(
		'postLinks',						// test to be displayed in the title tags of te page when the menu is selected
		'postLinks',						// text to be usded for the menu
		'manage_options',					// capability
		'postlinks',
		'postLinks_outputContent' );
}

function postLinks_outputContent()
{
	?>

	<div class="wrap">
	<h2>postLinks</h2>

	<form action="options.php" method="post">
	<?php settings_fields( 'postlinks-group' ); ?>
	<?php do_settings_sections( 'postlinks-group' ); ?>
	<?php submit_button(); ?>
	</form>
	</div>

	<?php
}

function postLinks_displaySectionContent()
{
}

function postLinks_displayPostCount()
{
	$options = get_option('postlinks_options');
	echo "<input id='idPostCount' name='postlinks_options[post_count]' size='10' type='text' value='{$options['post_count']}' />";
	echo "<br/><i>default: 5 if not set</i>";
}

?>