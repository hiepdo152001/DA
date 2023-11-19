<template>
    <div class="panel" style="margin: 50px 30px 0px 30px;">
        <div class="col-md-11">
            <div class="panel-hdr">
            <h2>Tìm Kiếm</h2>
            </div>
            <form
            class="navbar-form navbar-left"
            enctype="multipart/form-data"
            @submit.prevent="SearchUser"
            >
            <div class="input-group">
                <input
                type="text"
                class="form-control"
                placeholder="Search"
                v-model="input.search"
                />
                <button class="btn btn-primary mt-2" type="submit" style="background-color: #886ab5;">Tìm Kiếm</button>
            </div>
            </form>
        </div>
        <user-component :users="users.data" />
        <div class="page">
            <Bootstrap5Pagination :data="users" @pagination-change-page="getUsers" />
        </div>
    </div>
</template>
<script>
import { reactive, ref } from 'vue';
import axios from 'axios';
import  UserComponent from '../../../../components/user.vue';
import { Bootstrap5Pagination } from "laravel-vue-pagination";
export default{
name:"list-users",
components:{
    UserComponent,
    Bootstrap5Pagination,

},
data(){
    const users=ref([]);
    const input = reactive({
        search: ""
    })
    return {
        users,
        input
    }
},
mounted(){
    axios.get(`http://localhost:8000/api/user/all?page=1`).then(response=>{
            this.users=response.data[0];
        });
},
methods:{
    getUsers(page =1){
        axios.get(`http://localhost:8000/api/user/all?page=${page}`).then(response=>{
            this.users=response.data[0];
        });
    },
    SearchUser(page =1){
        axios.get(`http://localhost:8000/api/user/all?page=${page}`,
        {params: { search: this.input.search }},
        ).then(response=>{
            this.users=response.data[0];
            console.log(this.users);
        });
    }
}
}
</script>