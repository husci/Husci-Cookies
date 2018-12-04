<?php
/**
 * @copyright	Copyright © 2018 - All rights reserved.
 * @license		GNU General Public License v2.0
 * @generator	http://xdsoft/joomla-module-generator/
 */
defined('_JEXEC') or die;

$doc = JFactory::getDocument();
/* Available fields:"popup_title","popup_desc","title_font_size","desc_font_size","button_text","popup_color","cookie_name","cookie_policy_link","GA_enable","google_an_cod","fb_pixel_enable","fb_pixel_code","cookies_expires_days", */
// Include assets
//$doc->addStyleSheet(JURI::root()."modules/mod_husci_cookies/assets/css/style.css");
// $width 			= $params->get("width");

/**
	$db = JFactory::getDBO();
	$db->setQuery("SELECT * FROM #__mod_husci_cookies where del=0 and module_id=".$module->id);
	$objects = $db->loadAssocList();
*/
require JModuleHelper::getLayoutPath('mod_husci_cookies', $params->get('layout', 'default'));