<template>
    <article class="message">
        <div class="message-header handler" >
            {{this.datum.id}} -- {{this.datum.name}}
            <a class="delete" @click="deleteConfirmItem"></a>
        </div>
        <div class="message-body">
            <div v-if="this.datum.type=='switch'" >
                <vb-switch type="success" size="large" :checked="Boolean(Number(datum.last_value==null?false:datum.last_value))" @input="sendValue"></vb-switch>
            </div>
            <div v-else>
                <div class="box" >
                    <p class="control field">
                        <slider type="success" size="large" :max="100" :step=".1" @change="update" :value="sliderVal"
                                is-fullwidth></slider>
                        {{sliderVal}}
                    </p>
                    <br>
                </div>
                <button class="button is-fullwidth is-large is-info" @click="sendValue">Send Value</button>
            </div>
        </div>

    </article>

</template>

<script>

    import VbSwitch from './element/Switch.vue';
    import Slider from 'vue-bulma-slider';
    export default {
        components:{
            VbSwitch, Slider,
        },
        data(){
          return{
              sliderVal:Number(this.datum.last_value),
              showModal:false,
          }  ;
        },
        props:{
            datum:{
                type:Object
            },

        },
        methods:{
            update(value)
            {
                this.sliderVal=Number(value);
            },
            sendValue(value)
            {
                if(typeof(value)=="boolean"){
                    this.$emit('change',{id:this.datum.id,val:value});
                }
                else
                {
                    this.$emit('change',{id:this.datum.id,val:this.sliderVal});
                }
            },
            deleteConfirmItem()
            {
                this.$emit('remove',{id:this.datum.id});
            },
        }
    }
</script>
