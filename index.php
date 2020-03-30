<?php

use UKMNorge\Filmer\UKMTV\Filmer;

if(!isset($_GET['url'])) {
	die(json_encode(false));
}

require_once('UKM/Autoloader.php');

$id = Filmer::getIdFromUrl($_GET['url']);

try {
    $film = Filmer::getById( $id );
} catch( Exception $e ) {
    die(json_encode(false));
}

$oembed = array('type' => 'video',
				'version' => '1.0',
				'title' => $film->getTitle(),
				'author_name' => 'UKM Norge',
				'author_url' => 'http://ukm.no',
				'provider_name' => 'UKM-TV',
				'provider_url' => 'http://tv.ukm.no',
				'thumbnail_url' => $film->getImageUrl(),
				'thumbnail_width' => $film->getWidth(),
				'thumbnail_height' => $film->getHeight(),
				'html' => $film->getEmbedHtml(),
				'width' => $film->getWidth(),
				'height' => $film->getHeight()
				);
die(json_encode($oembed));
