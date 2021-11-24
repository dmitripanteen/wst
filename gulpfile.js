var
	env = require('minimist')(process.argv.slice(2)),
	gulp = require('gulp'),
	uglify = require('gulp-uglify'),
	concat = require('gulp-concat'),
	gulpif = require('gulp-if'),
	connect = require('gulp-connect'),
	imagemin = require('gulp-imagemin'),
	include = require("gulp-include"),
	del = require('del'),
	less = require('gulp-less'),
	gulpSequence = require('gulp-sequence'),
	replace = require('gulp-replace'),
	gutil = require('gulp-util'),
	sourcemaps = require('gulp-sourcemaps'),
	LessPluginCleanCSS = require('less-plugin-clean-css'),
	LessPluginAutoPrefix = require('less-plugin-autoprefix');

var
	optStatic = env.static || env.s || false,
	optMinify = env.minify || env.m || false,
	optMinifySkipImg = env['minify-skip-img'] || false;

var
	srcDir = 'assets_src/',
	buildDir = optStatic ? 'www/tmp/templates/' : 'www/templates/wst/assets/',
	assetsDir = optStatic ? buildDir + 'assets/' : buildDir,
	cleancss = new LessPluginCleanCSS({
		advanced: true
	}),
	autoprefix = new LessPluginAutoPrefix({
		browsers: ["last 2 versions"]
	});


gulp.task('less', function(){
	return gulp.src(srcDir + 'less/main.less')
		.pipe(gulpif(!optMinify, sourcemaps.init()))
		.pipe(gulpif(
			optMinify,
			less({ plugins: [autoprefix, cleancss] }),
			less({ plugins: [autoprefix] })
		))
		.pipe(gulpif(!optMinify, sourcemaps.write()))
		.pipe(replace('/assets/', '../'))
		.pipe(replace('../../node_modules/mediaelement/build/mejs-controls.svg', '../img/node_modules/mejs-controls.svg'))
		.on('error', function(error){
			console.log(error.toString());
			this.emit('end');
		})
		.on('end', function(){ gutil.log('Compiled ' + assetsDir + 'css'); })
		.pipe(gulp.dest(assetsDir + 'css'))
		.pipe(connect.reload());
});

gulp.task('js', function(){
	return gulp.src(srcDir + 'js/main.js')
		.pipe(concat('main.js'))
		.pipe(include())
		.on('error', console.log)
		.pipe(gulpif(optMinify, uglify({
			compress: false,
			mangle: false
		})))
		.on('end', function(){ gutil.log('Compiled ' + assetsDir + 'js'); })
		.pipe(gulp.dest(assetsDir + 'js/'))
		.pipe(connect.reload());
});

gulp.task('img', function(){
	return gulp.src(srcDir + 'img/**/*')
		.pipe(gulpif(
			optMinify && !optMinifySkipImg,
			imagemin({optimizationLevel: 3, progressive: true, interlaced: true})
		))
		.on('end', function(){
			gutil.log((optMinify && !optMinifySkipImg ? 'Compiled ' : 'Copied ') + assetsDir + 'img');
		})
		.pipe(gulp.dest(assetsDir + 'img'))
		.pipe(connect.reload());
});

gulp.task('img-from-node', function(){
	return gulp.src([
		'node_modules/mediaelement/build/mejs-controls.svg'
	])
		.on('end', function(){ gutil.log('Copied from node_modules to ' + assetsDir + 'img/node_modules'); })
		.pipe(gulp.dest(assetsDir + 'img/node_modules'))
		.pipe(connect.reload());
});

gulp.task('font', function(){
	return gulp.src(srcDir + 'fonts/**/*')
		.pipe(gulp.dest(assetsDir + 'fonts'))
		.pipe(connect.reload());
});

gulp.task('fa-font', function(){
	return gulp.src('node_modules/font-awesome/fonts/*')
		.pipe(gulp.dest(assetsDir + 'fonts'))
		.pipe(connect.reload());
});

gulp.task('clean', function(){
	return del([
		buildDir + '**/*'
	]);
});

gulp.task('monitor', function(){
	gulp.watch(srcDir + 'less/**/*.less', ['less']);
	gulp.watch(srcDir + 'js/**/*.js', ['js']);
	gulp.watch(srcDir + 'html/**/*.html', ['html']);
	gulp.watch(srcDir + 'img/**/*.{jpg,png,gif}', ['img']);
});

gulp.task('html', function(){
	if (! optStatic){ return; }
	
	gulp.src(srcDir + 'samples/**/*')
		.on('end', function(){ gutil.log('Copied samples to ' + buildDir + 'samples'); })
		.pipe(gulp.dest(buildDir + 'samples'))
		.pipe(connect.reload());
	
	return gulp.src([srcDir + 'html/*.html', srcDir + 'html/index.php'])
		.pipe(include())
		.on('error', console.log)
		.on('end', function(){ gutil.log('Compiled ' + buildDir); })
		.pipe(replace('../../samples/', 'samples/'))
		.pipe(replace('../samples/', 'samples/'))
		.pipe(replace('../img/', 'assets/img/'))
		.pipe(gulp.dest('./' + buildDir))
		.pipe(connect.reload());
});

/* copy some libs to admin panel only if not static build */
gulp.task('admin-from-node', function(){
	if (optStatic){ return; }
	
	var admintemplate = 'www/administrator/templates/system/';
	
	gulp.
		src([
			'node_modules/mediaelement/build/mediaelement-and-player.min.js',
			'node_modules/mediaelement/build/mediaelementplayer.min.css',
			'node_modules/mediaelement/build/mejs-controls.svg'
		])
		.on('end', function(){ gutil.log('Copied from node_modules to ' + admintemplate + 'custom'); })
		.pipe(gulp.dest(admintemplate + 'custom'));
	
	return true;
});


// Full build
gulp.task('build', gulpSequence(
	'clean',
	['less', 'js', 'img', 'img-from-node', 'font', 'fa-font', 'html', 'admin-from-node']
));

// Build css and js only (without img and fonts)
gulp.task('update', gulpSequence(
	['less', 'js', 'html']
));

// Watch
gulp.task('watch', ['build', 'monitor']);

// Show help message
gulp.task('help', function(){
	var
		colorGreen = '\x1b[32m',
		colorYellow = '\x1b[33m',
		colorReset = '\x1b[0m',
		echo = function(message){
			return process.stdout.write(message);
		};
	
	echo('\n');
	echo('\n');
	echo(colorYellow + 'Usage:\n' + colorReset);
	echo('  gulp [task] [options]\n');
	echo('\n');
	echo(colorYellow + 'Available tasks:\n' + colorReset);
	echo('  ' + colorGreen + 'build' + colorReset + '   full build\n');
	echo('  ' + colorGreen + 'update' + colorReset + '  build only less/js and html files\n');
	echo('  ' + colorGreen + 'watch' + colorReset + '   full build and watch for auto-rebuild if files changes\n');
	echo('  ' + colorGreen + 'help' + colorReset + '    show this message and quit\n');
	echo('\n');
	echo('Default task (if running without giving any task name) is ' + colorGreen + 'help' + colorReset + '\n');
	echo('\n');
	echo(colorYellow + 'Available options:\n' + colorReset);
	echo('  ' + colorGreen + '-s, --static' + colorReset + '        if set, will put result files to temporary directory, otherwise will put it to main template directory \n');
	echo('  ' + colorGreen + '-m, --minify' + colorReset + '        minify result files\n');
	echo('  ' + colorGreen + '--minify-skip-img' + colorReset + '   if set with --minify option, will skip minifying images, otherwise do nothing\n');
	echo('\n');
	echo('\n');
	
	return true;
});

// Default task
gulp.task('default', ['help']);
