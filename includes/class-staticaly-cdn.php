<?php

class Staticaly_CDN {

	public function convert_core_url($x) {
		return preg_replace('/^(?:https?:)?\/\/[^\s\/]+\/wp-includes\/([^?]+)\?ver=([^&]+)$/', 'https://cdn.staticaly.com/wp/c/$2/wp-includes/$1', $x);
	}

	public function convert_plugins_url($x) {
		return preg_replace('/^(?:https?:)?\/\/[^\s\/]+\/wp-content\/plugins\/([^\/?]+)\/([^?]+)\?ver=([^&]+)$/', 'https://cdn.staticaly.com/wp/p/$1/$3/$2', $x);
	}

	// TODO: You need to have a CDN URL for theme assets!
	public function convert_themes_url($x) {
		return preg_replace('/^(?:https?:)?\/\/[^\s\/]+\/wp-content\/themes\/([^\/?]+)\/([^?]+)\?ver=([^&]+)$/', 'https://cdn.staticaly.com/wp/t/$1/$3/$2', $x);
	}

}