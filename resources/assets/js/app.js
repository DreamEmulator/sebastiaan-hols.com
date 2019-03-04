
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('skills', require('./components/Skills.vue').default);
Vue.component('popmotion-ball-score', require('./components/PopmotionBallScore.vue').default);
Vue.component('photo-library', require('./components/PhotoLibrary.vue').default);
Vue.component('vue-magnifier', require('./components/VueMagnifier.vue').default);
Vue.component('clock', require('./components/Clock.vue').default);
Vue.component('vue-loader', require('./components/VueLoader.vue').default);

const app = new Vue({
    el: '#app'
});