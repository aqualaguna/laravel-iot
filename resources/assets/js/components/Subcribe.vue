<template>
    <div class="box">
        <p class="control">
            <label class="label">Credit :{{credit}}</label>
            <select class="select" v-model="selected">
                <option value="monthly">monthly</option>
                <option value="api_call">per API Call</option>
                <option value="yearly">yearly</option>
                <option value="lifetime">life time</option>
            </select>
            <button class="button is-primary" @click="setSubcribe">set</button>
        </p>
    </div>
</template>

<script>
    export default {
        props:{
            notification: {
                type: Function,
            }
        },
        data(){
          return {
              credit : 0,
              selected:null,

          }  ;
        },
        mounted() {
            axios.get('/api/user')
                .then(({data})=>{this.credit = data.credit;})
                .catch((error)=>console.log(error.message));
        },
        methods:{
            setSubcribe(){
            axios.post('/api/subcribe',{
                subcribe_type:this.selected,
            }).then(()=>this.openNotificationWithType('is-success','Operation Complete','Subcribe has been set'))
                .catch((error)=>this.openNotificationWithType('is-success','Api Call Failed!',error.message));
            },
            openNotificationWithType (type, title, msg) {
                this.notification(type, title, msg);
            }
        }
    }
</script>
