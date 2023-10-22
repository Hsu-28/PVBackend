import { createStore } from 'vuex'

// const baseURL =process.env.NODE_ENV === "development"? "/": "https://tibamef2e.com/cgd103/g1/api";


//中央狀態管理
// const publicURL = process.env.NODE_ENV === 'development' ? '' : 'https://tibamef2e.com/chd103/g3/PlanetVoyager'
// const phpPublicPath = process.env.NODE_ENV === 'development' ? 'http://localhost/PV/PlanetVoyager/public/php/' : 'https://tibamef2e.com/chd103/g3/PlanetVoyager/php/'
// const publicPath = process.env.NODE_ENV === 'development' ? process.env.BASE_URL : ''
// //中央狀態管理
const publicURL = process.env.NODE_ENV === 'development' ? '' : 'https://tibamef2e.com/chd103/g3/back'
const phpPublicPath = process.env.NODE_ENV === 'development' ? 'http://localhost/PV/PVBackend/public/php/' : 'https://tibamef2e.com/chd103/g3/back/php/'
const publicPath = process.env.NODE_ENV === 'development' ? process.env.BASE_URL : ''

const Picupload = process.env.NODE_ENV === 'development' ? '../../../PlanetVoyager/src/assets/image/teamMembers/memberSvg/' : '../../PlanetVoyager/img/'


export default createStore({
  state: {
    siteLoading: false,
    apiURL: '',
    publicURL: publicURL,
    phpPublicPath: phpPublicPath,
    publicPath: publicPath,
    Picupload :Picupload,
  },
  getters: {
  },
  mutations: {
    updateSiteLoad(state, value) {
      state.siteLoading = value
    }
  },
  actions: {
  },
  modules: {

  }
})