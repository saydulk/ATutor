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
global $db;
global $_my_uri;
global $_base_path;
global $savant;
global $contentManager;

ob_start();

echo '<div style="whitespace:nowrap;">';

echo '<a href="'.$_base_path.'?g=9">'._AT('home').'</a><br />';

/* @See classes/ContentManager.class.php	*/
$contentManager->printMainMenu();

echo '<img src="'.$_base_path.'images/'.$rtl.'tree/tree_split.gif" alt="" width="16" height="16" class="menuimage8" /> ';
echo '<img src="'.$_base_path.'images/glossary.gif" alt="" class="menuimage8" /> <a href="'.$_base_path.'glossary/">'._AT('glossary').'</a>';

echo '<br />';

echo '<img src="'.$_base_path.'images/'.$rtl.'tree/tree_end.gif" alt="" width="16" height="16" class="menuimage8" /> ';
echo '<img src="'.$_base_path.'images/toc.gif" alt="" class="menuimage8" /> <a href="'.$_base_path.'tools/sitemap/">'._AT('sitemap').'</a>';
echo '</div>';

$savant->assign('tmpl_dropdown_contents', ob_get_contents());
ob_end_clean();
$savant->assign('title', _AT('navigation'));
$savant->display('dropdown_open.tmpl.php');

?>