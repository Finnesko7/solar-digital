import VueRouter from "vue-router";
import AllPosts from "./pages/AllPosts";
import SinglePost from "./pages/SinglePost";

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: AllPosts
        },
        {
            path: '/post/:id',
            component: SinglePost,
            props: true
        }
    ],
})
