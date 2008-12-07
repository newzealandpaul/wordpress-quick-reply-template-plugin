=== Quick Reply Template Plugin ===
Contributors: paul1999
Requires at least: 2.7
Tested up to: 2.7
Stable tag: trunk
Tags: reply, template, quick, comments, author, 2.7, admin

Allows you to specify a reply template for the quick reply feature in Wordpress 2.7+.

== Description ==

This plugin allows you to specify a default text for the "quick reply" feature in Wordpress 2.7+. 

The template can contain the comment author's fullname, first name, link to the original comment and any other characters, spaces, symbols etc.

= Changelog =


View the changelog [here](http://svn.wp-plugins.org/quick-reply-template/trunk/CHANGELOG).

= Credits =


Kaspars for adding the comment ID tag.

== Installation ==

1) Download the plugin zip file.

2) Unzip.

3) Upload the quick-reply-template directory to your wordpress plugin directory (/wp-content/plugins).

4) Activate the plugin.

5) Open up the options (In the left hand menu under Settings > Quick Reply Template)

6) Set your desired template.

7) When you click reply in the admin comments page, your reply template will be automatically inserted.

== Frequently Asked Questions ==

= How can I link to the original comment? =

The %ID% tag contains the comment id of the original comment. You can use this to link to the original. For example:

<a href="#comment-%ID%">%NAME%</a>