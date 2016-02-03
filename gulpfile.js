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
    //mix.sass('app.scss');
    mix.sass(
		'stylesheet.scss',
		'public/css/stylesheet.css',
		{
	        includePaths: [
	            'vendor/twbs/bootstrap-sass/assets/stylesheets/',
	            'vendor/fortawesome/font-awesome/scss/'
	        ],
	        //outputStyle: 'expanded'
      	}
    );
    mix.sass(
		'admin.scss',
		'public/css/admin.css',
		{
	        includePaths: [
	            'vendor/twbs/bootstrap-sass/assets/stylesheets/',
	            'vendor/fortawesome/font-awesome/scss/'
	        ],
	        //outputStyle: 'expanded'
      	}
    );
    //mix.copy('node_modules/motion-ui/dist/motion-ui.js', 'resources/assets/js/foundation');
    mix.copy('vendor/twbs/bootstrap-sass/assets/javascripts/*.js', 'resources/assets/js/bootstrap');
    mix.scripts(
		[
	        'jquery-2.2.0.min.js',
	        'bootstrap/bootstrap.js'
		],
		'public/js/master.js'
    );
    mix.scripts(
		[
	        'jquery-2.2.0.min.js',
	        'bootstrap/bootstrap.js',
	        'adminlte/app.js'
		],
		'public/js/admin.js'
    );

	mix.copy('vendor/twbs/bootstrap-sass/assets/fonts', 'public/fonts/bootstrap');
	mix.copy('vendor/fortawesome/font-awesome/fonts', 'public/fonts');

    mix.version(['css/stylesheet.css', 'css/admin.css', 'js/master.js', 'js/admin.js']);

    //mix.copy('resources/assets/fonts/foundation-icons.*', 'public/build/fonts');
    mix.copy('vendor/twbs/bootstrap-sass/assets/fonts', 'public/build/fonts/bootstrap');
	mix.copy('vendor/fortawesome/font-awesome/fonts', 'public/build/fonts');
});
