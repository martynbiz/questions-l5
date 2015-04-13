<?php

return [
	
	/*
	|--------------------------------------------------------------------------
	| Default Active Theme
	|--------------------------------------------------------------------------
	|
	| Assign the default active theme to be used if one is not set during
	| runtime. This is especially useful if you're developing a very basic
	| application that does not require dynamically changing the theme.
	| NOTE: remember also to update the gulpfile.js path to the current theme!
	|
	*/
	
	'active' => 'japantravel',
	
	/*
	|--------------------------------------------------------------------------
	| Templating Engine
	|--------------------------------------------------------------------------
	|
	| Switch between using either Blade or Twig as youe templating engine. To
	| use Twig, be sure to install the twigbridge package and register its
	| service provider BEFORE the Caffeinated Themes service provider.
	|
	| Available Settings: "blade", "twig"
	|
	*/

	'engine' => 'blade',

	/*
	|--------------------------------------------------------------------------
	| Path to Themes
	|--------------------------------------------------------------------------
	|
	| Define the path where you'd like to store your themes. Note that if you
	| choose a path that's outside of your public directory, you will still need
	| to store your assets (CSS, images, etc.) within your public directory.
	|
	*/

	'path' => base_path('themes'),

];