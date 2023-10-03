<template>
    <div class="MuiToolbar-root MuiToolbar-gutters MuiToolbar-regular css-zqjezy d-flex" style="justify-content: space-between">
    <div class="MuiBox-root css-1guk29">
        <router-link :to="{name:'view-user'}">
            <button class=" css-hmyp7d"  type="button" style="margin-right: 10px;">
                <span class="css-16rzsu1">
                        <i class="bi bi-house"></i>
                        Home
                    </span>
            </button>
        </router-link>
        <router-link :to="{name:'sys-calendar'}">
            <button class=" css-hmyp7d"  type="button" style="margin-right: 10px;">
                <span class="css-16rzsu1">
                        <i class="bi bi-calendar"></i>
                        Calendar
                    </span>
            </button>
        </router-link>
        <router-link :to="{name:'admin-dn'}">
            <button class=" css-hmyp7d"  type="button" style="margin-right: 10px;">
                <span class="css-16rzsu1">
                        <i class="bi bi-calendar"></i>
                        StoreDN
                    </span>
            </button>
        </router-link>
        <router-link :to="{name:'admin-hcm'}">
            <button class=" css-hmyp7d"  type="button" style="margin-right: 10px;">
                <span class="css-16rzsu1">
                        <i class="bi bi-calendar"></i>
                        StoreHCM
                    </span>
            </button>
        </router-link>
    </div>
    <div class="dropdown" style="padding-right: 40px;">
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
              <img style="width: 50px;height: 50px;"
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
    <div >
        <router-view></router-view>
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
.profile-image {
  width: 50px;
  height: 50px;
}
.router-link-exact-active .css-hmyp7d {
    color: white !important;
    text-decoration: none !important;
    font-size: 14px;
    border-color: white  !important;
    font-weight: 700;
}
.css-16rzsu1 a{
color: rgb(138, 141, 147);
}

.active-button {
border-color: red!important;;
}
a:hover{
    text-decoration: none !important;;
}
.css-16rzsu1{
    font-size: 12px;
}
.css-i1wm59.MuiButton-outlined {
    padding: 0.1875rem 0.8125rem;
}
.css-hmyp7d:hover{
    border-color: white;
    color: white;
}
.css-hmyp7d {
    display: inline-flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    position: relative;
    box-sizing: border-box;
    -webkit-tap-highlight-color: transparent;
    background-color: transparent;
    outline: 0px;
    margin: 0px;
    cursor: pointer;
    user-select: none;
    vertical-align: middle;
    appearance: none;
    text-decoration: none;
    font-family: Inter, sans-serif, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    font-size: 0.8125rem;
    text-transform: uppercase;
    color: rgb(138, 141, 147);
    min-width: 64px;
    transition: background-color 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, box-shadow 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, border-color 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, color 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    border: 1px solid rgba(138, 141, 147, 0.5);
    font-weight: 500;
    border-radius: 5px;
    line-height: 1.71;
    letter-spacing: 0.3px;
    padding: 0.25rem 0.5625rem;
}
@media (min-width: 600px){
.css-zqjezy {
    padding-left: 0.75rem;
    padding-right: 0.75rem;
}
}
.css-zqjezy {
    position: relative;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    padding-left: 0.5rem;
    min-height: 64px;
    padding-right: 0rem;
    background-color: rgb(33, 57, 124);
}
.text-truncate{
  font-size: 14px;
  color: white;
  padding-left: 10px;
  margin-bottom: 10px;
}
</style>