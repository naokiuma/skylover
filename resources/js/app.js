/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./click_change');
require('./fadein');
require('./drop_prev');
//require('./masonry');
//require('./category_search');
//require('./form_validate.js')

window.Vue = require('vue');
Vue.component('category-component', require('./components/CategoryComponent.vue').default);


const app = new Vue({
    el: '#categoryapp',
});
