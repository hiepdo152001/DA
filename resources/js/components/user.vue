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
        <tr v-for="u in users  " :key="u.id" class="contact-row">
          <td>{{ u.name }}</td>
          <td>{{ u.email }} </td>
          <td v-if=" u.branch_id == null "> </td>
          <td v-if=" u.branch_id == 1 "> Hồ Chí Minh</td>
          <td v-if=" u.branch_id == 2 "> Đà Nẵng</td>
          <td v-if="u.role_id === null"> </td>
          <td v-if="u.role_id === 1">Quản trị hệ thống  </td>
          <td v-if="u.role_id === 2">Quản trị  </td>
          <td v-if="u.role_id === 3">Quản trị nhân lực  </td>
          <td v-if="u.role_id === 4">Quản lý  </td>
          <td v-if="u.role_id === 5"> Nhân viên </td>
          <td v-if="u.role_id === 6"> Khách </td>
          <td>
          <button
            v-if="u.status === 1"
            class="btn"
            type="button"
            @click="deletes(u.id)"
            data-toggle="tooltip"
            data-placement="top"
            title="block"
          >
            <i class="bi bi-lock-fill" style="color: black !important"></i>
          </button>
          <button
            v-if="u.status === 0"
            class="btn"
            type="button"
            @click="active(u.id)"
            data-toggle="tooltip"
            data-placement="top"
            title="active"
          >
          <i class="bi bi-key-fill" style="color: black !important"></i>
         </button>
          </td>
        <td>
          <button
            class="btn"
            type="button"
            data-toggle="tooltip"
            data-placement="top"
            title="view"
          >
            <router-link :to="{ name: 'sys-user-view', params: { id: parseInt(u.id) } }">
              <i class="bi bi-eye" style="color: black !important;"></i>
            </router-link>
          </button>
        </td>
        </tr>
      </tbody>
    </table>
    </div>
  </template>

<script>
import axios from 'axios';
export default {
  name: "comp-user",
  props: {
    users: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      // Không cần khai báo users ở đây vì bạn đã có props users
    };
  },
  methods: {
    deletes(id) {
      axios.put(`http://localhost:8000/api/user/${id}/deActive`, "").then((response) => {
        if (response.status === 202) {
          const indexToUpdate = this.users.findIndex((user) => user.id === response.data[0].id);
          if (indexToUpdate !== -1 && confirm('Bạn có muốn thay đổi trạng thái?')) {
            this.users[indexToUpdate]=response.data[0];
          }
        }
      });
    },
    active(id) {
      axios.put(`http://localhost:8000/api/user/${id}/active`, "").then((response) => {
        if (response.status === 202) {
          const indexToUpdate = this.users.findIndex((user) => user.id === response.data[0].id);
          if (indexToUpdate !== -1 && confirm('Bạn có muốn thay đổi trạng thái?')) {
            this.users[indexToUpdate]=response.data[0];
          }
        }
      });
    },
  },
};

</script>