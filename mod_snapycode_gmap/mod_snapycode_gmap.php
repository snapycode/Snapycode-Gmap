<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
if(!defined('DS')){
    define('DS',DIRECTORY_SEPARATOR);
}

// Include the helper functions only once
require_once dirname(__FILE__).'/helper.php';

$document = JFactory::getDocument();
$modulePath = JURI::base() . 'modules/mod_snapycode_gmap/';

$moduleclass_sfx 	= htmlspecialchars($params->get('moduleclass_sfx',''));

//Get module params
$map_header  = $params->get('snapycode_gmap_map_header', '');
$map_footer  = $params->get('snapycode_gmap_map_footer', '');
$map_address = $params->get('snapycode_gmap_map_address', '');
$map_zoom    = $params->get('snapycode_gmap_map_zoom', '');
$map_type    = $params->get('snapycode_gmap_map_type', '');
$map_enable_bubble    = $params->get('snapycode_gmap_map_enable_bubble', '');
$map_enable_direction = $params->get('snapycode_gmap_map_enable_direction', '');
$snapycode_gmap_map_marker           = $params->get('snapycode_gmap_map_marker', '');

$map_width  = (int)$params->get('snapycode_gmap_map_width', '450');
$map_height  = (int)$params->get('snapycode_gmap_map_height', '500');

if( $map_width == 0 ){ $map_width = 450; }
if( $map_height == 0 ){ $map_height = 500; }

if( $snapycode_gmap_map_marker != '' )
{
	$map_marker = $modulePath.'/assets/images/map-markers/'.$snapycode_gmap_map_marker;	
}else{
	$map_marker = '0';
}
//Calling helper file methodes
//$msg = modSnapycodeGmapHelper::show_message('Hi you have installed the module Snapycode Gmap');

// Adding module js and css file
$document->addStyleSheet($modulePath.'assets/css/mod_snapycode_gmap.css');
//$document->addScript($modulePath.'assets/js/mod_snapycode_gmap.js');
	
require JModuleHelper::getLayoutPath('mod_snapycode_gmap', $params->get('layout', 'default'));