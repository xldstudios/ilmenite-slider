# Ilmenite Slider #
Barebones WordPress slider plugin based on the Flexslider jQuery slider.

~Current Version:1.1~

## Description ##
Basic WordPress slider plugin that adds Flexslider by WooThemes. Made to work with custom theme development and therefore contains no direct theme options panel.

The idea behind the slider is to remove all bloatware that other plugins contain and make it easy to add a slider to a clients website and theme.

## Usage ##

**How to include**
To include the slider in a theme or plugin, do a custom WP_Query that pulls from the *ilmenite_slider* post type.

**Changing Slider Settings**
You can override the default slider settings, by placing a slider.js file in the *javascripts/* directory of your theme which will be loaded instead of the one provided by the plugin.

For documentation on the slider itself, please see Flexslider's page: http://www.woothemes.com/flexslider/

## Changelog ##

**Version 1.1**
* Completely changed plugin architecture.
+ Added new translation files.
+ Added plugin auto-update support via GitHub.

**Version 1.0**
* First version of the plugin.