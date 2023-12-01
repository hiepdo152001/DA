<template>
  <div class="panel" style="margin: 50px 30px;">
  <div class="panel-hdr">
    <h2>Chi tiết yêu cầu</h2>
  </div>
  <div class="panel-container">
    <div class="panel-content">
          </div>
    <div class="panel-content">
      <div class="panel-content" style="margin-bottom: 30px;">
        <router-link :to="{name:'edit-request-user', params: { id: req.id }}">
            <button class="btn btn-primary waves-effect waves-themed" style="background-color: #886ab5;">
              <i title="edit" class="bi bi-pencil-fill"></i>
            </button>
        </router-link>
      </div>
      <table class="table  table-bordered table-hover create-req">
        <tbody>
          <tr>
              <td><strong>Người tạo</strong></td>
              <td>{{req.user_name}} </td>
            </tr>
          <tr>
            <status :datas="req" />
          </tr>
            <tr>
              <td><strong>Thời hạn</strong></td>
              <td>{{req.time_start}} ~ {{req.time_end}}</td>
            </tr>
          <tr>
            <td><strong>Số điện thoại</strong></td>
            <td>{{ req.phone }}</td>
          </tr>
          <tr>
            <td><strong>Dự án</strong></td>
            <td>D1-Intern</td>
          </tr>
          <tr>
            <td><strong>Lý do</strong></td>
            <td><p>{{ req.reason }}</p></td>
          </tr>
        </tbody>

      </table>
       <button
                    class="btn btn-primary btn-sm waves-effect waves-themed"
                    type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Delete"
                    v-if="req.status == 1"
                    v-on:click="handleDelete(req.id)"
                    style="margin-bottom: 30px;margin-left: 50px;"
                  >
                    <span>Hủy</span>
                  </button> 
    </div>
  </div>
</div>
</template>
<script>
import axios from 'axios';
import req from './components/req.vue';
import { ref } from 'vue';
import { useRouter } from "vue-router";
import status from '../../../components/status.vue';

export default{
  name:'view-req',
  data(){
    const req=ref([]);
    const router=useRouter();
    const id = router.currentRoute.value.params.id;
    return {
      req,
      id
    }
  },
  components:{
      status
  },
 mounted(){
  axios.get(`http://localhost:8000/api/calendar/requests/${this.id}`)
        .then(response=>{
                    this.req=response.data.data;
                });
  },
    methods:{
      handleDelete(id){
        if(confirm('ban co muon xoa no!')){
          axios.delete(`http://localhost:8000/api/calendar/requests/${id}`).then(res=>{
            this.$router.push({ path: '/user/request' });
          });
        }
      }
    }   

  }
</script>
<style>
.create-req td{
  padding: 15px!important;
}
</style>
