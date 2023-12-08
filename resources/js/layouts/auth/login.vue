<template>
    <div class="login-form-header">
                    <h3 style="color: #886ab5;">Login</h3>
                </div>
    <div class="login-form">

<form @submit.prevent="login">
     <div class="form-group">
         <label style="color: #886ab5;" for="email">Email</label>
         <input type="text" style="color: black;"
     class="login-form-input"
     placeholder="Email or phone number"
     v-model="form.email"
         required
         />
     </div>
     <div class="form-group">
         <label style="color: #886ab5;;" for="password">Password</label>
         <input
         style="color: black;"
         type="password"
     class="login-form-input"
     placeholder="Password"
     v-model="form.password"
         />
     </div>
     <div class="alert alert-danger" v-if="check">
         {{ check }}
     </div>
     <button style="margin-left: 120px; background-color: #886ab5;;" type="submit" class="btn btn-dark">Login</button>
     </form>

 <div class="login-form-help">
     <div class="login-form-rememberMe">
        
        <router-link :to="{ name: 'password-guest' }">
                            <span >change Password</span>
        </router-link>
     </div>
     <a class="help-link" href="/">Need help?</a>
 </div>
</div>
<div class="login-form-other">
                    <a href="auth/google/url" class="login-fb">
                        <i class="bi bi-google"></i>
                        <span class="login-fb-text" style="color: #886ab5;font-weight: 700;">Login with Google</span>
                    </a>

                    <div class="login-form-signupnow">
                        New to Kma shope?
                        <router-link :to="{ name: 'register-guest' }">
                            <span >Sign up now.</span>
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
import { reactive, ref } from "vue";
import axios from "axios";
import { message } from "ant-design-vue";
export default {
  setup() {
    const errors = ref([]);
    const check = ref("");
    const form = reactive({
      email: "admin@gmail.com",
      password: "Aa123456@",
    });
    const login = async () => {
        message.value='';
      try {
        const res = await axios.post('http://localhost:8000/api/login', form);
        if (res.data.status === true) {
          window.location.href = 'http://localhost:8000/home';
        }
      } catch (error) {
        console.log(error); 
        if (error.response.status === 401) {
          for (const key in error.response.data) {
            errors.value = error.response.data;
          }
          check.value = errors.value.message;
        }
        else if (error.response.status === 500) {
          for (const key in error.response.data) {
            errors.value = error.response.data;
          }
          check.value = errors.value.message;
        }
      }
    };
    return {
      form,
      login,
      errors,
      check,
    };
  },
};
</script>