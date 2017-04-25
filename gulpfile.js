var gulp = require('gulp');
var browserify = require('gulp-browserify');
var concat = require('gulp-concat');
var sass = require('gulp-sass');
var refresh = require('gulp-livereload');
var minifyCSS = require('gulp-minify-css');

var path = {
  js : ['./src/js/*.js'],
  stylesheets : ['./src/stylesheets/*.scss', './src/stylesheets/*.css']
};

gulp.task('scripts', function() {
    gulp.src(path.js)
        .pipe(browserify())
        .pipe(concat('app.bundle.js'))
        .pipe(gulp.dest('dist/build'));
});

gulp.task('styles', function() {
    gulp.src(path.stylesheets)
        .pipe(sass().on('error', sass.logError))
        .pipe(minifyCSS())
        .pipe(concat('app.bundle.css'))
        .pipe(gulp.dest('dist/build'));
});

gulp.task('default', function() {
    gulp.run('scripts', 'styles');

    gulp.watch('./src/js/**', function(event) {
        gulp.run('scripts');
    });

    gulp.watch('./src/stylesheets/**', function(event) {
        gulp.run('styles');
    });
});
