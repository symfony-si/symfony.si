var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();

var config  = {
    bowerDir: 'bower_components',
    assetsDir: 'app/Resources/assets',
    cssPattern: 'css/**/*.css',
    jsPattern: 'js/**/*.js',
    production: !!plugins.util.env.production
};

gulp.task('styles', function() {
    gulp.src([
        config.bowerDir+'/bootstrap/dist/css/bootstrap.min.css',
        config.assetsDir+'/'+config.cssPattern
    ])
        .pipe(plugins.if(config.production, plugins.plumber()))
        .pipe(config.production ? plugins.cleanCss({compatibility: 'ie8'}) : plugins.util.noop())
        .pipe(plugins.concat('app.css'))
        .pipe(gulp.dest('web/css'));
});

gulp.task('scripts', function() {
    gulp.src([
        config.bowerDir+'/jquery/dist/jquery.min.js',
        config.bowerDir+'/bootstrap/dist/js/bootstrap.min.js',
        config.assetsDir+'/'+config.jsPattern
    ])
        .pipe(plugins.if(config.production, plugins.plumber()))
        .pipe(plugins.concat('app.js'))
        .pipe(config.production ? plugins.uglify() : plugins.util.noop())
        .pipe(gulp.dest('web/js'));
});

gulp.task('watch', function() {
    gulp.watch(config.assetsDir+'/'+config.cssPattern, ['styles']);
    gulp.watch(config.assetsDir+'/'+config.jsPattern, ['scripts']);
});

gulp.task('default', ['styles', 'scripts', 'watch']);
