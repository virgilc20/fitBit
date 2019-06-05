// Gruntfile.js from  https://www.sitepoint.com/using-node-mysql-javascript-client/

module.exports = (grunt) => {
  grunt.initConfig({
    execute: {
      target: {
        src: ['app.js']
      }
    },
    watch: {
      scripts: {
        files: ['ClothingSearch.js'],
        tasks: ['execute'],
      },
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-execute');
};
