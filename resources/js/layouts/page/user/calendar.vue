<template>

<div class="row d-flex">
      <div class="col-sm-2 d-none d-sm-flex" style="padding: 0">
        <div style="width: 100%;    background-color: rgb(136, 106, 181);">
        <div>
          <div style="height: 47px;background-color: rgb(136, 106, 181);">
            <h1 style="text-align: center;">Do an </h1>
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
              <router-link :to="{ name: 'user-calendar' }">
                <i class="bi bi-calendar"></i>
                      <span>Calendar</span>
              </router-link>
            </a-menu-item>

            <a-menu-item key="request"  :class="{ 'd-none': user.role_id <= 3 }">
              <router-link :to="{ name: 'request-user' }">
                <i class="fal fa-share-square"></i>
                      <span>Yêu cầu của tôi</span>
              </router-link>
            </a-menu-item>
            <a-menu-item key="request-member" :class="{ 'd-none': user.role_id > 4 }" >
              <router-link :to="{ name: 'request-member' }">
                <i class="fal fa-share-square"></i>
                      <span>Yêu cầu cần duyệt</span>
              </router-link>
            </a-menu-item>
          </a-menu>
        </div>
    </div>
  </div>
  <div class="col-sm-10" style="padding: 0; height: 880px;background-color: #ece7e7;">
    <div class="MuiToolbar-root MuiToolbar-gutters MuiToolbar-regular css-zqjezy d-flex" style="
  justify-content: end; border-bottom: 1px solid gray;background-color: white;">
    <div class="dropdown" style="padding-right: 40px;float: right;">
      <div class="btn custom-dropdown" type="button" data-toggle="dropdown">
        <img style="width: 50px;height: 50px;" class="profile-images rounded-circle" :src=user.avatar >
      </div>
      <ul class="dropdown-menu dropdown-menu-right" style="padding: 0px;">
        <div
          class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top" 
          style="background: linear-gradient(250deg, #3e93d6, #8a75aa);"
        >
        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white" >
            <span class="mr-2">
              <img style="width: 50px;height: 50px;margin-right: 10px;"
                v-if="user.avatar"
                class="profile-image rounded-circle"
                :src="user.avatar"
                alt=""
              />
              <img
                v-else
                class="profile-image rounded-circle"
                alt=""
              />
            </span>
            <div class="info-card-text">
              <div class="fs-lg text-truncate text-truncate-lg">
                {{ user.name }}
              </div>
              <span class="text-truncate text-truncate-md opacity-80">
                {{ user.email }}
              </span>
            </div>
          </div>
        </div>
        <li>
          <router-link :to="{ name: 'test-sys'}">
            <a class="dropdown-item">Thông tin cá nhân</a>
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: '' }">
            <a class="dropdown-item">Đổi mật khẩu</a>
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: '' }">
            <a class="dropdown-item">Danh sách yêu cầu</a>
          </router-link>
        </li>
        <li style="padding-left: 20px">
          <form>
            <form @submit.prevent="logout">
              <button type="submit" class="dropdown-item">Logout</button>
            </form>
          </form>
        </li>
      </ul>
    </div>
    </div>
      <router-view></router-view>
  </div>
</div>
</template>
<script>
import { reactive, toRefs, onMounted, ref } from "vue";
import axios from 'axios';
export default{
  
  data(){
    const user=ref([]);
    const state = reactive({
      selectedKeys: ["lich-lam-viec"],
      openKeys: [""],
      });
      return {
      ...toRefs(state),
      user
      };
  },
  mounted(){
    axios.get(`http://localhost:8000/api/user`).then(response=>{
          this.user=response.data.data;
      });
  },
    methods:{
      logout(){
        axios.get(`http://localhost:8000/api/logout`).then(response=>{
          location.reload('');
        });
      }
    }
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
.text-truncate{
  color: white;
  font-size: 14px;
}
</style>
