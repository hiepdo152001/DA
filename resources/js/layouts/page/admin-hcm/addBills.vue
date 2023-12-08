<template>
     <div class="panel" style="margin: 50px 30px 0px 30px;">
    <div style="width: 1000px; margin: auto;">
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
		</div>
</template>
<script>
  import axios from "axios";
  import { ref,reactive} from "vue";
  export default {
	data(){
		const cart=ref([]);
		var total=ref();
		var checks=ref();
		var error = ref("");
		const user =ref([]);
		const selectedProductIds= ref([]);
		const formUser = reactive({
		  name: "",
		  address: "",
		  email: "",
		  phone: "",
		  branch_id : 1,
		  keyProduct: [],	
		  error
		})
	  return {
		cart,
		total,
		checks,
		selectedProductIds,
		formUser,
		user,
		error
	  }
	},
	
  };

  </script>