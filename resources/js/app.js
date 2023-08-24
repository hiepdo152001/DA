
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router/index.js";
import { Menu, List, Drawer, Button, message } from "ant-design-vue";
import "bootstrap/dist/css/bootstrap-grid.min.css";
import "bootstrap/dist/css/bootstrap-utilities.min.css";

const app = createApp(App);

app.use(router);
app.use(Menu);
app.use(List);
app.use(Button);
app.use(Drawer);
app.mount("#app");

app.config.globalProperties.$message = message;
