<template>
    <div class="panel" style="margin:30px">
      <div class="panel-container">
        <div class="panel-hdr">
          <h2>Phiếu nhập hàng</h2>
          </div>
        <div class="panel-content" style="margin: 50px;">
          <form
            class="form-horizontal"
            @submit.prevent="AddProduct"
            enctype="multipart/form-data"
          >
          <h2 style="width: 50px;margin: auto;">Phiếu</h2>
            <div class="form-group">
              <div class="form-group">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                  <div>
                    <label class="form-label" style="font-size: 20px;">Tên</label>
                  </div>
                        <input v-model="form.name" class="form-control" type="text">
                </div>
                <div class="col-sm-4 "></div>
            </div>
            </div>
            <div class="form-group ">
                <div class="col-sm-5">
                <div>
                  <label class="form-label">Địa điểm nhập hàng</label>
                </div>
                      <input v-model="form.location" class="form-control" type="text">
              </div>
              <div class="col-sm-5">
                <div>
                  <label class="form-label">Nhà phân phối</label>
                </div>
                      <input v-model="form.daily_name" class="form-control" type="text">
              </div>
              <div class="col-sm-2">
                <div>
                  <label class="form-label " >Số điện thoại</label>
                </div>
                      <input v-model="form.phone_daily" class="form-control" type="number">
              </div>
            </div>
            <div class="form-group mt-4"  >
              <div class="col-sm-4">
                <div>
                  <label class="form-label">Người giao hàng</label>
                </div>
                      <input v-model="form.courier" class="form-control" type="text">
              </div>
              <div class="col-sm-3" style="position: relative;">
                <div>
                  <label class="form-label" >Số điện thoại</label>
                </div>
                      <input v-model="form.phone_courier" class="form-control" type="number">
              </div>
              
            </div>
            <div class="form-group "  v-for="(checks, index) in check" :key="index">
              <div class="col-sm-4 " >
                <div>
                  <label class="form-label">Tên sản phẩm</label>
                </div>
                <select
                  class="form-control"
                  aria-label="Default select example"
                  v-model="form.product_id[index]"
                >
                  <option  v-for="cate in products[0]"  :value="cate.id">{{ cate.name }}</option>
                  <option value="custom">Giá trị tùy chỉnh</option>
                </select>
                <input v-if="form.product_id[index] === 'custom'" v-model="form.product_name[index]" class="form-control" placeholder="Nhập giá trị tùy chỉnh">
              </div>
              <div class="col-sm-3 " >
                <div>
                  <label class="form-label">Giá Nhập(vnđ)</label>
                </div>
                     <input v-model="form.import_price[index]" class="form-control" type="number" >
              </div>
              <div class="col-sm-2 " >
                <div>
                  <label class="form-label">Số lượng</label>
                </div>
                     <input v-model="form.amount[index]" class="form-control" type="number" >
              </div>
              <div class="col-sm-2 " >
                <div>
                  <label class="form-label">Thành tiền</label>
                </div>
                     <input v-model="form.sum[index]"  class="form-control" type="number" >
                     <p class="d-none">{{ calculateSum(index) }}</p>
              </div>
            </div>
            
            <div style="padding-bottom: 40px;">
              <div class="col-md-1">
                <button
                  type="submit"
                  class="btn btn-success waves-effect waves-themed"
                  style="margin: 70px 0px 50px 50px"
                >
                  <i class="fal fa-save"></i>
                  Lưu
                </button>
              </div>
              <div class="col-md-3"></div>
            </div>
          </form>
          
          <div class="button-handle col-sm-11 " style="margin-top: -50px;">
            <div class="col-sm-4">
            <div>
              <label class="form-label">Tổng tiền</label>
            </div>
            <input v-model="form.total_price"  class="form-control" type="number" min="1">
            <p class="d-none">{{ totalSum }}</p>
          </div>
            <div class="col-sm-3 ">
                <div>
                  <label class="form-label"></label>
                </div>
                <button
                  class="btn btn-success waves-effect waves-themed"
                  style=""
                  v-on:click="addPro"
                >
                  Thêm sản phẩm
                </button>
              </div>
              <div class="col-sm-2">
                <div>
                  <label class="form-label"></label>
                </div>
                <button
                  class="btn btn-success waves-effect waves-themed"
                  style=""
                  v-on:click="deletePro"
                >
                Xóa bớt
                </button>
              </div>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
import { ref,reactive } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
export default {
name: 'add-prouct',
data() {
  const form = reactive({
    'name_order': "",
    'location': "",
    'daily_name':"",
    'courier':"",
    'phone_courier':"",
    'phone_daily':"",
    'product_name':[],
    'product_id':[],
    'branch_id': "",
    'name': [],
    'import_price': [],
    'amount': [],
    'sum': [],
    'total_price':"",
    "user_name":""
  });
  const fileInput = ref(null);
  const products=ref([]);
  const check=1;
  const router = useRouter();
  const id = router.currentRoute.value.params.id;
  const nameParth=router.currentRoute.name;
  return {
    nameParth,
    router,
    form,
    fileInput,
    id,
    products,
    check
  }
},
mounted() {
  this.nameParth=this.router.currentRoute.name;
  axios.get(`http://localhost:8000/api/product/all`)
    .then(response => {
      this.products = response.data;
    });
},
computed:{
  calculateSum() {
    return (index) => {
      if (this.form.import_price[index] && this.form.amount[index]) {
         this.form.sum[index]= this.form.import_price[index] * this.form.amount[index];
         return this.form.sum[index];
      } else {
        return 0; // Hoặc giá trị mặc định khác tùy theo nhu cầu của bạn
      }
    };
  },
  totalSum() {
    let total = 0;
    for (let index = 0; index < this.form.import_price.length; index++) {
      total += this.calculateSum(index);
    }
    this.form.total_price=total;
  },
},
methods: {
  addPro(){
    this.check++;
  },
  deletePro(){
    this.check--;
    this.form.product_name[this.check]="";
    this.form.amount[this.check]=0;
    this.form.product_id[this.check]=null;
    this.form.import_price[this.check]=0;
    this.form.sum[this.check]=0;

  },
  AddProduct() {
    axios.post('http://localhost:8000/api/bill',this.form).then(response=>{
        console.log(response);
    }).catch(console.error());    
    
  },
}
}

</script>
<style>
.product-image{
width: 124px;height: 124px;margin-right: 20px; margin-bottom: 20px;
}
</style>