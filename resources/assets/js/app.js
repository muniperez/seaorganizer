require('./bootstrap')

import Vue from "vue"
window.Vue = Vue

import vSelect from "vue-select"
Vue.use(vSelect)

/* Main components */

Vue.component('user-dashboard', require('./components/Dashboard/Dashboard.vue'))


/* Subscription components */

Vue.component('card-component', require('./components/Subscription/Card.vue'))
Vue.component('payment-form', require('./components/Subscription/Payment.vue'))

/* Certificates components */
Vue.component('certificates-list', require('./components/Certificates/List.vue'))
Vue.component('view-certificate', require('./components/Certificates/View.vue'))
Vue.component('edit-certificate', require('./components/Certificates/Edit.vue'))
Vue.component('add-certificates', require('./components/Certificates/Add.vue'))


/* Onboarding components */
Vue.component('onboarding-certificates', require('./components/Onboarding/Certificates.vue'))
Vue.component('phone-validation', require('./components/Onboarding/PhoneValidation.vue'))


/* System components */

Vue.component('user-settings', require('./components/System/Settings.vue'))
Vue.component('user-account', require('./components/System/Account.vue'))

/* Interface components */

Vue.component('card-widget', require('./components/Interface/CardWidget.vue'))
Vue.component('card-widget-content', require('./components/Interface/CardWidgetContent.vue'))

Vue.component('app-menu', require('./components/Interface/AppMenu.vue'))
Vue.component('app-menu-item', require('./components/Interface/AppMenuItem.vue'))

Vue.component('app-list', require('./components/Interface/AppList.vue'))
Vue.component('app-list-item', require('./components/Interface/AppListItem.vue'))

const app = new Vue({
    el: '#app'
})
