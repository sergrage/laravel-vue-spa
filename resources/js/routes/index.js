import VueRouter from "vue-router";
import PostsIndex from "../components/Posts/Index";
import PostsCreate from "../components/Posts/Create";
import PostsEdit from "../components/Posts/Edit";

export default {
    mode: 'history',
    routes: [
        {
            path: '/',
            component: PostsIndex,
            name: 'posts.index'

        },
        {
            path: '/create',
            component: PostsCreate,
            name: 'posts.create'
        },
        {
            path: '/edit/:id',
            component: PostsEdit,
            name: 'posts.edit'
        },
    ]
}
