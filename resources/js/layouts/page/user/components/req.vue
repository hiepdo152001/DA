<template>
     <div class="panel" style="margin: 50px 30px;">
     <div class="panel-hdr">
          <h2 class="title" style="padding-top: 10px">Yêu cầu của tôi</h2>
          
     </div>
     <div class="panel-content">
          <div class="col-md-6">
               <div class="alert alert-danger" v-if="checktime != '' ">
          {{ checktime }}
        </div>
          <form v-on:submit.prevent="CreateReq">
               <div class="form-row">
               <div class="col-md-9" style="margin-top: 15px">
               <label class="form-label" for="time_start">Nội dung</label>
               <select
                    class="form-control kind-select"
                    aria-label="Default select example"
                    required
                    v-model="data.content"
                    @change="onChange($event)"
                    :disabled="check === 1"
               >
                    <option value="days_on">Nghỉ phép có lương</option>
                    <option value="days_off">Nghỉ phép không lương</option>
                    <option value="over_time">Làm thêm giờ</option>
               </select>
               </div>
               <div class="col-md-3">
               <div class="form-check form-switch" style="margin-top: 40px">
                    <input
                    class="form-check-input"
                    type="checkbox"
                    role="switch"
                    v-model="data.type"
                    id="flexSwitchCheckChecked"
                    checked
                    />
                    <label class="form-check-label" for="flexSwitchCheckChecked"
                    >Request bù</label
                    >
               </div>
               </div>
               </div>
               <div class="form-group col-md-12" style="margin-top: 20px">
               <div class="form-group col-md-6" style="padding-left: 0px">
               <label class="form-label" for="time_start">Từ</label>
               <input
                    class="form-control"
                    type="datetime-local"
                    v-model="data.time_start"
                    v-bind:readonly="check === 1"
               />
               </div>
               <div
               class="form-group col-md-6"
               >
               <label class="form-label" for="time_end">Đến</label>
               <input
                    class="form-control"
                    type="datetime-local"
                    v-model="data.time_end"
                    v-bind:readonly="check === 1"
               />
               </div>
               </div>
               <div class="col-md-8">
                    <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input
                         type="text"
                         class="form-control"
                         required
                         v-model="data.phone"
                         v-bind:readonly="check === 1"
                    />
                    </div>
               </div>
               <div class="form-group col-md-8">
               <label for="reason" class="form-label">Lý do</label>
               <textarea
               class="form-control"
               id="validationTextarea"
               v-model="data.reason"
               v-bind:readonly="check === 1"
               required
               placeholder='Cần nêu lý do cụ thể, không viết "Lý do cá nhân".'
               ></textarea>
               </div>
               <div v-if="check === 1 && user.role_id <= 4 && data.user_id !== user.id  " class="col-md-6" style=" margin-bottom: 15px;">
               <label class="form-label" for="time_start">Trạng thái</label>
               <select
                    class="form-control kind-select"
                    aria-label="Default select example"
                    required
                    v-model="data.status"
               >
                    <option value="1">Đang xử lý</option>
                    <option value="2">Xác nhận</option>
                    <option v-if="data.status !==1" value="3">Chấp nhận</option>
                    <option value="4">Từ chối</option>
                    <option value="5">Hủy</option>
               </select>
               </div>
               <div class="col-md-7" style="margin-bottom: 10px">
               <button
               type="submit"
               class="btn btn-success waves-effect waves-themed"
               >
               <i class="fal fa-save"></i>
               Lưu
               </button>
               </div>
          </form>
          </div>
          <div class="rule-content col-md-5">
          <div
               class="rules take-leave"
               :class="{ 'd-none': active !== 'days_on'  }"
          >
               <strong>Khi xin nghỉ phép chú ý: </strong>
               <ul>
               <li>Nếu còn ngày phép: Xin nghỉ phép có lương.</li>
               <li>Nếu không còn ngày phép: Xin nghỉ phép không lương.</li>
               <li>
               Nếu xin nghỉ 3 ngày khi chỉ còn 2 ngày phép: Xin nghỉ phép có
               lương, hệ thống sẽ tự update ngày còn lại là nghỉ phép không
               lương.
               </li>
               </ul>
          </div>
          <div
               class="rules forgot-to-check"
               :class="{ 'd-none': active !== 'forgot_to_check' }"
          >
               <strong> Đối với Request Cập nhật thời gian làm việc: </strong>
               <ul>
               <li>
               Chỉ được chấp nhận khi tạo Request bổ sung trong vòng 7 ngày kể từ
               ngày phát sinh
               </li>
               <li>
               Quá thời hạn bổ sung trên sẽ không được cập nhật thời gian làm
               việc và được tính là không đi làm.
               </li>
               <li>
               Lý do: Cần nêu cụ thể, không được viết "Lý do cá nhân", "Quên
               CI/CO"...
               </li>
               <li>
               Request này có thể bị từ chối nếu lý do đưa ra không hợp lý.
               </li>
               </ul>
          </div>
          <div
               class="rules over-time"
               :class="{ 'd-none': active !== 'over_time' }"
          >
               <p>Request OT phải được tạo trước thời gian OT ít nhất 24 giờ.</p>
          </div>
          <div
               class="rules special-take-leave"
               :class="{ 'd-none': active !== 'special_take_leave' }"
          >
               <strong>
               <p>Điều 12. Nghỉ việc riêng có lương</p>
               </strong>
               <p>
               Người lao động có quyền nghỉ và hưởng đầy đủ lương như những ngày đi
               làm trong các trường hợp sau:
               </p>
               <li>Bản thân kết hôn: được nghỉ 3 ngày.</li>
               <li>Con đẻ, con nuôi lập gia đình: được nghỉ 1 ngày.</li>
               <li>
               Cha đẻ, mẹ đẻ, cha nuôi, mẹ nuôi; cha đẻ, mẹ đẻ, cha nuôi, mẹ nuôi
               của vợ hoặc chồng; vợ hoặc chồng; con đẻ, con nuôi chết: được nghỉ 3
               ngày.
               </li>
               <li>Một số ngày nghỉ có lương khác theo quy định của cty.</li>
          </div>
               </div>
     </div>
     </div>

</template>
     

<script>
import { reactive, ref, onMounted } from "vue";
import ApiService from "../../../../service/calendarService"
import { useRouter } from "vue-router";

import axios from "axios";
export default {
     name:'req',
     data() {
          const data=reactive({
               content:"",
               type:"",
               time_start:"",
               time_end:"",
               reason:"",
               phone:"",
               status:"",
          });
          const router= useRouter();
          const user=ref([]);
          const check = ref(0); 
          const checktime=ref("")
          const id = router.currentRoute.value.params.id;
          const active="days_on";
          return {
                active,
                data,
                id,
                check,
                user,
                router,
                checktime
          };
     },
     mounted(){
          axios.get(`http://localhost:8000/api/user`)
          .then(response=>{
                    this.user=response.data.data;
                    Object.assign(this.data, {
                         ...this.user,
                    });
          });
          if(this.id){
          axios.get(`http://localhost:8000/api/calendar/requests/${this.id}`)
          .then(response=>{
               this.data=response.data.data;
               if (this.$route.fullPath.includes("edit-request")) {
                    if(response.data.data.status != 1 || this.user.id != this.data.user_id){
                         this.check = 1; 
                    }
               
               }
     });

     }
        }
     ,
     methods: {
          onChange(event) {
               this.active = ApiService.Onchange(event, this.active);
          },
          CreateReq(){
          if ( this.data.time_start > this.data.time_end) {
               this.checktime ="Thời gian bắt đầu không được lớn hơn thời gian kết thúc";
          }
          else{
               const idParam = this.id ? [this.data, this.id] : [this.data];
               this.$emit('CreateReq', ...idParam);
                    
               }
     }
     },
}
</script>

<style>
h2 {
  font-size: 14px !important;
  font-weight: 600 !important;
}
.rules {
  padding: 25px;
  padding-top: 0px;
  background-color: ghostwhite;
  margin: 20px;
}
.btn-success {
  color: #fff;
  background-color: #1dc9b7;
  border-color: #1dc9b7;
}
.btn-success:hover {
  color: #fff;
  background-color: #18a899;
  border-color: #179c8e;
}
.page-content .panel {
  margin-bottom: 1.5rem;
}
.panel {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  position: relative;
  background-color: #fff;
  -webkit-box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
  box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
  margin-bottom: 1.5rem;
  border-radius: 4px;
  border: 1px solid rgba(0, 0, 0, 0.09);
  border-bottom: 1px solid #e0e0e0;
  border-radius: 4px;
  -webkit-transition: border 500ms ease-out;
  transition: border 500ms ease-out;
}
.panel-hdr {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: space-between;

  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  background: #fff;
  min-height: 3rem;
  border-bottom: 1px solid rgba(0, 0, 0, 0.07);
  border-radius: 4px 4px 0 0;
  -webkit-transition: background-color 0.4s ease-out;
  transition: background-color 0.4s ease-out;
}
.panel .panel-container {
  position: relative;
  border-radius: 0 0 4px 4px;
}
.panel-container {
  margin-top: 30px;
}
.panel .panel-container .panel-content:only-child,
.panel .panel-container .panel-content:last-child {
  border-radius: 0 0 4px 4px;
}
</style>