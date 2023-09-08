<template>
    <a-menu
      v-model:openKeys="openKeys"
      v-model:selectedKeys="selectedKeys"
      mode="inline"
    >
      <a-menu-item key="lich-lam-viec">
        <i class="bi bi-boxes"></i>
        <span>Thống kê</span>
      </a-menu-item>
  
      <a-menu-item key="yeu-cau-cua-toi" >
        <router-link :to="{ name: 'statistical' }">
          <i class="bi bi-person"></i>
                <span>Quản lý User</span>
        </router-link>
          
      </a-menu-item>
      <a-menu-item key="member-request" >
            <span> Kho hàng</span>
      </a-menu-item>
      <a-menu-item key="member" >
         <span>Quản lý User</span>
        
      </a-menu-item>
      <a-menu-item key="assss" >
             <span>Phòng ban</span>
        </a-menu-item>
    </a-menu>
  </template>
<script>
import { reactive, toRefs, onMounted, ref } from "vue";

export default {
  setup() {
    const state = reactive({
      selectedKeys: ["lich-lam-viec"],
      openKeys: [""],
    });
   
    return {
      ...toRefs(state),
    };
  },
};
</script>