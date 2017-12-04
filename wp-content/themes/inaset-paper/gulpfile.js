require('dotenv').config();

var gulp = require('gulp'),
	sass = require('gulp-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	cssmin = require('gulp-cssmin'),
    connect = require('gulp-connect');

var watch = require('gulp-watch');
var concat = require('gulp-concat');

var wpPot = require('gulp-wp-pot');
var sort = require('gulp-sort');


var gutil = require('gulp-util');

// Needs to add tasks for build and makepot

gulp.task('styles', function () {
	return gulp.src('source/**/style.scss')
	.pipe(sass().on('error', sass.logError))
	.pipe(concat('style.css'))
	.pipe(autoprefixer())
	.pipe(cssmin())
	.pipe(gulp.dest('./'))
        .pipe(connect.reload());
});


gulp.task('makepot', function () {
    return gulp.src('**/*.php')
        .pipe(sort())
        .pipe(wpPot( {
            domain: 'inaset',
        } ))
        .pipe( gulp.dest( 'languages/inaset.pot' ));
});

gulp.task('editor-styles', function () {
	return gulp.src('source/**/editor-style.scss')
	.pipe(sass().on('error', sass.logError))
	.pipe(concat('editor-style.css'))
	.pipe(autoprefixer())
	.pipe(cssmin())
	.pipe(gulp.dest('./'))
        .pipe(connect.reload());
});

gulp.task('ie', function () {
	return gulp.src('source/**/ie.scss')
	.pipe(sass().on('error', sass.logError))
	.pipe(concat('ie.css'))
	.pipe(autoprefixer())
	.pipe(cssmin())
	.pipe(gulp.dest('./'))
        .pipe(connect.reload());
});

gulp.task( 'webserver', function() {
    connect.server({
        livereload: true,
        port: process.env.PORT
    });
});

gulp.task('watchStyles', function() {
    gulp.watch( 'source/**/*.scss', ['styles'] );
    gulp.watch( 'source/**/*.scss', ['editor-styles'] );
//    gulp.watch( 'source/**/*.scss', ['ie'] );

    watch([ 'source/**/*.html', 'assets/**/*' ] ).pipe( connect.reload() );
});

gulp.task('default', ['watchStyles', 'webserver']);