<template>
    <div class="panel">
      <div class="panel-hdr">
        <h2 class="title" style="padding-top: 10px">Yêu cầu của tôi</h2>
        <div>
          <h2 style="padding: 10px 20px 0px 0px">
            Số ngày phép còn lại:
          </h2>
        </div>
      </div>
  
      <div class="panel-container">
        <div class="panel-content">
            <router-link :to="{name:'createHld'}">
            <button class="btn btn-primary waves-effect waves-themed" style="background-color: #886ab5;">
              + Thêm sự kiện
            </button>
        </router-link>
        </div>
        <div class="panel-content">
          <table class="table table-bordered" style="margin-top: 30px">
            <thead>
              <tr>
                <th>Nội dung</th>
                <th>Thời gian</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="holiday in data" class="contact-row">
                <td>{{ holiday.title }}</td>
                <td>{{ holiday.time_start }} ~ {{ holiday.time_end }}</td>
                <td>
                  <button
                    class="btn"
                    type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="View"
                  >
                  <router-link :to="{name:'holidayview',params: { id: holiday.id }}">
                    <i class="bi bi-eye-fill"></i>
                  </router-link>
                  </button>
                  <button
                    class="btn"
                    type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Delete"
                    v-on:click="handleDelete(holiday.id)"
                  >
                    <i class="bi bi-trash-fill"></i>
                  </button> 
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { reactive, ref, onMounted } from "vue";
  import axios from "axios";

  export default{
    name:"holiday",
    data(){
      const data=ref([]);
      return{
        data
      }
    },
    mounted(){
      axios.get(`http://localhost:8000/api/calendar/holiday`).then(response=>{
        this.data=response.data.data;
      });
    },
    methods:{
      handleDelete(id){
        if(confirm("delete holiday ????")){
          axios.delete(`http://localhost:8000/api/calendar/holiday/${id}`).then(response=>{
            const index = this.data.findIndex(item => item.id === id);// tim index cua phan tu co id === id
            if (index !== -1) {
              this.data.splice(index, 1); // xoa index do
            }
          });
        }
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
  