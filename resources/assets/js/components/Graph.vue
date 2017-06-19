<template>
    <div>
        <card-modal :visible="showModal" title="add a Graph" transition="bounce" ok-text="Yes" cancel-text="No"
                    @close="closeModalBasic"
                    @cancel="closeModalBasic" @ok="add">

            <div class="field">
                <label class="label" style="text-align:left;">Name :</label>
                <p class="control">
                    <input type="text" v-model="name">
                </p>
            </div>
            <div class="field" >
                <label class="label" style="text-align:left;">Device :</label>
                <p class="control">
                    <span class="select">
                      <select v-model="selected">
                          <option disabled> please select one</option>
                          <template v-for="device in datalist">
                            <option :value="device.id">{{device.name}}</option>
                          </template>
                      </select>
                    </span>
                </p>
            </div>
        </card-modal>
        <button class="button is-primary" @click="openModalBasic">Add a Graph</button>
        <div class="tile is-ancestor">
            <div class="tile is-parent" v-for="device in datalist" v-if="device.graph!=null">
                <chart :datalist="device.message"></chart>
            </div>
        </div>
    </div>
</template>

<script>
    import {CardModal} from 'vue-bulma-modal';
    import Chart from './Chart.vue'
    export default {
        props: {
            datalist: {
                type: Array
            },
            notification: {
                type: Function,

            }
        },

        data(){
            return {
                showModal: false,
                name: '',
                selected:null,
            };
        },
        components: {
            CardModal,Chart
        },
        methods: {
            openModalBasic () {
                this.showModal = true
            },

            closeModalBasic () {
                this.showModal = false
            },
            add(){
                if(this.selected==null||this.name=='')
                {
                    this.openNotificationWithType('is-warning','Form Validation Fail','name or selected device can not be empty');
                }
                else
                {
                    axios.post('/api/graph',{
                        device_id:this.selected,
                        name:this.name,
                    }).then(()=>this.openNotificationWithType('is-success','Operation Complete','Graph has been created'))
                .catch((error)=>this.openNotificationWithType('is-danger','API call Failed',error.message));

                    this.name=''
                    this.selected=null
                }
            },
            openNotificationWithType (type, title, msg) {
                this.notification(type, title, msg);
            }
        },
        mounted() {

        }
    }
</script>
