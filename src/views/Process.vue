<template>
   <div class=" layout" >
    <Side :activePage='4'/> 
    <button  class="out" style="width: 42px;height:32px;line-height: 35px;">
     登出
    </button>
    <Layout v-width="900" :style="{marginLeft: '300px'} ">
      <div v-if="showMore==1" >
      <h1>行程介紹</h1>
      <Button @click="modalProcess =true" class="add">新增 +</Button>
        <Modal
                  title="新增團隊"
                  v-model="modalProcess"
                  width="700px"
                  :closable="true">
                <Form
                    :model="moreDetail"
                    :label-width="80"
                    enctype="multipart/form-data"
                    method="post"  >
                  <FormItem label="地點:" prop="precautions" :label-width="47">
                   <Input v-model="moreDetail.precautions" placeholder="aa" ></Input>
                  </FormItem>
            <FormItem  :label-width="60" label="標題" prop="title">
                <Select v-model="moreDetail.title" >
                    <Option value="qqq">繞行</Option>
                    <Option value="moon">月球</Option>
                    <Option value="fire">火星</Option>
                    <Option value="ggg">金星</Option>
                </Select>
            </FormItem>
            <FormItem label="小標題:" prop="smTitle" :label-width="58">
                <Input v-model="moreDetail.smTitle" placeholder="aa" ></Input>
            </FormItem>
          
            <FormItem   :label-width="73"  label="行程簡介:" prop="max">
              
                <Input v-model="moreDetail.summary" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem>
              <!-- <FormItem     label="注意事項:" prop="max">
                  <Input v-model="moreDetail.precautions" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem> -->
              <div style="font-size: 18px;color: #515a6e; padding-left: 2px;padding-bottom: 10px;">行程內容</div>
              <FormItem     label="日程標題1:" prop="max">
                <Input v-model="moreDetail.day1Title" placeholder="aa" ></Input>          
              </FormItem>
              <FormItem label="照片1" prop="img1" :label-width="50">
                <input  type="file" multiple />
              </FormItem>
              <FormItem     label="日程內容1:" prop="max">
                  <Input v-model="moreDetail.day1Text" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem>
              <FormItem     label="日程標題2:" prop="max">
                <Input v-model="moreDetail.day2Title" placeholder="aa" ></Input>          
              </FormItem>
              <FormItem label="照片2" prop="img1" :label-width="50">
                <input  type="file" multiple />
              </FormItem>
              <FormItem     label="日程內容2:" prop="max">
                  <Input v-model="moreDetail.day3Title" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem>
              <FormItem     label="日程標題3:" prop="max">
                <Input v-model="moreDetail.day3Title" placeholder="aa" ></Input>          
              </FormItem>
              <FormItem label="照片3" prop="img1" :label-width="50">
                <input  type="file" multiple />
              </FormItem>
              <FormItem     label="日程內容3:" prop="max">
                  <Input v-model="moreDetail.day2Title" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem>
              <FormItem     label="日程標題4:" prop="max">
                <Input v-model="moreDetail.day4Title" placeholder="aa" ></Input>          
              </FormItem>
              <FormItem label="照片4" prop="img4" :label-width="40">
                <input  type="file" multiple />
              </FormItem>
              <FormItem     label="日程內容4:" prop="max">
                  <Input v-model="moreDetail.day4Title" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem>
              <FormItem     label="日程標題5:" prop="max">
                <Input v-model="moreDetail.day5Title" placeholder="aa" ></Input>          
              </FormItem>
              <FormItem label="照片5" prop="img5" :label-width="50">
                <input  type="file" multiple />
              </FormItem>
              <FormItem     label="日程內容5:" prop="max">
                  <Input v-model="moreDetail.day5Title" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem>
              <FormItem     label="日程標題6:" prop="max">
                <Input v-model="moreDetail.day6Title" placeholder="aa" ></Input>          
              </FormItem>
              <FormItem label="照片6" prop="img6" :label-width="50">
                <input  type="file" multiple />
              </FormItem>
              <FormItem     label="日程內容6:" prop="max">
                  <Input v-model="moreDetail.day6Title" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem>
           </Form>
          </Modal>
      

          <Table class="Table" border :columns="columns" :data="data">
                  <template #action="{ row, index }">
                  
                    <Button  size="small" style="margin-right: 5px" @click="Memindex = index;More()">編輯</Button>
                   <Button  size="small" @click="remove(index)">刪除</Button>
                  </template>
          </Table>  
      </div>
      <div class="showAll" v-if="showMore==2">
        <h1>行程</h1>
        <Form id="FormAll" v-width="700" ref="moreDetail" :model="moreDetail" :rules="ruleValidate" :label-width="80">
        <p style="font-size: 14px;color: #515a6e; padding-bottom: 8px;">編號:{{ data[Memindex].itinerary_no }}</p>
        <FormItem label="星球名稱:" prop="precautions" :label-width="47" placeholder="aa">
            <Input v-model="data[Memindex].content_title"  ></Input>
        </FormItem>
        <FormItem  :label-width="60" label="名稱" placeholder="輸入名稱" prop="title">
            <Select v-model="data[Memindex].planet_name" >
                <Option value="繞行">繞行</Option>
                <Option value="月球">月球</Option>
                <Option value="火星">火星</Option>
                <Option value="金星">金星</Option>
            </Select>
        </FormItem>
        <FormItem label="小標題:" prop="smTitle" :label-width="58">
            <Input v-model="data[Memindex].planet_subtitle" placeholder="小標題" ></Input>
        </FormItem>
        <!-- <div style="display: flex;">
          <FormItem  v-width="120" label="人數下限:" prop="min">
              <Input v-model="moreDetail.min" placeholder="aa" ></Input>
          </FormItem>
          <FormItem   v-width="120"  label="人數上限:" prop="max">
              <Input v-model="moreDetail.max" placeholder="aa" ></Input>
          </FormItem>
        </div> -->
        <FormItem   :label-width="73"  label="行程簡介:" prop="max">
          
            <Input v-model="data[Memindex].introduction " type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <!-- <FormItem     label="注意事項:" prop="max">
               <Input v-model="moreDetail.precautions" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem> -->
          <div style="font-size: 18px;color: #515a6e; padding-left: 2px;padding-bottom: 10px;">行程內容</div>
          <FormItem     label="日程標題1:" prop="max">
            <Input v-model="data[Memindex].itinerary_day[0]" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem label="照片1" prop="img1" :label-width="50">
            <input  type="file" multiple />
          </FormItem>
          <FormItem     label="日程內容1:" prop="max">
               <Input v-model="data[Memindex].itinerary_day[1]" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題2:" prop="max">
            <Input v-model="data[Memindex].itinerary_day[2]" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem label="照片2" prop="img1" :label-width="50">
            <input  type="file" multiple />
          </FormItem>
          <FormItem     label="日程內容2:" prop="max">
               <Input v-model="data[Memindex].itinerary_day[3]" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題3:" prop="max">
            <Input v-model="data[Memindex].itinerary_day[4]" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem label="照片3" prop="img1" :label-width="50">
            <input  type="file" multiple />
          </FormItem>
          <FormItem     label="日程內容3:" prop="max">
               <Input v-model="data[Memindex].itinerary_day[5]" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題4、5:" prop="max">
            <Input v-model="data[Memindex].itinerary_day[6]" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem label="照片4、5" prop="img4" :label-width="40">
            <input  type="file" multiple />
          </FormItem>
          <FormItem     label="日程內容4、5:" prop="max">
               <Input v-model="data[Memindex].itinerary_day[7]" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題6:" prop="max">
            <Input v-model="data[Memindex].itinerary_day[8]" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem label="照片6" prop="img5" :label-width="50">
            <input  type="file" multiple />
          </FormItem>
          <FormItem     label="日程內容6:" prop="max">
               <Input v-model="data[Memindex].itinerary_day[9]" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題7:" prop="max">
            <Input v-model="data[Memindex].itinerary_day[10]" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem label="照片7" prop="img6" :label-width="50">
            <input  type="file" multiple />
          </FormItem>
          <FormItem     label="日程內容7:" prop="max">
               <Input v-model="data[Memindex].itinerary_day[11]" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <!-- <FormItem     label="日程標題7:" prop="max">
            <Input v-model="moreDetail.day7Title" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem label="照片7" prop="img7" :label-width="40">
            <input  type="file" multiple />
          </FormItem>
          <FormItem     label="日程內容7:" prop="max">
               <Input v-model="moreDetail.day7Title" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem> -->
      
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

@import "~@/assets/sass/page/_Process.scss";
// :deep(tr.ivu-table-row-hover td){
//   background-color: red;
// }
</style>
<script>
import axios from 'axios';

import Side from '@/components/SideNav.vue';
     
export default {

      data() {
        return {
          Memindex:0,
          showMore:1,
          modalProcess: false,
          columns:[
                {
                  title: '編號',
                  key: 'itinerary_no',
                  width:80

                },      
                {
                  title: '星球名稱',
                  key: 'planet_name',
                  filters: [
                            {
                                label: '繞行',
                                value: 1
                            },
                            {
                                label: '月球',
                                value: 2
                            },
                            {
                                label: '火星',
                                value: 3
                            },
                            {
                                label: '金星',
                                value: 4
                            },
                         
                        ],
                        filterMultiple: false,
                        filterMethod (value, row) {
                            if (value === 1) {
                                return row.location === '繞行';
                            } else if (value === 2) {
                                return row.location ==='月球';
                            }else if (value === 3) {
                                return row.location ==='火星';
                            }else if (value === 4) {
                                return row.location ==='金星';
                            }
                        }
                },      
                {
                  title: '小標題',
                  key: 'planet_subtitle'
                },      
              
                {
                  title: '編輯',
                  slot: 'action',
                  width:145
                },           
            ],
            data:[
                // {
                //   number: 1,
                //   location: '月球',
                //   title: '月球背面探索之旅1',
                 
                
                // },
                // {
                //   number: 2,
                //   location: '火星',
                //   title: '火星背面探索之旅1',
                 
                
                // },
                // {
                //   number: 3,
                //   location: '月球',
                //   title: '月球背面探索之旅2',
                // },
                // {
                //   number: 4,
                //   location: '火星',
                //   title: '火星背面探索之旅2',                
                // },
                // {
                //   number: 5,
                //   location: '金星',
                //   title: '金星背面探索之旅1',                
                // },
                // {
                //   number: 6,
                //   location: '金星',
                //   title: '金星背面探索之旅2',                
                // },
                // {
                //   number: 7,
                //   location: '繞行',
                //   title: '繞行探索之旅1',                
                // },
            ],
            moreDetail:{
                number:'1',  
                location: '月球',
                title: '月球背面探索之旅2',
                smTitle:'',
                summary :'11111111111111',
                min:"5",
                max:'10',
                precautions:'2222222222222222',
                day1Title:'',
                day2Title:'',
                day3Title:'',
                day4Title:'',
                day5Title:'',
                day6Title:'',
                day7Title:'',
                day1Text:'',
                day2Text:'',
                day3Text:'',
                day4Text:'',
                day5Text:'',
                day6Text:'',
                day7Text:'',
              },
              ruleValidate: {
                number: [
                        { required: true, message: 'The name cannot be empty', trigger: 'blur' }
                    ],
                location: [
                        { required: true, message: 'Mailbox cannot be empty', trigger: 'blur' },
                        { type: 'email', message: 'Incorrect email format', trigger: 'blur' }
                    ],
                    title: [
                        { required: true, message: 'Please select the city', trigger: 'change' }
                    ],
                    summary: [
                        { required: true, message: 'Please select gender', trigger: 'change' }
                    ],
        }
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
        // handleSubmit (name) {
        //         this.$refs[name].validate((valid) => {
        //             if (valid) {
        //                 this.$Message.success('Success!');
        //             } else {
        //                 this.$Message.error('Fail!');
        //             }
        //         })
        //     },
        //     handleReset (name) {
        //         this.$refs[name].resetFields();
        //     }
        },
         created() {
        axios.get('http://localhost/PV/PVBackend/public/php/Process.php')
            .then(response => {
              // this.data = response.data.map(item => {
              //   item.itinerary_day = item.itinerary_day.split("\r\n");
              //   return item;
              // });
                this.data = response.data;
                // this.datac = [...this.myData];

            })
            .catch(error => {
                console.error(error);
            });
    }
  }

  
    


</script>