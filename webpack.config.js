const path = require('path');

module.exports = {
     mode: 'development',
     devtool: process.env.NODE_ENV == 'development' ? 'development' : 'production',
     entry: {
          app: ['@babel/polyfill','./public/assets/js/app.js'],
     },
     output: {
          path: path.resolve(__dirname, 'public'),
          filename: '[name].js',
          filename: 'my-first-webpack.bundle.js',
     },
     module: {
          rules: [
               {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    loader: 'babel-loader',
               },
          ],
     },
};
