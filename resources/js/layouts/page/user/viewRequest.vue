<template>
<req v-on:CreateReq="CreateReq" />
</template>
<script>
import axios from 'axios';
import req from './components/req.vue';
export default{
  name:'view-req',
  components:{
    req
  },
  methods:{
    CreateReq(data,id){
        axios.put(`http://localhost:8000/api/calendar/requests/${id}`,data).then(res=>{
               })
    }
  }

}
</script>
