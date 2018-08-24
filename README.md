# URI People Tool

A tool that makes it easy to create and edit custom bibliographic posts for people in the department. The tool appears in the WordPress admin sidebar.

This project was derived from part of the URI Post Types plugin that is built into the URI Department theme.

People Tool creates a custom post type for people and a taxonomy to go with it. It also provides a short code to display lists of people by group.

## Shortcode

The base syntax for the shortcode is as follows: `[uri-people-tool]`.  There are additional attributes that can be used to further customize the shortcode's output.

### Shortcode attributes

All of the options below are optional.

	# `group` expects the slug of a valid peoplegroup category.
	# `posts_per_page` expects a whole number. It limits the results to the specified amount. Default is 200
	# `thumbnail` expects the name of an image format e.g. "medium" or "third_column"  Set to "false" to hide thumbnails.
	# `link` controls whether or not the card lists link to posts.  Set to "false" to not link (default: true)
	# `phone` controls whether or not to display the phone number on card lists (default: true)
	# `department` controls whether or not to display the department on card lists (default: true)
	# `website` controls whether or not to display the website on card lists (default: false)
	# `address` controls whether or not to display the street address on card lists (default: false)
	# `email` controls whether or not to display the email address on card lists (default: true)
	# `before` allows HTML to be inserted before the list of people. It defaults to `<div class="uri-people-tool">`
	# `after` allows HTML to be inserted after the list of people. It defaults to `</div>`

## Examples

Display a list of people in a "faculty" group in a two column layout:

```[uri-people-tool group="faculty" before='<div class="uri-people-tool cl-tiles halves">' after="</div>"]```

Display a list of people in a "faculty" group as a three column layout, show street address and hide department:

```[uri-people-tool group="faculty" department="false" address="true" before='<div class="uri-people-tool cl-tiles thirds">' after="</div>"]```

Display a list of all people without links to people posts:

```[uri-people-tool link="false"]```


## Theming the output

This plugin includes default templates. The templates will likely require customization to match your site's theme. To customize the templates, copy one or both of `uri-people-tool/templates/person-card.php` and `uri-people-tool/templates/single-people.php` to your theme's directory -- either into your theme's root, or into a directory in your theme called `templates`. `person-card` handles the shortcode output, and `single-people` handles the page view of each person.

Edit the files in your theme to taste.

## Plugin Details

Contributors: John Pennypacker, Brandon Fuller  
Tags: posts, people  

