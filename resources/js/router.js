import Vue from 'vue'
import VueRouter from 'vue-router';
import Home from "./views/Home"
import Login from "./views/Login"
import Dashboard from "./views/Dashboard"
import Dashboard2 from "./views/Dashboard2"
import Dashboard3 from "./views/Dashboard3"
import CalculatePrice from "./views/CalculatePrice"
import Contacts from "./views/Contacts"
import Comments from "./views/Comments"
import Orders from "./views/Orders"
import OrdersData from "./views/OrdersData"
import InsideDoor from "./views/InsideDoor"
import OutsideDoor from "./views/OutsideDoor"
import Locks from "./views/Locks"
import CheckOrder from "./views/CheckOrder"
import Users from "./views/Users"
import EditGallery from "./views/EditGallery"
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
            name: 'login',
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
        },
        {
            path: '/manager_dashboard',
            name:"manager_dashboard",
            component: Dashboard2,
            meta:{
                title:`Dashboard`,
                middleware:"manager"
            }
        },
        {
            path: '/product_manager_dashboard',
            name:"product_manager_dashboard",
            component: Dashboard3,
            meta:{
                title:`Dashboard`,
                middleware:"production_manager"
            }
        },
        {
            path: '/calculate_price',
            name:"calculate_price",
            component: CalculatePrice,
            meta:{
                title:`Price calculation`,
                middleware:"guest"
            }
        },
        {
            path: '/contacts',
            name:"contacts",
            component: Contacts,
            meta:{
                title:`Contacts`,
                middleware:"guest"
            }
        },
        {
            path: '/comments',
            name:"commments",
            component: Comments,
            meta:{
                title:`Comments`,
                middleware:"guest"
            }
        },
        {
            path: '/orders',
            name:"orders",
            component: Orders,
            meta:{
                title:`Orders`,
                middleware:"admin"
            }
        },
        {
            path: '/orders_data',
            name:"orders_data",
            component: OrdersData,
            meta:{
                title:`Orders data`,
                middleware:"admin"
            }
        },
        {
            path: '/users',
            name:"users",
            component: Users,
            meta:{
                title:`Users`,
                middleware:"guest"
            }
        },
        {
            path: '/inside_doors',
            name:"inside_doors",
            component: InsideDoor,
            meta:{
                title:`Inside doors`,
                middleware:"guest"
            }
        },
        {
            path: '/outside_doors',
            name:"outside_doors",
            component: OutsideDoor,
            meta:{
                title:`Outside doors`,
                middleware:"guest"
            }
        },
        {
            path: '/locks',
            name:"locks",
            component: Locks,
            meta:{
                title:`Locks`,
                middleware:"guest"
            }
        },
        {
            path: '/check_order',
            name:"check_order",
            component: CheckOrder,
            meta:{
                title:`Check order`,
                middleware:"guest"
            }
        },
        {
            path: '/edit_gallery',
            name:"edit_gallery",
            component: EditGallery,
            meta:{
                title:`Edit gallery`,
                middleware:"worker"
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
                alert('bando patekt i admin')
            }
            break;
        case 'manager':
            if(store.state.auth.user.role_id == 2){
                next()
            }else{
                alert('bando patekt i manager')
            }
            break;  
        case 'production_manager':
            if(store.state.auth.user.role_id == 3){
                next()
            }else{
                alert('bando patekt i production manager')
            }
            break;   
        case 'worker':
            if(store.state.auth.user.role_id == 3 || store.state.auth.user.role_id == 2 || store.state.auth.user.role_id == 1){
                next()
            }else{
                alert('bando patekt i worker')
            }
            break;        
    }
})

export default router