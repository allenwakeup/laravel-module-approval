const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

require('laravel-mix-polyfill');
mix.js('resources/js/app.js', 'public/dist/module-approval/js')
    .sass('resources/js/plugins/css/style.scss', 'public/dist/module-approval/css')
    .setPublicPath('public/dist/module-approval')
    .setResourceRoot('/dist/module-approval/')
    //    .browserSync('127.0.0.1:8000')
    .polyfill({
        enabled: true,
        useBuiltIns: "usage",
        targets: {"firefox": "50", "ie": 11},
    })
    .webpackConfig({
        // externals: {
        //     'vue': 'Vue',//这些是你不需要webpakc帮你打包的库
        //     'vue-router': 'VueRouter',
        //     'ant-design-vue': 'antd',
        //     'moment': 'moment',
        //     'vue-amap':'VueAMap',
        //     'g2plot':'G2Plot',
        //     'clipboard':'ClipboardJS',
        //     // 'element-ui': 'ELEMENT',//这个比较坑　一开始我还以为是ElementUI结果就报错了XD
        // },
        output: {
            publicPath: '/dist/module-approval/',
            filename: '[name].js',
            chunkFilename : '[name].js?id=[chunkhash:20]'
        },
        resolve: {
            alias: {
                '@': path.resolve('resources/js/')
            }
        }
    })
    .version();
