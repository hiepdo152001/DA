<template>
    <table class="table table-bordered" style="margin-top: 30px">
    <thead>
      <tr>
        <th>Id</th>
        <th>Tên</th>
        <th>Email</th>
        <th>Phòng ban</th>
        <th>Chức vụ</th>
        <th>Trạng thái</th>
        <th>Xử lý</th>
      </tr>
    </thead>
    <tbody>
      <tr class="contact-row">
        <td>
          <button
            class="btn"
            type="button"
            data-toggle="tooltip"
            data-placement="top"
            title="edit"
          >
              <i class="bi bi-pencil-fill" style="color: black"></i>
          </button>
          <!-- <button
            v-if="user.status === 'Active'"
            class="btn"
            type="button"
            @click="deletes(user.id)"
            data-toggle="tooltip"
            data-placement="top"
            title="block"
          >
            <i class="bi bi-lock-fill"></i>
          </button>
          <button
            v-if="user.status === 'deActive'"
            class="btn"
            type="button"
            @click="active(user.id)"
            data-toggle="tooltip"
            data-placement="top"
            title="active"
          >
            <i class="bi bi-key-fill"></i>
          </button> -->
        </td>
      </tr>
    </tbody>
  </table>
</template>