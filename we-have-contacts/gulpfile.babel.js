import {src, dest, watch, series, parallel} from 'gulp';
import zip from "gulp-zip";
import info from "./package.json";
import yargs from 'yargs';
import sass from 'gulp-sass';
import cleanCss from 'gulp-clean-css';
import gulpif from 'gulp-if';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import imagemin from 'gulp-imagemin';
import webpack from 'webpack-stream';
import named from 'vinyl-named';
import browserSync from 'browser-sync';
import del from 'del';
const PRODUCTION = yargs.argv.prod;

export const style = () => {
    return src(['helpers/scss/public.scss', 'helpers/scss/admin.scss'])
     .pipe(gulpif(!PRODUCTION,sourcemaps.init()))
     .pipe(sass().on('error', sass.logError))
     .pipe(gulpif(PRODUCTION,postcss([autoprefixer])))
     .pipe(gulpif(PRODUCTION, cleanCss({compatibility: 'ie8'})))
     .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
     .pipe(dest('dist/css'));
}

export const images = () => {
    return src('helpers/images/**/*.{jpg,jpeg,png,svg,gif}')
    .pipe(gulpif(PRODUCTION, imagemin()))
    .pipe(dest('dist/images'));
}

export const copy = () => {
  return src(['helpers/**/*','!helpers/{images,js,scss}','!helpers/{images,js,scss}/**/*'])
    .pipe(dest('dist'));
}

export const clean = () => {
  return del(['dist']);
}

export const scripts = () => {
    return src(['helpers/js/admin.js','helpers/js/public.js'])
    .pipe(named())
    .pipe(webpack({
      module: {
        rules: [
          {
            test: /\.js$/,
            use: {
              loader: 'babel-loader',
              options: {
                presets: ['@babel/preset-env']
              }
            }
          }
        ]
      },
      mode: PRODUCTION ? 'production' : 'development',
      devtool: !PRODUCTION ? 'inline-source-map' : false,
      output: {
        filename: '[name].js'
      },
      externals: {
        jquery: 'jQuery'
      },
    }))
    .pipe(dest('dist/js'));
  }

  const server = browserSync.create();
  export const serve = done => {
    server.init({
      proxy: "contact.local" // put your local website link here
    });
    done();
  };
  export const reload = done => {
    server.reload();
    done();
  };

export const watchForChanges = () => {
    watch('helpers/scss/**/*.scss', series(style, reload));
    watch('helpers/images/**/*.{jpg,jpeg,png,svg,gif}', series(images, reload));
    watch(['helpers/**/*','!helpers/{images,js,scss}','!helpers/{images,js,scss}/**/*'], series(copy, reload));
    watch('helpers/js/**/*.js', series(scripts, reload));
    watch('**/*.php', reload);
}

export const compress = () => {
  return src([
    "**/*",
    "!node_modules{,/**}",
    "!bundled{,/**}",
    "!helpers{,/**}",
    "!.babelrc",
    "!.gitignore",
    "!gulpfile.babel.js",
    "!package.json",
    "!package-lock.json",
    ])
    .pipe(zip(`${info.name}.zip`))
    .pipe(dest('bundled'));
  };

export const dev = series(clean, parallel(style, images, copy, scripts), serve, watchForChanges);
export const build = series(clean, parallel(style, images, copy, scripts),compress);
export default dev;