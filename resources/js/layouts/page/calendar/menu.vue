<template>
    <a-menu
      v-model:openKeys="openKeys"
      v-model:selectedKeys="selectedKeys"
      mode="inline"
    >
      <a-menu-item key="lich-lam-viec">
        
        <router-link :to="{ name: 'calendars' }">

          <i class="bi bi-calendar"></i>
                <span>Calendar</span>
        </router-link>
      </a-menu-item>
  
      <a-menu-item key="holiday" >
        <router-link :to="{ name: 'holiday' }">
                <span>Holiday</span>
        </router-link>
      </a-menu-item>
      <a-menu-item key="member-request" >
        <router-link :to="{ name: 'request' }">
          <i class="fal fa-share-square"></i>
                <span>Request</span>
        </router-link>
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