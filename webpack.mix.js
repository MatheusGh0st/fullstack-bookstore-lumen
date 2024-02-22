const mix = require('laravel-mix');
const path = require('path');

mix.js('resources/js/app.js', 'dist').vue().sourceMaps()
    .webpackConfig({
        module: {
            rules: [
                {
                    test: /\.(png|jpe?g|gif)$/i,
                    type: 'asset',
                    parser: {
                        dataUrlCondition: {
                            maxSize: 8 * 1024, // Convert image to base64 if smaller than 8 KB
                        },
                    },
                },
                {
                    test: /\.blade\.php$/,
                    resolve: {
                        fullySpecified: false,
                    },
                    loader: 'blade-loader',
                },
            ],
        },
        resolve: {
            alias: {
                '~': path.join(__dirname, 'resources/js/vue'),
                '@': path.join(__dirname, 'public/images'),
            },
        },
    });
