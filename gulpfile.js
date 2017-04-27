var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();

var config  = {
    nodeDir: 'node_modules',
    assetsDir: 'app/Resources/assets',
    cssPattern: 'css/**/*.css',
    jsPattern: 'js/**/*.js',
    production: !!plugins.util.env.production,
    url: 'https://symfony.si/',
    appDescription: 'Symfony and PHP local user group',
    appName: 'Symfony Slovenia'

};

var app = {};

app.addStyle = function(paths, outputFilename) {
    gulp.src(paths)
        .pipe(plugins.if(!config.production, plugins.plumber()))
        .pipe(plugins.concat(outputFilename))
        .pipe(config.production ? plugins.cleanCss({compatibility: 'ie8'}) : plugins.util.noop())
        .pipe(gulp.dest('web/assets/css'));
};

app.addScript = function(paths, outputFilename) {
    gulp.src(paths)
        .pipe(plugins.if(!config.production, plugins.plumber()))
        .pipe(plugins.concat(outputFilename))
        .pipe(config.production ? plugins.uglify() : plugins.util.noop())
        .pipe(gulp.dest('web/assets/js'));
};

gulp.task('styles', function() {
  app.addStyle([
      config.nodeDir+'/bootstrap/dist/css/bootstrap.min.css',
      config.nodeDir+'/prismjs/themes/prism-okaidia.css',
      config.assetsDir+'/'+config.cssPattern
    ], 'app.css');
});

gulp.task('scripts', function() {
    // base.html.twig
    app.addScript([
        config.nodeDir+'/jquery/dist/jquery.min.js',
        config.nodeDir+'/bootstrap/dist/js/bootstrap.min.js',
        config.assetsDir+'/'+config.jsPattern,
        config.nodeDir+'/prismjs/prism.js',
        config.nodeDir+'/prismjs/components/prism-php.js',
        config.nodeDir+'/prismjs/components/prism-php-extras.js',
        config.nodeDir+'/prismjs/components/prism-twig.js',
        config.nodeDir+'/prismjs/components/prism-yaml.js',
        config.nodeDir+'/prismjs/components/prism-sql.js',
        config.nodeDir+'/prismjs/components/prism-nginx.js',
        config.nodeDir+'/prismjs/components/prism-markdown.js',
        config.nodeDir+'/prismjs/components/prism-json.js',
        config.nodeDir+'/prismjs/components/prism-ini.js',
        config.nodeDir+'/prismjs/components/prism-http.js',
        config.nodeDir+'/prismjs/components/prism-css-extras.js',
        config.nodeDir+'/prismjs/components/prism-apacheconf.js',
        config.nodeDir+'/prismjs/components/prism-rest.js'
    ], 'app.js');
});

gulp.task('fonts', function() {
    gulp.src([
        config.nodeDir+'/bootstrap/dist/fonts/glyphicons-halflings-regular*'
    ])
        .pipe(gulp.dest('web/assets/fonts'));
});

gulp.task('images', function() {
    gulp.src([
        config.assetsDir+'/img/**/*.*'
    ])
      .pipe(gulp.dest('web/assets/img'));
});

gulp.task("favicons", function () {
    gulp.src(config.assetsDir+"/favicon.png").pipe(plugins.favicons({
        appName: config.appName,
        appDescription: config.appDescription,
        developerName: config.appName,
        developerURL: config.url,
        background: "#ffffff",
        path: "/",
        url: config.url,
        display: "standalone",
        orientation: "portrait",
        version: 1.0,
        logging: false,
        online: false,
        html: "favicon.html",
        pipeHTML: true,
        replace: true
    })).pipe(gulp.dest("web"));
});

gulp.task('watch', function() {
    gulp.watch(config.assetsDir+'/'+config.cssPattern, ['styles']);
    gulp.watch(config.assetsDir+'/'+config.jsPattern, ['scripts']);
});

// build, no watching
gulp.task('build', ['styles', 'scripts', 'fonts', 'images', 'favicons']);

gulp.task('default', ['build', 'watch']);
