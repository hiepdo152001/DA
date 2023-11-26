<template>
    <div class="container">
        <div class="col-md-3">a</div>
        <div class="col-md-9 d-flex">
                          <div v-for="product in products.data" class=" col mb-5 " style="margin-right: 40px;">
							<div class="card h-100" id="sanpham" style="width: 300px">
								<!-- Sale badge-->
								<div class="badge text-white position-absolute" style="top: 0.5rem; right: 0.5rem ;" >
								<img style="width: 35px; height: 40px ;" src="../assets/new.png">
								</div>
								<div  class="badge text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
								<img style="width: 30px;height: 30px ; " src="../assets/ss.jpg">
								</div>
								<!-- Product image-->
								<!-- <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />\ -->
								<img  style="position: relative;width: 200px; height: 200px;margin: auto;" :src="product.avatar">
								
								<!-- Product details-->
								<div class="card-body p-4">
									<div class="text-center">
										<!-- Product name-->
										<a style="font-size: 18px" href="${base }/trangchu/converse/${products.seo}">{{ product.name }}</a>
											
										<!-- Product reviews-->
										<div
											class="d-flex justify-content-center small text-warning mb-2">
											<div class="bi-star-fill"></div>
											<div class="bi-star-fill"></div>
											<div class="bi-star-fill"></div>
											<div class="bi-star-fill"></div>
											<div class="bi-star-fill"></div>
										</div>
										<c:if test="${products.priceSale ==null }">
										<div style="margin-top: 25px; color: red; font-size: 20px">
										<h3>{{ formatCurrency(product.price) }}</h3>
										</div >
										</c:if>
										<c:if test="${products.priceSale !=null }">
										<!-- Product price-->
										<div style="margin-top: 25px;color: red; font-size: 20px">
										<span class="text-muted text-decoration-line-through" >
										
										</span>
										
										</div>
										</c:if>
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
            </div>
            <div class="page">
            <Bootstrap5Pagination :data="products" @pagination-change-page="get" />
        </div>
    
    <div class="d-none" style="position: absolute;">
        <router-view></router-view>
    </div>
</template>
<script>
import { ref} from "vue";
  import { Bootstrap5Pagination } from "laravel-vue-pagination";
  import axios from "axios";
  export default {
    name:'products',
    data(){
        const products=ref([]);
        return{
            products
        }
    },
    components:{
      Bootstrap5Pagination
    },
    mounted(){
      axios.get('http://localhost:8000/api/product?page=1').then(response =>{
        this.products=response.data.data;
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
              axios.get(`http://localhost:8000/api/product?page=${page}`).then(response=>{
              this.products=response.data.data;
            });
    }
  }
  }
</script>
<style>
/*sanpham*/
#sanpham:hover{
 margin:5px;
 position: relative;
  box-shadow: 0 4px 8px 0 black, 0 6px 20px 0 black;
  text-align: center;}
/*san pham*/
.sanpham{display: flex; width: 800px;margin: auto;}

</style>