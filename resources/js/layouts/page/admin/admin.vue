<template>
    <div class="row d-flex">
    <div class="col-sm-2" >
    <menuAdmin/>
    </div>
    <div class="col-sm-10">
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

