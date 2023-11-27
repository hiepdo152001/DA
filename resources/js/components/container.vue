<template>
	
    
	
    
    <div class="d-none" style="position: absolute;">
        
    </div>
</template>
<style src="../assets/style.css"></style>

<script>
import { ref,reactive} from "vue";
  import { Bootstrap5Pagination } from "laravel-vue-pagination";
  import axios from "axios";
  export default {
    name:'products',
    data(){
        const products=ref([]);
		const input = reactive({
        search: ""
    })
        return{
            products,
			input
        }
    },
    components:{
      Bootstrap5Pagination
    },
    mounted(){
      axios.get('http://localhost:8000/api/alls?page=1').then(response =>{
        this.products=response.data[0];
      });
      },
    methods:{
    	formatCurrency(value) {
			return parseFloat(value).toLocaleString('vi-VN', {
				style: 'currency',
				currency: 'VND'
			});
			},
      	get(page=1){
              axios.get(`http://localhost:8000/api/alls?page=${page}`).then(response=>{
              this.products=response.data[0];
            });
    	},
		SearchProducts(page =1){
			axios.get(`http://localhost:8000/api/alls?page=${page}`,
			{params: { search: this.input.search }}
			).then(response=>{
		console.log(response);
				
				this.products=response.data[0];
			});
		}
  }
  }
</script>
<style>
/*sanpham*/
#sanpham:hover {
  margin: 5px;
  box-shadow: 0 4px 8px 0 black, 0 6px 20px 0 black;
  text-align: center;
}
.page-item.pagination-page-nav.active .page-link{
  background-color: #d63384!important; /* Thay đổi màu nền thành màu mong muốn */
  color: #fff; /* Thay đổi màu chữ thành màu mong muốn */
  /* Các thuộc tính khác nếu cần */
}

/*san pham*/


</style>
