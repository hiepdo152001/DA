<template>
  <div class="panel" style="margin: 35px;">
  <div>
    <div>
      <div class="panel-hdr">
        <h2 >Thông tin sản phẩm</h2>
      </div>
      <div class="col-6">
        <router-link :to="{ name: 'edit-product',params: { id: product.id } }">
          <button
            class="btn  btn-sm waves-effect waves-themed"
            style="margin: 15px 0px 0px 25px;color: #fff;
              background-color: #886ab5;
              border-color: #886ab5;"
          >
            <i class="bi bi-pencil" style="padding: 0px 5px 0px 5px;"></i>
          </button>
        </router-link>
      </div>
    </div>
  </div>
    <div >
      <div class="mb-5">
        <h2 class="text-center">Thông tin </h2>
      </div>
      <div class="col-sm-2"></div>
      <div class="img col-sm-10" style="margin:auto;">
        <div class="avatar col-sm-3 p-l-3">
          <div>
          <label class="form-label">Ảnh</label>
          </div>
            <img
              class="product-image "
              :src="product.avatar"
              alt=""
              style="margin-bottom: 20px;"
            />
        </div>
        <div class="avatar col-sm-9">
          <div>
          <label class="form-label">Ảnh chi tiết</label>
          </div >
            <img v-for="index in 4"
            class="product-image " 
              v-if="`http://localhost:9000/mybucket/product/detail/${product.id}/${index-1}avatar.jpg`"
              :src="`http://localhost:9000/mybucket/product/detail/${product.id}/${index-1}avatar.jpg`"
              alt=""
              style="margin-bottom: 20px;margin-right: 10px;"
              
            />
            <img class="d-none">
        </div>
      </div>
      <table class="table table-bordered table-hover " style="width: 95%;margin: auto;margin-bottom: 50px;">
          <tbody>
          <tr>
            <td><strong>Tên sản phẩm</strong></td>
            <td>{{ product.name }}</td>
          </tr>
          <tr>
            <td><strong>Số lượng</strong></td>
            <td>{{ product.amount }}</td>
          </tr>
          <tr>
            <td><strong>Danh mục</strong></td>
            <td v-if=" product.category_id == 1 "> Giày</td>
            <td v-if=" product.category_id == 2 ">  Dép</td>
          </tr>
          <tr>
            <td><strong>Mô tả chi tiết</strong></td>
            <td>{{ product.description }}</td>
          </tr>
          
          <tr>
            <td><strong>Giá nhập kho</strong></td>
            <td>{{ product.import_price }}</td>
          </tr>
          <tr>
            <td><strong>Giá bán</strong></td>
            <td>{{ product.price }}</td>
          </tr>
          <tr v-for="size in product.sizes ">
            <td><strong>Size {{ size.name }}</strong></td>
            <td>{{ size.pivot.quantity }}</td>
          </tr>
          <tr>
            <td><strong>Trạng thái</strong></td>
            <td  v-if=" product.status === 0 "><span class="status pending">Chưa bày bán</span> </td>
            <td  v-if=" product.status === 1 "><span class="status agree">Đang bày bán</span></td>
          </tr>
        </tbody>
      </table>
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
      const product=ref([]);
      const router = useRouter();

      const id = router.currentRoute.value.params.id;
      return {
          product,
          id
      }
  },
  mounted(){
      try {
          if(this.id){
              axios.get(`http://localhost:8000/api/product/by/${this.id}`)
              .then(response=>{
                  this.product=response.data.data;
                  console.log(this.product);
              });
          }
      } catch (error) {
          alert(error);
      }
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