<template>
    <div>
        <card-modal :visible="showModal" title="add a Component" transition="bounce" ok-text="Yes" cancel-text="No" @close="closeModalBasic" @cancel="closeModalBasic" @ok="addDevice">
            <div class="content has-text-centered">
                <tabs @tab-selected="changeTab" animation="slide">
                    <tab-pane label="Button">Button</tab-pane>
                    <tab-pane label="Slider">Slider</tab-pane>
                    <div v-show="tabSelect(0)">
                        <div class="field">
                            <label class="label">Switch Name</label>
                            <p class="control">
                                <input class="input" type="text" placeholder="Name" v-model="objectName">
                            </p>
                        </div>

                    </div>
                    <div v-show="tabSelect(1)">
                        <div class="field">
                            <label class="label">Slider Name</label>
                            <p class="control">
                                <input class="input" type="text" placeholder="Name" v-model="objectName">
                            </p>
                        </div>
                    </div>
                </tabs>
            </div>
        </card-modal>
        <a class="button is-primary" @click="openModalBasic">Add Component</a>

    </div>
</template>

<script>
    import {CardModal} from 'vue-bulma-modal';
    import {Tabs, TabPane} from 'vue-bulma-tabs';
    export default {
        props:{
            notification:{
                type:Function,

            }
        },
        components: {
            CardModal,Tabs,
            TabPane
        },
        data(){
            return {
                showModal: false,
                objectName: '',
                selectedTab: -1,
            };
        },
        methods: {
            openModalBasic () {
                this.showModal = true
            },

            closeModalBasic () {
                this.showModal = false
            },
            changeTab(index)
            {
                this.selectedTab = index
            },
            tabSelect(index)
            {
                return index == this.selectedTab;
            },
            addDevice()
            {
                axios.post('/api/device',{
                    'type':this.selectedTab==0?'switch':'slider',
                    'name':this.objectName
                })
                    .then((response)=>{
                        this.objectName=''
                        this.selectedTab=-1
                        this.openNotificationWithType('success','Operation Success','added to the database');
                        this.$emit('added',response.data);
                    })
                    .catch((error)=>{
                        this.openNotificationWithType('danger','Api Call Failed',error.message);
                    });
                this.objectName=''
                this.selectedTab=-1
            },
            openNotificationWithType (type,title,msg) {
                this.notification(type,title,msg);
            }

        }
    }
</script>