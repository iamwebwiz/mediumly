import Vue from "vue";
import VueRouter from "vue-router";
import ExampleComponent from "../components/ExampleComponent";

Vue.use(VueRouter);

const routes = [{ path: "/", component: ExampleComponent }];

const router = new VueRouter({
    routes,
    mode: "history"
});

export default router;
