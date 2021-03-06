<?php

/**
 * @package Tubeify Player
 * @version 6.0
 */
/*
Plugin Name: Tubeify Player
Plugin URI: https://prodesigners.uk
Description: Tubeify Player. HTML5 Video Player With HLS, MPEG-DASH Support. Tubeify Player allows video and audio playback with video.js framework on all major desktop and mobile browsers. Video on Demand - HLS, MPEG-Dash.Video Formats Are Available - MP4, FLV(Flash),MKV . Other Sources Are Supported Also - Youtube Video , Youtube Live, Google Drive. Well As - Google IMA SDK support - VAST/VPAID/VMAP with Ads-pod advertising.. Player is highlly configurable -as clients needs..
license to : Tubeify AS (MIT)
Author: <a href="http://tubeify.tv">Imesh Umayanga</a>
Website: http://tubeify.tv
Version: 6.0
*/

$plugin_dir = plugin_dir_path( __FILE__ );

/* Register JS and CSS files */
function register_videojs(){
	$options = get_option('videojs_options');	

	function video_shortcode($atts, $content=null){
	tbplayer_header();
	
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$rnum = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	$options = get_option('videojs_options');
	
	extract(shortcode_atts(array(
		'hls' => '',
		'hls_label' => '',
		'mpeg' => '',
		'mpeg_label' => '',
		'Playlist' => '',
		'mp4' => '',
		'mp4_label' => '',
		'mp4_2' => '',
		'mp4_2_label' => '',
		'mp4_3' => '',
		'mp4_3_label' => '',
		'mp4_4' => '',
		'mp4_4_label' => '',
		'mp4_5' => '',
		'mp4_5_label' => '',
		'mp4_6' => '',
		'mp4_6_label' => '',
		'flv' => '',
		'flv_label' => '',
		'flv_2' => '',
		'flv_2_label' => '',
		'flv_3' => '',
		'flv_3_label' => '',
		'flv_4' => '',
		'flv_4_label' => '',
		'flv_5' => '',
		'flv_5_label' => '',
		'flv_6' => '',
		'flv_6_label' => '',
		'mkv' => '',
		'mkv_label' => '',
		'mkv_2' => '',
		'mkv_2_label' => '',
		'mkv_3' => '',
		'mkv_3_label' => '',
		'mkv_4' => '',
		'mkv_4_label' => '',
		'mkv_5' => '',
		'mkv_5_label' => '',
		'mkv_6' => '',
		'mkv_6_label' => '',
		'cap' => '',
		'cap_label' => '',
		'cap_2' => '',
		'cap_2_label' => '',
		'cap_3' => '',
		'cap_3_label' => '',
		'cap_4' => '',
		'cap_4_label' => '',
		'cap_5' => '',
		'cap_5_label' => '',
		'cap_6' => '',
		'cap_6_label' => '',
		'youtube' => '',
		'dailymotion' => '',
		'dailymotion2' => '',
		'wistia' => '',
		'vimeo' => '',
		'facebook' => '',
		'twitter' => '',
		'twitch' => '',
		'instagram' => '',
	    'tiktok'   => '',
		'gdrive' => '',
		
		'controls' => '',
		'poster' => $options['videojs_poster'],	
		'brand' => $options['videojs_brand'],
		'brandurl' => $options['videojs_brandurl'],
		'preroll' => $options['videojs_preroll'],
		'preskip' => $options['videojs_preskip'],
		'prehref' => $options['videojs_prehref'],
		'sp_preroll' => $options['videojs_sp_preroll'],
		'sp_presource' => $options['videojs_sp_presource'],
		'sp_preskip' => $options['videojs_sp_preskip'],
		'sp_prehref' => $options['videojs_sp_prehref'],
		'vast' => $options['videojs_vast'],
		'back_time' => $options['videojs_back_time'],
		'forward_time' => $options['videojs_forward_time'],
		'imgads_url' => $options['videojs_imgads_url'],
		'imgads_click' => $options['videojs_imgads_click'],
		'imgads_opacity' => $options['videojs_imgads_opacity'],
		'imgads_start' => $options['videojs_imgads_start'],
		'imgads_end' => $options['videojs_imgads_end'],
		'age_wl' => $options['videojs_age_wl'],
		'age_er' => $options['videojs_age_er'],
		'width' => $options['videojs_width'],
		'height' => $options['videojs_height'],
		'autoplay' => $options['videojs_autoplay'],
		'loop' => $options['videojs_loop'],
		'selector' => $options['videojs_selector'],
		'thumbnails' => $options['videojs_thumbnails'],
		'muted' => $options['videojs_muted'],
		'marker_tx1' => $options['videojs_marker_tx1'],
		'marker_sec1' => $options['videojs_marker_sec1'],
		'marker_time' => $options['videojs_marker_time'],
		'htmlads_code' => $options['videojs_htmlads_code'],
		'id' => ''
	), $atts));

	$dataSetup = array();
	
	// Poster image
	if ($poster)
		$poster_attribute = ' poster="'.$poster.'"';
	else
		$poster_attribute = '';
	
	// Watermark image
	if ($brand)
		$brand_attribute = ' brand="'.$brand.'"';
	else
		$brand_attribute = '';
	
	// Watermark url
	if ($brandurl)
		$brandurl_attribute = ' brandurl="'.$brandurl.'"';
	else
		$brandurl_attribute = '';
	
	// Autoplay
	if ($autoplay == "true" || $autoplay == "on")
		$autoplay_attribute = " autoplay";
	else
		$autoplay_attribute = "";
	
	// Controls?
	if ($controls == "false")
		$controls_attribute = "";
	else
		$controls_attribute = " controls";
	
	
	
	// Loop 
	if ($loop == "true" || $loop == "on")
		$loop_attribute = " loop";
	else
		$loop_attribute = "";
	
	// Muted
	if ($muted == "true" || $muted == "on")
		$muted_attribute = "muted";
	else
		$muted_attribute = "";

	// ID 
	if ($id == '')
		$id = 'player_'.rand();
	
	
	//Theme Default
	if($options['videojs_default'] == 'on') { 
		echo '
			<link href="'. plugins_url( 'player/css/default.css' , __FILE__ ) .'" rel="stylesheet">
			<script src="'. plugins_url( 'player/js/video.min.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
			{$videojs}	
_end_;
	}
	//Theme line
	if($options['videojs_line'] == 'on') { 
		echo '
			<link href="'. plugins_url( 'player/css/line.css' , __FILE__ ) .'" rel="stylesheet">
			<script src="'. plugins_url( 'player/js/video.min.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
			{$videojs}	
_end_;
	}
	//Theme Flix
	if($options['videojs_flix'] == 'on') { 
		echo '
			<link href="'. plugins_url( 'player/css/flix.css' , __FILE__ ) .'" rel="stylesheet">
			<script src="'. plugins_url( 'player/js/video.min.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
			{$videojs}	
_end_;
	}
	//Theme Round
	if($options['videojs_round'] == 'on') { 
		echo '
			<link href="'. plugins_url( 'player/css/round.css' , __FILE__ ) .'" rel="stylesheet">
			<script src="'. plugins_url( 'player/js/video.min.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		<!-- Theme Round -->
			{$videojs}	
		<!-- Theme Round -->
_end_;
	}
	//Theme classic
	if($options['videojs_classic'] == 'on') { 
		echo '
			<link href="'. plugins_url( 'player/css/classic.css' , __FILE__ ) .'" rel="stylesheet">
			<script src="'. plugins_url( 'player/js/video.min.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		<!-- Theme classic -->
			{$videojs}	
		<!-- Theme classic -->
_end_;
	}
	
	

	// HLS
	if ($hls)
		$hls_source = '<source src="'.$hls.'" label="'.$hls_label.'" type="application/x-mpegURL">';
	else
		$hls_source = '';
	
	// MPEG-DASH
	if ($mpeg)
		$mpeg_source = '<source src="'.$mpeg.'" label="'.$mpg_label.'" type="application/dash+xml">';
	else
		$mpeg_source = '';
	
	// Captions/Subtitles
	if ($cap)
		$cap_source = '<track kind="captions" src="'.$cap.'" label="'.$cap_label.'">';
	else
		$cap_source = '';
	
	if ($cap_2)
		$cap_2_source = '<track kind="captions" src="'.$cap_2.'" label="'.$cap_2_label.'">';
	else
		$cap_2_source = '';
	
	if ($cap_3)
		$cap_3_source = '<track kind="captions" src="'.$cap_3.'" label="'.$cap_3_label.'">';
	else
		$cap_3_source = '';
	
	if ($cap_4)
		$cap_4_source = '<track kind="captions" src="'.$cap_4.'" label="'.$cap_4_label.'">';
	else
		$cap_4_source = '';
	
	if ($cap_5)
		$cap_5_source = '<track kind="captions" src="'.$cap_5.'" label="'.$cap_5_label.'">';
	else
		$cap_5_source = '';
	
	if ($cap_6)
		$cap_6_source = '<track kind="captions" src="'.$cap_6.'" label="'.$cap_6_label.'">';
	else
		$cap_6_source = '';
	

	//Playlist
	if ($Playlist)
		$Playlist_source = '<source src="'.$mp4.'" label="'.$mp4_label.'" type="video/mp4" />';
	else
		$Playlist_source = '';

	//MP4
	if ($mp4)
		$mp4_source = '<source src="'.$mp4.'" label="'.$mp4_label.'" type="video/mp4" />';
	else
		$mp4_source = '';

	if ($mp4_2)
		$mp4_2_source = '<source src="'.$mp4_2.'" label="'.$mp4_2_label.'" type="video/mp4" />';
	else
		$mp4_2_source = '';
	
	if ($mp4_3)
		$mp4_3_source = '<source src="'.$mp4_3.'" label="'.$mp4_3_label.'" type="video/mp4" />';
	else
		$mp4_3_source = '';
	
	if ($mp4_4)
		$mp4_4_source = '<source src="'.$mp4_4.'" label="'.$mp4_4_label.'" type="video/mp4" />';
	else
		$mp4_4_source = '';
	
	if ($mp4_5)
		$mp4_5_source = '<source src="'.$mp4_5.'" label="'.$mp4_5_label.'" type="video/mp4" />';
	else
		$mp4_5_source = '';
	
	if ($mp4_6)
		$mp4_6_source = '<source src="'.$mp4_6.'" label="'.$mp4_6_label.'" type="video/mp4" />';
	else
		$mp4_6_source = '';


	
	

	// FLV 
	if ($flv){
		echo '
			<script src="'. plugins_url( 'player/js/flash.min.js' , __FILE__ ) .'"></script>
		';
		$flv_source = '<source src="'.$flv.'" label="'.$flv_label.'" type="video/x-flv" />';
	}
	else
		$flv_source = '';
	
	if ($flv_2)
		$flv_2_source = '<source src="'.$flv_2.'" label="'.$flv_2_label.'" type="video/x-flv" />';
	else
		$flv_2_source = '';
	
	if ($flv_3)
		$flv_3_source = '<source src="'.$flv_3.'" label="'.$flv_3_label.'" type="video/x-flv" />';
	else
		$flv_3_source = '';
	
	if ($flv_4)
		$flv_4_source = '<source src="'.$flv_4.'" label="'.$flv_4_label.'" type="video/x-flv" />';
	else
		$flv_4_source = '';
	
	if ($flv_5)
		$flv_5_source = '<source src="'.$flv_5.'" label="'.$flv_5_label.'" type="video/x-flv" />';
	else
		$flv_5_source = '';
	
	if ($flv_6)
		$flv_6_source = '<source src="'.$flv_6.'" label="'.$flv_6_label.'" type="video/x-flv" />';
	else
		$flv_6_source = '';
	

	
	// MKV
	if ($mkv){
		echo '
			<script src="'. plugins_url( 'player/js/flash.min.js' , __FILE__ ) .'"></script>
		';
		$mkv_source = '<source src="'.$mkv.'" label="'.$mkv_label.'" type="video/webm" />';
	}
	else
		$mkv_source = '';
	
	if ($mkv_2)
		$mkv_2_source = '<source src="'.$mkv_2.'" label="'.$mkv_2_label.'" type="video/webm" />';
	else
		$mkv_2_source = '';
	
	if ($mkv_3)
		$mkv_3_source = '<source src="'.$mkv_3.'" label="'.$mkv_3_label.'" type="video/webm" />';
	else
		$mkv_3_source = '';
	
	if ($mkv_4)
		$mkv_4_source = '<source src="'.$mkv_4.'" label="'.$mkv_4_label.'" type="video/webm" />';
	else
		$mkv_4_source = '';
	
	if ($mkv_5)
		$mkv_5_source = '<source src="'.$mkv_5.'" label="'.$mkv_5_label.'" type="video/webm" />';
	else
		$mkv_5_source = '';
	
	if ($mkv_6)
		$mkv_6_source = '<source src="'.$mkv_6.'" label="'.$mkv_6_label.'" type="video/webm" />';
	else
		$mkv_6_source = '';

	
	
	
	
	// Youtube
	if ($youtube){
		echo '
			<script src="'. plugins_url( 'player/js/youtube.min.js' , __FILE__ ) .'"></script>
		';
		$youtube_source = <<<_end_
		
		<script>
			videojs('{$id}', {
				controls: true,
				techOrder:  ["youtube"],
				sources: [{ "type": "video/youtube", "src": "{$youtube}"}],
			}, function(){
				var player = this;
				player.on('resolutionchange', function(){
					console.info('Source changed')
				})
			});  
		  </script>
		  
_end_;
	}
	else
		$youtube_source = '';


	// Daily Motion :

	if ($dailymotion){
		echo '
			<script src="'. plugins_url( 'player/js/dailymotion.js' , __FILE__ ) .'"></script>
		';
		$dailymotion_source = <<<_end_
		
		<script>
			videojs('{$id}', {
				controls: true,
				techOrder:  ["dailymotion"],
				sources: [{ "type": "video/dailymotion", "src": "{$dailymotion}"}],
			}, function(){
				var player = this;
				player.on('resolutionchange', function(){
					console.info('Source changed')
				})
			});  
		  </script>
		  
_end_;
	}
	else
		$dailymotion_source = '';


	// Daily Motion 2:

	if ($dailymotion2){
		echo '
			<script src="'. plugins_url( 'player/js/dailymotion.js' , __FILE__ ) .'"></script>
		';
		$dailymotion2_source = <<<_end_
		
		<script>
			videojs('{$id}', {
				controls: true,
				techOrder:  ["dailymotion"],
				sources: [{ "type": "video/dailymotion", "src": "{$dailymotion2}"}],
			}, function(){
				var player = this;
				player.on('resolutionchange', function(){
					console.info('Source changed')
				})
			});  
		  </script>
		  
_end_;
	}
	else
		$dailymotion2_source = '';
	
	

// Wistia :

	if ($wistia){
		echo '
			<script src="'. plugins_url( 'player/js/wistia.js' , __FILE__ ) .'"></script>
		';
		$wistia_source = <<<_end_
		
		<script>
			videojs('{$id}', {
				controls: true,
				techOrder:  ["wistia"],
				sources: [{ "type": "video/wistia", "src": "{$wistia}"}],
			}, function(){
				var player = this;
				player.on('resolutionchange', function(){
					console.info('Source changed')
				})
			});  
		  </script>
		  
_end_;
	}
	else
		$wistia_source = '';
	

// Vimeo :

	if ($vimeo){
		echo '
			<script src="'. plugins_url( 'player/js/vimeo.js' , __FILE__ ) .'"></script>
		';
		$vimeo_source = <<<_end_
		
		<script>
			videojs('{$id}', {
				controls: true,
				techOrder:  ["vimeo"],
				sources: [{ "type": "video/vimeo", "src": "{$vimeo}"}],
			}, function(){
				var player = this;
				player.on('resolutionchange', function(){
					console.info('Source changed')
				})
			});  
		  </script>
		  
_end_;
	}
	else
		$vimeo_source = '';



	// Twitch Tv:

	if ($twitch){
		echo '
			<script src="'. plugins_url( 'player/js/twitch.min.js' , __FILE__ ) .'"></script>
		';
		$twitch_source = <<<_end_
		
		<script>
			videojs('{$id}', {
				controls: true,
				techOrder:  ["twitch"],
				sources: [{ "type": "video/twitch", "src": "{$twitch}"}],
			}, function(){
				var player = this;
				player.on('resolutionchange', function(){
					console.info('Source changed')
				})
			});  
		  </script>
		  
_end_;
	}
	else
		$twitch_source = '';



	// Tiktok :

	if ($tiktok){
		echo '
			<script src="'. plugins_url( 'player/js/tiktok.js' , __FILE__ ) .'"></script>
		';
		$tiktok_source = <<<_end_
		
		<script>
			videojs('{$id}', {
				controls: true,
				techOrder:  ["tiktok"],
				sources: [{ "type": "video/tiktok", "src": "{$tiktok}"}],
			}, function(){
				var player = this;
				player.on('resolutionchange', function(){
					console.info('Source changed')
				})
			});  
		  </script>
		  
_end_;
	}
	else
		$tiktok_source = '';



	// Facebook :

	if ($facebook){
		echo '
			<script src="'. plugins_url( 'player/js/facebook.min.js' , __FILE__ ) .'"></script>
		';
		$facebook_source = <<<_end_
		
		<script>
			videojs('{$id}', {
				controls: true,
				techOrder:  ["facebook"],
				sources: [{ "type": "video/facebook", "src": "{$facebook}"}],
			}, function(){
				var player = this;
				player.on('resolutionchange', function(){
					console.info('Source changed')
				})
			});  
		  </script>
		  
_end_;
	}
	else
		$facebook_source = '';
	

   
   // Twitter:

	if ($twitter)
		$twitter_source = '<source src="'.$twitter.'"  type="video/mp4">';
	else
		$twitter_source = '';


	// Instagram:
	
	if ($instagram)
		$instagram_source = '<source src="'.$instagram.'"  type="video/mp4">';
	else
		$instagram_source = '';



	// Google Drive
	if ($gdrive)
		$gdrive_source = '<source src="'.$gdrive.'"  type="video/mp4">';
	else
		$gdrive_source = '';

	
	// Player Output
	$videojs = <<<_end_
	<video id="{$id}" class="video-js vjs-default-skin vjs-big-play-centered" width="{$width}" height="{$height}"  preload="auto" poster="{$poster}" {$autoplay_attribute}{$controls_attribute}{$loop_attribute}{$muted_attribute} playsInline data-setup='{}'>
		{$mp4_6_source}
		{$mp4_5_source}
		{$mp4_4_source}
		{$mp4_3_source}
		{$mp4_2_source}
		{$mp4_source}
		{$Playlist_source}
		{$flv_6_source}
		{$flv_5_source}
		{$flv_4_source}
		{$flv_3_source}
		{$flv_2_source}
		{$flv_source}
		{$mkv_6_source}
		{$mkv_5_source}
		{$mkv_4_source}
		{$mkv_3_source}
		{$mkv_2_source}
		{$mkv_source}
		{$hls_source}
		{$mpeg_source}
		{$cap_source}
		{$cap_2_source}
		{$cap_3_source}
		{$cap_4_source}
		{$cap_5_source}
		{$cap_6_source}
		{$gdrive_source}
		
	</video>
		{$youtube_source}
		{$dailymotion_source}
		{$dailymotion2_source}
		{$dailymotion_source}
		{$wistia_source}
		{$vimeo_source}
		{$facebook_source}
		{$tiktok_source}
		{$instagram_source}
		{$twitch_source}
		{$twitter_source}
		<script>
			var player = videojs('#{$id}'); 
		</script>

_end_;
	
	//Playback Speed
	if($options['videojs_prate'] == 'on') { 
		$videojs = <<<_end_
		<video id="{$id}" class="video-js vjs-default-skin vjs-big-play-centered" width="{$width}" height="{$height}"  preload="auto" poster="{$poster}" {$autoplay_attribute}{$controls_attribute}{$loop_attribute}{$muted_attribute} playsInline  data-setup='{"playbackRates": [0.5, 1, 1.5, 2, 4]}'>
		{$mp4_6_source}
		{$mp4_5_source}
		{$mp4_4_source}
		{$mp4_3_source}
		{$mp4_2_source}
		{$mp4_source}
		{$Playlist_source}
		{$flv_6_source}
		{$flv_5_source}
		{$flv_4_source}
		{$flv_3_source}
		{$flv_2_source}
		{$flv_source}
		{$mkv_6_source}
		{$mkv_5_source}
		{$mkv_4_source}
		{$mkv_3_source}
		{$mkv_2_source}
		{$mkv_source}
		{$hls_source}
		{$mpeg_source}
		{$cap_source}
		{$cap_2_source}
		{$cap_3_source}
		{$cap_4_source}
		{$cap_5_source}
		{$cap_6_source}
		{$gdrive_source}
		
	</video>
		{$youtube_source}
		{$dailymotion_source}
		{$dailymotion2_source}
		{$wistia_source}
		{$vimeo_source}
		{$facebook_source}
		{$twitter_source}
		{$twitch_source}
		{$instagram_source}
		{$tiktok_source}
		<script>
			var player = videojs('#{$id}'); 
		</script>	
_end_;
	}
	
	//Responsive
	if($options['videojs_responsive'] == 'on') { 
	echo '
		<link href="'. plugins_url( 'player/css/plugins/rsp.css' , __FILE__ ) .'" rel="stylesheet">
	';
		$videojs = <<<_end_
			<div class='player_responsive'>
				{$videojs}
			</div>
_end_;
	}
	
	//VAST/VMAP
	if($options['videojs_imaon'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/ads.min.js' , __FILE__ ) .'"></script>
			<script src="'. plugins_url( 'player/js/ima.js' , __FILE__ ) .'"></script>
			<script src="//imasdk.googleapis.com/js/sdkloader/ima3.js"></script>
			
		';
		$videojs = <<<_end_
			{$videojs}
			<script>
				var player = videojs('{$id}');
				var options = {	
				  id: '{$id}',
				  adTagUrl: '{$vast}'
				};
				player.ima(options);
				var contentPlayer =  document.getElementById('{$id}');
				var startEvent = 'click';
				player.one(startEvent, function() {
					player.ima.initializeAdDisplayContainer();
					player.ima.requestAds();
					player.play();
				});
			</script>	
_end_;
	}


	
	//Video Thumbnails
	if ($thumbnails == "true" || $thumbnails == "on"){ 
		echo '
			<script src="'. plugins_url( 'player/js/thumbnails.min.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}		
_end_;
	}
	
	//Watermark
	if($options['videojs_brand_on'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/watermark.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>player.watermark({ file: '{$brand}', clickable: true, url: "{$brandurl}" });</script>
_end_;
	}
	
	//Video Preroll
	if($options['videojs_prerollon'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/ads.min.js' , __FILE__ ) .'"></script>
			<script src="'. plugins_url( 'player/js/preroll.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
			{$videojs}
			<script>
				  player.preroll({
					skipTime:"{$preskip}",
					src:{src:"{$preroll}",type:"video/mp4"},
					href:"{$prehref}",
					adsOptions: {debug:true}
				  });
			</script>
_end_;
	}
	//Disable Download
	if($options['videojs_download'] == 'on') { 
		$videojs = <<<_end_
		{$videojs}	
		<script>
			var myVideo = document.getElementById("{$id}");
			if (myVideo.addEventListener) {
				myVideo.addEventListener('contextmenu', function(e) {
					e.preventDefault();
				}, false);
			} else {
				myVideo.attachEvent('oncontextmenu', function() {
					window.event.returnValue = false;
				});
			}
		</script>	
_end_;
	}
	
	
	
	// Hls/Mpeg Selector 
	if ($selector == "true" || $selector == "on"){ 
		echo '
			<script src="'. plugins_url( 'player/js/http-source-selector.min.js' , __FILE__ ) .'"></script>
			<script src="'. plugins_url( 'player/js/quality-levels.min.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>
		  player.httpSourceSelector();
		</script>	
_end_;
	}
	
	//Picture in Picture
	if($options['videojs_pip'] == 'on') { 
		echo '
			<link href="'. plugins_url( 'player/css/plugins/pip.css' , __FILE__ ) .'" rel="stylesheet">
		';
		$videojs = <<<_end_
		{$videojs}		
_end_;
	}
	
	//Video Preroll (single player)
	if ($sp_preroll == "true" || $sp_preroll == "on"){ 
		echo '
			<script src="'. plugins_url( 'player/js/ads.min.js' , __FILE__ ) .'"></script>
			<script src="'. plugins_url( 'player/js/preroll.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>
				  player.preroll({
					skipTime:"{$sp_preskip}",
					src:{src:"{$sp_presource}",type:"video/mp4"},
					href:"{$sp_prehref}",
					adsOptions: {debug:true}
				  });
			</script>	
_end_;
	}
	
	//Remember Playback
	if($options['videojs_resume'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/remember.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>
			player.remember({"localStorageKey": "videojs.remember.{$rnum}"});
		</script>	
_end_;
	}
	
	//Download Button
	if($options['videojs_download_btn'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/download.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>
		  player.downloadButton();
		</script>	
_end_;
	}
	
	//Remember Volume
	if($options['videojs_volume'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/volume.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>
			player.persistvolume({
				namespace: "set volume"
			});
		  </script>	
_end_;
	}
	
	
	//Resolution Button
	if($options['videojs_res'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/resolution.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>
			player.videoJsResolutionSwitcher()
		</script> 
_end_;
	}
	
	
	//Backward
	if($options['videojs_back'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/seek-buttons.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>
			player.seekButtons({
					back: {$back_time}
			});
		 </script>
_end_;
	}
	//Forward
	if($options['videojs_forward'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/seek-buttons.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>
			player.seekButtons({
					forward: {$forward_time}
			});
		  </script>
_end_;
	}
	//Share
	if($options['videojs_share'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/share.js' , __FILE__ ) .'"></script>
			<script src="'. plugins_url( 'player/js/social.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>player.share();</script>
_end_;
	}
	//Toggle button
	if($options['videojs_toggle'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/toggle.min.js' , __FILE__ ) .'"></script>
			<script src="'. plugins_url( 'player/js/jquery.min.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>
			(function(window, videojs) {
			  player.theaterToggle({
				"saveTheaterState" : true,
				"localItemName" : 'theaterVideoState'
			  });
			  player.on("theaterMode",function(){
				if(player.theaterToggle().isTheater()){
				  player.fluid(true);
				}else {
				  player.fluid(false);
				}
			  });
			}(window, window.videojs));
		</script>
_end_;
	}
	//Fixed Player
	if($options['videojs_fixed'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/fixed.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		<div id="beez_fixed_nw"></div>
		<div id="beez_fixed">
			{$videojs}	
		</div>	
_end_;
	}
	
	//Age Lock
	if($options['videojs_age'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/age.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>
		  var player = videojs('{$id}');
		  var minimumDate = new Date();
		  minimumDate.setFullYear(minimumDate.getFullYear() - 18);

		  player.ageGate({
			minDate: minimumDate,
			promptMessage: '{$age_wl}',
			deniedMessage: '{$age_er}'
		  });

		</script>
_end_;
	}
	//DVR
	if($options['videojs_dvr'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/dvr.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>
		  player.dvrseekbar();
		</script>
_end_;
	}

	//Controls on top
	if($options['videojs_controls_ontop'] == 'on') { 
		echo '
			<link href="'. plugins_url( 'player/css/plugins/ontop.css' , __FILE__ ) .'" rel="stylesheet">
		';
		$videojs = <<<_end_
		{$videojs}	
_end_;
	}
	//Inline Text
	if($options['videojs_marker'] == 'on') { 
		echo '
			<script src="'. plugins_url( 'player/js/markers.js' , __FILE__ ) .'"></script>
		';
		$videojs = <<<_end_
		{$videojs}	
		<script>
		   player.markers({
			  markerTip:{
				 display: true,
				 text: function(marker) {
					return "" + marker.text;
				 }
			  },
			  breakOverlay:{
				 display: true,
				 displayTime: {$marker_time},
				 text: function(marker) {
					return "" + marker.text;
				 }
			  },
			  onMarkerReached: function(marker) {
				 $('.event-list').append("<div>marker reached: " + marker.text + "</div>");

			  },
			  onMarkerClick: function(marker){
				 $('.event-list').append("<div>marker clicked: " + marker.text + "</div>");

			  },
			  markers: [
				 {
					time: {$marker_sec1},
					text: "{$marker_tx1}"
				 }
			  ]
		   });
		</script>
_end_;
	}

	//HTML Ads
	if($options['videojs_htmlads'] == 'on') { 
		$videojs = <<<_end_
		<div class="vidmain">	
			{$videojs}	
			<div id="ads_overlay"> 
				<button onclick="myClosebtn()"><span class="icon-cancel-circled"></span></button>
				<div class="ads_code"> 
					{$htmlads_code} 
				</div> 
			</div> 
		</div>
		<script>
			function myClosebtn() {
				var x = document.getElementById('ads_overlay');
					x.style.display = 'none';
			}
		</script>
_end_;
	}

	
	return $videojs;
}	


}
add_action( 'wp_enqueue_scripts', 'register_videojs' );

function tbplayer_header(){

}

/* Main settings */
include_once($plugin_dir . 'settings.php');

/* Player Style */
function tbplayer_theme_style() {
	$options = get_option('videojs_options');
	
	if($options['videojs_c_1'] != "" || $options['videojs_c_2'] != "" || $options['videojs_c_3'] != "" || $options['videojs_c_4'] != "" || $options['videojs_c_5'] != "" || $options['videojs_c_6'] != "" || $options['videojs_c_7'] != "" || $options['videojs_c_8'] != "" || $options['videojs_c_9'] != "" || $options['videojs_c_10'] != "" || $options['videojs_c_11'] != "" || $options['videojs_c_12'] != "" || $options['videojs_c_13'] != "" || $options['videojs_c_14'] != "" || $options['videojs_c_15'] != "" || $options['videojs_c_16'] != "" || $options['videojs_c_17'] != "" || $options['videojs_c_18'] != "" || $options['videojs_c_19'] != "" || $options['videojs_c_20'] != "" || $options['videojs_c_21'] != "" || $options['videojs_c_22'] != "" || $options['videojs_c_23'] != "" || $options['videojs_c_24'] != "" || $options['videojs_c_25'] != "" || $options['videojs_c_26'] != "") 
	{
		echo "
			<style type='text/css'>			
				.vjs-default-skin .vjs-control-bar { background-color: " . $options['videojs_c_1'] . " !important }
				.vjs-default-skin .vjs-control-bar { color: " . $options['videojs_c_2'] . " !important }
				.vjs-download-button-control:before { color: " . $options['videojs_c_2'] . " !important }
				.video-js .vjs-control:focus:before, .video-js .vjs-control:hover:before, .video-js .vjs-control:focus { color: " . $options['videojs_c_3'] . " !important }
				.vjs-big-play-centered .vjs-big-play-button:hover { color: " . $options['videojs_c_26'] . " !important }
				.vjs-big-play-centered .vjs-big-play-button { color: " . $options['videojs_c_4'] . " !important }
				.video-js .vjs-time-tooltip, .video-js .vjs-mouse-display:after, .video-js .vjs-play-progress:after { color: " . $options['videojs_c_5'] . " !important; background-color: " . $options['videojs_c_6'] . " !important }
				.vjs-mouse-display .vjs-time-tooltip, .video-js .vjs-progress-control .vjs-mouse-display:after { color: " . $options['videojs_c_7'] . " !important; background-color: " . $options['videojs_c_8'] . " !important }
				.video-js .vjs-volume-level { background-color: " . $options['videojs_c_9'] . " !important }
				.vjs-volume-bar.vjs-slider-horizontal { background-color: " . $options['videojs_c_10'] . " !important }
				.video-js.vjs-videojs-share_open .vjs-modal-dialog .vjs-modal-dialog-content{ background: " . $options['videojs_c_11'] . " !important }
				.rrssb-buttons li a .rrssb-icon svg circle, .rrssb-buttons li a .rrssb-icon svg path { fill: " . $options['videojs_c_12'] . " !important }
				.video-js.vjs-videojs-share_open .vjs-modal-dialog .vjs-close-button { color: " . $options['videojs_c_13'] . " !important }
				.video-js .vjs-play-progress { background-color: " . $options['videojs_c_14'] . " !important }
				.video-js .vjs-slider { background: " . $options['videojs_c_15'] . " !important }
				.video-js .vjs-load-progress { background: " . $options['videojs_c_16'] . " !important }				
				.vjs-menu-button-popup .vjs-menu .vjs-menu-content { background: " . $options['videojs_c_18'] . " !important }
				.vjs-menu li { color: " . $options['videojs_c_19'] . " !important }
				.vjs-menu li.vjs-menu-item:focus, .vjs-menu li.vjs-menu-item:hover { color: " . $options['videojs_c_24'] . " !important; background: " . $options['videojs_c_20'] . " !important }
				.video-js .vjs-volume-level:before{ background: " . $options['videojs_c_25'] . " !important }		
				.vjs-current-time-display { color: " . $options['videojs_c_21'] . " !important }
				.vjs-duration-display { color: " . $options['videojs_c_22'] . " !important }
				.vjs-time-divider { color: " . $options['videojs_c_23'] . " !important }
				.vjs-progress-control:hover .vjs-play-progress:before {background: " . $options['videojs_c_17'] . " !important;}
			</style>
		";
	}
}
add_action( 'wp_head', 'tbplayer_theme_style' );

/* Shortcodes */
add_shortcode('tbplayer', 'video_shortcode');
$options = get_option('videojs_options');



/* Tinymce */
function tbplayer_button() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter('mce_external_plugins', 'tbplayer_mce_plugin');
		add_filter('mce_buttons', 'register_tbplayer_button');
	}
}

/* Buttons */
add_action('init', 'tbplayer_button');
function register_tbplayer_button($buttons) {
	array_push($buttons, "|", "videojs");
	$options = get_option('videojs_options');
	echo('<div style="display:none"><input type="hidden" id="videojs-autoplay-default" value="' . $options['videojs_autoplay'] . '"><input type="hidden" id="videojs-preload-default"></div>'); 
	return $buttons;
}

/* Inputs */
function tbplayer_mce_plugin($plugin_array) {
	$plugin_array['videojs'] = plugins_url( 'input.js' , __FILE__ );
	return $plugin_array;
}

?>