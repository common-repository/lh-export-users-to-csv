=== LH Export Users to CSV ===
Contributors: shawfactor
Donate link: https://lhero.org/portfolio/lh-export-users-to-csv/
Tags: Export Users, User Export, Reports, Users, CSV
Requires at least: 5.0
Tested up to: 6.0
Requires PHP: 5.6
Stable tag: trunk

Export Users to CSV Plugin allows you to export users listings and their metadata into a CSV file.

== Description ==

Export Users to CSV Plugin allows you to export users list and their metadata in CSV file. The CSV includes all the core wordpress user data, as well as the important meta fields, including:

1. Username
2. Email
3. Display Name
4. First Name
5. Last Name
6. Registered Date

This plugin, is deliberately simple, but it is also standards compliant, extendable, and built to maximise data security

**Like this plugin? Please consider [leaving a 5-star review](https://wordpress.org/support/view/plugin-reviews/lh-export-users-to-csv/).**

**Love this plugin or want to help the LocalHero Project? Please consider [making a donation](https://lhero.org/portfolio/lh-export-users-to-csv/).**

== Installation ==

1. Upload the entire `lh-export-users-to-csv` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Navigate to Users->Export Users and click the button, that simple!


== Frequently Asked Questions ==

= How do you export users? =

1. Fo to Tools in the wordpress admin menu
2. Click the Generate Report in the Download your Users section

= Why did you write this plugin? =

I wrote this plugin because I wanted a plugin that:
1. Generated the csv dynamically, to ensure the security of my users data.
2. Used wordpress apis to generate the csv data, to ensure that it was the actual data I wanted (rather than querying the database directly as some plugins do).

= How do I add fields to the download? =

The plugin includes a filter called `lh_eutc_headings`, simply add the meta field to the headings array by use of this filter e.g.:

= What is something does not work?  =

LH Logged In Post Status, and all [https://lhero.org](LocalHero) plugins are made to WordPress standards. Therefore they should work with all well coded plugins and themes. However not all plugins and themes are well coded (and this includes many popular ones). 

If something does not work properly, firstly deactivate ALL other plugins and switch to one of the themes that come with core, e.g. twentyfifteen, twentysixteen etc.

If the problem persists pleasse leave a post in the support forum: [https://wordpress.org/support/plugin/lh-export-users-to-csv/](https://wordpress.org/support/plugin/lh-export-users-to-csv/). I look there regularly and resolve most queries.

= What if I need a feature that is not in the plugin?  =

Please contact me for custom work and enhancements here: [https://shawfactor.com/contact/](https://shawfactor.com/contact/)

`
function my_csv_filter_function($headings){

$headings[] = 'street_address';    

return $headings;
    
}

add_filter('lh_eutc_headings', 'my_csv_filter_function', 10, 1);
`

== Changelog ==

**1.00 May 02, 2019**  
Initial release.