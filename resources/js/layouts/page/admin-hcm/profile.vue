<template>
<profile-component :user="user" />
</template>
<script>
import ProfileComponent from '../../../components/profile.vue';
import { useRouter } from "vue-router";
import { ref } from 'vue';
import axios from 'axios';

export default{
    name:'sys-pro-user',
    components:{
        ProfileComponent
    },
    data(){
        const user=ref([]);
        const router= useRouter();
        const id = router.currentRoute.value.params.id;
        return {
            user,
            id
        }
    },
    mounted(){
        if(this.id != null){
            axios.get(`http://localhost:8000/api/user/by/${this.id}`)
            .then(response=>{
                        this.user=response.data.data;
                    });
        }
        else{
            
            axios.get(`http://localhost:8000/api/user`)
            .then(response=>{
                        this.user=response.data.data;
                    });
            }
    }
}
</script>