<template>
    <div class="panel" style="margin: 50px 30px 0px 30px;">
        <div class="col-sm-11">
            <div class="panel-hdr">
            <h2>Tìm Kiếm</h2>
            </div>
            <div class="col-sm-10">
            <form
            class="navbar-form navbar-left"
            enctype="multipart/form-data"
            @submit.prevent="SearchUser"
            >
            <div class="input-group">
                <input
                type="text"
                class="form-control"
                placeholder="Search"
                v-model="input.search"
                />
                <button class="btn btn-primary mt-2" type="submit" style="background-color: #886ab5;">Tìm Kiếm</button>
            </div>
            </form>
        </div>
        <div class="col-sm-2">
                <router-link :to="{name:'import-product'}">
                    <button class="btn btn-primary waves-effect waves-themed" style="background-color: #886ab5;margin-top: 40px;">
                    + Thêm phiếu 
                    </button>
                </router-link>
        </div>
    </div>
    <div class="panel-content " style="width: 95%;margin: auto;margin-bottom: 50px;">
    <table class="table table-bordered" style="margin-top: 30px">
      <thead>
        <tr>
          <th>Tên</th>
          <th>người tạo</th>
          <th>Đại lý</th>
          <th>Điện thoại liên hệ</th>
          <th>Địa điểm</th>
          <th>Người giao hàng</th>
          <th>Điện thoại liên hệ</th>
          <th>Chi nhanh</th>
          <th>Chi phí hóa đơn</th>
          <th>Trạng thái</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="bill in bills  " :key="bill.id" class="contact-row">
          <td>{{ bill.name }}</td>
          <th>{{ bill.user.name }}</th>
          <td>{{ bill.daily_name }} </td>
          <td>{{ bill.phone_daily }}</td>
          <td>{{ bill.location }} </td>
          <td>{{ bill.courier }}</td>
          <td>{{ bill.phone_courier }}</td>
          <td v-if=" bill.branch_id == null "> </td>
          <td v-if=" bill.branch_id == 1 "> Hồ Chí Minh</td>
          <td v-if=" bill.branch_id == 2 "> Đà Nẵng</td>
          <td>{{ formatCurrency(bill.total_price) }}</td>
          <td v-if=" bill.status == 0 " class="status-pending"> Chưa thanh toán</td>
          <td v-if=" bill.status == 1 " class="status-confirmed"> Đã thanh toán</td>
         
          
        <td>
          <button
            class="btn"
            type="button"
            data-toggle="tooltip"
            data-placement="top"
            title="view"
          >
            <router-link :to="{ name: 'view-import-booking', params: { id: parseInt(bill.id) } }">
              <i class="bi bi-eye" style="color: black !important;"></i>
            </router-link>
          </button>
        </td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="page">
      <Bootstrap5Pagination :data="bills" @pagination-change-page="Bills" />
    </div>
    </div>
</template>
<script>
import { reactive, ref } from 'vue';
import axios from 'axios';
import {Bootstrap5Pagination} from "laravel-vue-pagination";
export default{
name:"list-bills",
components:{
    Bootstrap5Pagination,

},
data(){
    const bills=ref([]);
    const users=ref([]);
    const input = reactive({
        search: ""
    });
    const user = ref([]);
    return {
        bills,
        users,
        input,
        user
    }
},
mounted(){
    axios.get(`http://localhost:8000/api/bill/get?page=1`)
    .then(response => {
      this.bills=response.data[0].data;
      console.log(this.bills);
    });

    
},
methods:{
    formatCurrency(value) {
      return parseFloat(value).toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND'
      });
    },
    Bills(page =1){
        axios.get(`http://localhost:8000/api/bill/get?page=${page}`).then(response=>{
          this.bills = response.data[0].data;
        });
    },
    // SearchUser(page =1){
    //     axios.get(`http://localhost:8000/api/user/all?page=${page}`,
    //     {params: { search: this.input.search }},
    //     ).then(response=>{
    //         this.users=response.data[0];
    //     });
    // }
}
}
</script>