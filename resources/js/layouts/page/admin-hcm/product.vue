<template>
    <div class="panel" style="margin: 50px 30px 0px 30px;">
        <div class="col-md-11">
            <div class="panel-hdr">
            <h2>Sản phẩm</h2>
            </div>
            <div>
            <div class="col-sm-10">
                <form
            class="navbar-form navbar-left"
            enctype="multipart/form-data"
           
            >
            <div class="input-group">
                <input
                type="text"
                class="form-control"
                placeholder="Search"
                />
                <button class="btn btn-primary mt-2" type="submit" style="background-color: #886ab5;">Tìm Kiếm</button>
            </div>
            </form>
            </div>
            <div class="col-sm-2">
                <router-link :to="{name:'product-add'}">
                    <button class="btn btn-primary waves-effect waves-themed" style="background-color: #886ab5;margin-top: 40px;">
                    + Thêm sản phẩm
                    </button>
                </router-link>
            </div>
        </div>
        </div>
        <table class="table table-bordered" style="margin-top: 30px">
            <thead>
              <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Giá Nhập</th>
                <th>Giá Bán</th>
                <th>Miêu tả</th>
                <td>Trạng thái</td>
                <th></th>
              </tr>
            </thead>
            <tbody >
              <tr v-for="product in products.data" class="contact-row">
                <td>{{ product.id }}</td>
                <td>
                  <img :src="product.avatar" alt="" style="width: 50px;height: 50px;">
                </td>
                <td>{{ product.name }}</td>
                <td>{{ product.import_price }}</td>
                <td>{{ product.price }}</td>
                <td>{{ product.description }}</td>
                <td  v-if=" product.status === 0 "><span class="status pending">Chưa bày bán</span> </td>
                <td  v-if=" product.status === 1 "><span class="status agree">Đang bày bán</span></td>
                <td>
                  <button
                    class="btn btn-primary btn-sm waves-effect waves-themed"
                    type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="View"
                  >
                  <router-link :to="{name:'view-product', params: { id: product.id }}">
                    <i class="bi bi-eye-fill" style="color: black;"></i>
                  </router-link>
                  </button>
                  <!-- <button
                    class="btn btn-primary btn-sm waves-effect waves-themed" 
                    type="button"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Delete"
                    v-on:click="handleDelete(product.id)"
                  >
                    <i class="bi bi-trash-fill" style="color: red;"></i>
                  </button>  -->
                </td>
               
              </tr>
            </tbody>
          </table>
          <div class="page">
            <Bootstrap5Pagination :data="products" @pagination-change-page="get" />
        </div>
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
      get(page=1){
              axios.get(`http://localhost:8000/api/product?page=${page}`).then(response=>{
              this.products=response.data.data;
            });
    }
  }
  }
</script>
<style>
.pending{
  background-color: #a26304;
}
.agree{
  background-color: #4caf50;
}
</style>