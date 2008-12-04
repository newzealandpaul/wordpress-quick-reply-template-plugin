<?php
/*
Plugin Name: Quick Reply Template Plugin
Plugin URI: http://www.entropytheblog.com/
Description: Allows you to specify a reply template for the quick reply feature in Wordpress 2.7+. The template can contain the comment author's fullname and firstname and any other characters.
Version: 0.1
Author: Paul William
Author URI: http://www.entropytheblog.com/blog/

Copyright 2008 Paul William

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('PW_QUICK_REPLY_TEMPLATE_OPTION', "pw_quick_reply_template");
define('PW_QUICK_REPLY_TEMPLATE_NAME', "Quick Reply Template");

// Script that will be inserted into edi-comments.php

function pw_quick_reply_template_comment_script(){
	echo <<<SCRIPT
	<script type='text/javascript'>
	if (!(typeof commentReply == 'undefined')){
		var overloaded_comment_reply_open_func = commentReply.open

		commentReply.open = function(id,p,a){ 
		    overloaded_comment_reply_open_func(id,p,a);
		    var name = jQuery("#comment-"+id+" strong")[0].innerHTML.match(/>\s(.*)/)[1];
		    jQuery('#replycontent')[0].value = name+", ";
		}
	}
	</script>
	
SCRIPT;
}

add_action( "admin_footer", 'pw_quick_reply_template_comment_script', 100);

// Admin menu

add_action('admin_menu', 'pw_quick_reply_template_admin_menu');

function pw_quick_reply_template_admin_menu() {
  add_options_page(PW_QUICK_REPLY_TEMPLATE_NAME.' Options', PW_QUICK_REPLY_TEMPLATE_NAME, 8, __FILE__, 'pw_quick_reply_template_options_page');
}

// Admin options

add_option(PW_QUICK_REPLY_TEMPLATE_OPTION, "@%NAME%, ", "", true);

function pw_quick_reply_template_options_page() {
?>

	<div class="wrap">
	<h2><?php echo PW_QUICK_REPLY_TEMPLATE_NAME; ?> Options</h2>	
		<div>
			<p>If any of the following "tags" appear in the template they are substitued for the infomation they represent.</p>
			<p><strong>%NAME%</strong> is substituted for the comment author's full name.</p>
			<p><strong>%FIRST_NAME%</strong> is substituted for the comment author's first name. The first name is all the characters of the author name until the first space. For example:</p>		
			<blockquote>
				<p>The first name of "Paul William" would be "Paul".</p>
				<p>The first name of "King of Spain" would be "King".</p>
			</blockquote>
		</div>
	
		<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>

		<table class="form-table">

		<tr valign="top">
		<th scope="row">Reply Template</th>
		<td>
			<textarea name="<?php echo PW_QUICK_REPLY_TEMPLATE_OPTION; ?>"><?php echo get_option(PW_QUICK_REPLY_TEMPLATE_OPTION); ?></textarea>
		</td>
		</tr>

		</table>

		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="<?php echo PW_QUICK_REPLY_TEMPLATE_OPTION; ?>" />

		<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
		</p>

		</form>
	</div>


<?php
}
?>