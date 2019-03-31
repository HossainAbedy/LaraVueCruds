
require('./../vue-assets');

Vue.component('student-list', require('./StudentList.vue').default);
Vue.component('navbar', require('./../components/Navbar.vue').default);

const student = new Vue({
    el: '#student'
});