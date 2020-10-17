/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(
    "house-create",
    require("./modules/house/HouseCreate.vue").default
);
Vue.component(
    "house-list",
    require("./modules/house/HouseList.vue").default
);
Vue.component(
    "house-view",
    require("./modules/house/HouseView.vue").default
);
Vue.component(
    "house-edit",
    require("./modules/house/HouseEdit.vue").default
);
Vue.component(
    "property-list",
    require("./modules/property/PropertyList.vue").default
);
Vue.filter('str_limit', function (value, size) {
  if (!value) return '';
  value = value.toString();

  if (value.length <= size) {
    return value;
  }
  return value.substr(0, size) + '...';
});
const app = new Vue({
    el: '#app',
});
