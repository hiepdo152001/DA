<template>
    <div class="col-sm-12">
      <div class="panel">
        <div class="panel-container">
          <div class="panel-content">
            <form
              class="form-horizontal"
              @submit.prevent="updateProfile"
              enctype="multipart/form-data"
              style="padding: 20px 0px 20px 20px"
            >
              <div class="form-group">
                <div class="col-md-12">
                  <label class="form-label">
                    <span class="translation_missing">Avatar</span>
                  </label>
                </div>
                <div class="form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <img
                  class="profile-image rounded-circle"
                  :src="form.avatar"
                  alt=""
                />
                
                <br />
                <input type="file" ref="fileInput" @change="handleFileUpload" />
              </div>
            </div>
          </div>
              </div>
  
              <div class="form-group">
                <div class="col-md-4">
                  <div>
                    <label class="form-label">Tên</label>
                  </div>
                  <div class="frame-wrap d-flex">
                    <div class="form-check">
                      <label class="form-check-label" for="flexRadioDefault2"
                        > {{ form.name }}
                      </label>
                    </div>
                  </div>
                </div>
              </div>
  
              <div class="form-group">
                <div class="col-md-4">
                  <div>
                    <label class="form-label">Giới tính</label>
                  </div>
                  <div class="frame-wrap d-flex">
                      <div class="form-check" style="margin-right: 20px">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="flexRadioDefault"
                          id="flexRadioDefault1"
                          v-model="form.gender"
                          :value="1"
                        />
                        <label class="form-check-label" for="flexRadioDefault1">Nam</label>
                      </div>
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="flexRadioDefault"
                          id="flexRadioDefault2"
                          v-model="form.gender"
                          :value="2"
                        />
                        <label class="form-check-label" for="flexRadioDefault2">Nữ</label>
                      </div>
                    </div>
                </div>
              </div>
  
              <div class="form-group">
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="form-label">Bộ phận</label>
                  </div>
                  <select
                    class="form-control"
                    aria-label="Default select example"
                    v-model="form.branch_id"
                  >
                  <option  value="1">HCM</option>
                    <option value="2">HN</option>
                    
                  </select>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="form-label">Vị trí</label>
                  </div>
                  <select
                    class="form-control"
                    aria-label="Default select example"
                    v-model="form.role_id"
                  >
                    <option  value="1">User</option>
                    <option value="2">Admin</option>
                    <option value="3">System Admin</option>
                    <option value="4">Guest</option>
                    <option value="5">Manager</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-label">Ngày sinh</label>
                  </div>
                  <input
                    class="form-control datetimepicker"
                    type="date"
                    required
                    v-model="form.birth_day"
                  />
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label">Số diện thoại</label>
                  </div>
                  <input
                    type="text"
                    class="form-control"
                    required
                    v-model="form.phone"
                  />
                </div>
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
    </div>
  </template>
  <script>
  import { ref, onMounted, reactive } from "vue";
  import { useRouter } from "vue-router";
  import axios from "axios";
  export default {
  name: 'edit-user',
  data() {
    const form = reactive({
      'name': "",
      'email': "",
      'gender': "",
      'address': "",
      'birth_day': "",
      'phone': "",
      'cccd': "",
      'avatar': "",
      'branch_id': "",
      'role_id': "",
    });
    const fileInput = ref(null);
    const router = useRouter();
    const id = router.currentRoute.value.params.id;
    const selectedFile = ref(null); // Sử dụng selectedFile để lưu tệp được chọn
    return {
      form,
      fileInput,
      id,
      selectedFile, // Đổi tên thành selectedFile
    }
  },
  mounted() {
    axios.get(`http://localhost:8000/api/user/by/${this.id}`)
      .then(response => {
        const user = response.data.data;
        console.log(user);
        Object.assign(this.form, {
          ...user,
          birth_day: user.birth_day.substring(0, 10),
        });
        this.form.gender = user.gender;
        console.log(this.form.gender);
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
    updateProfile() {
      axios.put(`http://localhost:8000/api/user/${this.id}`, this.form)
          .then(res => {
            console.log(res);
          })
          .catch(error => {
            console.error(error);
          });
      if (this.selectedFile) {
        let formData = new FormData();
        formData.append("image_data", this.selectedFile);
        axios.post(`http://localhost:8000/api/user/${this.id}`, formData, )
          .then(response => {
            console.log(response);
          })
          .catch(error => {
            console.error(error);
          });
      }
      
    },
  }
}

  </script>
  