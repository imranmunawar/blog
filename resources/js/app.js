import Vue from 'vue'
import App from './components/App.vue'
import VueRouter from 'vue-router'
import VueMeta from 'vue-meta'
import VueSweetalert2 from 'vue-sweetalert2'
import axios from 'axios'
import VueAxios from 'vue-axios'
import routes from './routes'
import 'jquery'
import 'popper.js'
import 'bootstrap'
import './../sass/app.scss'
import 'sweetalert2/dist/sweetalert2.min.css'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(VueSweetalert2)
Vue.use(VueMeta, {
  // optional pluginOptions
  refreshOnceOnNavigation: true
})
const router = new VueRouter({
  mode: 'history',
  routes 
})
router.beforeEach( (to, from, next) => {
  console.log(to.meta.middleware);
  console.log(from);
  return next();
})
new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
