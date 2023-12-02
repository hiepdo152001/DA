<template>
	<section class="py-5">
	  <div class="container px-4 px-lg-5 mt-5">
		<!-- Shopping cart table -->
		<div class="table-responsive">
		  <table class="table">
			<thead>
			  <tr>
				<th scope="col" class="border-0 bg-light">
				  <div class="p-2 px-3 text-uppercase">Sản phẩm</div>
				</th>
				<th scope="col" class="border-0 bg-light">
				  <div class="py-2 text-uppercase">Status</div>
				</th>
				<th scope="col" class="border-0 bg-light">
				  <div class="py-2 text-uppercase">Giá</div>
				</th>
				<th scope="col" class="border-0 bg-light">
				  <div class="py-2 text-uppercase">Số lượng</div>
				</th>
				<th scope="col" class="border-0 bg-light">
				  <div class="py-2 text-uppercase">Hành động</div>
				</th>
			  </tr>
			</thead>
			<tbody>
			  <!-- Sử dụng v-for để lặp qua danh sách sản phẩm trong giỏ hàng -->
				 <tr v-for="(ci, index) in cart" :key="index">
      <!-- Kiểm tra xem ci có phải là phần tử cuối cùng không -->
				<td  scope="row" class="border-0">
				  <div class="p-2">
					<img
					  v-if="checks != 1"
					  :src="ci.product.avatar"
					  style="width: 80px; height:80px;"
					/>
					<img
					  v-else
					  :src="ci.avatar"
					  style="width: 80px; height:80px;"
					/>
				  </div>
				  <div class="ml-3 d-inline-block align-middle">
					<h5 class="mb-0">
					  <a href="#" class="text-dark d-inline-block align-middle">
						<!-- Sử dụng {{ ci.productName }} để hiển thị tên sản phẩm -->
						{{ ci.name }}
					  </a>
					</h5>
				  </div>
				</td>
				<td>
				  <span v-if="checks != 1">{{ ci.product.status }}</span>
				  <span v-else>{{ ci.status }}</span>
				</td>
				<td class="border-0 align-middle">
				  <strong v-if="checks != 1">{{ formatCurrency(ci.product.price) }}</strong>
				  <strong v-else>{{ formatCurrency(ci.price) }}</strong>
				</td>
				<td class="border-0 align-middle">
				<button @click="updateQuantity(ci.id, -1)" v-if="ci.quantity > 1" class="quantity-button" style="margin-right: 5px;">-</button>
				<button @click="deletes(ci.id)" v-if="ci.quantity == 1" class="quantity-button">-</button>
				<strong><span :id="'quanlity_' + ci.id">{{ ci.quantity }}</span></strong>
				<button @click="updateQuantity(ci.id, 1)" v-if="ci.quantity >= 1" class="quantity-button" style="margin-left: 5px;"> + </button>
				</td>
				<td class="border-0 align-middle">
				  <button class="btn btn-danger " @click="deletes(ci.id)" >Delete</button>
				</td>
			  </tr>
			</tbody>
		  </table>
		</div>
		<!-- End -->
  
		<!-- Hiển thị tổng tiền -->
		<div style="width: 300px; margin: auto; display: flex;">
		  <a style="margin-top: 20px">Tổng Tiền :</a>
		  <h1 id="totalPrice" >
			<!-- Sử dụng {{ cart.totalPrice }} để hiển thị tổng tiền -->
			{{ formatCurrency(total) }}
		  </h1>
		 
		</div>
  
		<!-- Form đặt hàng -->
		<!-- <form  >
		  <div class="p-4" style="width: 300px">
			<div class="form-group">
			  <label for="customerFullName">Name</label>
			  <input
				type="text"
				class="form-control"
				id="customerFullName"
				name="customerFullName"
				v-model="userLogined.name"
				placeholder="Full name"
			  />
			</div>
			<div class="form-group">
			  <label for="customerAddress">Address</label>
			  <input
				type="text"
				class="form-control"
				id="customerAddress"
				name="customerAddress"
				v-model="userLogined.address"
				placeholder="Address"
			  />
			</div>
			<div class="form-group">
			  <label for="customerEmail">Email Address</label>
			  <input
				type="email"
				class="form-control"
				id="customerEmail"
				name="customerEmail"
				v-model="userLogined.email"
				placeholder="Enter email"
			  />
			  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			</div>
			<div class="form-group">
			  <label for="customerPhone">Phone</label>
			  <input
				type="tel"
				class="form-control"
				id="customerPhone"
				name="customerPhone"
				v-model="userLogined.phone"
				placeholder="Phone"
			  />
			</div>
		  </div>
		  <button type="submit" class="btn btn-dark rounded-pill py-2 btn-block">Mua Hàng</button>
		</form> -->
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
		var checks=ref();
	  return {
		// Thêm dữ liệu mới cho userLogined và cart
		// userLogined: {
		//   name: "",
		//   address: "",
		//   email: "",
		//   phone: "",
		// },
		cart,
		total,
		checks,
		
	  }
	},
	mounted() {
	  this.fetchCartData();
	  
	},
	methods: {
		fetchCartData(){
		axios.get(`http://localhost:8000/api/order/get`).then((response) => {
			if(response.data.check == 'notuser'){
				this.checks=1;
				this.cart = response.data.data;
				this.total = response.data.total;
				console.log(this.cart);
			}
			else{
				this.cart = response.data.data.order[0].order_details.product;
				this.total= response.data.data.order[0].total_amount;
			}
		
	  });
		}
		,
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
  </style>