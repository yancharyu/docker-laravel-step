const mix = require('laravel-mix');

/**
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

if (!mix.inProduction()) {
  mix.webpackConfig({
    module: {
      rules: [
        {
          enforce: 'pre',
          exclude: /node_modules/,
          loader: 'eslint-loader',
          test: /\.(js|vue)?$/,
          options: {
            fix: true,
          },
        },
      ],
    },
  });
}

mix
  .js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .options({
    autoprefixer: {
      options: {
        browsers: ['last 6 versions'],
      },
    },
  });

mix
  .browserSync({
    host: 'localhost',
    port: '3000',
    proxy: 'localhost:8080',
    open: 'external',
    reloadOnRestart: true,
    files: [
      './app/**/*',
      './config/**/*',
      './resources/views/**/*.blade.php',
      './resources/views/*.blade.php',
      './public/**/*',
      './routes/**/*',
    ],
  })
  .version();

// 通知オフ
mix.disableNotifications();
