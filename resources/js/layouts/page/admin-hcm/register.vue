<template>
 <div class="container  mx-auto text-center" >
  <div class="card">
    <div class="card-header text-center" style="background-color: #886ab5;">
      <h3>Đăng ký</h3>
    </div>
    <div class="col-sm-8 mt-4" style="margin: auto;">
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
   <style>
   .container{
    width: 800px;
   }
   body {
     background-color: #f8f9fa;
   }
   .card {
     margin-top: 50px;
     border: none;
     border-radius: 15px;
     box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
   }
   .card-header {
     color: #ffffff;
     border-radius: 15px 15px 15px 15px;
   }
   .form-group {
     margin-bottom: 20px;
   }
   .btn-dark {
     background-color: #343a40;
     color: #ffffff;
   }
   .btn-dark:hover {
     background-color: #1d2124;
   }
 </style>