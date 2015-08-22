<?php

class KokenFBComments extends KokenPlugin {
  function __construct()
	{
		$this->require_setup = true;
		$this->register_hook('after_opening_body', 'render_js');
		//$this->register_hook('before_closing_body', 'render_div');
    $this->register_hook('discussion', 'render_div');
	}

	function render_div($item)
	{
    $locale = $this->data->locale;
    if (!isset($locale)) {
      $locale = "en_US";
    }
		echo <<<OUT
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/{$locale}/sdk.js#xfbml=1&version=v2.4";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
OUT;
    $width = $this->data->width;
		if (!isset($width)) {
			$width = '100%';
		}
		if ($width === '0') {
			$width = "100%";
		}
    $posts = $this->data->posts;
    if (!isset($posts)) {
        $posts = "5";
    }
    $color = $this->data->scheme;
    if (!isset($color)) {
        $color = "light";
    }
    echo '<div class="fb-comments" data-href="'.$item['url'].'"'.
          ' data-width="'.$width.'"'.
          ' data-colorscheme="'.$color.'"'.
          ' data-numposts="'.$posts.'"></div>';
	}

	function render_js()
	{
	}
}
