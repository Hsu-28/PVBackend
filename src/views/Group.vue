<template>
  <div class=" layout" >
    <Side :activePage='6'/> 
    <button  class="out" style="width: 42px;height:32px;line-height: 35px;">
     登出
    </button>
    <Layout v-width="900" :style="{marginLeft: '300px'} ">
      <div v-if="showMore==1" >
      <h1>旅行團</h1>
      <Button @click="modal1 =true" class="add ivu-mb">新增 +</Button> 
      <!-- 彈窗 -->
      <Modal
            title="新增旅行團"
            v-model="modal1"
            width="700px"
            :closable="true"
            @on-ok="ok"
            @on-cancel="cancel">
            <Form
              :width="500"
              id="addForm"
              :model="addItem"
              :label-width="80"
              enctype="multipart/form-data"
              method="post"  >
              <FormItem label="名稱:" prop="precautions" :label-width="45" class="ivu-mb">
                <Input v-model="moreDetail.precautions" placeholder="aa" ></Input>
              </FormItem>
              <Space size="large" rap  class="ivu-mb">
                  <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">訓練起始日期:</div>
                  <DatePicker v-model="addItem.trianing_date" type="date" :options="options2" placement="bottom-end" placeholder="Select date" style="width: 200px" />
              </Space>
              <Space size="large"  rap class="ivu-mb">
                  <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">出發日期:</div>
                  <DatePicker v-model="addItem.date" type="date" :options="options2" placement="bottom-end" placeholder="Select date" style="width: 200px" />
              </Space>
              <FormItem   v-width="150"  label="人數上限:" prop="max" :label-width="72" class="ivu-mb">
                  <Input v-model="addItem.max" placeholder="aa" ></Input>
              </FormItem>
              <FormItem   v-width="150"  label="已報名人數:" prop="max" :label-width="86" class="ivu-mb">
                  <Input v-model="addItem.applicants" placeholder="aa" ></Input>
              </FormItem>
              <FormItem   v-width="150"  label="候補人數:" prop="max" :label-width="72" class="ivu-mb">
                  <Input v-model="addItem.wait" placeholder="aa" ></Input>
              </FormItem> 
<!--               
              <template>
                    <Input v-model="value" placeholder="出發日期" style="width: 150px" />
                     <span> -</span>
                    <Input v-model="value" placeholder="回程日期" style="width: 150px" /> 
              </template>  -->
            </Form>
        </Modal>
        
      <!-- <template>
            <Input v-model="value" placeholder="訓練日期" style="width: 150px" />
      </template>  -->

          <Table class="Table" border :columns="columns" :data="data">
              <template #action="{ row, index }">
                <Button  size="small" style="margin-right: 5px" @click="More()">編輯</Button>
                <Button  size="small" @click="remove(index)">刪除</Button>
              </template>
          </Table>  
          <Page  class="nextPage" :total="40" size="" />
      </div>
      <div v-if="showMore==2">
        <h1>行程</h1>
        <Form id="FormAll" v-width="700" ref="moreDetail" :model="moreDetail" :rules="ruleValidate" :label-width="80">
            <p style="font-size: 14px;color: #515a6e; padding-bottom: 8px;">編號:{{ moreDetail.number }}</p>
            <FormItem label="名稱:" prop="precautions" :label-width="45">
                <Input v-model="moreDetail.precautions" placeholder="aa" ></Input>
            </FormItem>
              <Space size="large"   class="ivu-mb">
                  <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">訓練起始日期:</div>
                  <DatePicker v-model="addItem.trianing_date" type="date" :options="options2" placement="bottom-end" placeholder="Select date" style="width: 200px" />
              </Space>
                <Space size="large"    class="ivu-mb">
                  <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">出發日期:</div>
                    <DatePicker  type="date" v-model="moreDetail.date"  placement="bottom-end" placeholder="Select date" style="width: 200px" />
                </Space>
              <FormItem   v-width="150"  label="人數上限:" prop="max" :label-width="72">
                  <Input v-model="moreDetail.max" placeholder="aa" ></Input>
              </FormItem>
              <FormItem   v-width="150"  label="已報名人數:" prop="applicants" :label-width="86">
                  <Input v-model="moreDetail.applicants" placeholder="aa" ></Input>
              </FormItem>
              <FormItem   v-width="150"  label="候補人數:" prop="wait" :label-width="72">
                  <Input v-model="moreDetail.wait" placeholder="aa" ></Input>
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
@import "~@/assets/sass/page/_Group.scss";
</style>

<script>
import Side from '@/components/SideNav.vue';

export default {

  data() {
    return {
      showMore:1,
      modal1: false,//新增彈窗預設關閉
      columns:[
            {
              title: '旅程編號',
              key: 'number',
            },      
          
            {
              title: '名稱',
              key: 'title',
              width: 160
            },  
            {
              title: '訓練起始日期',
              key: 'trianing_date',
              width: 100
            },          
            {
              title: '出發日期',
              key: 'date',
              width: 110
            },      
            {
              title: '報名人數',
              key: 'applicants',
              width: 100

            },      
            {
              title: '審核通過人數',
              key: 'pass',
              width: 100

            },      
            {
              title: '候補人數',
              key: 'wait',
              width: 100

            },      
            {
              title: '狀態',
              key: 'state',
              width: 90

            },      
            {
              title: '編輯',
              slot: 'action',
              width: 150
            },           
        ],
        data:[
            {
              number: 1,
              
              title: '月球背面探索之旅1',
              trianing_date:'1117/11/02',
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
            trianing_date:'1117/11/02',
            daytrain:'1117/12/06',


          },
          addItem:{
            number:'',  
            numberProcess: '',
            date: '',
            max :'',
            applicants:'',
            wait:'',
            trianing_date:'',
            daytrain:'',

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
     remove (index) {
                this.data.splice(index, 1);
    },
    ok () {
                this.$Message.info('新增成功');
    },

}

}
</script>