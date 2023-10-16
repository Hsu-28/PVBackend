const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({

  // devServer: {
  //   proxy: {
  //     '/public/php/': {
  //       target: 'http://localhost:8080/Order',
  //       ws: true,
  //       changeOrigin: true
  //     }
  //   }
  // },
  filenameHashing: false,
  transpileDependencies: true,
  css: {
    loaderOptions: {
      scss: {
        additionalData: `

          @import "~@/assets/sass/style.scss";
          
        `
      },
    }
  },

  transpileDependencies: true,
  publicPath: process.env.NODE_ENV === 'production'
    ? '/chd103/g3/back/'
    : '/',
  outputDir: 'back'

})
