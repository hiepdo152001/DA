<template>
    <div class="panel" style="margin: 45px 30px 0px 30px;">
      <div class="panel-hdr">
        <h2 class="title" style="padding-top: 10px">Danh mục của tôi</h2>
      </div>
  
      <div class="panel-container">
        <div class="panel-content">
            <router-link :to="{name:'view-category'}">
            <button class="btn btn-primary waves-effect waves-themed" style="background-color: #886ab5;">
              + Thêm danh mục
            </button>
        </router-link>
        </div>
        <div class="panel-content">
          <table class="table table-bordered" style="margin-top: 30px">
            <thead>
              <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Trạng thái</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="category in data.data" class="contact-row">
                <td>{{ category.id }}</td>
                <td>{{ category.name }}</td>
                <td v-if="category.status ===1">Hoạt động</td>
                <td v-if="category.status ===2">Hủy bỏ</td>
                <td>
                  <button
                    class="btn btn-primary btn-sm waves-effect waves-themed"
                    type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="View"
                  >
                  <router-link :to="{name:'sys-holidayview', params: { id: category.id }}">
                    <i class="bi bi-eye-fill" style="color: black;"></i>
                  </router-link>
                  </button>
                  <button
                    class="btn btn-primary btn-sm waves-effect waves-themed" 
                    type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Delete"
                    v-on:click="handleDelete(category.id)"
                  >
                    <i class="bi bi-trash-fill" style="color: red;"></i>
                  </button> 
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="page">
            <Bootstrap5Pagination :data="data" @pagination-change-page="get" />
        </div>

      </div>
    </div>
  </template>
  
  <script>
  import { reactive, ref, onMounted } from "vue";
  import axios from "axios";
  import { Bootstrap5Pagination } from "laravel-vue-pagination";

  export default{
    name:"category",
    components:{
      Bootstrap5Pagination
    },
    data(){
      const data=ref([]);
      return{
        data
      }
    },
    mounted(){
      axios.get(`http://localhost:8000/api/category?page=1`).then(response=>{
        this.data=response.data.data;

      });
    },
    methods:{
      handleDelete(id){
        if(confirm("delete holiday ????")){
          axios.delete(`http://localhost:8000/api/category/${id}`).then(response=>{
            const index = this.data.findIndex(item => item.id === id);
            if (index !== -1) {
              this.data.splice(index, 1); 
            }
          });
        }
      },
      get(page=1){
        axios.get(`http://localhost:8000/api/category?page=${page}`).then(response=>{
        this.data=response.data.data;
      });
      }
    }
  }
    
  </script>
  
  <style>
  .status {
    border-radius: 15px;
    width: 75%;
    margin: auto;
    padding: 4px 0px;
    text-align: center;
    font-weight: 600;
  }
  
  .page-content .panel {
    margin-bottom: 1.5rem;
  }
  .panel {
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
  .panel-hdr > :first-child {
    padding-left: 1rem;
  }
  .table {
    margin-top: 30px;
    width: 100%;
    border-collapse: collapse;
  }
  .panel .panel-container .panel-content {
    padding: 0px 10px;
  }
  .contacts {
    margin: 20px;
  }
  
  .title {
    font-size: 24px;
    margin-bottom: 10px;
  }
  
  .table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .contact-row {
    border-bottom: 1px solid #ccc;
  }
  
  .contact-row:hover {
    background-color: #f5f5f5;
  }
  
.table-bordered th {
    font-size: 12px;
    text-align: center;
    font-weight: 700;
    padding: 12px!important;
    border: 1px solid #e9e9e9;
  }
  
  .table-bordered td {
    text-align: center;
    font-weight: 600;
    padding: 12px;
  }
  .table-bordered {
    border-collapse: collapse;
}
  
  .status-processing {
    color: #ff9800;
  }
  
  .status-completed {
    color: #4caf50;
  }
  
  .status-pending {
    color: #2196f3;
  }
  </style>
  