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
      <template>
            <Input v-model="value" placeholder="捐款日期" style="width: 150px" />
            <span> -</span>
            <Input v-model="value" placeholder="回程日期" style="width: 150px" />
      </template> 
          <Table class="Table" border :columns="columns" :data="data">
              <template #action="{ row, index }">
                <Button  size="small" style="margin-right: 5px" @click="More()">編輯</Button>
                <Button  size="small" @click="remove(index ,'News')">刪除</Button>
              </template>
          </Table>  
          <Page  class="nextPage" :total="40" size="" />
      </div>
      <div v-if="showMore==2">
        <h1>行程</h1>
        <Form id="FormAll" v-width="700" ref="moreDetail" :model="moreDetail" :rules="ruleValidate" :label-width="80">
        <p style="font-size: 14px;color: #515a6e; padding-bottom: 8px;">編號:{{ moreDetail.number }}</p>
        <FormItem label="名稱:" prop="precautions">
            <Input v-model="moreDetail.precautions" placeholder="aa" ></Input>
        </FormItem>
          <FormItem   v-width="150"  label="人數上限:" prop="max">
              <Input v-model="moreDetail.max" placeholder="aa" ></Input>
          </FormItem>
          <FormItem   v-width="150"  label="已報名人數:" prop="max">
              <Input v-model="moreDetail.max" placeholder="aa" ></Input>
          </FormItem>
          <FormItem   v-width="150"  label="候補人數:" prop="max">
              <Input v-model="moreDetail.max" placeholder="aa" ></Input>
          </FormItem>
      
      
        <FormItem v-width="700">
            <Button  size="small" style="margin-right: 5px; float: right;" @click="reTable()">返回</Button>
            <Button  size="small" style="margin-right: 5px;  float: right;" @click="reTable()">確定</Button>
        </FormItem>
        </Form>
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
              title: '旅程編號',
              key: 'number',
              width:80
            },      
          
            {
              title: '名稱',
              key: 'title'
            },      
            {
              title: '出發日期',
              key: 'date'
            },      
            {
              title: '報名人數',
              key: 'applicants',
              width: 80

            },      
            {
              title: '審核通過人數',
              key: 'pass',
              width: 80

            },      
            {
              title: '候補人數',
              key: 'wait',
              width: 80

            },      
            {
              title: '狀態',
              key: 'state'
            },      
            {
              title: '編輯',
              slot: 'action',
            },           
        ],
        data:[
            {
              number: 1,
              
              title: '月球背面探索之旅1',
              date: '2022/01/21',
              applicants: '8/8',
              pass: '7/8',
              wait: '5',
              state : '成團',             
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
