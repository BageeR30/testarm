
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import Vuelidate from 'vuelidate';

window.Vue.use(VueRouter);
window.Vue.use(Vuelidate);

import EmployeesIndex from './components/employees/employeesIndex.vue';
import EmployeesCreate from './components/employees/employeesCreate.vue';
import EmployeesEdit from './components/employees/employeesEdit.vue';
import EmployeesStructure from './components/employees/employeesStructure.vue';

const routes = [
    {
        path: '/',
        components: {
            employeesIndex: EmployeesIndex
        }
    },
    {path: '/admin/employees/create', component: EmployeesCreate, name: 'createEmployee'},
    {path: '/admin/employees/edit/:id', component: EmployeesEdit, name: 'editEmployee'},
    {path: '/admin/employees/structure', component: EmployeesStructure, name: 'employeesStructure'}
]

const router = new VueRouter({ routes })

const app = new Vue({ router }).$mount('#app')
