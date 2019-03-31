
require('./../vue-assets');

Vue.component('employee-list', require('./List.vue').default);
Vue.component('navbar', require('./../components/Navbar.vue').default);
const employee = new Vue({
    el: '#employee'
});