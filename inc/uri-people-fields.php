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
 * You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 * This code must run every time the functions.php file is read
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
				'instructions' => 'People are sorted alphabetically by this field, and then by post date if this field is the same. This field is not displayed.',
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
				'instructions' => 'Enter the title',
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
				'instructions' => 'Enter the department label',
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
				'instructions' => 'Use periods for breaks per branding guidelines',
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
				'instructions' => 'Use periods between breaks per branding guidelines',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'key' => 'field_5017da5164ac9',
				'order_no' => '5',
			),
			array (
				'label' => 'Biography',
				'name' => 'peoplebio',
				'type' => 'wysiwyg',
				'instructions' => 'Enter bio information',
				'required' => '0',
				'toolbar' => 'basic',
				'media_upload' => 'no',
				'key' => 'field_5017da5164ea8',
				'order_no' => '6',
			),
			array (
				'label' => 'Publications',
				'name' => 'peoplepubs',
				'type' => 'wysiwyg',
				'instructions' => 'Enter publication list. Use list items when possible.',
				'required' => '0',
				'toolbar' => 'basic',
				'media_upload' => 'no',
				'key' => 'field_5017da5165266',
				'order_no' => '7',
			),
			array (
				'label' => 'URL',
				'name' => 'peopleurl',
				'type' => 'text',
				'instructions' => 'URL to a personal website if available',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'key' => 'field_5017da516562b',
				'order_no' => '8',
			),
			array (
				'label' => 'People Excerpt',
				'name' => 'peoplereview',
				'type' => 'wysiwyg',
				'instructions' => 'For use with people reviews or testimonials',
				'required' => '0',
				'toolbar' => 'basic',
				'media_upload' => 'no',
				'key' => 'field_5017da5165286',
				'order_no' => '9',
			),
			array (
				'label' => 'Research Interests',
				'name' => 'peopleresearch',
				'type' => 'wysiwyg',
				'instructions' => 'Research interests for this person',
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
				'instructions' => 'Education info for this person',
				'required' => '0',
				'toolbar' => 'basic',
				'media_upload' => 'no',
				'key' => 'field_5017da5165357',
				'order_no' => '11',
			),
			array (
				'label' => 'Custom',
				'name' => 'peoplecustom',
				'type' => 'textarea',
				'instructions' => 'A custom area for anything. Bold section titles. Use two line breaks for new paragraphs and an h3 for header items',
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
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (),
		),
		'menu_order' => 0,
	));
	

	
	register_field_group(array (
		'id' => '502a639e58574',
		'title' => 'People Options',
		'fields' => array (
			0 => array (
				'label' => 'People Category',
				'name' => 'peoplecat',
				'type' => 'text',
				'instructions' => 'For use when limiting the people page template to one or more specific people groups. Use the desired people group slug. Separate multiple groups with a space between slugs',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'key' => 'field_502a636e3a5d7',
				'order_no' => '0',
			),
		),
		'location' => array (
			'rules' => array (
				0 => array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => '0',
				),
			),
			'allorany' => 'all',
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (),
		),
		'menu_order' => 0,
	));
	
	
	
	register_field_group(array (
		'id' => '506ae97f314e0',
		'title' => 'People Sorting',
		'fields' => array (
			0 => array (
				'label' => 'Sort People',
				'name' => 'peoplesort',
				'type' => 'true_false',
				'instructions' => '',
				'required' => '0',
				'message' => 'When checked, the people page will be sorted into groups.',
				'key' => 'field_506ae96a8e2f5',
				'order_no' => '0',
			),
		),
		'location' => array (
			'rules' => array (
				0 => array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => '0',
				),
			),
			'allorany' => 'all',
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => 
			array (),
		),
		'menu_order' => 0,
	));
}
