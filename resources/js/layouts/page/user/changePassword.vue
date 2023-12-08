<template>
     
    <div class="panel" style=" width: 800px; margin: auto; margin-top: 50px;background-color: white;
" >
    <div class="panel-hdr">
        <h2 class="title" style="padding-top: 10px">Đổi mật khẩu</h2>
        
      </div>
      <div class="wallpaper-register"></div>
      <div class="container">
        <div class="row" style="padding: 20px;">
          <div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
            <form @submit.prevent="changePassword">
              <div class="form-group">
                <label for="email">Email</label>
                <input
                  type="email"
                  class="form-control"
                  v-model="form.email"
                  required
                />
              </div>
              <div class="form-group">
                <label for="old_password">Mật khẩu cũ</label>
                <input
                  type="password"
                  class="form-control"
                  v-model="form.old_password"
                  required
                />
              </div>
              <div class="form-group">
                <label for="new_password">Mật khẩu mới</label>
                <input
                  type="password"
                  class="form-control"
                  v-model="form.new_password"
                  required
                />
              </div>
              <div class="form-group">
                <label for="confirm_password">Nhập lại mật khẩu</label>
                <input
                  type="password"
                  class="form-control"
                  v-model="form.new_password_confirmation"
                  required
                />
              </div>
              <div class="alert alert-danger" v-if="message">
                {{ message }}
              </div >
              <button type="submit" class="btn btn-primary" style="background-color: rgb(136, 106, 181)!important;margin-left: 70px;">
                Câp nhật
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>
  <script>
  import { useRouter } from "vue-router";
  import { reactive, ref } from "vue";
  import axios from 'axios';
  export default {
    data() {
      const errors = ref([]);
      const message = ref("");
      const form = reactive({
        email: "test@gmail.com",
        old_password: "Aa123456@",
        new_password: "12345678",
        new_password_confirmation: "12345678",
      });
      return{
        form,
        message,
        errors
      }
    },
    methods:{
      changePassword(){
        this.message="";
        this.error="";
        if (this.form.new_password !== this.form.new_password_confirmation) {
            this.message = "Nhật lại mật khẩu không khớp!";
          }else if(this.form.new_password === this.form.old_password){
            this.message = "Mật khẩu mới không được trùng với mật khẩu hiện tại";
          } else {
            console.log(1);
            axios.put(`http://localhost:8000/api/user/password`, this.form).then(response =>{
            alert(response.data.message)
            window.location.href = 'http://localhost:8000/home';
            }).catch (error=> {
          console.log(error.response);
          if (error.response.status === 404) {
            for (const key in error.response.data) {
              this.errors = error.response.data;
            }
            this.message = this.errors.message;
          }
          if (error.response.status === 422) {
            for (const key in error.response.data.error) {
              this.errors = error.response.data.error;
            }
            if (this.errors.hasOwnProperty("new_password")) {
              this.message = this.errors.new_password[0];
            }
          }
        });
    }
  }
}
}
  </script>
  <style>
  .custom-card {
    max-width: 400px;
  }
  </style>
  