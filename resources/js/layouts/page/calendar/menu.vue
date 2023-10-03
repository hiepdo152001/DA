<template>
  <div style="width: 100%;    background-color: rgb(136, 106, 181);">
    <div>
      <div style="height: 30px;background-color: brown;">
      </div>
      <div class="info-card">
            <img style="width: 50px;height: 50px;" class="profile-image rounded-circle" :src="user.avatar" >
        <div class="info-card-text">
            <div>
              <span class="text-info ">{{ user.name }} </span>
            </div>
            <div>
              <span class="text-info">{{ user.email }} </span>
            </div>
        </div>
      </div>
    </div>
  <div>
      <a-menu
        v-model:openKeys="openKeys"
        v-model:selectedKeys="selectedKeys"
        mode="inline"
      >
        <a-menu-item key="lich-lam-viec">
          
          <router-link :to="{ name: 'sys-calendar' }">
            <i class="bi bi-calendar " style="margin-right: 10px;"></i>
                  <span>Lịch làm việc</span>
          </router-link>
        </a-menu-item>
    
        <a-menu-item key="holiday" >
          <router-link :to="{ name: 'sys-holiday' }">
            <i class="bi bi-gift " style="margin-right: 10px;"></i>
                  <span>Sự kiện</span>
          </router-link>
        </a-menu-item>
      </a-menu>
  </div>
</div>
  </template>
<script>
import { ref } from "vue";
import axios from "axios";
export default {
    data(){
        const user=ref([]);
        return {
            user
        }
    },
    mounted(){
        axios.get(`http://localhost:8000/api/user`).then(response=>{
            this.user=response.data.data;
            
        });

    },
   
};
</script>
<style>
.info-card {
    position: relative;
    height: 9.53rem;
    color: #fff;
    overflow: hidden;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 0 2rem;
    -webkit-transition: all 700ms cubic-bezier(0.34, 1.25, 0.3, 1);
    transition: all 700ms cubic-bezier(0.34, 1.25, 0.3, 1);
    background-image: url('../../../assets/images.webp');
}
.info-card .profile-image {
    width: 3.125rem;
    height: auto;
    display: inline-block;
    z-index: 2;
    position: relative;
}
.text-info{
  font-size: 14px;
  color: white!important;;
}

.rounded-circle {
    border-radius: 50% !important;
}
.info-card .info-card-text {
    margin-left: 1rem;
    color: inherit;
    text-shadow: #000 0 1px;
    z-index: 1;
    position: relative;
    line-height: normal;
}
.info-card-text {
    font-size: 0.875rem;
    display: inline-block;
    vertical-align: middle;
    font-weight: 500;
    line-height: 1.35;
}
</style>