<template>
    <div class="login-container" >
        <div class="login-header">
            <a style="color: #886ab5;" href="http://localhost:8000/home">KMA Shope</a>
        </div>

        <div class="login-body">
            <!-- Form Login -->
            <div class="login-form-container" style="background-color: #fff;   ">
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
                            <input
                                type="checkbox"
                                class="remberMe-cbx"
                                id="checkbox_id"
                            />
                            <label class="remember-lbl" for="checkbox_id"
                                >Remember me</label
                            >
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
                        <a href="/" class="login-form-signupnow-link"
                            >Sign up now.</a
                        >
                    </div>

                    <div class="login-term">
                        <p>
                            This page is protected by Google reCAPTCHA to ensure
                            you're not a bot.
                        </p>
                        <a href="">Learn more.</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="login-overlay" style=" background-color: rgb(236, 231, 231);"></div>

        
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
      password: "12345678",
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
<style>
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

html {
    font-size: 10px;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.login-container {
    background-size: cover;
    height: 1086px;
    position: relative;
    width: 100%;
}

.login-overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
}

.login-header {
    padding-top: 20px;
    padding-left: 44px;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
}

.login-header a {
    font-size: 5rem;
    font-weight: 700;
    text-decoration: none;
    text-transform: uppercase;
    color: #e50914;
}

.login-body {
    width: 448px;
    height: 200px;
    background-color: rgba(0, 0, 0, 0.75);
    position: absolute;
    left: 0;
    right: 0;
    margin: auto;
    top: 88px;
    border-radius: 5px;
    z-index: 1;
}

.login-form-header {
    font-size: 3.2rem;
    font-weight: 700px;
    color: #fff;
}

.login-form-container {
    padding: 60px 70px 0;
}

.login-form-input {
    width: 100%;
    height: 50px;
    margin-top: 16px;
    padding: 0 16px;
    color: #fff;
    font-size: 1.6rem;
    background-color: rgb(236, 231, 231);;
    border: 1px solid #333333;
    border-radius: 4px;
    outline: none;
}

.login-form-input:focus {
    border-bottom: 3px solid #eeaf67;
}

.login-form-input:first-child {
    margin-top: 30px;
}

.login-form-button {
    color: #fff;
    background-color: #e50914;
    width: 100%;
    font-size: 1.6rem;
    padding: 16px;
    border-radius: 4px;
    border: 0px;
    margin: 40px 0 14px;
    font-weight: 700;
}

.login-form-help {
    color: #737373;
    font-size: 1.3rem;
    display: flex;
    justify-content: space-between;
}

.remberMe-cbx {
    height: 16px;
    width: 16px;
    border-radius: 2px;
    accent-color: #737373;
}

.remember-lbl {
    position: relative;
    bottom: 3px;
}

.help-link {
    text-decoration: none;
    color: #737373;
}

.login-form-other {
    margin-top: 60px;
}

.login-fb {
    text-decoration: none;
}

.login-fb-icon {
    height: 20px;
    width: 20px;
    margin-right: 10px;
}

.login-fb-text {
    font-size: 1.3rem;
    color: #737373;
    font-weight: 500;
    position: relative;
    bottom: 6px;
}

.login-form-signupnow {
    font-size: 16px;
    color: #737373;
    margin-top: 16px;
}

.login-form-signupnow-link {
    color: #fff;
    text-decoration: none;
}

.login-term {
    color: #737373;
    font-size: 1.3rem;
    margin-top: 16px;
    color: #737373;
}

.login-term p {
    display: inline;
}

.login-term a {
    color: #0071eb;
    text-decoration: none;
}

.login-term a:hover {
    text-decoration: underline;
}


</style>
