/**
 *  Gulp Config
 */
var gulp = require('gulp'),
    rename = require('gulp-rename'),
    uglify = require('gulp-uglify'),
    gutil = require('gulp-util'),
    path = require('path'),
    eslint = require('gulp-eslint'),
    phpcs = require('gulp-phpcs'),
    runSequence = require('run-sequence'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    postcss = require('gulp-postcss'),
    autoprefixer = require('autoprefixer'),
    scsslint = require('gulp-scss-lint');


// Folders
const ROOT = path.join(__dirname, '');
const ASSETS = path.join(ROOT, 'assets');
const JS = path.join(ASSETS, 'js');
const SCSS = path.join(ROOT, 'scss');
const CSS = path.join(ASSETS, 'css');

// Globs
const JS_FILES = [ path.join(JS, '*.js'), '!' + path.join(JS, '*.min.js') ];
const PHP_FILES = [ path.join(ROOT, '**/*.php') ];
const SCSS_ALL_FILES = [ path.join(SCSS, '**/*.scss') ];
const SCSS_MAIN_FILES = [ path.join(SCSS, '**/*.scss'), '!' + path.join(SCSS, '**/_*.scss') ]


/**
 *  Production-ready JavaScript
 */
gulp.task('js:build:production', function() {
    return gulp.src(JS_FILES)
        .pipe(uglify().on('error', gutil.log))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(JS));
});


/**
 *  JavaScript Linting
 */
gulp.task('js:lint', function() {
    return gulp.src(JS_FILES)
        .pipe(eslint())
        .pipe(eslint.format());
});


/**
 *  PHP Linting
 */
gulp.task('php:lint', function() {
    return gulp.src(PHP_FILES)
        .pipe(phpcs({
            standard: path.join(__dirname, 'phpcs.ruleset.xml')
        }))
        .pipe(phpcs.reporter('log'));
});


/**
 *  Development Version CSS
 */
gulp.task('scss:build:development', function() {
    return gulp.src(SCSS_MAIN_FILES)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([ autoprefixer({ browsers: ['> 5%', 'IE 9'] }) ]))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(CSS));
});


/**
 *  Watch SCSS
 */
gulp.task('scss:watch', ['scss:build:development'], function() {
    return gulp.watch(SCSS_ALL_FILES, ['scss:build:development']);
});


/**
 *  Production ready CSS
 */
gulp.task('scss:build:production', function() {
    return gulp.src(SCSS_MAIN_FILES)
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(postcss([ autoprefixer({ browsers: ['> 5%', 'IE 9'] }) ]))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(CSS));
});


/**
 *  Scss Linting
 */
gulp.task('scss:lint', function() {
    return gulp.src(SCSS_ALL_FILES)
        .pipe(scsslint({
            config: '.scss-lint.yml'
        }));
});


/**
 *  Main Tasks
 */
gulp.task('default', ['scss:watch']);
gulp.task('build', ['js:build:production', 'scss:build:production']);
gulp.task('lint', function() {
    runSequence('php:lint', 'js:lint', 'scss:lint');
});
