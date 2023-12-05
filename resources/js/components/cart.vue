<template>
	<div style="    position: absolute; margin-top: -32px; right: 150px; color: white;">
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
				<th>Chọn</th>
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
				  <div class="py-2 text-uppercase">Hành động</div>
				</th>
			  </tr>
			</thead>
			<tbody>
			  <!-- Sử dụng v-for để lặp qua danh sách sản phẩm trong giỏ hàng -->
				 <tr v-for="(ci, index) in cart" :key="index">
      <!-- Kiểm tra xem ci có phải là phần tử cuối cùng không -->
	  			<td  class="border-0 align-middle">
					<label class="custom-checkbox">
						<input type="checkbox" v-model="selectedProductIds" :value="index">
					</label>
				</td>
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
				<td class="border-0 align-middle">
				  <span v-if="checks != 1">
					<span v-if="ci.product.status == 1" class="status-approved"> Còn hàng </span>
					<span v-if="ci.product.status == 0" class="status-canceled"> Hết hàng </span>
				</span>
				  <span v-else>
					<span v-if="ci.status == 1" class="status-approved"> Còn hàng </span>
					<span v-if="ci.status == 0" class="status-canceled"> Hết hàng </span>
				  </span>
				</td>
				<td class="border-0 align-middle" style="color: brown;font-size: 20px;">
				  <strong v-if="checks != 1">{{ formatCurrency(ci.product.price) }}</strong>
				  <strong v-else>{{ formatCurrency(ci.price) }}</strong>
				</td>
				<td class="border-0 align-middle" v-if="checks ==1">
				<button @click="updateQuantity(ci.id, -1)" v-if="ci.quantity > 1" class="quantity-button" style="margin-right: 10px;">-</button>
				<button @click="deletes(ci.id)" v-if="ci.quantity == 1" class="quantity-button" style="margin-right: 10px;">-</button>
				<strong><span :id="'quanlity_' + ci.id">{{ ci.quantity }}</span></strong>
				<button @click="updateQuantity(ci.id, 1)" v-if="ci.quantity >= 1" class="quantity-button" style="margin-left: 10px;"> + </button>
				</td>
				<td class="border-0 align-middle" v-if="checks ==0">
				<button @click="updateQuantity(ci.product_id, -1)" v-if="ci.quantity > 1" class="quantity-button" style="margin-right: 10px;">-</button>
				<button @click="deletes(ci.product_id)" v-if="ci.quantity == 1" class="quantity-button" style="margin-right: 10px;">-</button>
				<strong><span :id="'quanlity_' + ci.product_id">{{ ci.quantity }}</span></strong>
				<button @click="updateQuantity(ci.product_id, 1)" v-if="ci.quantity >= 1" class="quantity-button" style="margin-left: 10px;"> + </button>
				</td>
				<td class="border-0 align-middle">
				  <button v-if="checks ==1" class="btn btn-danger " @click="deletes(ci.id)" >Delete</button>
				  <button v-if="checks ==0" class="btn btn-danger " @click="deletes(ci.product_id)" >Delete</button>
				</td>
			  </tr>
			</tbody>
		  </table>
		</div>
		<!-- End -->
  
		<!-- Hiển thị tổng tiền -->
		<div style="width: 300px; margin: auto; display: flex;">
		  <a style="margin-top: 30px;font-size: 20px;">Tổng Tiền : &nbsp</a>
		  <h1 id="totalPrice" style="color: red;">
			<!-- Sử dụng {{ cart.totalPrice }} để hiển thị tổng tiền -->
			<!-- {{ formatCurrency(total) }} -->
			{{ formatCurrency(selectedProductsTotal) }}
		  </h1>
		</div>
		<div style="width: 1000px; margin: auto;" v-if="checks ==1">
			<form @submit.prevent="Buy">
			<div class="col-md-6">
			<div class="form-group">
			  <label for="customerFullName">Họ và Tên</label>
			  <input
				type="text"
				class="form-control"
				id="customerFullName"
				name="customerFullName"
				v-model="formUser.name"
				placeholder="Full name"
				required
			  />
			</div>
			<div class="form-group" style="margin-top: 35px;">
			  <label for="customerAddress">Địa chỉ</label>
			  <input
				type="text"
				class="form-control"
				id="customerAddress"
				name="customerAddress"
				v-model="formUser.address"
				placeholder="Address"
				required
			  />
			</div>
			</div>
			<div class="col-md-6">
			<div class="form-group">
			  <label for="customerEmail">Email</label>
			  <input
				type="email"
				class="form-control"
				id="customerEmail"
				name="customerEmail"
				v-model="formUser.email"
				placeholder="Enter email"
				required
			  />
			  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			</div>
			<div class="form-group">
			  <label for="customerPhone">Số điện thoại</label>
			  <input
				type="tel"
				class="form-control"
				id="customerPhone"
				name="customerPhone"
				v-model="formUser.phone"
				placeholder="Phone"
				required
			  />
			</div>
		  </div>
		  <div style="width: 100px; margin: auto;">
		  <button type="submit" class="btn btn-danger" >Mua Hàng</button>
		</div>
		</form>
		
		</div>
		<div style="width: 100px; margin: auto;" v-if="checks == 0">
		  <button @click="Buy" class="btn btn-danger" >Mua Hàng</button>
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
		var checks=ref();
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
		checks,
		selectedProductIds,
		formUser
	  }
	},
	computed: {
		selectedProductsTotal() {
		// Tính tổng giá dựa trên các sản phẩm đã chọn
		if(this.checks ==1){
			return this.selectedProductIds.reduce((total, productId) => {
			const product = this.cart[productId];
			return total + (this.checks !== 1 ? product.product.price : product.price * product.quantity);
			}, 0);
		}
		else{
			return this.selectedProductIds.reduce((total, productId) => {
			const product = this.cart[productId];
			return total + (this.checks !== 1 ? product.product.price * product.quantity : 1);
			}, 0);

		}
		
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
				console.log(this.cart);
			}
			else{
				this.checks =0;
				this.cart = response.data.data.order[0].order_details;
				console.log(this.cart);

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
			window.location.reload();
			});
			}
		},
		Buy(){
			// Khởi tạo đối tượng FormData từ this.formUser (nếu this.formUser chưa phải là FormData)
			this.formUser.keyProduct=this.selectedProductIds;
			if(this.checks == 1){
				if(this.$route.path.includes("hcm")){
				this.formUser.branch_id = 2;
			}
			axios.post(`http://localhost:8000/api/bills/create`,this.formUser).then((response) => {
				if(response.data.message == 'success'){
					alert('Mua hàng thành công');
					this.$router.push('./');
				}
			});
			}
			else{
				console.log(this.formUser);
				axios.post(`http://localhost:8000/api/bills/create`,this.formUser).then((response) => {
				if(response.data.message == 'success'){
					alert('Mua hàng thành công');
					this.$router.push('./');
				}
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