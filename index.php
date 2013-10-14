<?php
if(!isset($_GET['url'])) {
	die(json_encode(false));
}
require_once('UKM/tv.class.php');

$url = urldecode($_GET['url']);

$start = strlen('http://tv.ukm.no/');
$stop  = strpos($url, '/', $start);
$ID = substr($url, $start, $stop-$start);

$UKMTV = new tv($ID);

var_dump($UKMTV);

$width = isset($_GET['maxwidth']) ? $_GET['maxwidth'] : false;
$height = isset($_GET['maxheight']) ? $_GET['maxheight'] : false;

$oembed = array('type' => 'video',
				'version' => '1.0',
				'title' => $UKMTV->title,
				'author_name' => 'UKM Norge',
				'author_url' => '://ukm.no',
				'provider_name' => 'UKM-TV',
				'provider_url' => '://tv.ukm.no',
				'thumbnail_url' => $UKMTV->image,
				'thumbnail_width' => $UKMTV->image,
				'thumbnail_heigh' => $UKMTV->image,
				'html' => $UKMTV->embed,
				'width' => $UKMTV->width,
				'height' => $UKMTV->height
				);
				
die(json_encode($oembed));