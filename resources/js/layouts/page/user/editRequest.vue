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
            axios.post(`http://localhost:8000/api/calendar/requests/edit/${id}`,data).then(res=>{
              console.log(res);
              this.$router.push({ path: '/user/request' });
                   });
        }
      }
    
    }
    </script>
    