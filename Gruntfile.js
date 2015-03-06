'use strict';

module.exports = function (grunt) {

    require('load-grunt-tasks')(grunt);

    require('time-grunt')(grunt);

    grunt.initConfig({
        watch: {
            bower: {
                files: ['bower.json'],
                tasks: ['wiredep']
            },
            js: {
                files: [],
                tasks: ['newer:jshint:all']
            },
            gruntfile: {
                files: ['Gruntfile.js']
            },
            livereload: {
                files: [
                    'resources/views/{,*/}*.php',
                    'public/css/{,*/}*.css'
                ],
                options: {
                    livereload: true
                }
            }
        }
    });

    grunt.registerTask('default', 'watch files', function (target){
        grunt.task.run([
              'watch'
        ]);
    });
};