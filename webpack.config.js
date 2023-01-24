const path = require('path');


module.exports = {
     mode: process.env.NODE_ENV,
     devtool: process.env.NODE_ENV == 'development' ? 'source-map' : '',
     entry: {
          app: ['./public/assets/js/app.js'],
     },
     output: {
          path: path.resolve(__dirname, 'public'),
          filename: '[name].js',
     },
     module: {
          rules: [
               {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    loader: 'babel-loader',
               },
               // {
               //      test: /(@?react-(navigation|native)).*\.(ts|js)x?$/,
               //      include: /node_modules/,
               //      exclude: [/react-native-web/, /\.(native|ios|android)\.(ts|js)x?$/],
               //      loader: 'babel-loader'
               // },
               // // This would match ui-kitten
               // {
               //      test: /@?(ui-kitten|eva-design).*\.(ts|js)x?$/,
               //      loader: 'babel-loader'
               // }
          ],
     },
};