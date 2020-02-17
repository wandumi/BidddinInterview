
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';

/**
 * Vue router codes
 */
/**
 * form validation
 */
import { Form, HasError, AlertError } from 'vform';

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

/**
 * vue router configarations
 */

import VueRouter from 'vue-router'
Vue.use(VueRouter)

let routes = [
    // { path: '/dashboard', component: require('./components/dashboard.vue')},
    { path: '/products', component: require('./components/products/AddProduct.vue') }
  ]

  const router = new VueRouter({
      mode: 'history',
      routes //short for
  });

/**
 * Laravel Vue pagination
 */

 Vue.component('pagination', require('laravel-vue-pagination'));
 

  /**
   * Filters for the site, globally registered
   */
  Vue.filter('capWords', function(text){
     return text.charAt(0).toUpperCase() + text.slice(1);
  });

  Vue.filter('formartDate', function(created){
      return moment(created).format('MMMM DD YYYY');
  })

  Vue.filter('time', function(created){
    return moment(created).format('h:m:s');
  })
  /***
   * Global event lister in vue
   * 
   */
  // let Fire = new Vue();
  window.Fire = new Vue();

/**
 * Vue js progressbar
 */
import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '5px'
});

/**
 * sweet alert
 */
// ES6 Modules or TypeScript
import swal from 'sweetalert2';
window.Swal = swal;

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    // timerProgressBar: true,
});

window.toast = toast;


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('products', require('./components/products/AddProduct.vue'));
Vue.component('front-view', require('./components/frontview/front.vue'));


const app = new Vue({
    el: '#app',
    router
});
