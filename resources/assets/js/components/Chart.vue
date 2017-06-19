<template>

        <line-chart download="true" :data="data" class="is-children" ></line-chart>

</template>

<script>
    export default {
        props:{
            datalist:{
                type:Array,
            }
        },
        data(){
            return{
                data:{},

            }
        },
        created() {
            this.datalist.forEach((msg)=>{
                this.data[msg.created_at]=msg.msg;

            });
        }
    }
</script>
