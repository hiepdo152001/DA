<template>
    <div class="topsite small_hide d-flex">
        <div class="col-md-11">
            <ul class="container">
            <li class="col-md-3 rea1">
                <span class="glyphicon glyphicon-link"></span>
                BẢO HÀNH 12 THÁNG 1 ĐỔI 1

                <div class="pop-rea pop-rea1">
                    <div class="left-popr">
                        <span class="glyphicon glyphicon-link"></span>
                    </div>
                    <div class="right-popr">
                        Chế độ bảo hành tốt nhất Việt Nam
                    </div>
                </div>
            </li>
            <li class="col-md-3 rea2">
                <span class="glyphicon glyphicon-send"></span>
                MIỄN PHÍ GIAO HÀNG TOÀN QUỐC

                <div class="pop-rea pop-rea2">
                    <div class="left-popr">
                        <span class="glyphicon glyphicon-send"></span>
                    </div>
                    <div class="right-popr">
                        <span style="font-size: 13px"
                            >Ship hàng siêu tốc sau 1 đến 3 ngày</span
                        >
                    </div>
                </div>
            </li>
            <li class="col-md-3 rea3">
                <span class="glyphicon glyphicon-ok"></span>
                ĐƯỢC KIỂM TRA &amp; ĐI THỬ TRƯỚC

                <div class="pop-rea pop-rea3">
                    <div class="left-popr">
                        <span class="glyphicon glyphicon-ok"></span>
                    </div>
                    <div class="right-popr">
                        <span style="font-size: 13px"
                            >Hoàn toàn yên tâm khi mua hàng Online</span
                        >
                    </div>
                </div>
            </li>
            <li class="col-md-3 rea4">
                <span class="glyphicon glyphicon-phone-alt"></span>
                HOTLINE: 094-161-0000

                <div class="pop-rea pop-rea4">
                    <div class="left-popr">
                        <span class="glyphicon glyphicon-phone-alt"></span>
                    </div>
                    <div class="right-popr">
                        <span style="font-size: 13px"
                            >Phục vụ 24/7 - Tư vấn tận tình</span
                        >
                    </div>
                </div>
            </li>
        </ul>
        </div>
        <div class="dropdown col-md-1" style="padding-right: 40px; padding-top: 3px;">
      <div class="btn custom-dropdown" type="button" data-toggle="dropdown" style="padding: 0px;">
        <img style="width: 35px;height: 35px;" class="profile-image rounded-circle" :src=user.avatar>
      </div>
      <ul class="dropdown-menu dropdown-menu-right" style="padding: 0px;">
        <div
          class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top" 
          style="background: linear-gradient(250deg, #3e93d6, #8a75aa);"
        >
        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white" >
            <span class="mr-2">
              <img style="width: 50px; height: 50px;"
                v-if="user.avatar"
                class="profile-image rounded-circle"
                :src="user.avatar"
                alt=""
              />
              <img
                v-else
                class="profile-image rounded-circle"
                alt=""
              />
            </span>
            <div class="info-card-text">
              <div class="fs-lg text-truncate text-truncate-lg">
                {{ user.name }}
              </div>
              <span class="text-truncate text-truncate-md opacity-80">
                {{ user.email }}
              </span>
            </div>
          </div>
        </div>
        <li>
          <router-link :to="{ name: 'test' }">
            <a class="dropdown-item">Profile</a>
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: '' }">
            <a class="dropdown-item">Đổi mật khẩu</a>
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: '' }">
            <a class="dropdown-item">Danh sách yêu cầu</a>
          </router-link>
        </li>
        <li style="padding-left: 20px">
          <form>
            <form @submit.prevent="logout">
              <button type="submit" class="dropdown-item">Logout</button>
            </form>
          </form>
        </li>
      </ul>
    </div>
    </div>
    <div class="menu-fixed">
        <div class="fullsize-menubar small_show bar-top">
            <div class="container">
                <div class="col-xs-12">
                    <div class="menu-btn-no-modal row small-menu-top">
                        <div class="col-xs-11 logo-sm">
                            <a href="/" title="" class="a-niveau1">
                                <table width="100%" border="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img
                                                    src="http://giaycaochonam.com/uploads/about/home-logo.png"
                                                    height="54"
                                                />
                                            </td>
                                            <td>
                                                <center>
                                                    <img
                                                        src="http://giaycaochonam.com/uploads/about/Logo-Tmen-00.png"
                                                        height="54"
                                                    />
                                                </center>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </a>
                        </div>
                        <div
                            @click="bam()"
                            class="col-xs-1 nutbam_mobile menu-btn"
                        >
                            <i class="fas fa-bars">aaaa</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!---thongnv-->
        <div class="size-menubar small_show bar-menu">
            <div class="container">
                <div class="col-xs-12">
                    <div class="menu-btn-no-modal row small-menu-item">
                        <div class="col-xs-3">
                            <a href="/shops/group/giay-cao-ban-chay.html"
                                ><span style="color: black">• Bán chạy</span></a
                            >
                        </div>
                        <div class="col-xs-3">
                            <a href="/shops/group/giay-cao-the-thao.html"
                                ><span style="color: black">• Thể thao</span></a
                            >
                        </div>
                        <div class="col-xs-3">
                            <a href="/shops/group/giay-cao-cong-so.html"
                                ><span style="color: black">• Công sở</span></a
                            >
                        </div>
                        <div class="col-xs-3">
                            <a href="/shops/group/giay-cao-tre-trung.html"
                                ><span style="color: black"
                                    >• Thời trang</span
                                ></a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="mobile pushy" :class="{ 'pushy-left': check === false }">
        <nav class="navigation">
            <ul class="main">
                <li class="main">
                    <a href="/" title="↑ 9-10CM" class="main"
                        ><img
                            src="../assets/home.png"
                            alt=""
                            title=""
                            width="18"
                            height="18"
                            class="adtm_menu_icon"
                        />
                        Home</a
                    >
                </li>
                <li class="main">
                    <a
                        href="https://giaycaochonam.com/news/giay-tang-chieu-cao-nam/gioi-thieu-ve-giay-tang-chieu-cao-nam-t-men-32.html"
                        title="GIỚI THIỆU"
                        class="main"
                        >GIỚI THIỆU<i class="main-arrow"></i
                    ></a>
                </li>
                <li class="main">
                    <a
                        href="/news/giay-cao-nam.html"
                        title="TIN TỨC"
                        class="main"
                        >TIN TỨC<i class="main-arrow"></i
                    ></a>
                </li>
                <li class="main">
                    <a
                        href="/news/huong-dan-mua-hang/huong-dan-mua-hang-11.html"
                        title="HD MUA HÀNG"
                        class="main"
                        >HD MUA HÀNG<i class="main-arrow"></i
                    ></a>
                </li>
                <li class="main">
                    <a
                        href="http://giaycaochonam.com/shops/group/6cm.html"
                        title="↑ 6CM"
                        class="main"
                        >↑ 6CM<i class="main-arrow"></i
                    ></a>
                </li>
                <li class="main">
                    <a
                        href="http://giaycaochonam.com/shops/group/7cm.html"
                        title="↑ 7CM"
                        class="main"
                        >↑ 7CM<i class="main-arrow"></i
                    ></a>
                </li>
                <li class="main">
                    <a
                        href="http://giaycaochonam.com/shops/group/8cm.html"
                        title="↑ 8CM"
                        class="main"
                        >↑ 8CM<i class="main-arrow"></i
                    ></a>
                </li>
                <li class="main">
                    <a
                        href="http://giaycaochonam.com/shops/group/9-10cm.html"
                        title="↑ 9-10CM"
                        class="main"
                        >↑ 9-10CM<i class="main-arrow"></i
                    ></a>

                    <div class="clear"></div>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
import { ref } from "vue";
import axios from "axios";
export default {
    name:"top",
    data(){
        const check = ref(false);
        const user=ref([]);
        return {
            check,
            user
        }
    },
    mounted(){
        this.check = false;
        axios.get(`http://localhost:8000/api/user`).then(response=>{
            this.user=response.data.data;
            console.log(this.user.avatar);
            
        });

    },
    methods:{
        bam(){
            if (this.check === true) {
                this.check = false;
            } else {
                this.check= true;
            }
        },
        logout(){
        axios.get(`http://localhost:8000/api/logout`).then(response=>{
          location.reload('');
        });
      }
    }
   
};
</script>
<style>
.text-truncate{
  font-size: 14px;
  color: white;
  padding-left: 10px;
  margin-bottom: 10px;
}
.container {
    padding-right: 5px;
    padding-left: 5px;
    margin-right: auto;
    margin-left: auto;
}
ul {
    display: block;
    list-style-type: disc;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 40px;
    list-style: none;
    margin-top: 0px;
    margin-bottom: auto;
}
.topsite {
    background: #a7051a;
    min-height: 34.5px;
    color: #fff;
    padding: 0;
    -webkit-transition: 0.5s;
    -moz-transition: 0.5s;
    transition: 0.5s;
    position: fixed;
    z-index: 9999;
    top: 0;
    width: 100%;
    margin: 0;
    padding: 0;
    border: 0;
    outline: 0;
    font-size: 100%;
    vertical-align: baseline;
}

.topsite ul li {
    text-align: left;
    -webkit-transition: 0.5s;
    -moz-transition: 0.5s;
    transition: 0.5s;
    height: 100%;
    padding: 0 0 7px 0;
    margin: 0;
}
.topsite .glyphicon {
    font-size: 18px;
    color: #fff;
    margin-right: 5px;
    margin-top: 5px;
}

.glyphicon {
    position: relative;
    top: 1px;
    display: inline-block;
    font-family: "Glyphicons Halflings";
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.pop-rea {
    position: absolute;
    background: #fff;
    border-left: solid #000 1px;
    border-right: solid #000 1px;
    border-bottom: solid #000 1px;
    color: #000;
    width: 120%;
    padding: 10px 10px 10px 10px;
    margin-top: 7px;
    margin-left: -1px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    visibility: hidden;
    opacity: 0;
    -webkit-opacity: 0;
    -moz-opacity: 0;
    z-index: 800000 !important;
    font-size: 13px;
}

.topsite li:hover {
    position: relative;
    background: #fff !important;
    -webkit-transition: 0.5s;
    -moz-transition: 0.5s;
    transition: 0.5s;
    color: #000;
    .pop-rea {
        position: absolute;
        background: #fff;
        border-left: solid #000 1px;
        border-right: solid #000 1px;
        border-bottom: solid #000 1px;
        color: #000;
        width: 120%;
        padding: 10px 10px 10px 10px;
        margin-top: 7px;
        margin-left: -1px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        visibility: hidden;
        opacity: 0;
        -webkit-opacity: 0;
        -moz-opacity: 0;
        z-index: 800000 !important;
        font-size: 13px;
        display: block;
    }
    .pop-rea div.left-popr span {
        font-size: 80px !important;
        color: #a7051a;
        margin-top: 45px;
    }
    .topsite .glyphicon {
        font-size: 18px;
        color: #fff;
        margin-right: 5px;
        margin-top: 5px;
    }
    .glyphicon {
        position: relative;
        top: 1px;
        display: inline-block;
        font-family: "Glyphicons Halflings";
        font-style: normal;
        font-weight: 400;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    .pop-rea,
    .left-popr {
        visibility: visible;
        -webkit-transition: 0.5s;
        -moz-transition: 0.5s;
        transition: 0.5s;
        opacity: 1;
        -webkit-opacity: 1;
    }
    .pop-rea div.left-popr {
        width: 30%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        float: left;
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;
        font-size: 100%;
        vertical-align: baseline;
        background: transparent;
    }
    .pop-rea div.right-popr {
        width: 70%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        float: left;
        padding: 0 10px;
        text-align: left;
        border-left: 1px solid #000;
    }
}

.fullsize-menubar {
    width: 100%;
    margin-top: 0;
    background: #a7051a;
    border-top: 1px solid #a7051a;
    border-bottom: 1px solid #a7051a;
}
a:link,
a:active,
a:visited {
    color: #444;
    text-decoration: none;
}

.pushy,
#container,
.push {
    -webkit-transition: -webkit-transform 0.2s
        cubic-bezier(0.16, 0.68, 0.43, 0.99);
    -moz-transition: -moz-transform 0.2s cubic-bezier(0.16, 0.68, 0.43, 0.99);
    -o-transition: -o-transform 0.2s cubic-bezier(0.16, 0.68, 0.43, 0.99);
    transition: transform 0.2s cubic-bezier(0.16, 0.68, 0.43, 0.99);
}
.pushy-open {
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0);
    -o-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
}
.pushy-left {
    -webkit-transform: translate3d(-200px, 0, 0);
    -moz-transform: translate3d(-200px, 0, 0);
    -ms-transform: translate3d(-200px, 0, 0);
    -o-transform: translate3d(-200px, 0, 0);
    transform: translate3d(-200px, 0, 0);
}
.pushy {
    position: fixed;
    width: 200px;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 9999;
    background: #eee;
    font-size: 0.9em;
    font-weight: bold;
    border-right: 1px solid #afa88b;
    overflow: auto;
    -webkit-overflow-scrolling: touch;
    z-index: 9999999999999999;
}
.pushy a {
    display: block;
    color: #444;
    padding: 15px 30px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    text-decoration: none;
}
.navigation li {
    display: list-item;
    text-align: -webkit-match-parent;
}

.row {
    flex-wrap: nowrap;
}
</style>
