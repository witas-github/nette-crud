const path = require('path');

module.exports = {
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    "style-loader",
                    "css-loader",
                    "sass-loader",
                ],
            },
            {
                test: /\.js$/,
                enforce: "pre",
                use: [
                    "source-map-loader"
                ],
            },
            {
                test: /\.mjs$/,
                use: [
                    "source-map-loader"
                ],
            },
        ],
    },
    entry: {
        app: './resources/js/app.js',
        css: './resources/js/css.js'
    },
    mode: (process.env.NODE_ENV === 'production') ? 'production' : 'development',
    resolve: {
        extensions: ['*', '.js', '.jsx']
    },
    output: {
        filename: '[name].js',
        path: path.join(__dirname, 'www', 'assets'),
    },
    optimization: {
        chunkIds: 'named',
    },
};