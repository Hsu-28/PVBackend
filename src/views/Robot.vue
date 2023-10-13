     <template>
  <div class=" layout" >
    <Side :activePage='8'/> 
    <button  class="out" style="width: 42px;height:32px;line-height: 35px;">
     登出
    </button>
    <Layout v-width="900" :style="{marginLeft: '300px'} ">
      <div v-if="showMore==1" >
      <h1>聊天機器人</h1>
      <Button @click="modal1Robot =true" class="add">新增 +</Button> 
            <!-- 彈窗 -->
            <Modal
                  title="新增聊天機器人"
                  v-model="modal1Robot"
                  width="700px"
                  :closable="true">
                  <Form
                    :model="addRobot"
                    :label-width="80"
                    enctype="multipart/form-data"
                    method="post"  >
                    <FormItem label="關鍵字:" prop="Keyword" :label-width="70" class="ivu-mb"  v-width="300">
                      <Input v-model="addRobot.Keyword" placeholder="關鍵字" ></Input>
                    </FormItem>
                    <FormItem    label="答案:" prop="anwer" :label-width="70" class="ivu-mb">
                      <Input v-model="addRobot.anwer" type="textarea" :autosize="{minRows: 5,maxRows: 5}" placeholder="內容"></Input>
                    </FormItem> 
                  </Form>
              </Modal> 
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
                <Button  size="small" style="margin-right: 5px" @click="clickRtEdit(index)">編輯</Button>
                <Modal
                      title="編輯問題資訊"
                      ok-text="確認修改"
                      cancel-text="取消"
                      v-model="RTEdit[index]"
                      width="700px"
                      :closable="true"
                      @on-ok="ok"
                      @on-cancel="cancel">
                      <Form
                        :model="addRobot"
                        :label-width="80"
                        enctype="multipart/form-data"
                        method="post"  >
                      
                        <FormItem label="編號:" :label-width="75">
                              <text>{{ addRobot.number }}</text>
                        </FormItem>
                        <FormItem label="問題標題:" prop="Keyword" :label-width="75" class="ivu-mb"  v-width="300">
                          <Input v-model="addRobot.Keyword" placeholder="標題" ></Input>
                        </FormItem>
                        <FormItem    label="問題答案:" prop="anwer" :label-width="75" class="ivu-mb">
                          <Input v-model="addRobot.anwer" type="textarea" :autosize="{minRows: 5,maxRows: 5}" placeholder="內容"></Input>
                        </FormItem> 
                      </Form>
                   </Modal>
                
                
                
                <Button  size="small" @click="remove(index)">刪除</Button>
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
      modal1Robot:false,
      RTEdit:[],
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
        addRobot:{
            number:null,
            Keyword:'',
            anwer:'',  
          },
  }
},
  components: {
    Side
    },
    methods:{

      clickRtEdit(index){
                this.RTEdit[index] = true;
                this.addRobot = { ...this.data[index] };
            },
    More(){
        this.showMore=2;
      
    },
    reTable(){
        this.showMore=1;
        
    }, 
     remove (index) {
                this.data.splice(index, 1);
            },

}

}
</script>

