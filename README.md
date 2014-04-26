# Ilmenite Slider #
A simple slider plugin for WordPress that adds post type support but leaves styling up to the theme.

## Description ##
Basic WordPress slider plugin that adds post type support and if Advanced Custom Fields is enabled, a set of custom ACF fields, leaving the frontend generation to the theme in question.

The idea behind the slider is to remove all bloatware that other plugins contain and make it easy to add a slider to a clients website and theme.

## Usage ##

**How to include**
To include the slider in a theme or plugin, do a custom WP_Query that pulls from the *ilmenite_slider* post type.

You will also need to load the slider of your choice in your theme.

## Changelog ##

**Version 1.2**
* Again changed plugin architecture to be class-oriented.
* Removed loading of any slider function code (flexslider) and leaves styling completely to the theme.
* Removed plugin auto-update support as it is not ideal for this type of plugin.

**Version 1.1**
* Completely changed plugin architecture.
+ Added new translation files.
+ Added plugin auto-update support via GitHub.

**Version 1.0**
* First version of the plugin.