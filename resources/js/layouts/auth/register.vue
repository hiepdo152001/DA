<template>
     <div class="login-form-header">
                    <h3 style="color: #886ab5;">Register</h3>
                </div>
    <div class="login-form">
    <form @submit.prevent="register">
        <div class="form-group">
          <label for="name">Name</label>
          <input class="form-control" v-model="form.name" required />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" v-model="form.email" required />
          <div class="alert alert-danger mt-2" v-if="checkEmail">
            {{ checkEmail }}
          </div>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" v-model="form.password" required /> 
          <div class="alert alert-danger mt-2" v-if="checkPassword">
            {{ checkPassword }}
          </div>
        </div>
        <button type="submit" class="btn btn-dark" style="background-color: #886ab5;margin-bottom: 50px;">Đăng ký</button>
      </form>
      </div>
      <div class="login-form-other" style="margin-top: 0px;">
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
import { reactive, ref} from "vue";
 import { useRouter } from "vue-router";
 import axios from "axios";
 export default {
   name: "register",
   data() {
    const form=reactive({
        name:"",
        email:"",
        password:""
       });
       const checkEmail=ref();
       const checkPassword =ref();
     return {
       form,
       checkEmail,
       checkPassword
     };
   },
   mounted(){
   }
   ,
   methods: {
    async register() {
    try {
      const res = await axios.post('http://localhost:8000/api/user/register', this.form);
      if (res.data.status === true) {
        window.location.href = "http://localhost:8000/admin/list/user";
        console.log(1); 
      }
    } catch (error) {
      this.checkEmail='';
      this.checkPassword='';
      if (error.response && error.response.status === 422) {
        this.errors = error.response.data.error;

        if (this.errors.hasOwnProperty('email')) {
          this.checkEmail = this.errors.email[0];
        }

        if (this.errors.hasOwnProperty('password')) {
          this.checkPassword = this.errors.password[0];
        }
      }
    }
  },
   }
 };
</script>