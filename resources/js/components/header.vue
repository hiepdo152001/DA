<template>
    <div id="header" class="small_hide">
        <div class="container">
            <div id="logo" class="col-md-3">
                <a
                    title="TOP +1000 MẪU GIÀY TĂNG CHIỀU CAO NAM ĐẸP NHẤT - MIỄN PHÍ GIAO HÀNG - KIỂM TRA ĐI THỬ TRƯỚC KHI NHẬN - BẢO HÀNH 12 THÁNG 1 ĐỔI 1 - GIÀY TĂNG CHIỀU CAO NAM ĐỘN ĐẾ NÂNG GÓT T-MEN"
                    href="/"
                    ><img
                        class="img-responsive"
                        src="../assets/logo.png"
                        alt="TOP +1000 MẪU GIÀY TĂNG CHIỀU CAO NAM ĐẸP NHẤT - MIỄN PHÍ GIAO HÀNG - KIỂM TRA ĐI THỬ TRƯỚC KHI NHẬN - BẢO HÀNH 12 THÁNG 1 ĐỔI 1 - GIÀY TĂNG CHIỀU CAO NAM ĐỘN ĐẾ NÂNG GÓT T-MEN"
                /></a>
            </div>
            <span class="col-md-7">
                <br /><br />
                <div class="banner_img" style="text-align: center">
                    <img alt="" src="../assets/banner-10cm-tmen.jpg" />
                </div>
                <div style="text-align: center; margin-top: 15px">
                    <br />
                    Website: www.giaycaochonam.com&nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; Call/Zalo: 094-161-0000
                </div>
            </span>
            <div class="col-md-2 option_search_cart">
                <div class="block clearfix">
                    <div class="block_cart clearfix" id="cart_shops">
                        <div class="shopping_cart">
                            <span
                                style="
                                    font-size: 18px;
                                    padding-top: 10px;
                                    color: #fff;
                                "
                                ><span
                                    class="glyphicon glyphicon-share-alt"
                                ></span></span
                            ><a
                                onclick="popup_cart(this)"
                                href="javascript:void(0)"
                                title="Giỏ hàng"
                                rel="nofollow"
                                data-toggle="modal"
                                data-target="#introVideo"
                                ><b> Giỏ hàng</b><span> (0)</span></a
                            >
                        </div>
                    </div>
                </div>

                <div style="clear: both"></div>
                <div id="search_block_top">
                    <form
                        action="/"
                        method="get"
                        id="searchbox"
                        onsubmit="return nv_search_submit('topmenu_search_query', 'topmenu_search_checkss', 'topmenu_search_submit', 3, 60);"
                    >
                        <fieldset>
                            <input
                                type="hidden"
                                id="topmenu_search_checkss"
                                value=""
                            />
                            <input
                                placeholder="Search"
                                class="search_query"
                                type="text"
                                name="topmenu_search_query"
                                id="topmenu_search_query"
                                maxlength="60"
                            />
                            <button
                                class="btn btn-default button-search"
                                type="submit"
                                value=""
                                name="topmenu_search_submit"
                                id="topmenu_search_submit"
                                onclick="nv_search_submit('topmenu_search_query', 'topmenu_search_checkss', 'topmenu_search_submit', 3, 60);"
                            >
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<style src="../assets/style.css"></style>
<style>
#header {
    z-index: 1;
    position: relative;
    background: url(../images/header.jpg) center center repeat #fff;
    padding-top: 40px;
}
.container {
    padding-right: 5px;
    padding-left: 5px;
    margin-right: auto;
    margin-left: auto;
}
#header #logo {
    padding-top: 25px;
    padding-bottom: 10px;
}

a:link,
a:active,
a:visited {
    color: #444;
    text-decoration: none;
}
html[xmlns] .clearfix {
    display: block;
}
.block {
    padding: 0;
    margin-bottom: 0;
}

#search_block_top {
    margin-top: 73px;
    margin-left: 0;
    float: right;
    text-align: center;
    width: 100%;
}
.shopping_cart {
    position: relative;
    padding: 10px 10px 10px 10px;
    text-align: center;
    margin-top: 40px;
    background: #a7051a;
}

.shopping_cart a {
    color: #fff;
}
#search_block_top #searchbox {
    float: right;
    width: 100%;
}
form#searchbox {
    position: relative;
}
fieldset {
    min-width: 0;
    padding: 0;
    margin: 0;
    border: 0;
    display: block;
    margin-inline-start: 2px;
    margin-inline-end: 2px;
    padding-block-start: 0.35em;
    padding-inline-start: 0.75em;
    padding-inline-end: 0.75em;
    padding-block-end: 0.625em;
    min-inline-size: min-content;
}
#search_block_top {
    margin-top: 73px;
    margin-left: 0;
    float: right;
    text-align: center;
    width: 100%;
}
input,
select,
textarea {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
}
input {
    line-height: normal;
}
button,
input,
optgroup,
select,
textarea {
    margin: 0;
    font: inherit;
    color: inherit;
}
#search_block_top #topmenu_search_query {
    display: inline;
    padding: 5px 30px 5px 10px;
    height: 30px;
    line-height: 30px;
    background: #fff;
    margin-right: 1px;
    border: 2px solid #a7051a;
    width: 100%;
}
button,
input,
select,
textarea {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
}
#search_block_top .btn.button-search {
    background: none;
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    color: #a7051a;
    width: 34px;
    top: 6px;
    right: 13px;
    text-align: center;
    padding: 4px 0 4px 0;
}
</style>
