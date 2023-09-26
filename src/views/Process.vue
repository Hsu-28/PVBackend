<template>
   <div class=" layout" >
    <Side :activePage='4'/> 
    <button  class="out" style="width: 42px;height:32px;line-height: 35px;">
     登出
    </button>
    <Layout v-width="900" :style="{marginLeft: '300px'} ">
      <div v-if="showMore==1" >
      <h1>行程介紹</h1>
      <Button @click="modal1 =true" class="add">新增 +</Button> 

          <Table class="Table" border :columns="columns" :data="data">
                  <template #action="{ row, index }">
                  
                    <Button  size="small" style="margin-right: 5px" @click="More()">編輯</Button>
                   <Button  size="small" @click="remove(index ,'News')">刪除</Button>
                  </template>
          </Table>  
      </div>
      <div class="showAll" v-if="showMore==2">
        <h1>行程</h1>
        <Form id="FormAll" v-width="700" ref="moreDetail" :model="moreDetail" :rules="ruleValidate" :label-width="80">
        <p style="font-size: 14px;color: #515a6e; padding-bottom: 8px;">編號:{{ moreDetail.number }}</p>
        <FormItem label="地點:" prop="precautions">
            <Input v-model="moreDetail.precautions" placeholder="aa" ></Input>
        </FormItem>
        <FormItem label="標題" prop="">
            <Select v-model="moreDetail.location" placeholder="Select your city">
                <Option value="qqq">繞行</Option>
                <Option value="moon">月球</Option>
                <Option value="fire">火星</Option>
                <Option value="ggg">金星</Option>
            </Select>
        </FormItem>
        <div style="display: flex;">
          <FormItem  v-width="120" label="人數下限:" prop="min">
              <Input v-model="moreDetail.min" placeholder="aa" ></Input>
          </FormItem>
          <FormItem   v-width="120"  label="人數上限:" prop="max">
              <Input v-model="moreDetail.max" placeholder="aa" ></Input>
          </FormItem>
        </div>
        <FormItem     label="行程簡介:" prop="max">
          
            <Input v-model="moreDetail.summary" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="注意事項:" prop="max">
               <Input v-model="moreDetail.precautions" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <div style="font-size: 18px;color: #515a6e; padding-left: 2px;padding-bottom: 10px;">行程內容</div>
          <FormItem     label="日程標題1:" prop="max">
            <Input v-model="moreDetail.day1Title" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem     label="日程內容1:" prop="max">
               <Input v-model="moreDetail.day1Text" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題2:" prop="max">
            <Input v-model="moreDetail.day2Title" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem     label="日程內容2:" prop="max">
               <Input v-model="moreDetail.day3Title" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題3:" prop="max">
            <Input v-model="moreDetail.day3Title" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem     label="日程內容3:" prop="max">
               <Input v-model="moreDetail.day2Title" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題4:" prop="max">
            <Input v-model="moreDetail.day4Title" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem     label="日程內容4:" prop="max">
               <Input v-model="moreDetail.day4Title" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題5:" prop="max">
            <Input v-model="moreDetail.day5Title" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem     label="日程內容5:" prop="max">
               <Input v-model="moreDetail.day5Title" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題6:" prop="max">
            <Input v-model="moreDetail.day6Title" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem     label="日程內容6:" prop="max">
               <Input v-model="moreDetail.day6Title" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題7:" prop="max">
            <Input v-model="moreDetail.day7Title" placeholder="aa" ></Input>          
          </FormItem>
          <FormItem     label="日程內容7:" prop="max">
               <Input v-model="moreDetail.day7Title" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
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
@import "~@/assets/sass/page/_Process.scss";
// :deep(tr.ivu-table-row-hover td){
//   background-color: red;
// }
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
                  key: 'number'
                },      
                {
                  title: '地點',
                  key: 'location',
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
                  title: '名稱',
                  key: 'title'
                },      
              
                {
                  title: '編輯',
                  slot: 'action',
                },           
            ],
            data:[
                {
                  number: 1,
                  location: '月球',
                  title: '月球背面探索之旅1',
                 
                
                },
                {
                  number: 2,
                  location: '火星',
                  title: '火星背面探索之旅1',
                 
                
                },
                {
                  number: 3,
                  location: '月球',
                  title: '月球背面探索之旅2',
                },
                {
                  number: 4,
                  location: '火星',
                  title: '火星背面探索之旅2',                
                },
                {
                  number: 5,
                  location: '金星',
                  title: '金星背面探索之旅1',                
                },
                {
                  number: 6,
                  location: '金星',
                  title: '金星背面探索之旅2',                
                },
                {
                  number: 7,
                  location: '繞行',
                  title: '繞行探索之旅1',                
                },
            ],
            moreDetail:{
                number:'1',  
                location: '月球',
                title: '月球背面探索之旅2',
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
        handleSubmit (name) {
                this.$refs[name].validate((valid) => {
                    if (valid) {
                        this.$Message.success('Success!');
                    } else {
                        this.$Message.error('Fail!');
                    }
                })
            },
            handleReset (name) {
                this.$refs[name].resetFields();
            }
        }

    }


</script>