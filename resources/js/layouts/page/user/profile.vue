<template>
    <profile-component :user="user"  />
</template>
<script>
import { ref } from "vue";
import axios from "axios";
import ProfileComponent from "../../../components/profile.vue";
export default {
    name:'user-profile',
    components:{
    ProfileComponent
    },
    data(){
        const user=ref([]);
        return {
            user,
        }
    },
    mounted() {
    axios.get(`http://localhost:8000/api/user`).then(response => {
        this.user = response.data.data;
    });
},
   
};
</script>
<style>
.panel-hdr {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    background: #fff;
    min-height: 3rem;
    border-bottom: 1px solid rgba(0,0,0,0.07);
    border-radius: 4px 4px 0 0;
    -webkit-transition: background-color 0.4s ease-out;
    transition: background-color 0.4s ease-out;
}
.panel-hdr>:last-child {
    padding-right: 1rem;
}
.panel-hdr>:first-child {
    padding-left: 1rem;
}
.panel-hdr h2 {
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    font-size: 0.875rem;
    margin: 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    line-height: 3rem;
    color: inherit;
    color: #333;
    position: relative;
    font-weight: 700;
    font-size: 14px;
    padding: 10px;
}
</style>