# URI People Tool

A tool that makes it easy to create and edit custom bibliographic posts for people in the department. The tool appears in the WordPress admin sidebar.

This project was derived from part of the URI Post Types plugin that is built into the URI Department theme.

People Tool creates a custom post type for people and a taxonomy to go with it. It also provides a short code to display lists of people by group.

## Shortcode

The syntax is as follows: `[uri-people-tool group="faculty"]` The "group" attribute is optional and it expects the slug of a `peoplegroup`. There is one other attribute that can be used, that is posts_per_page, and its default value is "-1"

## Theming the output

This plugin includes default templates that will get the plugin running, but may require customization to match your site's theme.  To customize the templates, copy one or both of `uri-people-tool/templates/person-card.php` and `uri-people-tool/templates/single-people.php` to your theme's directory -- either in your theme's root, or in a directory called `templates`.

Edit the files in your theme to taste.

## Plugin Details

Contributors: John Pennypacker, Brandon Fuller  
Tags: posts, people  

