<template>
    <div class="panel-content " style="width: 95%;margin: auto;margin-bottom: 50px;">
    <table class="table table-bordered" style="margin-top: 30px">
      <thead>
        <tr>
          <th>Tên</th>
          <th>Email</th>
          <th>Chi nhanh</th>
          <th>Chức vụ</th>
          <th>Trạng thái</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="u in users" class="contact-row">
          <td>{{ u.name }}</td>
          <td>{{ u.email }}</td>

          <td v-if=" u.branch_id == 1 "> Hồ Chí Minh</td>
          <td v-if=" u.branch_id == 2 "> Đà Nẵng</td>
          <td v-if="u.role_id === null"> </td>
          <td v-if="u.role_id === 1">Quản trị hệ thống  </td>
          <td v-if="u.role_id === 2">Quản trị  </td>
          <td v-if="u.role_id === 3">Quản trị nhân lực  </td>
          <td v-if="u.role_id === 4">Quản lý  </td>
          <td v-if="u.role_id === 5"> Nhân viên </td>
          <td v-if="u.role_id === 6"> Khách </td>
          <td></td>
          <td>
            <button
            class="btn"
            type="button"
            data-toggle="tooltip"
            data-placement="top"
            title="view"
          >
            <router-link :to="{ name: 'sys-user-view', params: { id: u.id } }">
              <i class="bi bi-eye-fill" style="color: black"></i>
            </router-link>
          </button>
         
          </td>
        </tr>
      </tbody>
    </table>
    </div>
  </template>

<script>
export default{
    name:"comp-user",
    props:{
        users: {
            type: Array,
            required: true,
        },
    },
}
</script>