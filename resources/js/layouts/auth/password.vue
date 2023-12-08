<template>
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
              <button type="submit" class="btn btn-primary" style="background-color: #b00a1a!important;margin-left: 70px;">
                Câp nhật
              </button>
            </form>
            <div class="login-form-other">
                    <a href="auth/google/url" class="login-fb">
                        <i class="bi bi-google"></i>
                        <span class="login-fb-text" style="color: #886ab5;font-weight: 700;">Login with Google</span>
                    </a>

                    <div class="login-form-signupnow">
                        New to Kma shope?
                        <router-link :to="{ name: 'logins' }">
                            <span >Login now.</span>
                        </router-link>
                    </div>

                    <div class="login-term">
                        <p>
                            This page is protected by Google reCAPTCHA to ensure
                            you're not a bot.
                        </p>
                        <a href="">Learn more.</a>
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
            window.location.href = 'http://localhost:8000/login';
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