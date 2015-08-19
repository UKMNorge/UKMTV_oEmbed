<?php
if(!isset($_GET['url'])) {
	die(json_encode(false));
}
require_once('UKM/tv.class.php');

$url = urldecode($_GET['url']);

$parts = explode('/', $url);
$IDstring = $parts[ sizeof( $parts )-2 ];
$subparts = explode('-', $IDstring);
$ID = $subparts[0];
$UKMTV = new tv($ID);

if(!$UKMTV->id)
	die(json_encode(false));
	
$UKMTV->size();

$maxwidth = isset($_GET['maxwidth']) ? $_GET['maxwidth'] : false;
$maxheight = isset($_GET['maxheight']) ? $_GET['maxheight'] : false;

if($maxwidth && $UKMTV->width > $maxwidth) {
	$width = $maxwidth;
	$height = $maxwidth / $UKMTV->ratio;
} else {
	$width = $UKMTV->width;
	$height = $UKMTV->height;
}

if($maxheight && $UKMTV->height > $maxheight) {
	$height = $maxheight;
	$width = $UKMTV->ratio * $height;
}

$oembed = array('type' => 'video',
				'version' => '1.0',
				'title' => $UKMTV->title,
				'author_name' => 'UKM Norge',
				'author_url' => 'http://ukm.no',
				'provider_name' => 'UKM-TV',
				'provider_url' => 'http://tv.ukm.no',
				'thumbnail_url' => $UKMTV->image_url,
				'thumbnail_width' => $UKMTV->width,
				'thumbnail_height' => $UKMTV->height,
				'html' => $UKMTV->embedcode($width),
				'width' => $width,
				'height' => $height
				);
die(json_encode($oembed));
