<template>
    <div id="search_block_top">
        <form
            action="/"
            method="get"
            id="searchbox"
            @submit.prevent="SearchProducts"
        >
            <fieldset>
                
                <input
                    placeholder="Search"
                    class="search_query"
                    type="text"
                    v-model="input.search"
                    id="topmenu_search_query"
                    maxlength="60"
                />
                <button
                    class="btn btn-default button-search"
                    type="submit"
                    id="topmenu_search_submit"
                >
  <span class="glyphicon glyphicon-search"></span>
                </button>
            </fieldset>
        </form>
    </div>
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
                            <div class="icon" style="background: #CC1417; margin-right: 10px;">
                                
                                <a  @click="AddToCart(product.id)" style="cursor: pointer;" >add to cart</a>
                            </div>
                            <div class="icon" style="background: #5CDBDB">
                            <a href="http://localhost:8000/home/order" @click="AddToCart(product.id)" style="cursor: pointer;" >Đặt Hàng</a>
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
        ,
        AddToCart(id){
            axios.post(`http://localhost:8000/api/order/create/${id}`,[]).then(response=>{
              console.log(response);
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
#search_block_top {
    position: absolute;
    margin-top: -39px!important;
    margin-left: 0;
    float: right;
    text-align: center;
    width: 100%;
}
#search_block_top #searchbox {
    float: right;
    width: 15%;
}
form#searchbox {
    position: relative;
}
#search_block_top #topmenu_search_query {
    display: inline;
    padding: 5px 30px 5px 10px;
    height: 30px;
    line-height: 30px;
    background: #fff;
    margin-right: 1px;
    border: 2px solid #a7051a;
    width: 100%;
}
#search_block_top .btn.button-search {
    background: none;
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    color: #a7051a;
    width: 34px;
    top: 6px;
    right: 13px;
    text-align: center;
    padding: 4px 0 4px 0;
}
</style>