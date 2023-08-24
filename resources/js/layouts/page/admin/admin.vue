<template>
    <div class="row d-flex">
    <div class="col-sm-2" style=" background-color: rgb(33, 57, 124);">
    <menuAdmin/>
    </div>
    <div class="col-12 col-sm-10">
        <router-view></router-view>
    </div>
</div>
</template>
<script>
import menuAdmin from '../../../components/menuAdmin.vue';

export default{
    components:{
        menuAdmin,
    }
}

</script>

