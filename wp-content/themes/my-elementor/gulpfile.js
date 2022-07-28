var gulp         = require('gulp');
var sass         = require('gulp-sass')(require('sass'));
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps   = require('gulp-sourcemaps');
var cleanCSS     = require('gulp-clean-css');
var concat       = require('gulp-concat');
var minify       = require('gulp-minify');
var browserSync  = require('browser-sync').create();

var config       = require( './gulpconfig.json' );
var vendorCSS    = config.vendorCSS;
var vendorJS     = config.vendorJS;
var localhost    = config.localhost;

gulp.task('stylesheet', function() {
  return gulp
    .src('./assets/scss/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer('last 2 versions'))
    .pipe(cleanCSS())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./assets/css'));
});

gulp.task('minify-vendors-css',function() {
  return gulp.src(vendorCSS)
    .pipe(sourcemaps.init())
    .pipe(cleanCSS())
    .pipe(concat('vendors.css'))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./assets/css'));
});

gulp.task('minify-vendors-js',function() {
  return gulp.src(vendorJS)
    .pipe(minify())
    .pipe(concat('vendors.js'))
    .pipe(gulp.dest('./assets/js'));
});

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

// watch browserSync
gulp.task( 'watch-bs', function() {
  browserSync.init(localhost);
  gulp.watch(['./assets/scss/**/*.scss', './elementor-widgets/**/*.scss'], stylesheet);
  gulp.watch('./**/*.php').on('change', browserSync.reload);
  gulp.watch('./assets/css/*.css').on('change', browserSync.reload);
});

// watch
// gulp.task( 'watch', function() {
//   gulp.watch(['./assets/scss/**/*.scss', './elementor-widgets/**/*.scss'], stylesheet);
// });

function widget_stylesheet() {
  return gulp
    .src('./elementor-widgets/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer('last 2 versions'))
    // .pipe(cleanCSS())
    // .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./elementor-widgets'));
}

// watch
gulp.task( 'watch', function() {
  gulp.watch(['./assets/scss/**/*.scss'], stylesheet);
  gulp.watch(['./elementor-widgets/**/*.scss'], widget_stylesheet);
});

exports.style = stylesheet;