const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.sass('resources/scss/fontawesome/brands.scss', 'public/css').options({ processCssUrls: false })
    .sass('resources/scss/fontawesome/duotone.scss', 'public/css').options({ processCssUrls: false })
    .sass('resources/scss/fontawesome/fontawesome.scss', 'public/css').options({ processCssUrls: false })
    .sass('resources/scss/fontawesome/light.scss', 'public/css').options({ processCssUrls: false })
    .sass('resources/scss/fontawesome/regular.scss', 'public/css').options({ processCssUrls: false })
    .sass('resources/scss/fontawesome/solid.scss', 'public/css').options({ processCssUrls: false })
    .sass('resources/scss/fontawesome/thin.scss', 'public/css').options({ processCssUrls: false })
    .sass('resources/scss/login.scss', 'public/css').options({ processCssUrls: false })
    .sass('resources/scss/search.scss', 'public/css').options({ processCssUrls: false })
    .sass('resources/scss/createEmail.scss', 'public/css').options({ processCssUrls: false })
    .sass('resources/scss/styles.scss', 'public/css').options({ processCssUrls: false })
    .sass('resources/scss/adminAdd.scss', 'public/css').options({ processCssUrls: false })
    .sass('resources/scss/adminView.scss', 'public/css').options({ processCssUrls: false })
    .sass('resources/scss/fontawesome/v4-shims.scss', 'public/css').options({ processCssUrls: false });

mix.copy('resources/js/bootstrap.js', 'public/js');

// mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
//     require('postcss-import'),
//     require('tailwindcss'),
//     require('autoprefixer'),
// ]);
