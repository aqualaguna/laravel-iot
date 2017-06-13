<template>
    <div>
        <draggable :v-model="datalist" :options="{group:'componentGroup',handle:'.handler',ghostClass:'.ghost'}">
            <div v-for="element in datalist" :key="element.id" ref="list">
                <device :datum="element" @change="update" @remove="removeItem"></device>
            </div>
        </draggable>
        <card-modal :visible="showModal" title="Confirmation" transition="bounce" @close="showModal=false" @cancel="showModal=false" @ok="ok" ok-text="Yes" cancel-text="No">
            <div class="content has-text-centered">
                Are You Sure want to delete this item?
            </div>
        </card-modal>
    </div>
</template>

<script>

    import {CardModal} from 'vue-bulma-modal';
    import draggable from 'vuedraggable';
    import device from './device.vue';
    export default {
        props: {
            datalist: {
                type: Array,
            },

        },
        components: {
            draggable, device,CardModal,
        },
        data(){
            return {
                removeItemId:null,
                showModal:false,
            }
        },
        mounted() {
        },
        methods:{
            update(evt)
            {
                this.$emit('change',evt);
            },
            removeItem(item)
            {
                this.removeItemId=item.id;
                this.showModal=true;
            },
            ok()
            {
                this.$emit('remove',{id:this.removeItemId});
            }

        }
    }
</script>

<style>
    .handler {

        cursor: move;
        cursor: -webkit-grabbing;
    }

    .ghost {
        opacity: 0.1;
    }

    .message {
        margin: 10px;
    }
</style>
