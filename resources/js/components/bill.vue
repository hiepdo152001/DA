<template>
	<div style="position: absolute; margin-top: -32px; right: 150px; color: white;">
		<router-link :to="{ name: 'view-bills' }">
            <span style="color: white!important; font-size: 20px;">Đơn hàng</span>
          </router-link>
		
	</div>
	<section class="py-5">
		<div v-if="cart == null">
			<div class="wrapper" style="width: 1000px;height:500px; margin: auto;margin-top:200px" > 
			<div style="; margin: auto;margin-left: 100px"> 
			<h2 >Không có sản phẩm nào trong giỏ hàng</h2> 
			<a style="margin-left: 250px"  class="btn btn-danger" href="../home">Mua Thêm 
			</a>
			</div> 
			</div>
		</div>
	  <div v-else class="container px-4 px-lg-5 mt-5">
		<!-- Shopping cart table -->
		<div class="table-responsive">
		  <table class="table">
			<thead>
			  <tr>
				<th scope="col" class="border-0 bg-light">
				  <div class="p-2 px-3 text-uppercase">Sản phẩm</div>
				</th>
				<th scope="col" class="border-0 bg-light">
				  <div class="py-2 text-uppercase">Trạng thái</div>
				</th>
				<th scope="col" class="border-0 bg-light">
				  <div class="py-2 text-uppercase">Giá</div>
				</th>
				<th scope="col" class="border-0 bg-light">
				  <div class="py-2 text-uppercase">Số lượng</div>
				</th>
                <th scope="col" class="border-0 bg-light">
				  <div class="py-2 text-uppercase">Tổng tiền</div>
				</th>
				<th scope="col" class="border-0 bg-light">
				  <div class="py-2 text-uppercase">Hành động</div>
				</th>
			  </tr>
			</thead>
			<tbody>
			  <!-- Sử dụng v-for để lặp qua danh sách sản phẩm trong giỏ hàng -->
				 <tr v-for="(ci, index) in cart.data" :key="index">
      <!-- Kiểm tra xem ci có phải là phần tử cuối cùng không -->
				<td  scope="row" class="border-0">
				  <div class="p-2">
					<img v-if="hasBillDetails(ci)"
					  :src="ci.bill_details[0].product.avatar"
					  style="width: 80px; height:80px;"
					/>
				  </div>
				  <div class="ml-3 d-inline-block align-middle">
					<h5 class="mb-0">
					  <a v-if="hasBillDetails(ci)" href="#" class="text-dark d-inline-block align-middle">
						<!-- Sử dụng {{ ci.productName }} để hiển thị tên sản phẩm -->
						{{ ci.bill_details[0].product.name }}
					  </a>
					</h5>
				  </div>
				</td>
				<td class="border-0 align-middle">
				  <span v-if="hasBillDetails(ci)" >
					<span v-if="ci.status == 1" class="status-approved" style="color: white;"> Giao hàng thành công </span>
					<span v-if="ci.status == 0" class="status-approved" style="color: white;"> Đang giao hàng </span>
					<span v-if="ci.status == 3" class="status-canceled" style="color: white;"> Chờ phản hồi hủy đơn </span>
					<span v-if="ci.status == 2" class="status-approved" style="color: white;">Hoàn tất </span>
				  </span>
				</td>
				<td v-if="hasBillDetails(ci)" class="border-0 align-middle" style="color: brown;font-size: 20px;">
				  <strong >{{ formatCurrency(ci.bill_details[0].product.price) }}</strong>
				</td>
				<td v-if="hasBillDetails(ci)" class="border-0 align-middle" >
				<strong><span :id="'quanlity_' + ci.id">{{ ci.bill_details[0].quantity }}</span></strong>
				</td>
                <td v-if="hasBillDetails(ci)" class="border-0 align-middle" style="color: brown;font-size: 20px;">
                    <strong >{{ formatCurrency(ci.bill_details[0].subtotal) }}</strong>
                    
                </td>
				<td class="border-0 align-middle" v-if="ci.status == 0 && hasBillDetails(ci)">
				  <button class="btn btn-danger " @click="update(ci.id,3)" >Hủy</button>
				</td>
                <td class="border-0 align-middle" v-if="ci.status ==1 && hasBillDetails(ci)">
				  <button class="btn btn-danger " @click="update(ci.id,2)" >Đã thanh toán</button>
				</td>
			  </tr>
			</tbody>
		  </table>
		</div>
	  </div>
	</section>
  </template>
  
  <script>
  import axios from "axios";
  import { ref,reactive} from "vue";
  export default {
	data(){
		const cart=ref([]);
		var total=ref();
		var status=ref();
		const selectedProductIds= ref([]);
		const formUser = reactive({
		  name: "",
		  address: "",
		  email: "",
		  phone: "",
		  branch_id : 1,
		  keyProduct: [],	
		})
	  return {
		cart,
		total,
		status,
		selectedProductIds,
		formUser
	  }
	},
	computed: {
		
	},
	mounted() {
	  this.fetchCartData();
	},
	methods: {
		fetchCartData(){
		axios.get(`http://localhost:8000/api/bills/get`).then((response) => {
            this.cart= response.data.data;
			console.log(this.cart);
            this.status= response.data.data.status;
            this.total=response.data.data.total_amount;
	  	});
		}
		,
      hasBillDetails(category) {
      return category.bill_details  && category.bill_details.length >0;
      },
		formatCurrency(value) {
			return parseFloat(value).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			});
			},
	  // Hàm cập nhật số lượng
		updateQuantity(productId, change) {
			var data= {
				'value' : change
			}
			// Gọi API để cập nhật số lượng
			axios.post(`http://localhost:8000/api/order/update/${productId}`,data).then((response) => {
			this.fetchCartData();
		});
		},
	  // Hàm xóa sản phẩm
		deletes(productId) {
			if(confirm("Bạn có muốn xóa sản phẩm khỏi giỏ hàng?")){
          	axios.delete(`http://localhost:8000/api/order/${productId}`).then(response=>{
			this.fetchCartData();
			});
			}
		},
		update(productId,status){
			var message ='';
			if(status ==2){
				message = "Bạn đã nhận hàng và thanh toán ?";
			}
			if(status == 3){
				message =" Bạn muốn hủy đơn hàng?";
			}
			if(confirm(message)){
				var data= {
				'status' : status
			}
          	axios.post(`http://localhost:8000/api/bills/update/${productId}`,data).then(response=>{
			this.fetchCartData();
			});
			}
		}
	},
  };

  </script>
  <style scoped>
  .quantity-button {
	/* Thêm các thuộc tính CSS tùy chọn dưới đây */
	background-color: #c02f3e;
	color: white;
	border: none;
	padding: 0px 10px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 16px;
	margin: 4px 2px;
	cursor: pointer;
  }
  .status-approved{
background-color:  #1dc9b7;
padding: 5px;
border-radius: 15px;
}
.status-canceled{
background-color:  #c53511;
padding: 5px;
border-radius: 15px;
}

  </style>