module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        jshint: {
            all: [
                'Gruntfile.js',
                'assets/dev/js/main.js',
                '!assets/dev/js/scripts.min.js'
            ]
        },
        sass: {
            dist: {
                options: {
                    style: 'compressed',
                    sourcemap: 'file'
                },
                files: {
                    'assets/dist/css/main.min.css': [
                        'assets/dev/scss/main.scss'
                    ]
                }
            }
        },
        autoprefixer: {
          single_file: {
              src: 'assets/dist/css/main.min.css',
              dest: 'assets/dist/css/main.min.css'
          }
        },
        uglify: {
            options: {
                compress: {}
            },
            build: {
                src: [
                    'node_modules/jquery-match-height/jquery.matchHeight.js',
                    'assets/dev/js/main.js'
                ],
                dest: 'assets/dist/js/scripts.min.js'
            }
        },
        imageoptim: {
            src: [
                'assets/dist/img'
            ],
            options: {
                quitAfter: true
            }
        },
        watch: {
            css: {
                files: 'assets/dev/scss/*.scss',
                tasks: ['sass']
            },
            js: {
                files: [
                    '<%= jshint.all %>'
                ],
                tasks: ['jshint', 'uglify']
            }
        },
        clean: {
            dist: [
                'assets/dist/css/main.min.css',
                'assets/dist/js/scripts.min.js'
            ]
        }
    });

    // Load tasks
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-imageoptim');
    grunt.loadNpmTasks('grunt-autoprefixer');

    // Register tasks
    grunt.registerTask('default', [
        'clean',
        'sass',
        'autoprefixer',
        'uglify'
    ]);
    grunt.registerTask('dev', [
        'watch'
    ]);
    grunt.registerTask('image', [
        'imageoptim'
    ]);

};
