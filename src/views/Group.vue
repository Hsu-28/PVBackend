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
      <!-- 新增旅行團彈窗 -->
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
                <Input v-model="addItem.title" placeholder="輸入旅程名稱" ></Input>
              </FormItem>
              <Space size="large" rap  class="ivu-mb">
                  <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">訓練起始日期:</div>
                  <DatePicker v-model="addItem.trianing_date" type="date" :options="options2" placement="bottom-end" placeholder="Select date" style="width: 200px" />
              </Space>
              <Space size="large"  rap class="ivu-mb">
                  <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">出發日期:</div>
                  <DatePicker v-model="addItem.date" type="date" :options="options2" placement="bottom-end" placeholder="Select date" style="width: 200px" />
              </Space>
              <!-- <FormItem   v-width="150"  label="人數上限:" prop="max" :label-width="72" class="ivu-mb">
                  <Input v-model="addItem.max" placeholder="10" ></Input>
              </FormItem>
              <FormItem   v-width="150"  label="已報名人數:" prop="max" :label-width="86" class="ivu-mb">
                  <Input v-model="addItem.applicants" placeholder="0" ></Input>
              </FormItem>
              <FormItem   v-width="150"  label="出團狀態:" prop="max" :label-width="72" class="ivu-mb">
                  <Input v-model="addItem.applicants" placeholder="0" ></Input>
              </FormItem>
              <FormItem   v-width="150"  label="候補人數:" prop="max" :label-width="72" class="ivu-mb">
                  <Input v-model="addItem.wait" placeholder="0" ></Input>
              </FormItem>  -->
            </Form>
      </Modal>
        
      <!-- <template>
            <Input v-model="value" placeholder="訓練日期" style="width: 150px" />
      </template>  -->

          <Table class="Table" border :columns="columns" :data="myData">
              <template #action="{ row, index }">
                <Button  size="small" style="margin-right: 5px" @click=" tabIndex = index; More()">編輯</Button>
                <Button  size="small" @click="remove()">刪除</Button>
              </template>
          </Table>  
          <Page  class="nextPage" :total="40" size="" />
      </div>

      <!-- 編輯  彈窗區塊 -->
      <div v-if="showMore==2">
        <h1>行程</h1>
        <Form id="FormAll" v-width="700" ref="moreDetail" :model="moreDetail" :rules="ruleValidate" :label-width="80">
            <p style="font-size: 14px;color: #515a6e; padding-bottom: 8px;">編號:{{index}}</p>
            <FormItem label="名稱:" prop="precautions" :label-width="45">
                <Input v-model="myData[tabIndex].title" placeholder="輸入旅程名稱" ></Input>
            </FormItem>
              <Space size="large"   class="ivu-mb">
                  <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">訓練日期:</div>
                  <DatePicker v-model="myData[tabIndex].trianing_date" type="date" :options="options2" placement="bottom-end" placeholder="Select date" style="width: 200px" />
              </Space>
                <Space size="large"    class="ivu-mb">
                  <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">出發日期:</div>
                    <DatePicker  type="date" v-model="myData[tabIndex].date"  placement="bottom-end" placeholder="Select date" style="width: 200px" />
                </Space>
              <FormItem   v-width="150"  label="人數上限:" prop="max" :label-width="72">
                  <Input v-model="myData[tabIndex].max_num" placeholder="10" ></Input>
              </FormItem>
              <FormItem   v-width="150"  label="已報名人數:" prop="applicants" :label-width="86">
                  <Input v-model="myData[tabIndex].applicants" placeholder="0" ></Input>
              </FormItem>
              <FormItem   v-width="170"  label="審核通過人數:" prop="pass" :label-width="100">
                  <Input v-model="myData[tabIndex].pass" placeholder="0" ></Input>
              </FormItem>
              <FormItem   v-width="150"  label="候補人數:" prop="wait" :label-width="72">
                  <Input v-model="myData[tabIndex].wait" placeholder="0" ></Input>
              </FormItem> 
              <FormItem   v-width="150"  label="出團狀態:" prop="max" :label-width="72" class="ivu-mb">
                  <Input v-model="myData[tabIndex].state" placeholder="" ></Input>
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
import axios from 'axios';
export default {

  data() {
    return {
      dindex: 0,
      showMore:1,
      modal1: false,//新增彈窗預設關閉
      columns:[
            {
              title: '旅程編號',
              key: 'trip_no',
            },      
          
            {
              title: '名稱',
              key: 'planet_subtitle',
              width: 160
            },  
            {
              title: '訓練日期',
              key: 'training_date',
              width: 110
            },          
            {
              title: '出發日期',
              key: 'trip_date',
              width: 110
            },      
            {
              title: '報名人數',
              key: 'signup_num',
              width: 96

            },      
            {
              title: '審核通過人數',
              key: 'pass',
              width: 130

            },      
            {
              title: '候補人數',
              key: 'waiting_people',
              width: 96

            },      
            // {
            //   title: '出團狀態',
            //   key: 'state',
            //   width: 96

            // },      
            {
              title: '編輯',
              slot: 'action',
              width: 130
            },           
        ],
        myData:[
             
            {
              number: 1, //trip_no
              title: '月球背面探索之旅1',  //name
              trianing_date:'1117/11/02',//training_date
              date: '2022/01/21',//trip_date
              applicants: '8/8',//signup_num
              pass: '7/8',//pass
              wait: '5',//waiting_people
              state : '成團',//none
              max_num: '10',//max_num 
     
            },
            {
              number: 2,
              title: '月球背面探索之旅2',
              trianing_date:'1117/11/02',
              date: '202/01/21',
              applicants: '8/8',
              pass: '8',
              wait: '',
              state : '成團', 
              max_num: '10',//max_num             
            },
            
        ],
          addItem:[{
            number:'',  
            title: '',
            date: '',
            max :'',
            applicants:'',
            wait:'',
            trianing_date:'',
            daytrain:'',
            //   number: 1, //trip_no
            //   title: '月球背面探索之旅1',  //name
            //   trianing_date:'1117/11/02',//training_date
            //   date: '2022/01/21',//trip_date
            //   applicants: '8/8',//signup_num
            //   pass: '7/8',//pass
            //   wait: '5',//waiting_people
            //   state : '成團',//none   
          }],
  }
},
  components: {
    Side
    },
    methods:{
      
    More(){
      this.showMore = 2;

    },
    reTable(){
        this.showMore=1;
        
    }, 
     remove (index) {
                this.data.splice(index, 1);
    },
    ok () {
          this.$Message.info('新增成功');
          const newItem = {
          number: this.addItem.index,
          title: this.addItem.title,
          trianing_date: this.addItem.trianing_date,
          date: this.addItem.date,
          applicants: this.addItem.applicants,
          pass: this.addItem.pass,
          wait: this.addItem.wait,
          state: this.addItem.state,
  };
  this.myData.push(newItem);
  // 清空表单字段以准备输入下一个项目
  this.addItem = {
    number: '',
    title: '',
    trianing_date: '',
    date: '',
    applicants: '',
    pass: '',
    wait: '',
    state: '',
  };
    },

},
created() {
        // 發起HTTP GET 請求
        axios.get('http://localhost/PV/PVBackend/public/php/Group.php')
            .then(response => {
                this.myData = response.data;
            })
            .catch(error => {
                console.error(error);
            });
    }

}
</script>