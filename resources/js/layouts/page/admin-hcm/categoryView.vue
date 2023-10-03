<template>
    <div class="panel" style="margin: 50px 30px 0px 30px;">
      <div class="panel-hdr">
        <h2 class="title" style="padding-top: 10px">Danh mục của tôi</h2>
        <div>
          <h2 style="padding: 10px 20px 0px 0px">
            Số ngày phép còn lại:
          </h2>
        </div>
      </div>
      <div class="panel-content" style="margin-top: 20px;">
        <div class="col-md-6">
          <form v-on:submit.prevent="CreateCategory">
            <div class="col-md-8">
              <div class="form-group">
                <label for="phone">Tên danh mục</label>
                <textarea
                  class="form-control"
                  id="validationTextarea"
                  required
                  v-model="data.name"
                  
                ></textarea>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-3"></div>
            </div>
           
            <div class="col-md-6" style="margin-bottom: 10px">
              <button
                type="submit"
                class="btn btn-success waves-effect waves-themed"
              >
                <i class="fal fa-save"></i>
                Thêm
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { reactive} from "vue";
  import { useRouter } from "vue-router";
  import axios from "axios";
  export default {
    data() {
     const router = useRouter();
     const id = router.currentRoute.value.params.id;
     const data=reactive({
         name:"",
         status:1,
        });
      return {
        data,
        id
      };
    },
    mounted(){
       if(this.id){
         axios.get(`http://localhost:8000/api/category/${this.id}`)
         .then(response=>{
                     this.data=response.data.data;
                 });
       }
     }
    ,
    methods: {
      CreateCategory() {
        axios.post(`http://localhost:8000/api/category`,this.data).then(response=>{
               console.log(response);
               
          });
      }
    }
  };
  </script>
<style>
h2 {
font-size: 14px !important;
font-weight: 600 !important;
}
.rules {
padding: 25px;
background-color: ghostwhite;
margin: 20px;
}
.btn-success {
color: #fff;
background-color: #1dc9b7;
border-color: #1dc9b7;
}
.btn-success:hover {
color: #fff;
background-color: #18a899;
border-color: #179c8e;
}
.page-content .panel {
margin-bottom: 1.5rem;

}
.panel {
   padding: 20px;
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-orient: vertical;
-webkit-box-direction: normal;
-ms-flex-direction: column;
flex-direction: column;
position: relative;
background-color: #fff;
-webkit-box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
margin-bottom: 1.5rem;
border-radius: 4px;
border: 1px solid rgba(0, 0, 0, 0.09);
border-bottom: 1px solid #e0e0e0;
border-radius: 4px;
-webkit-transition: border 500ms ease-out;
transition: border 500ms ease-out;
}
.panel-hdr {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
justify-content: space-between;

-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
background: #fff;
min-height: 3rem;
border-bottom: 1px solid rgba(0, 0, 0, 0.07);
border-radius: 4px 4px 0 0;
-webkit-transition: background-color 0.4s ease-out;
transition: background-color 0.4s ease-out;
}
.panel .panel-container {
position: relative;
border-radius: 0 0 4px 4px;
}
.panel-container {
margin-top: 30px;
}
.panel .panel-container .panel-content:only-child,
.panel .panel-container .panel-content:last-child {
border-radius: 0 0 4px 4px;
}
</style>