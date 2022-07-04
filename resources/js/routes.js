import log from './middleware/log';
import HomeLayout from './components/pages/HomeLayout.vue'
import BlogLayout from './components/pages/BlogLayout.vue'
import LoginLayout from './components/pages/LoginLayout.vue'
import DashboardLayout from './components/pages/DashboardLayout.vue'
import ListCat from './components/pages/category/ListCat.vue'
import AddCat from './components/pages/category/AddCat.vue'
import EditCat from './components/pages/category/EditCat.vue'
import ListPost from './components/pages/post/ListPost.vue'
import AddPost from './components/pages/post/AddPost.vue'

let routes = [
    { 
        path: '/login', name: 'login_page', component: LoginLayout 
    },
    {
        path: '/user/dashboard', name: 'dashboard', component: DashboardLayout, meta: {
            middleware: log,
        },
    },
    {
        path: '/user/category', name: 'category_list', component: ListCat, meta: {
            middleware: log,
        },
    },
    {
        path: '/user/category/add', name: 'category_list_add', component: AddCat, meta: {
            middleware: log,
        },
    },
    {
        path: '/user/category/edit/:id', name: 'category_list_edit', component: EditCat, meta: {
            middleware: log,
        },
    },
    {
        path: '/user/post', name: 'post_list', component: ListPost, meta: {
            middleware: log,
        },
    },
    {
        path: '/user/post/add', name: 'post_list_add', component: AddPost, meta: {
            middleware: log,
        },
    },
    {
        path: '/', name: 'home_page', component: HomeLayout
    },
    {
        path: '/blog/:slug', name: 'blog_page', component: BlogLayout
    },
]
export default routes;