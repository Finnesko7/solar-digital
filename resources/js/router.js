import VueRouter from "vue-router";
import AllPosts from "./views/AllPosts";
import SinglePost from "./views/SinglePost";

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: AllPosts
        },
        {
            path: '/post',
            component: SinglePost
        }
    ],
})
