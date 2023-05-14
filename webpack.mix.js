let mix = require('laravel-mix');
let fs = require('node:fs');

const isProd = mix.inProduction();

mix.copyDirectory('resources/images', 'public/images');
fs.rmSync('./public/storage', {force: true});
fs.symlinkSync('../storage/app/public', './public/storage', "dir");
mix.ts('resources/js/app.ts', 'public/js/app.js').vue({version: 3});
mix.sass('resources/scss/styles.scss', 'public/css/styles.css');

if (!isProd) {
    mix.sourceMaps(false, 'source-map');
    mix.version();
}

const watchType = process.env.MIX_WATCH_TYPE
if (watchType === 'browsersync') {
    mix.browserSync({port: 80, open: false, server: 'public/' + displayVersion, 'files': 'public/' + displayVersion});
}
