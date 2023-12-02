<template>
    <div class="panel" style="margin: 50px 30px;">
      <div class="panel-hdr">
        <h2 class="title" style="padding-top: 10px">Yêu cầu cần duyệt</h2>
        
      </div>
      <div class="panel-container">
        <div class="panel-content">
        </div>
        <div class="panel-content">
          <div v-if="contacts.length===0" style="text-align: center">
              <h3 style="line-height: 50px">Không có dữ liệu</h3>
          </div>
          <table v-else class="table table-bordered " style="margin-top: 30px">
            <thead>
              <tr>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th>Người tạo</th>
                <th>Số điện thoại</th>
                <th>Thời hạn</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="contact in contacts">
                <status :datas="contact" />
                <td>{{ contact.user_name }}</td>
                <td>{{ contact.phone }}</td>
                <td>{{ contact.time_start }} ~ {{ contact.time_end }}</td>
                <td>
                  <button 
                    class="btn  btn-sm waves-effect waves-themed"
                    type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="View"
                  >
                  <router-link :to="{name:'view-request-user', params: { id: contact.id }}">
                    <i class="bi bi-eye-fill" style="color: black;"></i>
                  </router-link>
                  </button>
                      <button
                  class="btn btn-primary"
                  type="button"
                  @click="confirm(contact.id)"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Xác nhận"
                  style="margin-right: 30px;margin-left: 20px;background-color:  #1dc9b7;"
                >
                  Xác nhận
                </button>
                <button
                  class="btn btn-primary"
                  type="button"
                  @click="cancel(contact.id)"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Từ chối"
                  style="background-color:  #c53511;"
                >
                  Từ chối
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
import { ref,reactive } from 'vue';
import status from '../../../components/status.vue';
export default{
  name:'req-member',
  data(){
    const contacts=ref([]);
    return {
      contacts
    }
    },
    components:{
      status
    },
  mounted(){
    axios.get(`http://localhost:8000/api/calendar/requests/manager`).then(res=>{
      this.contacts=res.data[0];
      });
  },
  methods:{
    cancel(id){
      const form = reactive({
      status: 3,
      });
      if(confirm('Đồng ý với yêu cầu này?')){
        axios.post(`http://localhost:8000/api/calendar/requests/edit/${id}`,form).then(res=>{
      console.log(res);
      this.$router.push({ path: '/user/request' });
            });
      }
      
    },
    confirm(id){
      const form = reactive({
      status: 2,
      });
      if(confirm('Từ chối yêu cầu?')){
        axios.post(`http://localhost:8000/api/calendar/requests/edit/${id}`,form).then(res=>{
        this.$router.push({ path: '/user/request' });
            });
      }
      
    }

  }
  
}
</script>
