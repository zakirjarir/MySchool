const mix = require('laravel-mix');
const webpack = require('webpack');

mix.js('resources/js/main.js', 'public/js/')
    .vue({ version: 3 }) // Ensure Vue 3 compatibility
    .sourceMaps();

mix.options({
    hmrOptions: {
        host: 'localhost', // Your app's hostname
        port: 8080         // HMR port
    }
});

mix.webpackConfig({
    plugins: [
        new webpack.DefinePlugin({
            __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: false,  // Disable hydration mismatch details in production
            __VUE_OPTIONS_API__: true,  // Enable Options API if you use it
            __VUE_PROD_DEVTOOLS__: false, // Disable devtools in production
        }),
    ],
});

if (mix.inProduction()) {
    mix.version();
}
