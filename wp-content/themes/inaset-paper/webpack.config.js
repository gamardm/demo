require('dotenv').config();

const path = require('path');

const webpack = require('webpack'); //to access built-in plugins

module.exports = {
    entry: {
        public: [ './source/scripts/polyfill-flexibility.js','./source/scripts/modernizr-custom.js','./source/scripts/polyfill-foreach.js', './source/scripts/polyfill-classlist.js', './source/scripts/main.js'  ],
        /*admin: './source/scripts/admin.js'*/
    },
    output: {
        filename: "[name].min.js",
        path: path.resolve(__dirname, 'assets/js/')
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                use: [{
                    loader: 'babel-loader',
                    options: {
                        "presets": [ [ "es2015" ] ],
                       // "plugins": [ "transform-es2015-destructuring", "transform-object-rest-spread", "transform-runtime" ]
                    }
                }],
                exclude: /node_modules/,
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader',
            }
        ]
    },

    resolve: {
        alias: {
        }
    },

    plugins: [
        new webpack.optimize.UglifyJsPlugin( { minimize: true } )
    ]
};


if (process.env.NODE_ENV === 'development') {
    module.exports.resolve.alias = {
        vue: 'vue/dist/vue.js',
        axios: 'axios/dist/axios.min.js',
    };
}


if (process.env.NODE_ENV === 'production') {
    module.exports.resolve.alias = {
        vue: 'vue/dist/vue.min.js',
        axios: 'axios/dist/axios.min.js',

    };
}