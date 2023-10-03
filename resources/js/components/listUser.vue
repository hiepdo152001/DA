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
        <user-component :users="users"/>
        <div class="page">
            <Bootstrap5Pagination :data="users" @pagination-change-page="getUsers" />
        </div>
    </div>
</template>
<script>
import { reactive, ref } from 'vue';
import axios from 'axios';
import  UserComponent from '../components/user.vue'
import { Bootstrap5Pagination } from "laravel-vue-pagination";

export default{
    name:'list-user-comp',
    data(){
        const input = reactive({
        search: ""
    })
    return {
        input
    }
    },
    props:{
        users: {
            type: Array,
            required: true
        }
    }
    ,
    methods:{
        SearchUser(){
            this.$emit('SearchUser',page=1,this.input.search);
        },
        getUsers(){
            this.$emit('getUsers',page=1);
        }
    }

}

</script>