<?php
/**
 *	URI People Tool fields
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');



/**
 * Register field groups
 * The register_field_group function accepts 1 array which holds the relevant data to register a field group
 * @see ACF's acf_add_local_field_group() for documentation
 */

if(function_exists('register_field_group')) {

	register_field_group(array (
		'id' => '502a639e579f1',
		'title' => 'People',
		'fields' => array (
			array (
				'label' => 'Sort Name',
				'name' => 'sortname',
				'type' => 'text',
				'instructions' => 'People are sorted alphabetically first by this field, then by post date. This field is not displayed.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'key' => 'field_sortname',
				'order_no' => '-1',
			),
			array (
				'label' => 'Title',
				'name' => 'peopletitle',
				'type' => 'text',
				'instructions' => 'Job title / position.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'key' => 'field_5017da51637c7',
				'order_no' => '0',
			),
			array (
				'label' => 'Department',
				'name' => 'peopledepartment',
				'type' => 'text',
				'instructions' => 'Add department label if applicable.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'key' => 'field_5017da5163bdb',
				'order_no' => '1',
			),
			array (
				'label' => 'Phone',
				'name' => 'peoplephone',
				'type' => 'text',
				'instructions' => 'Use periods for breaks per branding guidelines.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'key' => 'field_5017da5163f7d',
				'order_no' => '2',
			),
			array (
				'label' => 'Email',
				'name' => 'peopleemail',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'key' => 'field_5017da516431f',
				'order_no' => '3',
			),
			array (
				'label' => 'Pronouns',
				'name' => 'peoplepronouns',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'key' => 'field_64f9ede6738a0',
				'order_no' => '15',
			),
			array (
				'label' => 'Office Location or Mailing Address',
				'name' => 'peoplemail',
				'type' => 'textarea',
				'instructions' => 'Often, the office number is sufficient e.g. 100 Avedesian Hall, but enter a complete mailing address with line breaks if desired.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'br',
				'key' => 'field_5017da5164706',
				'order_no' => '4',
			),
			array (
				'label' => 'Fax Number',
				'name' => 'peoplefax',
				'type' => 'text',
				'instructions' => 'Use periods between breaks per branding guidelines.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'key' => 'field_5017da5164ac9',
				'order_no' => '5',
			),
			array (
				'label' => 'URL',
				'name' => 'peopleurl',
				'type' => 'text',
				'instructions' => 'URL to a personal website if available.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'key' => 'field_5017da516562b',
				'order_no' => '8',
			),
			array (
				'label' => 'Google Scholar Link',
				'name' => 'peoplegooglescholar',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'key' => 'field_64f9ec1c5e656',
				'order_no' => '13',
			),
			array (
				'label' => 'ReasearchGate Link',
				'name' => 'peopleresearchgate',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'key' => 'field_64f9ed847389f',
				'order_no' => '14',
			),
			array (
				'label' => 'Looking for Students?',
				'name' => 'peoplelookingforstudents',
				'type' => 'text',
				'instructions' => 'Are you looking for students? Please specify M.S., Ph.D., Post Doc, etc.',
				'required' => '0',
				'key' => 'field_64f9ebbd5e655',
				'order_no' => '16',
			),
			array (
				'label' => 'Biography',
				'name' => 'peoplebio',
				'type' => 'wysiwyg',
				'instructions' => 'A brief biography.',
				'required' => '0',
				'toolbar' => 'basic',
				'media_upload' => 'no',
				'key' => 'field_5017da5164ea8',
				'order_no' => '6',
			),
			array (
				'label' => 'Research Interests',
				'name' => 'peopleresearch',
				'type' => 'wysiwyg',
				'instructions' => 'Research interests.',
				'required' => '0',
				'toolbar' => 'basic',
				'media_upload' => 'no',
				'key' => 'field_5017da5165317',
				'order_no' => '10',
			),
			array (
				'label' => 'Education',
				'name' => 'peopleedu',
				'type' => 'wysiwyg',
				'instructions' => 'Education info (degrees earned, etc) for this person.',
				'required' => '0',
				'toolbar' => 'basic',
				'media_upload' => 'no',
				'key' => 'field_5017da5165357',
				'order_no' => '11',
			),
			array (
				'label' => 'Selected Publications',
				'name' => 'peoplepubs',
				'type' => 'wysiwyg',
				'instructions' => 'Selected publication list. Use list items when possible.',
				'required' => '0',
				'toolbar' => 'basic',
				'media_upload' => 'no',
				'key' => 'field_5017da5165266',
				'order_no' => '7',
			),
		
			array (
				'label' => 'Custom',
				'name' => 'peoplecustom',
				'type' => 'textarea',
				'instructions' => 'A custom area for anything. Bold section titles. Use two line breaks for new paragraphs and an h3 for header items.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_5017da5165387',
				'order_no' => '12',
			),
		),
		'location' => array (
			'rules' => array (
				0 => array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'people',
					'order_no' => '0',
				),
			),
			'allorany' => 'all',
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => 
			array (),
		),
		'menu_order' => 0,
	));
	

}
