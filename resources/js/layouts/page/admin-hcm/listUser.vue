<template>
    <list-users 
    v-on:SearchUser="SearchUser"
    v-on:getUsers="getUsers"
    v-bind:users="users"
     />
</template>
<script>
import { reactive, ref } from 'vue';
import axios from 'axios';
import listUser from '../../../components/listUser.vue';
export default{
name:"list-users",
components:{
    listUser,
},
data(){
const users=reactive([]);
return {
    users
}
},mounted(){
    axios.get(`http://localhost:8000/api/user/all?page=1`).then(response=>{
            this.users=response.data[0];
        });
},
methods:{
    SearchUser(page,search){
        axios.get(`http://localhost:8000/api/user/all?page=${page}`,
        {params: { search: search }},
        ).then(response=>{
            this.users=response.data[0];
        });
    },
    getUsers(page){
        axios.get(`http://localhost:8000/api/user/all?page=${page}`).then(response=>{
            this.users=response.data[0];
        });
    },
}
}
</script>