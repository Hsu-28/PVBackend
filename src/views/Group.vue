<template>
  <div class=" layout" >
    <Side :activePage='6'/> 
    <Button to="/" class="out" style="width: 42px;height:32px;line-height: 35px;">
     登出
    </Button>
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
            @on-ok="addgroup"
            ok-text="確認新增"
            @on-cancel="cancel">
            <Form
              :width="500"
              id="addForm"
              :model="addItem"
              :label-width="80"
              enctype="multipart/form-data"
              method="post"  >

              <FormItem label="旅程名稱" prop="precautions" :label-width="45" class="ivu-mb">
                <Select v-model="addItem.title" placeholder="選擇增加旅程">
                  <Option value="1"> &nbsp; 星際繞行</Option>
                  <Option value="2"> &nbsp; 月 球 巡 禮</Option>
                  <Option value="3"> &nbsp; 太空之心 </Option>
                  <Option value="4"> &nbsp; 奧林帕斯山脈之旅</Option>
                  <Option value="5"> &nbsp; 尋找生命之旅</Option>
                  <Option value="6"> &nbsp; 人文遺跡之旅</Option>
                  <Option value="7"> &nbsp; 金星夢幻秘境</Option>
                  
                </Select>
              </FormItem>




              <!-- <FormItem label="名稱:" prop="precautions" :label-width="45" class="ivu-mb">
                <Input v-model="addItem.title" placeholder="選擇增加旅程" ></Input>
              </FormItem> -->
              <Space size="large" rap  class="ivu-mb">
                  <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">訓練起始日期:</div>
                  <DatePicker v-model="addItem.trianing_date" type="date" :options="options2" placement="bottom-end" placeholder="Select date" style="width: 200px" />
              </Space>
              <Space size="large"  rap class="ivu-mb">
                  <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">出發日期:</div>
                  <DatePicker v-model="addItem.date" type="date" :options="options2" placement="bottom-end" placeholder="Select date" style="width: 200px" />
              </Space>

            </Form>
      </Modal>
        
      <!-- <template>
            <Input v-model="value" placeholder="訓練日期" style="width: 150px" />
      </template>  -->

          <Table class="Table" border :columns="columns" :data="myData">
              <template #action="{ row, index }">
                <Button  size="small" style="margin-right: 5px" @click=" tabIndex = index; More(tabIndex)">編輯</Button>
                <Button  size="small" @click="remove()">刪除</Button>
              </template>
          </Table>  
          <Page  class="nextPage" :total="40" size="" />
      </div>

      <!-- 編輯  彈窗區塊 -->
      <div v-if="showMore==2">
        <h1>行程</h1>
        <Form id="FormAll" v-width="700" ref="moreDetail" :model="moreDetail" :rules="ruleValidate" :label-width="80">
            <p style="font-size: 14px;color: #515a6e; padding-bottom: 8px;">編號:{{myData[tabIndex].trip_no}}</p>
            <!-- <FormItem label="名稱:" prop="precautions" :label-width="45">
                <Input v-model="myData[tabIndex].title" placeholder="輸入旅程名稱" ></Input>
            </FormItem> -->

            <FormItem label="旅程名稱" prop="precautions" :label-width="45">
                <Select v-model="myData[tabIndex].planet_subtitle" placeholder="修改旅程名稱">
                  <Option value="1"> &nbsp; 星際繞行</Option>
                  <Option value="2"> &nbsp; 月 球 巡 禮</Option>
                  <Option value="3"> &nbsp; 太空之心</Option>
                  <Option value="4"> &nbsp; 奧林帕斯山脈之旅</Option>
                  <Option value="5"> &nbsp; 尋找生命之旅</Option>
                  <Option value="6"> &nbsp; 人文遺跡之旅</Option>
                  <Option value="7"> &nbsp; 金星夢幻秘境</Option>
                </Select>
              </FormItem>


              <Space size="large"   class="ivu-mb">
                  <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">訓練日期:</div>
                  <DatePicker v-model="myData[tabIndex].training_date" type="date" :options="options2" placement="bottom-end" placeholder="Select date" style="width: 200px" />
              </Space>
                <Space size="large"    class="ivu-mb">
                  <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">出發日期:</div>
                    <DatePicker  type="date" v-model="myData[tabIndex].trip_date"  placement="bottom-end" placeholder="Select date" style="width: 200px" />
                </Space>
              <FormItem   v-width="150"  label="人數上限:" prop="max" :label-width="72">
                  <Input v-model="myData[tabIndex].max_num" placeholder="10" ></Input>
              </FormItem>
              <FormItem   v-width="150"  label="已報名人數:" prop="applicants" :label-width="86">
                  <Input v-model="myData[tabIndex].signup_num" placeholder="0" ></Input>
              </FormItem>
              <FormItem   v-width="170"  label="審核通過人數:" prop="pass" :label-width="100">
                  <Input v-model="myData[tabIndex].pass" placeholder="0" ></Input>
              </FormItem>
              <FormItem   v-width="150"  label="候補人數:" prop="wait" :label-width="72">
                  <Input v-model="myData[tabIndex].waiting_people" placeholder="0" ></Input>
              </FormItem> 
              <!-- <FormItem   v-width="150"  label="出團狀態:" prop="max" :label-width="72" class="ivu-mb">
                  <Input v-model="myData[tabIndex].state" placeholder="" ></Input>
              </FormItem> -->
            <FormItem v-width="700">
                <Button  size="small" style="margin-right: 5px; float: right;" @click="reTable()">返回</Button>
                <Button  size="small" style="margin-right: 5px;  float: right;" @click=" editgroup(tabIndex)">確定</Button>
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
          }],
  }
},
  components: {
    Side
    
    },
    methods:{
    
    More(tabIndex   ){
      this.showMore = 2;
      console.log(this.myData[tabIndex].trip_no)
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
  //  清空資料
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
    addgroup() {

      const addjourney = new FormData()
      const tdate = new Date(this.addItem.trianing_date)
      const gdate = new Date(this.addItem.date)
      const tripno = this.addItem.title
      addjourney.append('itinerary_no',tripno );
      addjourney.append('training_date', `${tdate.getFullYear()}-${tdate.getMonth() + 1}-${tdate.getDate()}`);
      addjourney.append('trip_date', `${gdate.getFullYear()}-${gdate.getMonth() + 1}-${gdate.getDate()}`);

      axios.post('http://localhost/PV/PVBackend/public/php/GroupAdd.php',  addjourney )
        .then(response => {
          console.log(response)
        })
        .catch(error => {
          console.error(error);
        });
    },
    editgroup(tabIndex) {
        this.showMore=1;
        const editjourney = new FormData()
        // const tdate = new Date(this.addItem.trianing_date)
        // const gdate = new Date(this.addItem.date)
        // const pass = myData[tabIndex].pass
        // const waiting_people = myData[tabIndex].wait
        // const signup_num = myData[tabIndex].applicants
        // const max_num = myData[tabIndex].max_num
        // const tripno = myData[tabIndex].title


        // this.editjourney
        // this.tdate
        // this.gdate
        // this.pass
        // this.waiting_people
        // this.signup_num
        // this.max_num
        // this.tripno




        editjourney.append('trip_no',this.myData[tabIndex].trip_no);
        editjourney.append('itinerary_no',this.myData[tabIndex].itinerary_no);
        editjourney.append('training_date', this.myData[tabIndex].training_date);
        editjourney.append('trip_date', this.myData[tabIndex].trip_date);
        editjourney.append('pass',this.myData[tabIndex].pass );
        editjourney.append('waiting_people',this.myData[tabIndex].waiting_people );
        editjourney.append('signup_num',this.myData[tabIndex].signup_num );
        editjourney.append('max_num',10);

        axios.post('http://localhost/PV/PVBackend/public/php/Groupedit.php', editjourney, {
    headers: {
      'Content-Type': 'multipart/form-data' // Use 'multipart/form-data' for FormData
    }
  })
          .then(response => {
            console.log(response)
          })
          .catch(error => {
            console.error(error);
          });
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