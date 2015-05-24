// Require dependencies
var gulp = require( 'gulp'),
    coffee = require( 'gulp-coffee' ),
    compass = require( 'gulp-compass'),
    livereload = require( 'gulp-livereload');

// Compile scss to css
gulp.task( 'css', function() {
    return gulp.src( 'assets/sass/main.scss' )
        .pipe( compass( {
            css: 'assets/css',
            sass: 'assets/sass',
            image: 'assets/img'
        } ) )
        .pipe( gulp.dest( 'assets/css' ) );
} );

// Compile coffeescript to javascript
gulp.task( 'coffee', function() {
    return gulp.src( 'assets/js/app.coffee')
        .pipe( coffee() )
        .pipe( gulp.dest( 'assets/js' ) );
} );

// Watch changes
gulp.task( 'watch', function(){
    gulp.watch( 'assets/js/app.coffee', [ 'coffee' ] );
    gulp.watch( 'assets/sass/*.scss', [ 'css' ] );
} );

// Default task
gulp.task( 'default', [ 'css', 'coffee' ], function() {} );