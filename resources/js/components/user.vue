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
          <td></td>
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
    mounted(){
      console.log(this.users);
    }
}
</script>