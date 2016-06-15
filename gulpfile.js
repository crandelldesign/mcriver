var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    // Build Stylesheet
    mix.sass(
		'stylesheet.scss',
		'public/css/stylesheet.css',
		{
	        includePaths: [
	            'node_modules/bootstrap-sass/assets/stylesheets/',
	            'node_modules/font-awesome/scss/'
	        ]
      	}
    );
    // Build Admin Stylesheet
    mix.sass(
		'admin.scss',
		'public/css/admin.css',
		{
	        includePaths: [
	            'node_modules/bootstrap-sass/assets/stylesheets/',
	            'node_modules/font-awesome/scss/'
	        ]
      	}
    );
    // Copy Bootstrap's JS
    mix.copy('node_modules/bootstrap-sass/assets/javascripts/*.js', 'resources/assets/js/bootstrap');
    // Copy Handlebars's JS
    mix.copy('node_modules/handlebars/dist/*.js', 'resources/assets/js/handlebars');
    // Build JS
    mix.scripts(
		[
	        'jquery-2.2.0.min.js',
	        'bootstrap/bootstrap.js'
		],
		'public/js/master.js'
    );
    // Build Admin JS
    mix.scripts(
		[
	        'jquery-2.2.0.min.js',
	        'bootstrap/bootstrap.js',
	        'adminlte/app.js',
	        'jquery.nestable.js',
            'handlebars/handlebars.js'
		],
		'public/js/admin.js'
    );

    // Copy Fonts
	mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/fonts/bootstrap');
	mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

    // Create Build Numbers
    mix.version(['css/stylesheet.css', 'css/admin.css', 'js/master.js', 'js/admin.js']);

    // Copy Fonts for Build Numbers
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/build/fonts/bootstrap');
	mix.copy('node_modules/font-awesome/fonts', 'public/build/fonts');
});
