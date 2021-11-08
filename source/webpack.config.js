const path = require('path');

module.exports = {
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: [
                    // Creates `style` nodes from JS strings
                    "style-loader",
                    // Translates CSS into CommonJS
                    "css-loader",
                    // Compiles Sass to CSS
                    "sass-loader",
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
};