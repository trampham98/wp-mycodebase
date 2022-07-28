var gulp         = require('gulp');
var sass         = require('gulp-sass')(require('sass'));
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps   = require('gulp-sourcemaps');
var cleanCSS     = require('gulp-clean-css');

function stylesheet() {
  return gulp
    .src('./assets/scss/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer('last 2 versions'))
    // .pipe(cleanCSS())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./assets/css'));
}

function widget_stylesheet() {
  return gulp
    .src('./includes/widgets/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer('last 2 versions'))
    // .pipe(cleanCSS())
    // .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./includes/widgets'));
}

// watch
gulp.task( 'watch', function() {
  gulp.watch(['./assets/scss/**/*.scss', './includes/widgets/**/*.scss'], stylesheet);
  gulp.watch(['./assets/scss/**/*.scss', './includes/widgets/**/*.scss'], widget_stylesheet);
});

exports.style = stylesheet;