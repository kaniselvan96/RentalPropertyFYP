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

//Property
Vue.component(
    "property-list",
    require("./modules/property/PropertyList.vue").default
);
Vue.component(
    "request-property-list",
    require("./modules/property/RequestPropertyList.vue").default
);

//tenant
Vue.component(
    "add-tenant",
    require("./modules/tenant/AddTenant.vue").default
);
Vue.component(
    "view-tenant",
    require("./modules/tenant/ViewTenant.vue").default
);


//invoice
Vue.component(
    "invoice-list",
    require("./modules/invoice/InvoiceList.vue").default
);
Vue.component(
    "invoice-create",
    require("./modules/invoice/InvoiceCreate.vue").default
);
Vue.component(
    "invoice-view",
    require("./modules/invoice/InvoiceView.vue").default
);
Vue.component(
    "invoice-tenant-list",
    require("./modules/invoice/InvoiceTenantList.vue").default
);


//limit amount word display
Vue.filter('str_limit', function(value, size) {
    if (!value) return '';
    value = value.toString();

    if (value.length <= size) {
        return value;
    }
    return value.substr(0, size) + '...';
});

//formatting date
import moment from 'moment'

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('DD-MMM-YYYY')
    }
});
Vue.filter('formatmonth', function(value) {
    if (value) {
        return moment(String(value)).format('MMM-YYYY')
    }
});

const app = new Vue({
    el: '#app',
});