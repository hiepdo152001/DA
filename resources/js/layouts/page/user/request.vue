<template>
    <div class="panel" style="margin: 50px 30px;">
      <div class="panel-hdr">
        <h2 class="title" style="padding-top: 10px">Yêu cầu của tôi</h2>
        
      </div>

      <div class="panel-container">
        <div class="panel-content">
            <router-link :to="{name:'createReq-user'}">
            <button class="btn btn-primary waves-effect waves-themed" style="background-color: #886ab5;">
              + Thêm yêu cầu
            </button>
        </router-link>
        </div>
        <div class="panel-content">
          <table class="table table-bordered " style="margin-top: 30px">
            <thead>
              <tr>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th>Người xử lí</th>
                <th>Thời hạn</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="datas in data" :key="datas.id">
                <status :datas="datas" />
                <td > Admin</td>
                <td>{{ datas.time_start }} ~ {{ datas.time_end }}</td>
                <td>
                  <button
                    class="btn btn-primary btn-sm waves-effect waves-themed"
                    type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="View"
                  >
                  <router-link :to="{name:'view-request-user', params: { id: datas.id }}">
                    <i class="bi bi-eye-fill" style="color: black;"></i>
                  </router-link>
                  </button>
                    <button
                    class="btn btn-primary btn-sm waves-effect waves-themed"
                    type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Delete"
                    v-if="datas.status === 1"
                    v-on:click="handleDelete(datas.id)"
                  >
                    <i class="bi bi-trash-fill" style="color: red;"></i>
                  </button> 
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>
  
  <script>
import axios from 'axios';
import { ref } from 'vue';
import status from '../../../components/status.vue';
  export default{
    data(){
      const data=ref([])
      return {
        data
      }
    },
    components:{
      status
    },
    mounted(){
      axios.get(`http://localhost:8000/api/calendar/requests`).then(res=>{
      this.data=res.data.data;
      });
    },
    methods:{
      handleDelete(id){
        if(confirm('ban co muon xoa no!')){
          axios.delete(`http://localhost:8000/api/calendar/requests/${id}`).then(res=>{
            this.data = this.data.filter(item => item.id !== id);
          });
        }
      }
    }
  }
    
  </script>