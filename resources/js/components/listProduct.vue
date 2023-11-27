<template>
    <div class="container col-md-9  px-4 px-lg-5 mt-5">
                <div class="d-flex " style="flex-wrap: wrap!important">
                <div v-for="(product, index) in products.data" class="col-md-3  box-product"  :style="{ 'padding-bottom': index >= 0 && index < 4 ? '30px' : '0' }">
                    <div  class="card" id="sanpham" style="margin-bottom: 10px;" >
                        <img  style="width: 200px; height: 200px;margin: auto; margin-top: 3px;" :src="product.avatar">
                        
                        <!-- Product details-->
                        <div class="card-body p-2">
                            <div class="text-center">
                                <!-- Product name-->
                                <router-link :to="{ name: 'view-products', params: { id: product.id}} ">
                                  <a style="font-size: 18px">{{ product.name }}</a>
                                </router-link>
                                <div style="margin-top: 5px; color: red; font-size: 20px">
                                <h3>{{ formatCurrency(product.price) }}</h3>
                                </div >
                            </div>
                        </div>
                        
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent" style="display: flex; margin: auto;">
                            <div class="icon" style="background: #CC1417">
                                
                                <a onclick="AddToCart('${base }', ${products.id}, 1);" >add to cart</a>
                            </div>
                            <div class="icon" style="background: #5CDBDB">
                            <a href="" >Đặt Hàng</a>
                        </div>
                        </div>
                        </div>
                </div>
            </div>
            <div class="page">
                <Bootstrap5Pagination :data="products" @pagination-change-page="get" />
            </div>
        </div>
</template>
<script>
import { ref,reactive} from "vue";
  import { Bootstrap5Pagination } from "laravel-vue-pagination";
  import axios from "axios";
  export default {
    name:'products',
    data(){
        const products=ref([]);
		const input = reactive({
        search: ""
    })
        return{
            products,
			input
        }
    },
    components:{
      Bootstrap5Pagination
    },
    mounted(){
      axios.get('http://localhost:8000/api/alls?page=1').then(response =>{
        this.products=response.data[0];
      });
      },
    methods:{
    	formatCurrency(value) {
			return parseFloat(value).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			});
			},
      	get(page=1){
              axios.get(`http://localhost:8000/api/alls?page=${page}`).then(response=>{
              this.products=response.data[0];
            });
    	},
		SearchProducts(page =1){
			axios.get(`http://localhost:8000/api/alls?page=${page}`,
			{params: { search: this.input.search }}
			).then(response=>{
		console.log(response);
				
				this.products=response.data[0];
			});
		}
  }
  }
</script>
<style>
/*sanpham*/
#sanpham:hover {
  margin: 5px;
  box-shadow: 0 4px 8px 0 black, 0 6px 20px 0 black;
  text-align: center;
}
.page-item.pagination-page-nav.active .page-link{
  background-color: #a7051a!important; /* Thay đổi màu nền thành màu mong muốn */
  color: #fff; /* Thay đổi màu chữ thành màu mong muốn */
  /* Các thuộc tính khác nếu cần */
}

/*san pham*/


</style>