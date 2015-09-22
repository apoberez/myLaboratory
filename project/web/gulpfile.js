var gulp = require('gulp');

var babelify = require('babelify');
var browserify = require('browserify');
var source = require('vinyl-source-stream');

gulp.task('modules', function() {
    browserify({
        entries: './src/js/pages/parser.js',
        debug: true
    })
        .transform(babelify)
        .bundle()
        .pipe(source('parser.js'))
        .pipe(gulp.dest('./dist'));
});


gulp.task('watch', function(){
    gulp.watch('src/**/*.*', ['modules']);
});