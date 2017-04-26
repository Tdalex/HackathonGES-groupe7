var gulp = require('gulp');
var browserify = require('gulp-browserify');
var concat = require('gulp-concat');
var sass = require('gulp-sass');
var refresh = require('gulp-livereload');
var minifyCSS = require('gulp-minify-css');
var image = require('gulp-image');

var path = {
  js : ['./src/js/*.js'],
  stylesheets : ['./src/stylesheets/*.scss', './src/stylesheets/*.css'],
  img: ['./src/img/*.jpg', './src/img/*.png', './src/img/*.jpeg']
};

gulp.task('images', function () {
  gulp.src(path.img)
  .pipe(image())
  .pipe(gulp.dest('dist/build/img'));
});

gulp.task('scripts', function() {
    gulp.src(path.js)
        .pipe(browserify())
        .pipe(concat('app.bundle.js'))
        .pipe(gulp.dest('dist/build/js'));
});

gulp.task('styles', function() {
    gulp.src(path.stylesheets)
        .pipe(sass().on('error', sass.logError))
        .pipe(minifyCSS())
        .pipe(concat('app.bundle.css'))
        .pipe(gulp.dest('dist/build/css'));
});

gulp.task('default', function() {
    gulp.run('scripts', 'styles', 'images');

    gulp.watch('./src/js/**', function(event) {
        gulp.run('scripts');
    });

    gulp.watch('./src/stylesheets/**', function(event) {
        gulp.run('styles');
    });
});
