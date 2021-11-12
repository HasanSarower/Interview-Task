import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import Axios from "axios";

import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

Vue.config.productionTip = false;

Vue.prototype.$axios = Axios;

new Vue({
  store,
  router,
  render: (h) => h(App),
}).$mount("#app");
