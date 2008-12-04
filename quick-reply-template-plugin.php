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

function pw_quick_reply_template_comment_head(){
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

add_action( "admin_footer", 'pw_quick_reply_template_comment_head', 100);

?>