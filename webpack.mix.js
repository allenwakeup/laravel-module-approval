const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('Resources/assets/public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'public/admin/js/approval.js')
    .sass( __dirname + '/Resources/assets/sass/app.scss', 'public/admin/css/approval.css');

if (mix.inProduction()) {
    mix.version();
}
