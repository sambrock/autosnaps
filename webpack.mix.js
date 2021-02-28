const mix = require('laravel-mix');
require('laravel-mix-purgecss');

mix
  .js('resources/js/app.js', 'public/js')
  .sass('resources/styles/app.scss', 'public/css')
  .options({
    postCss: [
      require('postcss-import'),
      require('tailwindcss'),
      require('postcss-nested'),
      require('autoprefixer'),
    ]
  })
  // .purgeCss({
  //   enabled: mix.inProduction(),
  //   folders: ['src', 'templates'],
  //   extensions: ['html', 'js', 'php', 'vue'],
  // });

if (mix.inProduction()) {
  mix
    .version();
}
