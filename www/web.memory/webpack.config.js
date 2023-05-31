const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = function(env) {
    // Read --env args from webpack build, default to dev
    let appTarget = env.APP_TARGET || 'dev';

    return {
        entry: './src/main.js',
        output: {
            path: path.resolve(__dirname, 'dist'),
            filename: 'main.js',
            chunkFilename: 'vendor.js'
        },
        // Babel to translate es6 to old school es5
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: '/node_modules',
                    use: {
                        loader: 'babel-loader'
                    }
                },
                {
                    test: /\.sc|ass$/,
                    use: [
                        {
                            loader: MiniCssExtractPlugin.loader
                        },
                        {
                            loader: 'css-loader'
                        },
                        {
                            loader: 'sass-loader'
                        }
                    ]
                }
            ]
        },
        plugins: [
            new MiniCssExtractPlugin({
                filename: './../assets/css/[name].css',
                chunkFileName: '../../assets/css/[id].css'
            }),
            new webpack.NormalModuleReplacementPlugin(/(.*)-APP_TARGET(\.*)/, function(resource) {
                resource.request = resource.request.replace(/-APP_TARGET/, `-${appTarget}`);
            })
        ]
    }
}