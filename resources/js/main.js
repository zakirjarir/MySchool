import { createApp } from "vue";
import App from "./App.vue";
import router from "./routes";
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-default.css";
import axios from "axios";
import VueAxios from "vue-axios";
import store from "./helper/store/index";
import "sweetalert2/src/sweetalert2.scss";
import {initialize} from './helper/action/action'

// Create Vue App
const app = createApp(App);

// Import Mixin Files
import base_mixin from "./helper/mixins/base_mixin";
import http_mixin from "./helper/mixins/http_mixin";
import auth_mixin from "./helper/mixins/auth_mixin";
import notifaction from "./helper/mixins/notifaction";

// Register Mixins Correctly
app.mixin(base_mixin);
app.mixin(http_mixin);
app.mixin(auth_mixin);
app.mixin(notifaction);

initialize(store, router);
app.use(store);
app.use(VueAxios, axios);
app.use(VueToast);
app.use(router);


// Mount the App
app.mount("#app");
