<template>
    <div class="container  mx-auto text-center" >
     <div class="card" style="margin-top: 100px;">
       <div class="card-header text-center" style="background-color: #886ab5;">
         <h3>Thống kê</h3>
       </div>
       <div style="width: 300px; margin: auto; display: flex; margin-bottom: 30px;">
		  <a style="margin-top: 30px;font-size: 20px;"> Doanh thu : &nbsp</a>
		  <h1 id="totalPrice" style="color: red;">
		 {{ formatCurrency(total) }}
			
		  </h1>
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
          const total=ref();
          return{
            total
          }
        },
        mounted(){
          axios.get(`http://localhost:8000/api/sta`).then(response=>{
           
           this.total= response.data.data;
        });
        }
        ,
        methods: {
            formatCurrency(value) {
              return parseFloat(value).toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
              });
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