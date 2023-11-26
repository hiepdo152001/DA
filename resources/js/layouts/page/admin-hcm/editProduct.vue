<template>
    <div class="panel" >
      <div class="panel-container">
        <div class="panel-hdr">
          <h2>Sản phẩm</h2>
          </div>
        <div class="panel-content" style="margin:0px 50px 0px 50px">
          <form
            class="form-horizontal"
            @submit.prevent="AddProduct"
            enctype="multipart/form-data"
            style="padding: 20px 0px 20px 20px"
          >
            <div class="form-group">
                <div class="form-row">
                  <div class="col-sm-4" style="padding-left: 0px;">
                    <div>
                    <label class="form-label">Ảnh</label>
                    </div>
                    <img
                      class="product-image "
                      alt=""
                      :src="avatar"
                      v-if="avatar"
                      style="margin-bottom: 20px;"
                    />
                    <br />
                    <input type="file" ref="fileInput" @change="handleFileUpload" />
                </div>
                <div class="col-sm-8" >
                    <div>
                    <label class="form-label">Ảnh chi tiết</label>
                    </div>
                    <img v-if="checkDetail !== 1" v-for="index in 4"
                        class="product-image " 
                        :src="`http://localhost:9000/mybucket/product/detail/${product.id}/${index -1}avatar.jpg`"
                        alt=""
                        style="margin-bottom: 20px;margin-right: 10px;"
                        
                        />
                      <img v-else v-for="avt in avatarDetail" 
                        class="product-image "
                        :src="avt.dataURL"
                        alt=""
                        
                      />
                    <br/>
                    <input type="file" ref="fileInputs" @change="handleFileUploads" multiple/>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-group mt-4">
              <div class="col-sm-2">
                <div >
                  <label class="form-label">Danh mục</label>
                </div>
                <select
                  class="form-control"
                  aria-label="Default select example"
                  v-model="form.category_id"
                >
                  <option  v-for="cate in category.data"  :value="cate.id">{{ cate.name }}</option>
                </select>
              </div>
              <div class="col-sm-4">
                <div>
                  <label class="form-label">Tên</label>
                </div>
                      <input v-model="form.name" class="form-control" type="text">
              </div>
              <div class="col-sm-2">
                <div >
                  <label class="form-label">Trạng thái</label>
                </div>
                <select
                  class="form-control"
                  aria-label="Default select example"
                  v-model="form.status"
                >
                  <option value="0">Chưa bày bán</option>
                  <option value="1">Bày bán</option>
                </select>
              </div>
            </div>
            <div class="mt-4">
              <div class="col-md-4 px-0" >
                <div>
                  <label class="form-label">Giá Nhập(vnđ)</label>
                </div>
                     <input v-model="form.import_price" class="form-control" type="number" min="1">
              </div>
              <div class="col-md-4">
                <div>
                  <label class="form-label">Giá Bán(vnđ)</label>
                </div>
                     <input v-model="form.price" class="form-control" type="number" min="1">
              </div>
              <div class="col-md-3 " >
                <div>
                  <label class="form-label">Số lượng</label>
                </div>
                     <input v-model="form.amount" class="form-control" type="number" min="1">
              </div>
            </div>
            <div class="col-md-4  mt-4 p-0" >
                <div>
                  <label class="form-label">Miêu tả chi tiết</label>
                </div>
                     <textarea v-model="form.description" class="form-control" type="text" ></textarea>
            </div>
           
             <div class="form-group col-sm-12 p-0">
              <div class="col-sm-5"></div>
                <div class="col-sm-2"><h2 style="text-align: center;">Size</h2></div>
                <div class="col-sm-5"></div>
                <div class="col-sm-12">
                  <div class="size-price">
                    <div class="col-sm-1 mt-4" ></div>
                    <div class="col-sm-2 mt-4" >
                      <div>
                        <label class="form-label">Size(36)</label>
                      </div>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.size36"
                      />
                    </div>
                    <div class="col-sm-2 mt-4" >
                      <div>
                        <label class="form-label">Size(37)</label>
                      </div>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.size37"
                      />
                    </div>
                    <div class="col-sm-2 mt-4" >
                      <div>
                        <label class="form-label">Size(38)</label>
                      </div>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.size38"
                      />
                    </div>
                    <div class="col-sm-2 mt-4" >
                      <div>
                        <label class="form-label">Size(39)</label>
                      </div>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.size39"
                      />
                    </div>
                    <div class="col-sm-2 mt-4" >
                      <div>
                        <label class="form-label">Size(40)</label>
                      </div>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.size40"
                      />
                    </div>
                    </div>
                    <div class="col-sm-12 p-0 mt-4">
                      <div class="col-sm-1"></div>
                    <div class="col-sm-2 mt-4" >
                      <div>
                        <label class="form-label">Size(41)</label>
                      </div>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.size41"
                      />
                    </div>
                    <div class="col-sm-2 mt-4" >
                      <div>
                        <label class="form-label">Size(42)</label>
                      </div>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.size42"
                      />
                    </div>
                    <div class="col-sm-2 mt-4" >
                      <div>
                        <label class="form-label">Size(43)</label>
                      </div>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.size43"
                      />
                    </div>
                    <div class="col-sm-2 mt-4" >
                      <div>
                        <label class="form-label">Size(44)</label>
                      </div>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.size44"
                      />
                    </div>
                    <div class="col-sm-2 mt-4" >
                      <div>
                        <label class="form-label">Size(45)</label>
                      </div>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.size45"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div style="padding-bottom: 40px">
              <div style="width: 80px;margin: auto;">
                <button
                  type="submit"
                  class="btn btn-success waves-effect waves-themed"
                  style=""
                >
                  <i class="fal fa-save"></i>
                  Lưu
                </button>
              </div>
              <div class="col-md-3">
              </div>
            </div>
          </form>
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
    'name': "",
    'description':"",
    'category_id':"",
    'import_price':"",
    'price':"",
    'amount':"",
    'avatarList':[],
    'branch_id': "",
    'size36':"",
    'size37':"",
    'size38':"",
    'size39':"",
    'size40':"",
    'size41':"",
    'size42':"",
    'size43':"",
    'size44':"",
    'size45':"",
  });
  const fileInput = ref(null);
  const category=ref([]);
  const router = useRouter();
  const avatar="";
  const id = router.currentRoute.value.params.id;
  const checkAvt=null;
  const checkDetail=null;
  const nameParth=router.currentRoute.name;
  const avatarDetail=ref([]);
  const listDetail=ref([]);
  const product=ref([]);
  const selectedFiles = ref(null); 
  return {
    nameParth,
    router,
    form,
    fileInput,
    id,
    category,
    selectedFiles,
    avatarDetail,
    product,
    listDetail,
    checkAvt,
    checkDetail,
    avatar
  }
},
mounted() {
  this.nameParth=this.router.currentRoute.name;
    axios.get(`http://localhost:8000/api/category`)
    .then(response => {
      this.category = response.data.data;
     
    });
    if(this.id){
              axios.get(`http://localhost:8000/api/product/by/${this.id}`)
              .then(response=>{
                this.product=response.data.data;
                Object.assign(this.form, {
                ...this.product,
              });
                this.avatar=this.product.avatar;
                for (let key = 1, value = 36; key <= 10; key++, value++) {
                  this.product.sizes.forEach((size) => {
                    if(size.name == value){
                      var fsize="size"+value;
                      this.form[fsize]=size.pivot.quantity;
                    }
                  });
                }
              });
          }
},
methods: {
  handleFileUpload(event) {
    this.checkAvt=1;
    const file = event.target.files[0];
    this.selectedFile = file;
    if (file) {
      const reader = new FileReader();
      reader.onload = () => {
        this.avatar = reader.result;
      };
      reader.readAsDataURL(file);
    }
  },
  handleFileUploads(event) {
    this.checkDetail=1;
    const listFile = event.target.files;
    this.listDetail=listFile;
    if (this.avatarDetail < 5 && listFile.length < 5 ) {
      this.selectedFiles = Array.from(listFile);
      this.selectedFiles.forEach((file) => {
        const reader = new FileReader();
        reader.onload = () => {
          this.avatarDetail.push({ file, dataURL: reader.result });
        };
        reader.readAsDataURL(file);
      });
    } else {
      alert('Tổng số tệp tối đa là 4.');
      event.target.value = null; 
      this.selectedFiles = []; 
      this.avatarDetail = []; 
    }
  },
  AddProduct() {
    let formAvt=new FormData();
    Object.keys(this.form).forEach(key => {
      formAvt.append(key, this.form[key]);
    });
    if(this.router.currentRoute.href.includes('admin-hcm')){
        formAvt.append("branch_id",1);
      }
    if(this.checkAvt == 1 ){
      formAvt.append("imageAvt",this.selectedFile);
    }
    if(this.checkDetail ==1 ){
      if(this.listDetail.length > 0){
            formAvt.append("check", 1);
            const fileListArray = Array.from(this.listDetail);
            fileListArray.forEach((file, index) => {
              formAvt.append(`avatarDetail[${index}]`, file);
            });
      }
      else if(this.listDetail.length === 0){
        formAvt.append("check", 0);
      }
    }
    formAvt.append('checkAvt',this.checkAvt);
    formAvt.append('checkDetail',this.checkDetail);
    axios.post(`http://localhost:8000/api/product/${this.id}`,formAvt).then(response=>{
      window.location.href = "http://localhost:8000/admin/product";        
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