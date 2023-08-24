<template>
    <hld v-on:submitHoliday="submitHoliday" />
</template>
<script>
import hld from "./components/hld.vue";
import axios from "axios";
export default{
    components:{
      hld
    },
    methods:{
      submitHoliday(data,id){
        axios.post(`http://localhost:8000/api/calendar/holiday/${id}`,data).then(response=>{
               console.log(response);
               
          });
      },
    }
}
</script>