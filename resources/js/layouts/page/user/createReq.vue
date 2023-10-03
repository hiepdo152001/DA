<template>
<req v-on:CreateReq="CreateReq"/>
</template>
<script>
import { reactive, ref, onMounted } from "vue";
import axios from "axios";
import req from "./components/req.vue";
export default {
     name:'create-req',
     components:{
          req
     }
     ,
     data() {
     },
     methods: {
          CreateReq(data){
               axios.post(`http://localhost:8000/api/calendar/requests`,data).then(res=>{
                this.$router.push({ path: '/user/request' });
               })
          }
     },
}
</script>
<style>
h2 {
  font-size: 14px !important;
  font-weight: 600 !important;
}
.rules {
  padding: 25px;
  padding-top: 0px;
  background-color: ghostwhite;
  margin: 20px;
}
.btn-success {
  color: #fff;
  background-color: #1dc9b7;
  border-color: #1dc9b7;
}
.btn-success:hover {
  color: #fff;
  background-color: #18a899;
  border-color: #179c8e;
}
.page-content .panel {
  margin-bottom: 1.5rem;
}
.panel {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  position: relative;
  background-color: #fff;
  -webkit-box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
  box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
  margin-bottom: 1.5rem;
  border-radius: 4px;
  border: 1px solid rgba(0, 0, 0, 0.09);
  border-bottom: 1px solid #e0e0e0;
  border-radius: 4px;
  -webkit-transition: border 500ms ease-out;
  transition: border 500ms ease-out;
}
.panel-hdr {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: space-between;

  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  background: #fff;
  min-height: 3rem;
  border-bottom: 1px solid rgba(0, 0, 0, 0.07);
  border-radius: 4px 4px 0 0;
  -webkit-transition: background-color 0.4s ease-out;
  transition: background-color 0.4s ease-out;
}
.panel .panel-container {
  position: relative;
  border-radius: 0 0 4px 4px;
}
.panel-container {
  margin-top: 30px;
}
.panel .panel-container .panel-content:only-child,
.panel .panel-container .panel-content:last-child {
  border-radius: 0 0 4px 4px;
}
</style>