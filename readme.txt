=== Archive Title ===

Contributors:      webmandesign
Donate link:       https://www.webmandesign.eu/contact/#donation
Author URI:        https://www.webmandesign.eu/
Plugin URI:        https://www.webmandesign.eu/portfolio/archive-title-wordpress-plugin/
Requires at least: 6.0
Tested up to:      6.7
Requires PHP:      7.0
Stable tag:        1.0.2
License:           GPL-3.0-or-later
License URI:       http://www.gnu.org/licenses/gpl-3.0.html
Tags:              label, category, tag, taxonomy, post type

Provides options to control an archive page title.


== Description ==

This plugin provides options to tweak an archive page title, such as removing annoying archive label (see FAQ). You can remove the label for any archive page completely, or just hide it accessibly.

= Features =

* Modifying category, tag, author, custom post type and custom taxonomy archive title (no need to modify the date archive title)
* Removing archive page title label completely
* Hiding archive page title label accessibly (using a CSS class of `screen-reader-text`)

= Additional Resources =

* [Have a question?](https://wordpress.org/support/plugin/archive-title/)
* [Grab a free theme](https://profiles.wordpress.org/webmandesign/#content-themes)
* [WebMan Design website](https://www.webmandesign.eu/)


== Installation ==

1. Unzip the plugin download file and upload `archive-title` folder into the `/wp-content/plugins/` directory.
2. Activate the plugin through the *"Plugins"* menu in WordPress.
3. Navigate to *Settings &rarr; Reading* to edit plugin options under "Archive Title Options" section.


== Frequently Asked Questions ==

= What is an archive page? =

Archive page contains an archive - a list of posts or custom post types. WordPress recognizes 6 types of archives: category, tag, author, custom post type, custom taxonomy and date.

= What is an archive label? =

Title of every archive page contains an 'archive label' *(please note this is a terminology used in this plugin)*. By default it is the first text in archive title followed with colon. For example, a category archive page with title of *"Category: Uncategorized"* has an archive label of *"Category:"*.

= Where can I find the plugin settings page? =

This plugin integrates its settings directly into ***Settings &rarr; Reading*** WordPress admin page. You can edit plugin options under "**Archive Title Options**" section on that page.

= What does it mean "hiding label accessibly"? =

The plugin allows you to remove the archive title label completely or to hide it accessibly. Accessible hiding causes wrapping the archive title label in a `<span class="screen-reader-text">` HTML element.

Every WordPress [theme should provide styles for the `screen-reader-text` CSS class](https://make.wordpress.org/accessibility/handbook/best-practices/markup/the-css-class-screen-reader-text/). And every text wrapped in such CSS class element will be hidden from visibility, but will be still accessible for assistive devices, such as screen reader.

We recommend using this option instead of removing the label completely.

= My theme uses a different CSS class to hide elements accessibly. Can I change it? =

Yes you can.

You can override the CSS class by defining the `ARCHIVE_TITLE_CSS_CLASS_A11Y` constant in your [child theme's](https://support.webmandesign.eu/child-theme/) `functions.php` like so:

`define( 'ARCHIVE_TITLE_CSS_CLASS_A11Y', 'your-theme-accessibly-hidden-class' );`

= Can I change the archive title label instead of removing it? =

Well, the only 2 use cases I can think of for this option would be:

* To change the **taxonomy name**: For example, if you would like to keep the category archive title label such as "Category:" in "Category: Uncategorized", but only want to change the "Category" text to "Topic". For that case it's much better to properly [rename the taxonomy using a dedicated plugin](https://wordpress.org/plugins/rename-taxonomies/). You can use this for any WordPress native taxonomy, such as Category, Tag, or any other custom taxonomy, such as [Jetpack's Project Types](https://en.support.wordpress.com/portfolios/).
* To change the **post type name**: For example, if you would like to rename "Archives: Portfolio" to "Archives: Projects" (note that "Archives:" is actually a label here, and you can remove it with this plugin). For that case it's much better to properly [rename the post type using a dedicated plugin](https://wordpress.org/plugins/cpt-editor/).


== Screenshots ==

1. Default WordPress archive page titles, before plugin options are applied.
2. After we apply plugin options, the archive page title labels are gone.


== Changelog ==

Please see the [`changelog.md` file](https://github.com/webmandesign/archive-title/blob/master/changelog.md) for details.


== Upgrade Notice ==

= 1.0.0 =
This is initial plugin release.
