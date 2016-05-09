var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var browserSync = require('browser-sync').create();

gulp.task('default', ['styles', 'scripts'], function() {
  gulp.watch('sass/**/*.scss', ['styles']);
  gulp.watch('js/**/*.js', ['scripts']);
});

gulp.task('scripts', function(){
  gulp.src('js/**/*.js')
  .pipe(concat('app.js'))
  .pipe(gulp.dest('dist/public/js'));
});

gulp.task('styles', function(){
  gulp.src('sass/stylesheet.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['last 2 versions']
    }))
    .pipe(gulp.dest('dist/public/css'));
});

// Add uglify later
// add imagemin later
