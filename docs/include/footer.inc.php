<?php
/************************************************************************/
/* ATutor																*/
/************************************************************************/
/* Copyright (c) 2002-2005 by Greg Gay, Joel Kronenberg & Heidi Hazelton*/
/* Adaptive Technology Resource Centre / University of Toronto			*/
/* http://atutor.ca														*/
/*																		*/
/* This program is free software. You can redistribute it and/or		*/
/* modify it under the terms of the GNU General Public License			*/
/* as published by the Free Software Foundation.						*/
/************************************************************************/
// $Id$
if (!defined('AT_INCLUDE_PATH')) { exit; }

global $next_prev_links, $langEditor;
global $_base_path, $_my_uri;
global $_stacks, $db;

$side_menu = array();

if ($_SESSION['course_id'] > 0) {
	$savant->assign('tmpl_my_uri', $_my_uri);

	if (($_SESSION['prefs'][PREF_MAIN_MENU] == 1) && $_SESSION['prefs'][PREF_MAIN_MENU_SIDE] != MENU_LEFT) {
		$savant->assign('tmpl_right_menu_open', TRUE);
		$savant->assign('tmpl_popup_help', 'MAIN_MENU');
		$savant->assign('tmpl_menu_url', '<a name="menu"></a>');
		$savant->assign('tmpl_close_menu_url', $_my_uri.'disable='.PREF_MAIN_MENU);
		$savant->assign('tmpl_close_menus', _AT('close_menus'));
	}	
	$sql = "SELECT copyright FROM ".TABLE_PREFIX."courses WHERE course_id=".$_SESSION['course_id'];
	if($result = mysql_query($sql, $db)) {
		while($row=mysql_fetch_row($result)) {
			if(strlen($row[0])>0) {
				$custom_copyright= $row[0];
				$custom_copyright = str_replace('CONTENT_DIR/', '', $custom_copyright);
			}
		}
		$savant->assign('tmpl_custom_copyright', $custom_copyright);
	} else {
		$savant->assign('tmpl_custom_copyright', '');
	}

	//side menu array
	$side_menu = explode('|', $system_courses[$_SESSION['course_id']]['side_menu']);
	$side_menu = array_intersect($side_menu, $_stacks);
}

if (isset($err)) {
	$err->showErrors(); // print all the errors caught on this page
}

$savant->assign('side_menu', $side_menu);

$savant->display('include/footer.tmpl.php');

debug($_SESSION);

?>