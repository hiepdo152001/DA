<template>
    <div id="center_column" class="col-md-9">
            <!--thongnv slide main top-->
<div class="pb-left-column d-flex  col-xs-12 col-sm-8 col-md-8" style="flex-direction: column;">
    <div id="image-block" class="clearfix">
                <img  itemprop="image" :src="product.avatar"  style="width: 400px;height: 400px;margin-top: 27px;">
    </div>
    <div>
    <ul class="d-flex" style="margin-top: 20px; padding-left: 0xp!important;">
      <li v-for="index in 4" :key="index">
        <img  v-if="`http://localhost:9000/mybucket/product/detail/${product.id}/${index-1}avatar.jpg`"
              :src="`http://localhost:9000/mybucket/product/detail/${product.id}/${index-1}avatar.jpg`" style="border: 1px solid black;width: 80px;margin-right: 20px;">
      </li>
    </ul>
  </div>    
</div>

<div class="pb-center-column col-xs-12 col-sm-4 col-md-4">
    <h1 class="centertitle_block" style="text-align:left">Tên sp: <span>{{ product.name }}</span></h1>
    <div class="block_content clearfix">
                <p>
        </p><div class="fl">Giá:&nbsp;&nbsp;</div> <div class="fl"><span class="discounts_money">{{ product.price }}</span>
            </div><div class="clearfix"></div>
        <p></p>
        
        <div class="other">Miêu tả :</div>
         
                <div class="other"><span>{{ product.description }}</span></div>
        
        <div class="size">
            Size:&nbsp;
            <span name="37">37,</span>
            
            <span name="38">38,</span>
            
            <span name="39">39,</span>
            
            <span name="40">40,</span>
            
            <span name="41">41,</span>
            
            <span name="42">42,</span>
            
            <span name="43">43,</span>
            
            <input type="hidden" name="showsize" id="showsize" value="no-size">
        </div><br>

        <div class="other"><a href="http://giaycaochonam.com/images/size-giay.png" title="Hướng dẫn đo size" rel="shadowbox[miss]"><img class="logo-s" src="http://giaycaochonam.com/uploads/tmen-size.png" style="width:85px;"><span class="zoom_img"> xem Bảng tính size giày</span></a></div>        

        
        <div class="box-info-product">
                        <div class="box-cart-bottom">
                <p id="quantity_wanted_p" class="buttons_bottom_block no-print" style="display:none">
                    <span class="fl" style="line-height:22px;">Đặt hàng : &nbsp;</span> 
                    <input type="text" name="num" id="pnum" class="text" value="1" style="border: 1px solid rgb(189, 194, 201);">
                </p>
                <div class="clearfix"></div><br>
                <a href="javascript:void(0)" id="148" title="" class="exclusive-new" onclick="cartorder_detail(this)">
                    <span>
                        <div class="add-product-name">Đặt hàng mẫu này 🛍️</div>
                        <div class="add-product-note">(Không ưng trả lại - Không mất tiền)</div>
                    </span>
                </a>
            </div><br>
            
            
            <a href="tel:0941610000" class="call_button-bk detail-call_button">
                <div class="add-product-name">Call/Zalo</div>
                <div class="add-product-note">(Chăm sóc Khách hàng: 094-161-0000)</div>
            </a>    
        </div>
        <!--<div class="fb-like" data-action='like' data-layout='button_count' data-share='true' data-show-faces='false' ></div>-->
        <div>
</div>
    </div>
</div>
<div class="small_show" id=""> <hr color="grey"> <table cellpadding="0" cellspacing="0" class="style1" style="width: 100%"> <tbody> <tr> <td align="center" width="18%"> <img alt="" src="http://giaycaochonam.com/uploads/free-ship-icon-black.png" style="height: 40px; width: 40px;"></td> <td> <span style="color:rgb(0, 0, 0);">MIỄN PHÍ GIAO HÀNG TOÀN QUỐC<br> <em>(Ship hàng siêu tốc sau 1 đến 3 ngày)</em></span></td> </tr> </tbody> </table> <hr color="grey"> <table cellpadding="0" cellspacing="0" class="style1" style="width: 100%"> <tbody> <tr> <td align="center" width="18%"> <img alt="" src="http://giaycaochonam.com/uploads/like-icon-black.png" style="height: 40px; width: 40px;"></td> <td> <span style="color:rgb(0, 0, 0);">ĐƯỢC KIỂM TRA &amp; ĐI THỬ KHI MUA ONLINE<br> <em>(Không ưng trả lại ngay - Không mất tiền)</em></span></td> </tr> </tbody> </table> <hr color="grey"> <table cellpadding="0" cellspacing="0" class="style1" style="width: 100%"> <tbody> <tr> <td align="center" width="18%"> <img alt="" src="http://giaycaochonam.com/uploads/warranty-icon-black.png" style="width: 40px; height: 40px;"></td> <td> <span style="color:rgb(0, 0, 0);">BẢO HÀNH 12 THÁNG 1 ĐỔI 1<br> <em>(Cam kết chất lượng sản phẩm vượt trội)</em></span></td> </tr> </tbody> </table> <hr color="grey"></div>
<!--minhkhoa810 freeship desktop detail-->
<div class="small_hide">
    <table cellpadding="2px" style="width:100%; background-color: rgb(247, 247, 247);">
		<tbody>
			<tr>
				<td>
					<hr color="grey"></td>
			</tr>
		</tbody>
	</table>
	<table cellpadding="2px" style="width:100%; background-color: rgb(247, 247, 247);">
		<tbody>
			<tr>
				<td align="center" width="10%">
					<img class="logo-s" src="http://giaycaochonam.com/uploads/free-ship-icon-black.png" style="width:60px;"></td>
				<td width="22%">
					<span style="color: Black; font-size: 13px">FREESHIP TOÀN QUỐC</span></td>
				<td align="center" width="10%">
					<img class="logo-s" src="http://giaycaochonam.com/uploads/like-icon-black.png" style="width:60px;"></td>
				<td width="24%">
					<span style="color: Black; font-size: 13px">ĐƯỢC KIỂM TRA &amp; ĐI THỬ GIÀY</span></td>
				<td align="center" width="10%">
					<img class="logo-s" src="http://giaycaochonam.com/uploads/warranty-icon-black.png" style="width:60px;"></td>
				<td width="24%">
					<span style="color: Black; font-size: 13px">BẢO HÀNH 12 THÁNG 1 ĐỔI 1</span></td>
			</tr>
		</tbody>
	</table>
</div>
<hr>

            
        </div>
</template>
<script>
  import { ref} from "vue";
  import axios from "axios";
  import { useRouter } from "vue-router";

export default {
  name:"view-product",
  data(){
      const product=ref([]);
      const router = useRouter();

      const id = router.currentRoute.value.params.id;
      return {
          product,
          id
         
      }
  },
  mounted(){
      try {
          if(this.id){
              axios.get(`http://localhost:8000/api/product/by/${this.id}`)
              .then(response=>{
                  this.product=response.data.data;
                  console.log(this.product);
              });
          }
      } catch (error) {
          alert(error);
      }
  }
 
};
</script>