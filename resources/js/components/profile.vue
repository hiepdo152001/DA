<template>
    <div class="panel" style="margin: 35px;">
    <div>
      <div>
        <div class="panel-hdr">
          <h2 >Thông tin cá nhân</h2>
        </div>
        <div class="col-6">
          <router-link :to="{ name: 'sys-edit-user',params: { id: {id} } }">
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
          <h2 class="text-center">Thông tin nhân viên</h2>
        </div>
        <table class="table table-bordered table-hover " style="width: 95%;margin: auto;margin-bottom: 50px;">
            <tbody>
            <tr>
              <td><strong>Email</strong></td>
              <td>{{ user.email }}</td>
            </tr>
            <tr>
              <td><strong>Họ tên</strong></td>
              <td>{{ user.name }}</td>
            </tr>
            <tr>
              <td><strong>Chi Nhánh</strong></td>
              <td v-if=" user.branch_id == 1 "> Hồ Chí Minh</td>
              <td v-if=" user.branch_id == 2 "> Hà Nội</td>
            </tr>
            <tr>
              <td><strong>Vị trí</strong></td>
              <td></td>
            </tr>
            <tr>
              <td><strong>Giới tính</strong></td>
              <td v-if=" user.gender == 1 ">Nam</td>
              <td v-if=" user.gender == 2 "> Nữ</td>
            </tr>
            <tr>
              <td><strong>Địa chỉ thường trú</strong></td>
              <td></td>
            </tr>
            <tr>
              <td><strong>Số điện thoại</strong></td>
              <td>{{ user.phone }}</td>
            </tr>
            <tr>
              <td><strong>Ngày sinh</strong></td>
              <td>{{ user.birth_day }}</td>
            </tr>
            <tr>
              <td><strong>Số CCCD</strong></td>
              <td></td>
            </tr>
            <tr>
              <td><strong>Email cá nhân</strong></td>
              <td></td>
            </tr>
            <tr>
              <td><strong>Mã số thuế</strong></td>
              <td></td>
            </tr>
            <tr>
              <td><strong>Tên ngân hàng</strong></td>
              <td></td>
            </tr>
            <tr>
              <td><strong>Số tài khoản</strong></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</template>
<script>
export default {
    name:"comp-profile",
    props:{
        user:{
            type: Object,
            required: true,
        },
        id:{
          type: Number,
            required: true,
        }
    }
   
};
</script>