import Vue from 'vue'
import VueRouter from 'vue-router';
import Home from "./views/Home"
import Dashboard from "./views/Dashboard"
import Login from "./views/Login"
import store from './store';

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        { 
            path: '/', 
            component: Home,
            name: 'home',
            meta:{
                middleware:"guest",
                title:`Home`
            }
        },
        { 
            path: '/login', 
            component: Login,
            meta:{
                middleware:"guest",
                title:`Login`
            }
        },
        {
            path: '/dashboard',
            name:"dashboard",
            component: Dashboard,
            meta:{
                title:`Dashboard`,
                middleware:"admin"
            }
        }
    ],
    mode: 'history'
});

router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} - ${process.env.MIX_APP_NAME}`
    switch(to.meta.middleware){
        case 'guest':
            next()
            break;
        case 'admin':
            if(store.state.auth.user.role_id == 1){
                next()
            }else{
                alert('pasol nx')
            }
            break;
    }
})

export default router