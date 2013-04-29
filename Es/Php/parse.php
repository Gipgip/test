<?php

/*
 3. Parsing XML (20min)
Input specifications:
The following XML file from the Youtube GDATA API:
http://gdata.youtube.com/feeds/api/playlists/4308E545B34F885D?v=2
Expected output:
Print to the browser the title, yt:videoId and media:description of each video in the
most simple and efficient way you can using PHP.

*/
$feedURL = 'http://gdata.youtube.com/feeds/api/playlists/4308E545B34F885D?v=2';


$sxml = simplexml_load_file($feedURL);



foreach ($sxml->entry as $entry) {

	$media = $entry->children('http://search.yahoo.com/mrss/');
	$title = $media->group->title;
	$description = $media->group->description;

	$yt = $media->children('http://gdata.youtube.com/schemas/2007');
	$videoid = $yt->videoid;


	echo "title : $title", "<br/>";
	echo "yt:videoid : $videoid", "<br/>";
	echo "media:description : $description", "<br/>";
	echo "<br/>";

}


