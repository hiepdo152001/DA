<template>
    <div class="panel" style="margin: 35px;">
    <div>
      <div>
        <div class="panel-hdr">
          <h2 >Thông tin Đơn Nhập Hàng</h2>
        </div>
        <div class="col-6">
          <!-- <router-link :to="{ name: 'view-import-booking',params: { id: product.id } }">
            <button
              class="btn  btn-sm waves-effect waves-themed"
              style="margin: 15px 0px 0px 25px;color: #fff;
                background-color: #886ab5;
                border-color: #886ab5;"
            >
              <i class="bi bi-pencil" style="padding: 0px 5px 0px 5px;"></i>
            </button>
          </router-link> -->
        </div>
      </div>
    </div>
    <div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-center mb-4">Thông tin</h2>

            <!-- Thông tin Nhập Hàng -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Thông Tin Nhập Hàng</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Địa điểm nhập hàng:</strong> {{ bill.location }}</p>
                            <p><strong>Nhà phân phối:</strong> {{ bill.daily_name }}</p>
                            <p><strong>Số điện thoại:</strong> {{ bill.phone_daily }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Người lập phiếu:</strong> {{ user }}</p>
                            <p><strong>Người giao hàng:</strong> {{ bill.courier }}</p>
                            <p><strong>Số điện thoại:</strong> {{ bill.phone_courier }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chi Tiết Sản Phẩm -->
            <div class="card">
                <div class="card-header">
                    <h4>Chi Tiết Sản Phẩm</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ảnh</th>
                                    <th>Tên</th>
                                    <th>Giá Nhập</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in bill.products" class="contact-row">
                                    <td>{{ product.id }}</td>
                                    <td>
                                        <img :src="product.avatar" alt="" style="width: 50px; height: 50px;">
                                    </td>
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.import_price }}</td>
                                    <td>{{ product.amount }}</td>
                                    <td>{{ formatCurrency(product.pivot.sum)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card mt-4">
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
    <p>
        <strong>Tổng hóa đơn: </strong>
        <span style="color: red; font-size: 24px; display: inline-block;">{{ formatCurrency(bill.total_price) }}</span>
    </p>
</div>
<div class="col-md-6">
    <p>
        <strong>Trạng thái:</strong>
        <span v-if="bill.status === 0" class="badge status-pending" style="font-size: 24px; display: inline-block;">Chưa thanh toán</span>
        <span v-if="bill.status === 1" class="badge status-confirmed" style="font-size: 24px; display: inline-block;">Đã thanh toán</span>
    </p>
</div>

                    </div>
                </div>
            </div>
                </div>
            </div>

            <!-- Thông tin Tổng Hợp -->
           
        </div>
    </div>
</div>



    </div>
  </template>
  <script>
    import { ref} from "vue";
    import axios from "axios";
    import { useRouter } from "vue-router";
  
  export default {
    name:"view-product",
    data(){
        const bill=ref([]);
        const router = useRouter();
        const user=ref();
        const id = router.currentRoute.value.params.id;
        return {
            bill,
            id,
            user
        }
    },
    mounted(){
        try {
            if(this.id){
                axios.get(`http://localhost:8000/api/bill/by/${this.id}`)
                .then(response=>{
                    this.bill=response.data[0];
                    this.user=this.bill.user.name;
                    console.log(this.bill);
                });
            }
        } catch (error) {
            alert(error);
        }
    },
    methods:{
        formatCurrency(value) {
      // Định dạng giá trị về tiền tệ VNĐ
      return parseFloat(value).toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND'
      });
    },
    }
   
  };
  </script>
  <style>
  .product-image{
    width: 100px;height: 100px;
  }
  .pending{
    background-color: #a26304;
  }
  .agree{
    background-color: #4caf50;
  }
  </style>