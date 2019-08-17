import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/js/components/Home';

import Information from '@/js/pages/Information';
import Clients from '@/js/components/Clients';
import VAT from '@/js/components/VAT';

import Setting from '@/js/pages/Setting';
import SetPartner from '@/js/components/setting/setPartner';

Vue.use(VueRouter);

const router = new VueRouter({

   routes:[
       // {
       //     path: '/',
       //     name:'home',
       //     component:Home
       // },
       {
           path: '/information',
           name: 'information',
           component: Information,
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

export default router;