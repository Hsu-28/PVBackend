     <template>
  <div class=" layout" >
    <Side :activePage='8'/> 
    <button  class="out" style="width: 42px;height:32px;line-height: 35px;">
     登出
    </button>
    <Layout v-width="900" :style="{marginLeft: '300px'} ">
      <div v-if="showMore==1" >
      <h1>聊天機器人</h1>
      <Button @click="modal1 =true" class="add">新增 +</Button> 
      <!-- <template>
            <Input v-model="value" placeholder="捐款日期" style="width: 150px" />
            <span> -</span>
           
      </template>  -->
      <!-- <Space size="large" wrap >
        <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">日期:</div>
        <DatePicker type="daterange" :options="options2" placement="bottom-end" placeholder="Select date" style="width: 200px" />
      </Space> -->
          <Table class="Table" border :columns="columns" :data="data">
              <template #action="{ row, index }">
                <Button  size="small" style="margin-right: 5px" @click="More()">編輯</Button>
                <Button  size="small" @click="remove(index ,'News')">刪除</Button>
              </template>
          </Table>  
          <Page  class="nextPage" :total="40" size="20" />
      </div>
   

    </Layout>
  </div>

</template> 
<style scoped lang="scss">
@import "~@/assets/sass/page/_Robot.scss";
</style>
<script>
import Side from '@/components/SideNav.vue';

export default {

  data() {
    return {
      showMore:1,
      columns:[
            {
              title: '編號',
              key: 'number',
              width:80

            },      
          
           
            {
              title: '關鍵字',
              key: 'Keyword',
              width:190
            },      
            {
              title: '解答',
              key: 'anwer',

            },    
     
            {
              
              title: '編輯',
              slot: 'action',
              width:150

            },           
        ],
        data:[
            {
              number: 1,
              Keyword: '月球背面探索之旅1',
              anwer: '月球背面探索之旅11121212',
                         
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
    More(){
        this.showMore=2;
      
    },
    reTable(){
        this.showMore=1;
        
    }, 
     removeN (index) {
                this.dataNews.splice(index, 1);
            },

}

}
</script>

