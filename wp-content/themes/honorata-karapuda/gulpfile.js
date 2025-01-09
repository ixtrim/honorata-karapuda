const gulp = require('gulp');
const babel = require('gulp-babel');
const sass = require('gulp-sass')(require('node-sass'));
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const terser = require('gulp-terser');
const svgmin = require('gulp-svgmin');
const newer = require('gulp-newer');

// Compile and minify theme-wide JS (excluding blocks)
gulp.task('babel-theme', function () {
  return gulp
    .src(['assets/src/js/**/*.js', '!assets/src/js/blocks/**/*.js'])
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ['@wordpress/default'],
    }))
    .pipe(concat('theme.js'))
    .pipe(terser())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('assets/dist/js'));
});

// Compile theme-wide SCSS to CSS (excluding blocks)
const css = function () {
  return gulp
    .src('./assets/src/scss/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        outputStyle: 'compressed',
      }).on('error', sass.logError)
    )
    .pipe(autoprefixer())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('assets/dist/css'));
};

// Copy and optimize images
const images = function () {
  return gulp
    .src('./assets/src/images/**/*')
    .pipe(newer('assets/dist/images'))
    .pipe(gulp.dest('assets/dist/images'));
};

// Minify SVG files
const svg = function () {
  return gulp
    .src('./assets/src/images/**/*.svg')
    .pipe(svgmin())
    .pipe(gulp.dest('assets/dist/images'));
};

// Watch for changes and reload browser
const watch = function (cb) {
  browserSync.init({
    proxy: 'http://honorata.karapuda/',
  });

  gulp.watch('./assets/src/scss/**/*.scss', gulp.series(css)).on('change', browserSync.reload);
  gulp.watch(['./assets/src/js/**/*.js'], gulp.series('babel-theme')).on('change', browserSync.reload);
  gulp.watch('./assets/src/images/**/*', gulp.series(images, svg)).on('change', browserSync.reload);
  gulp.watch('./*.php').on('change', browserSync.reload);
  gulp.watch('./*/*.php').on('change', browserSync.reload);
  cb();
};

// Export tasks
exports.css = css;
exports.cssBlocks = cssBlocks;
exports.images = images;
exports.svg = svg;
exports.watch = watch;
exports.default = gulp.series(css, cssBlocks, 'babel-theme', 'babel-blocks', images, svg, watch);
