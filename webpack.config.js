const path = require('path');

module.exports = {
    mode: 'development',
    entry: './frontend/js/app.js',
    output: {
        filename: 'app.js',
        path: path.resolve(__dirname, 'dist')
    },
    module:{
        rules: [
            {
                test: /\.s[ac]ss$/i,
                use: ['style-loader', 'css-loader', 'sass-loader']
            },
            {
                test: /\.(png|jpe?g|gif)$/i,
                loader: 'file-loader',
                options: {
                    name: '[name].[ext]',
                    outputPath: 'png',
                }
            }
        ]
    },
    devServer: {
        contentBase: './dist'
    },
    plugins: [],
}
