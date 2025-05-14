"use strict";
const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
gulp.task("scss", scssCompile);
gulp.task("watch", watch);
function scssCompile() {
  return gulp
    .src("styles/scss/**/*.scss")
    .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
    .pipe(gulp.dest("assets/css"));
}
function watch() {
  gulp.watch("styles/scss/**/*.scss", scssCompile);
}
