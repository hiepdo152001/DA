<template>
    <div class="panel" style="margin:30px">
      <div class="panel-container">
        <div class="panel-hdr">
          <h2>Sản phẩm</h2>
          </div>
        <div class="panel-content" style="margin: 50px;">
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
                      :src="form.avatar"
                      alt=""
                      v-if="form.avatar"
                      style="margin-bottom: 20px;"
                    />
                    <br />
                    <input type="file" ref="fileInput" @change="handleFileUpload" />
                </div>
                <div class="col-sm-8" v-if="nameParth === 'product-add'" >
                    <div>
                    <label class="form-label">Ảnh chi tiết</label>
                    </div>
                    <img v-for="avt in avatarDetail" 
                      class="product-image "
                      :src="avt.dataURL"
                      alt=""
                      
                    />
                    <br />
                    <input type="file" ref="fileInputs" @change="handleFileUploads" multiple/>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-group">
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

             
            </div>
            <div >
              <div class="col-md-5 p-0" >
                <div>
                  <label class="form-label">Giá Nhập(vnđ)</label>
                </div>
                     <input v-model="form.import_price" class="form-control" type="number" min="1">
              </div>
              <div class="col-md-5" v-if="nameParth === 'product-add' " >
                <div>
                  <label class="form-label">Giá Bán(vnđ)</label>
                </div>
                     <input v-model="form.price" class="form-control" type="number" min="1">
              </div>
              <div class="col-md-5 " >
                <div>
                  <label class="form-label">Số lượng</label>
                </div>
                     <input v-model="form.amount" class="form-control" type="number" min="1">
              </div>
            </div>
            <div class="col-md-4 p-0 mt-4" v-if="nameParth === 'product-add'">
                <div>
                  <label class="form-label">Miêu tả chi tiết</label>
                </div>
                     <textarea v-model="form.description" class="form-control" type="text" ></textarea>
            </div>
           
            <!-- <h3>Size</h3> -->
            <!-- <div class="form-group">
              <div>
                <div class="col-sm-6">
                <div class="size-price">
                <div class="col-sm-4" style="padding-left: 0px;">
                  <div>
                    <label class="form-label">Size</label>
                  </div>
                  <input
                    type="text"
                    class="form-control"
                    required
                    v-model="form.phone"
                  />
                  </div>
                </div>
                <div class="col-sm-8" style="padding-right: 0px;">
                  <div>
                    <label class="form-label">Số lượng</label>
                  </div>
                  <input
                    type="text"
                    class="form-control"
                    required
                    v-model="form.phone"
                  />
                  </div>
                </div>
                <div class="col-sm-6">
                <div class="size-price">
                <div class="col-sm-4" style="padding-left: 0px;">
                  <div>
                    <label class="form-label">Size</label>
                  </div>
                  <input
                    type="text"
                    class="form-control"
                    required
                    v-model="form.phone"
                  />
                  </div>
                </div>
                <div class="col-sm-8" style="padding-right: 0px;">
                  <div>
                    <label class="form-label">Số lượng</label>
                  </div>
                  <input
                    type="text"
                    class="form-control"
                    required
                    v-model="form.phone"
                  />
                  </div>
                </div>
              </div>
            </div> -->
            </div>
            <div style="padding-bottom: 40px">
              <div class="col-md-1">
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
name: 'prouct-comp',
props:{
    
}
,
data() {
  const form = reactive({
    'name': "",
    'avatar': "",
    'description':"",
    'category_id':"",
    'import_price':"",
    'price':"",
    'amount':"",
    'avatarList':[],
    'branch_id': "",
  });
  const fileInput = ref(null);
  const category=ref([]);
  const router = useRouter();
  const id = router.currentRoute.value.params.id;
  const nameParth=router.currentRoute.name;
  const avatarDetail=ref([]);
  const listDetail=ref([]);
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
    listDetail,
  }
},
mounted() {
  this.nameParth=this.router.currentRoute.name;
  axios.get(`http://localhost:8000/api/category`)
    .then(response => {
      this.category = response.data.data;
     
    });
},
methods: {
  handleFileUpload(event) {
    const file = event.target.files[0];
    this.selectedFile = file;
    if (file) {
      const reader = new FileReader();
      reader.onload = () => {
        this.form.avatar = reader.result;
      };
      reader.readAsDataURL(file);
    }
  },
  handleFileUploads(event) {
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
}
}

</script>
<style>
.product-image{
width: 124px;height: 124px;margin-right: 20px; margin-bottom: 20px;
}
</style>