var gulp         = require('gulp');
var sass         = require('gulp-sass')(require('sass'));
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps   = require('gulp-sourcemaps');
var cleanCSS     = require('gulp-clean-css');
var concat       = require('gulp-concat');
var minify       = require('gulp-minify');
var browserSync  = require('browser-sync').create();

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
    .src('./elementor-widgets/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer('last 2 versions'))
    // .pipe(cleanCSS())
    // .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./elementor-widgets'));
}

function minify_vendors_style() {
  return gulp
    .src('./assets/vendors/css/*.css')
    .pipe(sourcemaps.init())
    .pipe(concat('vendors.css'))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./assets/css'));
}

function minify_vendors_script() {
  return gulp
    .src('./assets/vendors/js/*.js')
    .pipe(concat('vendors.js'))
    .pipe(gulp.dest('./assets/js'));
}

// watch
gulp.task( 'watch', function() {
  gulp.watch(['./assets/scss/**/*.scss', './elementor-widgets/**/*.scss'], stylesheet);
  gulp.watch(['./assets/scss/**/*.scss', './elementor-widgets/**/*.scss'], widget_stylesheet);
  gulp.watch(['./assets/scss/**/*.scss', './elementor-widgets/**/*.scss'], minify_vendors_style);
  gulp.watch(['./assets/scss/**/*.scss', './elementor-widgets/**/*.scss'], minify_vendors_script);
});

// watch browserSync
gulp.task( 'watch-bs', function() {
  browserSync.init({
    "proxy": "mywordpress.local"
  });
  gulp.watch(['./assets/scss/**/*.scss', './elementor-widgets/**/*.scss'], stylesheet);
  gulp.watch(['./assets/scss/**/*.scss', './elementor-widgets/**/*.scss'], widget_stylesheet);
  gulp.watch(['./assets/scss/**/*.scss', './elementor-widgets/**/*.scss'], minify_vendors_style);
  gulp.watch(['./assets/scss/**/*.scss', './elementor-widgets/**/*.scss'], minify_vendors_script);

  gulp.watch('./**/*.php').on('change', browserSync.reload);
  gulp.watch('./assets/css/*.css').on('change', browserSync.reload);
  gulp.watch('./elementor-widgets/**/*.css').on('change', browserSync.reload);
});

exports.style = stylesheet;