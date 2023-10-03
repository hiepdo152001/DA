<template>
    <td v-if="datas.content === 'days_on'">Nghỉ phép có lương</td>
    <td v-if="datas.content === 'days_off'">Nghỉ phép không lương</td>
    <td v-if="datas.content === 'over_time'">Làm thêm giờ</td>
    <td v-if="datas.status === 1 "><span class="status status-pending">Đang xử lý</span></td>
    <td v-if="datas.status === 2 "><span class="status status-confirmed">Xác nhận</span></td>
    <td v-if="datas.status === 3 "><span class="status status-approved">Đồng ý</span></td>
    <td v-if="datas.status === 4 "><span class="status status-declined">Từ chối </span></td>
    <td v-if="datas.status === 5 "><span class="status status-canceled">Hủy</span></td>
</template>
<script>
export default{
    name:'status-comp',
    props:{
        datas:{
            type: Object,
            required: true,
        }
    }
}
</script>
<style>
.status-pending {
background-color: #2196f3;
}
.status-confirmed {
background-color: #4caf50;
}
.status-approved{
background-color:  #1dc9b7;
}
.status-declined {
background-color:  #a26304;
}
.status-canceled{
background-color:  #c53511;
}
</style>