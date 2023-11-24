<template>
    <div class="container">
      <div class="card card-default" style="padding-bottom: 50px">
        <div class="card-header">Register</div>
        <div class="col-sm-4 mt-5" style="margin: auto">
          <form @submit.prevent="register">
            <div class="form-group">
              <label for="name">Name</label>
              <input class="form-control" v-model="form.name" required />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                class="form-control"
                v-model="form.email"
                required
              />
              <div class="alert alert-danger" v-if="checkEmail">
                {{ checkEmail }}
              </div>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="password"
                class="form-control"
                v-model="form.password"
                required
              />
            </div>
            <div class="alert alert-danger" v-if="checkPassword">
              {{ checkPassword }}
            </div>
            <button type="submit" class="btn btn-dark">Register</button>
          </form>
        </div>
      </div>
    </div>
  </template>
  <script>
  import { reactive, ref, onMounted } from "vue";
  import { useRouter } from "vue-router";
  
  export default {
    setup() {
      const errors = ref([]);
      const checkEmail = ref("");
      const checkPassword = ref("");
      const router = useRouter();
      const form = reactive({
        name: "",
        email: "",
        password: "",
      });
      const register = async () => {
        try {
          let res = await ApiService.post(API_REGISTER, form);
          if (res.data.status === true) {
            window.location = MEMBER;
          }
        } catch (error) {
          if (error.response.status === 422) {
            for (const key in error.response.data.error) {
              errors.value = error.response.data.error;
            }
            if (errors.value.hasOwnProperty("email"))
              checkEmail.value = errors.value.email[0];
          }
          if (errors.value.hasOwnProperty("password")) {
            checkPassword.value = errors.value.password[0];
          }
        }
      };
      return {
        form,
        register,
        errors,
        checkEmail,
        checkPassword,
      };
    },
  };
  </script>
  