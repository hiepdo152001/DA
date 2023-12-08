<template>
    <div class="panel" style="margin: 45px 30px 0px 30px;">
      <div class="panel-hdr">
        <h2 class="title" style="padding-top: 10px">Danh mục của tôi</h2>
      </div>
  
      <div class="panel-container">
        <div class="panel-content">
            <router-link :to="{name:'add-Bills'}">
            <button class="btn btn-primary waves-effect waves-themed" style="background-color: #886ab5;">
              + Thêm đơn hàng
            </button>
        </router-link>
        </div>
        <div class="panel-content">
          <table class="table table-bordered" style="margin-top: 30px">
            <thead>
              <tr>
                <th>Người mua </th>
                <th>Địa chỉ</th>
                <th>Sản phẩm</th>
                <th>Trạng thái</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(category, index) in data.data" :key="index" >
                
                <td v-if="hasBillDetails(category)">{{ category.name }} <br> sdt: {{ category.phone }}</td>
                <td v-if="hasBillDetails(category)">{{ category.address }}</td>
                <td v-if="hasBillDetails(category)">
                  <img v-if="category.bill_details[0]" :src="category.bill_details[0].product.avatar" alt="" style="width: 50px;height: 50px;">
                </td>
               <td v-if="category.status ===3 && hasBillDetails(category)" class="status-canceled">Hủy bỏ</td>
               <td v-if="category.status ===2" class="status-approved" style="color: red;">Hoàn thành</td>
               <td v-if="category.status ===1" class="status-confirmed" style="color: rgb(255, 136, 0);">Đang giao hàng</td>
                <td v-if="category.status === 0 " class="status-pending">Chờ lấy hàng</td> 
                <td v-if="hasBillDetails(category)">
                  {{ formatCurrency(category.bill_details[0].product.price) }}
                </td>
                <td v-if="hasBillDetails(category)">
                  {{ category.bill_details[0].quantity }}
                </td>
                <td v-if="hasBillDetails(category)">
                  {{ formatCurrency(category.total_amount) }}
                </td>
                <td v-if="hasBillDetails(category)">
                  
                  <button v-if="category.status == 0"
                    class="btn btn-primary btn-sm waves-effect waves-themed" 
                    type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    v-on:click="handle(category.id,1)"
                  >
                  <span>Đã gửi ship</span>
                  </button> 
                  <button v-if="category.status == 1"
                    class="btn btn-primary btn-sm waves-effect waves-themed" 
                    type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    v-on:click="handle(category.id,2)"
                  >
                 <span> Hoàn tất</span> 
                  </button>
                  <button v-if="category.status ==3"
                    class="btn btn-primary btn-sm waves-effect waves-themed" 
                    type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Delete"
                    v-on:click="handleDelete(category.bill_details[0].id,category.id)"
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
      const page =ref([]);
      var total=ref();
      return{
        data,
        page,
        total
        
      }
    },
    mounted(){
     this.fesh();
    },
    methods:{
      fesh(){
        axios.get(`http://localhost:8000/api/bills/get?page=1`).then(response=>{
        this.data=response.data.data;
        console.log(this.data.data);
        this.page = response.data.data;
      });
      }
      ,
      hasBillDetails(category) {
        console.log(category);
      return category.bill_details  && category.bill_details.length > 0;
      },
		formatCurrency(value) {
			return parseFloat(value).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			});
			},
      handleDelete(bill_details_id){
        console.log(bill_details_id);
        if(confirm("delete category ????")){
          axios.delete(`http://localhost:8000/api/bills/${bill_details_id}`).then(response=>{
          });
        }
      },
      handle(id,status){
            var message ='';
          if(status == 2){
            message = "Đã thanh toán ?";
          }
          if(status == 1){
            message =" Đã chuyển hàng cho shipper";
          }
          if(confirm(message)){
            var data= {
            'status' : status
          }
                axios.post(`http://localhost:8000/api/bills/update/${id}`,data).then(response=>{
          this.fesh();
          });
          }
      },
      get(page=1){
        axios.get(`http://localhost:8000/api/bills/get?page=${page}`).then(response=>{
        this.data=response.data.data;
      });
      }
    }
  }
    
  </script>
  
  <style>
  .status-pending {
background-color: #2196f3;
}
.status-confirmed {
background-color: #4caf50 ;
}
.status-approved{
background-color:  #1dc9b7;
}
.status-declined {
background-color:  #a26304;
}
.status-canceled{
background-color:  #c53511;
}
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
  