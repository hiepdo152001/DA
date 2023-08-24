<template>
    <div class="MuiToolbar-root MuiToolbar-gutters MuiToolbar-regular css-zqjezy">
    <div class="MuiBox-root css-1guk29">
       
        <router-link :to="{name:'sys'}">
            <button class=" css-hmyp7d"  type="button" style="margin-right: 10px;">
                <span class="css-16rzsu1">
                        <i class="bi bi-house"></i>
                        Home
                    </span>
            </button>
        </router-link>
           
        <router-link :to="{name:'calendars'}">
            <button class=" css-hmyp7d"  type="button" style="margin-right: 10px;">
                <span class="css-16rzsu1">
                        <i class="bi bi-calendar"></i>
                        Calendar
                    </span>
            </button>
        </router-link>
        <router-link :to="{name:'admin-dn'}">
            <button class=" css-hmyp7d"  type="button" style="margin-right: 10px;">
                <span class="css-16rzsu1">
                        <i class="bi bi-calendar"></i>
                        StoreDN
                    </span>
            </button>
        </router-link>
        <router-link :to="{name:'admin-hcm'}">
            <button class=" css-hmyp7d"  type="button" style="margin-right: 10px;">
                <span class="css-16rzsu1">
                        <i class="bi bi-calendar"></i>
                        StoreHCM
                    </span>
            </button>
        </router-link>
    </div>
    </div>
    <div >
        <router-view></router-view>
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
<style>

.router-link-exact-active .css-hmyp7d {
    color: white !important;
    text-decoration: none !important;
    font-size: 14px;
    border-color: white  !important;
    font-weight: 700;
}
.css-16rzsu1 a{
color: rgb(138, 141, 147);
}

.active-button {
border-color: red!important;;
}
a:hover{
    text-decoration: none !important;;
}
.css-16rzsu1{
    font-size: 12px;
}
.css-i1wm59.MuiButton-outlined {
    padding: 0.1875rem 0.8125rem;
}
.css-hmyp7d:hover{
    border-color: white;
}
.css-hmyp7d {
    display: inline-flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    position: relative;
    box-sizing: border-box;
    -webkit-tap-highlight-color: transparent;
    background-color: transparent;
    outline: 0px;
    margin: 0px;
    cursor: pointer;
    user-select: none;
    vertical-align: middle;
    appearance: none;
    text-decoration: none;
    font-family: Inter, sans-serif, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    font-size: 0.8125rem;
    text-transform: uppercase;
    color: rgb(138, 141, 147);
    min-width: 64px;
    transition: background-color 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, box-shadow 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, border-color 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, color 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    border: 1px solid rgba(138, 141, 147, 0.5);
    font-weight: 500;
    border-radius: 5px;
    line-height: 1.71;
    letter-spacing: 0.3px;
    padding: 0.25rem 0.5625rem;
}
@media (min-width: 600px){
.css-zqjezy {
    padding-left: 0.75rem;
    padding-right: 0.75rem;
}
}
.css-zqjezy {
    position: relative;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    padding-left: 0.5rem;
    min-height: 64px;
    padding-right: 0rem;
    background-color: rgb(33, 57, 124);
}
</style>