<template>
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-sm-2 d-none d-sm-flex" style="padding: 0">
            <TheMenu/>
        </div>
        <div class="col-12 col-sm-10" style="padding: 0; height: 880px">
            <router-view></router-view>
        </div>
      </div>
    </div>
</template>
<script>
import TheMenu from './menu.vue';
export default {
    components: {
      TheMenu,
    },
  };
  </script>
  