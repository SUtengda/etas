import Vue from 'vue';
import VueRouter from 'vue-router';

import { store, mutations, getters} from "@/js/store";
import Home from '@/js/components/Home';
import Login from '@/js/layouts/Login'
import Dashboard from '@/js/layouts/Dashboard'
import Information from '@/js/pages/Information';
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
           path: '/dashboard',
           name: 'dashboard',
           component: Dashboard,
           meta: {
               auth: true // A protected route
           },
           children: [
               {
                   path: '/client',
                   name: 'clients',
                   component: Clients
               },
               {
                   path: '/vat',
                   name: 'vat',
                   component: VAT
               },
           ]
       },
       {
           path: '/setting',
           name: 'setting',
           component: Setting,
           meta: {
               auth: true // A protected route
           },
           children : [
               {
                   path:'setPartner',
                   name: 'setPartner',
                   component: SetPartner
               }
           ]
       }
   ]
});

router.beforeEach((to, from, next) => {

    if (to.meta.auth && !getters.isLoggedIn()) {
        next('/login')
    }
    else {
        next()
    }

})

export default router;