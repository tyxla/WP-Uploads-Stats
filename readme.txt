=== WP Uploads Stats ===
Contributors: tyxla
Tags: wp, upload, stats, attachment, statistics, file, media
Requires at least: 3.8
Tested up to: 4.4
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides you with detailed statistics about your WordPress media uploads and attachments.

== Description ==

WP Uploads Stats provides you with detailed statistics about your WordPress media uploads and attachments.

To reach the page that reveals all uploads and media statistics, go to Media -> Uploads Stats in the administration.

This page shows various file, media and uploads statistics data and graphs, presented to the user as user-friendly modules. The following statistics modules are available:

- Overview
- Files by Type
- Files by Type - Chart
- Size by Year
- Size by Year - Chart
- Attachments by Type
- Attachments by Type - Chart
- Attachments by Author
- Attachments by Author - Chart
- Attachments by Year
- Attachments by Year - Chart
- Attachments by Post Type
- Attachments by Post Type - Chart
- Attachments by Month/Year

Please, refer to the Configuration section for additional information on how you can tailor the statistics page to your needs.

== Installation ==

1. Install WP Uploads Stats either via the WordPress.org plugin directory, or by uploading the files to your server.
1. Activate the plugin.
1. That's it. You're ready to go!

== Configuration ==

Each user can configure the order of appearance, as well as visibility of each module. These settings are separate for each user, so every different user can have different statistics module configuration. The settings that users can configure are:

- Module visibility - allows the users to hide/show a particular module. To do that, while in the Uploads Stats page, click the Screen Options in the top right portion of the screen, and toggle the checkbox next to your preferred module.
- Module order - allows the users to move the modules in their preferred order. To do that, click and hold the mouse on the icon with squares in the top right portion of your preferred module, then drag it to your preferred location.
- Module minimized/maximized - allows the users to minimize or restore a particular module. A minimized module will still appear on the screen (if enabled in Screen Options), but only its title will be visible - no data or charts will be shown for it. To minimize/restore a module, click the dash or restore icon in the top right portion of your preferred module.

== Further customization for developers ==

WP Uploads Stats is very flexible and completely customizable - it embraces the WordPress Plugin API by using actions and filters where necessary. It has a flexible template system, which allows developers to change the template of each module, as well the main template that renders all modules. Also, the module system is built to be extendable, so creating new modules is easy by building custom plugins or integrating custom code in the active theme.

If you are trying to build something on top of this plugin, and you need help or guidance - feel free to post a support topic in the WordPress Plugin Directory.

== Ideas and bug reports ==

Any ideas for new modules or any other additional functionality that users would benefit from are welcome. 

Also, plugin translators are very welcome!

If you have an idea for a new feature, or you want to report a bug, or you wish to help with translating, feel free to do it here in the Support tab, or you can do it at the Github repository of the project: 

https://github.com/tyxla/WP-Uploads-Stats/

== Changelog ==

= 1.0.2 =
Tested with WordPress 4.4.

= 1.0.1 =
Tested with WordPress 4.3.

= 1.0 =
Initial version.