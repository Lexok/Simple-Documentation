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
    runSequence = require('run-sequence');


// Folders
const ROOT = path.join(__dirname, 'theme');
const ASSETS = path.join(ROOT, 'assets');
const JS = path.join(ASSETS, 'js');

// Globs
const JS_FILES = [ path.join(JS, '*.js'), '!' + path.join(JS, '*.min.js') ];
const PHP_FILES = [ path.join(ROOT, '**/*.php') ];


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
 *  Main Tasks
 */
gulp.task('build', ['js:build:production']);
gulp.task('lint', function() {
    runSequence('php:lint', 'js:lint');
});
