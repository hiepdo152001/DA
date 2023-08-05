<template>
    <div class="login-container">
        <div class="login-header">
            <a href="/">KMA Shope</a>
        </div>

        <div class="login-body">
            <!-- Form Login -->
            <div class="login-form-container">
                <div class="login-form-header">
                    <h4>Login</h4>
                </div>

                <div class="login-form">
                    <input
                        type="text"
                        class="login-form-input"
                        placeholder="Email or phone number"
                    />
                    <input
                        type="password"
                        class="login-form-input"
                        placeholder="Password"
                    />
                    <button class="login-form-button">Sign In</button>

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
                        <span class="login-fb-text">Login with Google</span>
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

        <div class="login-overlay"></div>

        <div class="login-footer"></div>
    </div>
</template>
<script>
import { reactive, ref } from "vue";

export default {
    setup() {
        const registerActive = ref(false);
        const errors = ref([]);
        const check = ref("");
        const errorregis = ref([]);
        const checkEmail = ref("");
        const checkPassword = ref("");
        const formregis = reactive({
            name: "",
            email: "",
            password: "",
        });
        const formlogin = reactive({
            email: "admin@gmail.com",
            password: "12345678",
        });
        const login = async () => {
            try {
                let res = await ApiService.post(API_LOGIN, formlogin);
                if (res.data.status === true) {
                    jwtService.setToken(JSON.stringify(res.data.token));
                    window.location.href = HOME_CALENDAR;
                }
            } catch (error) {
                if (error.response.status === 401) {
                    for (const key in error.response.data) {
                        errors.value = error.response.data;
                    }
                    check.value = errors.value.message;
                }
            }
        };
        const register = async () => {
            try {
                let res = await ApiService.post(API_REGISTER, formregis);
                if (res.data.status === true) {
                    alert(res.data.message);
                    window.location.href = APP_URL;
                }
            } catch (error) {
                if (error.response.status === 422) {
                    checkEmail.value = "";
                    checkPassword.value = "";
                    for (const key in error.response.data.error) {
                        errorregis.value = error.response.data.error;
                    }
                    if (errorregis.value.hasOwnProperty("email"))
                        checkEmail.value = errorregis.value.email[0];
                }
                if (errorregis.value.hasOwnProperty("password")) {
                    checkPassword.value = errorregis.value.password[0];
                }
            }
        };
        return {
            login,
            formlogin,
            register,
            formregis,
            errorregis,
            check,
            registerActive,
            checkEmail,
            checkPassword,
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
    height: 660px;
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
    background-color: #333333;
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

.login-footer {
    width: 100%;
    background-color: rgba(0, 0, 0, 0.75);
    height: 220px;
    position: absolute;
    left: 0;
    bottom: 0;
    padding: 30px 0;
}
</style>
