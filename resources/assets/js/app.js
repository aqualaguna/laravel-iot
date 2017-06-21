
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('bulma');
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import {Tabs, TabPane} from 'vue-bulma-tabs';

import Notification from 'vue-bulma-notification'

const NotificationComponent = Vue.extend(Notification)
import Chartkick from 'chartkick'
import VueChartkick from 'vue-chartkick'

Vue.use(VueChartkick, { Chartkick })
const openNotification = (propsData = {
    title: '',
    message: '',
    type: '',
    direction: '',
    duration: 4500,
    container: '.notifications'
}) => {
    return new NotificationComponent({
        el: document.createElement('div'),
        propsData
    })
}
Vue.component('graph', require('./components/Graph.vue'));
Vue.component('subcribe', require('./components/Subcribe.vue'));
Vue.component('add-component', require('./components/addComponent.vue'));
Vue.component('dashboard', require('./components/dashboard.vue'));
Vue.component('passport-clients',
    require('./components/passport/Clients.vue'));

Vue.component('passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue'));

Vue.component('passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue'));

const app = new Vue({
    components:{
        Tabs,TabPane
    },
    data:{
        tabIndex:-1,
        componentList:[],
        isInitial:true,
    },
    el: '#app',
    methods:{
        changeTab(index)
        {
            this.tabIndex=index
        },
        tabSelect(index)
        {
            return this.tabIndex==index
        },
        openNotificationWithType (type,title,msg) {
            openNotification({
                title: title,
                message: msg,
                type: type,
                duration:3000,
            })
        },
        dashboardAdd(data){
            this.componentList.push(data);
        },
        changeData(evt)
        {
                this.componentList.forEach((data) => {
                    if (data.id == evt.id) {
                        data.last_value = Number(evt.val);
                        axios.put('/api/device',this.componentList);
                        var msg="";
                        if(data.type=="switch")
                        {
                            msg= evt.val?'on':'off';
                        }
                        else
                        {
                            msg=evt.val;
                        }
                        axios.post('/api/sendcmd',{
                            id:data.id,
                            message:msg
                        })  .catch((error)=>this.openNotificationWithType('danger','Api Call Failed!',error.message));
                    }
                });
        },
        removeItem(item)
        {
            $index = this.componentList.findIndex((data)=>{return data.id==item.id});
            this.componentList.splice($index,1);
            axios.delete('/device',{
                id:item.id
            }).then(()=>this.openNotificationWithType('is-success','Success!!!','success deleting item'))
                .catch((error)=>this.openNotificationWithType('is-danger','Api Call Failed!',error.message));
        }
    },
    beforeCreate()
    {
        // axios.get('api/graph/').then(({data})=>console.log(data));
        // axios.get('api/graph/').then((response)=>console.log(response.data));
            axios.get('api/device/').then((response)=>{
                response.data.forEach((data)=>{
                    this.componentList.push(data);
                    console.log(data);
                });
                this.isInit=false;
            })
                .catch((error)=>this.openNotificationWithType('danger','Api Call Failed!',error.message));

    },
});
