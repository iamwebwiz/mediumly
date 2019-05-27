import Vue from "vue";
import VueRouter from "vue-router";
import Homepage from "../components/Homepage";
import SingleArticle from "../components/SingleArticle";

Vue.use(VueRouter);

const routes = [
    { path: "/", component: Homepage },
    { path: "/articles/:id", component: SingleArticle }
];

const router = new VueRouter({
    routes
});

export default router;
