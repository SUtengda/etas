import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from '@/js/layouts/Login'
import Dashboard from '@/js/layouts/Dashboard'
import Clients from '@/js/components/Clients';
import VAT from '@/js/components/VAT';
import Setting from '@/js/pages/Setting';
import SetPartner from '@/js/components/setting/setPartner';

Vue.use(VueRouter);

const router = new VueRouter({

   routes:[
       {
           path: '/login',
           name:'login',
           component: Login
       },
       {
           path: '/',
           name:'home',
           component: Dashboard
       },
       {
           path: '/dashboard',
           name: 'dashboard',
           component: Dashboard,
           meta: {
               auth: true // A protected route
           },
           children: [
               {
                   path: '/dashboard/client',
                   name: 'clients',
                   component: Clients,
                   meta: {
                       auth: true // A protected route
                   },
               },
               {
                   path: '/dashboard/vat',
                   name: 'vat',
                   component: VAT,
                   meta: {
                       auth: true // A protected route
                   },
               },
               {
                   path: '/dashboard/setting',
                   name: 'setting',
                   component: Setting,
                   meta: {
                       auth: true // A protected route
                   },
                   children : [
                       {
                           path:'/dashboard/setting/setPartner',
                           name: 'setPartner',
                           component: SetPartner,
                           meta: {
                               auth: true // A protected route
                           },
                       }
                   ]
               }
           ]
       },

   ]
});

// router.beforeEach((to, from, next) => {
//
//     if (to.meta.auth && !getters.isLoggedIn()) {
//         next('/login')
//     }
//     if(to.name==="login" && getters.isLoggedIn()){
//         next('/dashboard')
//     }else{
//         next()
//     }
//
// });

export default router;