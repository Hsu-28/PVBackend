import { createApp } from 'vue'
import ViewUIPlus from 'view-ui-plus'
import 'view-ui-plus/dist/styles/viewuiplus.css'
import App from './App.vue'
import router from './router'
import store from './store'

createApp(App).use(store).use(router).use(ViewUIPlus).mount('#app')
