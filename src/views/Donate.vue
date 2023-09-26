  <template>
  <div class=" layout" >
    <Side :activePage='7'/> 
    <button  class="out" style="width: 42px;height:32px;line-height: 35px;">
     登出
    </button>
    <Layout v-width="900" :style="{marginLeft: '300px'} ">
      <div v-if="showMore==1" >
      <h1>捐款</h1>
      <!-- <Button @click="modal1 =true" class="add">新增 +</Button>  -->
      <Space  style="margin-bottom: 10px;" >
        會員編號:
            <Input v-model="value" placeholder="會員編號" style="width: 150px" />           
      </Space> 
      <br>
      <Space size="large" style="gap :10px"  >
        <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">日期:</div>

        <DatePicker type="daterange" :options="options2" placement="bottom-end" placeholder="Select date" style="width: 200px" />
      </Space>
          <Table class="Table" border :columns="columns" :data="data">
              <!-- <template #action="{ row, index }">
                <Button  size="small" style="margin-right: 5px" @click="More()">編輯</Button>
                <Button  size="small" @click="remove(index ,'News')">刪除</Button>
              </template> -->
          </Table>  
          <Page  class="nextPage" :total="40" size="20" />
      </div>
   

    </Layout>
  </div>

</template>
<style scoped lang="scss">
@import "~@/assets/sass/page/_Donate.scss";
</style>
<script>
import Side from '@/components/SideNav.vue';

export default {

  data() {
    return {
      showMore:1,
      columns:[
            {
              title: '捐獻編號',
              key: 'number',
            },      
          
           
            {
              title: '捐獻日期',
              key: 'date'
            },      
            {
              title: '捐獻金額',
              key: 'money',

            },    
            {
              title: '會員編號',
              key: 'numberMem'
            },        
            {
              title: '電子郵件',
              key: 'email',

            },      
         
            {
              title: '捐款狀態',
              key: 'state'
            },      
            // {
            //   title: '編輯',
            //   slot: 'action',
            // },           
        ],
        data:[
            {
              number: 1,
              
              title: '月球背面探索之旅1',
              date: '2022/01/21',
              money: '8888',
              numberMem: '711',
              email: '5444@gmail.com',
              state : '????',             
            },
         
        ],
        moreDetail:{
            number:'1',  
            numberProcess: '67',
            date: '1113/65/26',
            max :'11',
            applicants:'8/8',
            wait:'6',
            daytrain:'1117/12/06',

          },
  }
},
  components: {
    Side
    },
    methods:{
    // More(){
    //     this.showMore=2;
      
    // },
    // reTable(){
    //     this.showMore=1;
        
    // }, 
    //  removeN (index) {
    //             this.dataNews.splice(index, 1);
    //         },

}

}
</script>
