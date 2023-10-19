<template>
   <div class=" layout" >
    <Side :activePage='4'/> 
    <button  class="out" style="width: 42px;height:32px;line-height: 35px;">
     登出
    </button>
    <Layout v-width="900" :style="{marginLeft: '300px'} ">
      <div v-if="showMore==1" >
      <h1>行程介紹</h1>
      <!-- <Button @click="modalProcess =true" class="add">新增 +</Button> -->
        <!-- <Modal
                  title="新增團隊"
                  v-model="modalProcess"
                  width="900px"
                  @on-ok="ProcessAddPhp"
                  @on-cancel="Addclose"
                  :closable="false">
                <Form
                    :model="addProcess"
                    method="post"  >
                  <FormItem label="行程名稱:" class="ivu-mb" :label-width="80">
                   <Input v-model="addProcess.content_title" placeholder="請輸入行程名稱" ></Input>
                  </FormItem>
            <FormItem  :label-width="80" label="星球名稱:" class="ivu-mb">
                <Select v-model="addProcess.planet_name" >
                    <Option value="繞行">繞行</Option>
                    <Option value="月球">月球</Option>
                    <Option value="火星">火星</Option>
                    <Option value="金星">金星</Option>
                </Select>
            </FormItem>
            <FormItem label="小標題:" prop="smTitle" :label-width="66" class="ivu-mb">
                <Input v-model="addProcess.planet_subtitle" placeholder="請輸入星球名稱" ></Input>
            </FormItem>
          
            <FormItem   :label-width="80"  label="行程簡介:" class="ivu-mb">
              
                <Input v-model="addProcess.introduction "  placeholder="請輸入行程簡介" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem> -->

              <!-- <div style="font-size: 18px;color: #515a6e; padding-left:10px;padding-bottom: 10px;">行程內容</div>
              <FormItem :label-width="90"      label="日程標題1:" class="ivu-mb">
                <Input v-model="addProcess.itinerary_day[0]" placeholder="請輸入日程標題" ></Input>          
              </FormItem>
              <FormItem label="照片1" class="ivu-mb" :label-width="60">
                <input  type="file" @change="addTeamItem.TeamImageFile = $event.target.files" multiple />
              </FormItem>
              <FormItem  :label-width="90"   label="日程內容1:" class="ivu-mb">
                  <Input v-model="addProcess.itinerary_day[1]" placeholder="請輸入日程內容" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem>
              <FormItem  :label-width="90"   label="日程標題2:" class="ivu-mb">
                <Input v-model="addProcess.itinerary_day[2]" placeholder="請輸入日程標題" ></Input>          
              </FormItem>
              <FormItem label="照片2" class="ivu-mb" :label-width="60">
                <input  type="file" multiple />
              </FormItem>
              <FormItem   :label-width="90"  label="日程內容2:" class="ivu-mb">
                  <Input v-model="addProcess.itinerary_day[3]"  placeholder="請輸入日程內容" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem>
              <FormItem    :label-width="90" label="日程標題3:" class="ivu-mb">
                <Input v-model="addProcess.itinerary_day[4]"  placeholder="請輸入日程標題" ></Input>          
              </FormItem>
              <FormItem label="照片3" class="ivu-mb" :label-width="60">
                <input  type="file" multiple />
              </FormItem>
              <FormItem   :label-width="90"  label="日程內容3:" class="ivu-mb">
                  <Input v-model="addProcess.itinerary_day[5]" placeholder="請輸入日程內容" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem>
              <FormItem  :label-width="111"   label="日程標題4、5" class="ivu-mb">
                <Input v-model="addProcess.itinerary_day[6]" placeholder="請輸入日程標題" ></Input>          
              </FormItem>
              <FormItem label="照片4、5" class="ivu-mb" :label-width="85">
                <input  type="file" multiple />
              </FormItem>
              <FormItem  :label-width="115"    label="日程內容4、5:" class="ivu-mb">
                  <Input v-model="addProcess.itinerary_day[7]" placeholder="請輸入日程內容" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem>
              <FormItem   :label-width="90"   label="日程標題6:" class="ivu-mb">
                <Input v-model="addProcess.itinerary_day[8]" placeholder="請輸入日程標題" ></Input>          
              </FormItem>
              <FormItem label="照片6" class="ivu-mb" :label-width="60">
                <input  type="file" multiple />
              </FormItem>
              <FormItem  :label-width="90"    label="日程內容6:" class="ivu-mb">
                  <Input v-model="addProcess.itinerary_day[9]" placeholder="請輸入日程內容" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem>
              <FormItem  :label-width="90"    label="日程標題7:" class="ivu-mb">
                <Input v-model="addProcess.itinerary_day[10]" placeholder="請輸入日程標題" ></Input>          
              </FormItem>
              <FormItem label="照片7" prop="img6" :label-width="60">
                <input  type="file" multiple />
              </FormItem>
              <FormItem   :label-width="90"   label="日程內容7:" class="ivu-mb">
                  <Input v-model="addProcess.itinerary_day[11]" placeholder="請輸入日程內容" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
              </FormItem>
           </Form>
          </Modal> -->
      

          <Table class="Table" border :columns="columns" :data="data">
                  <template #action="{ row, index }">
                  
                    <Button  size="small" style="margin-right: 5px" @click="Memindex = index;More(index)">編輯</Button>
                   <Button  size="small" @click="remove(index)">刪除</Button>
                  </template>
          </Table>  
      </div>
      <div class="showAll" v-if="showMore==2">
        <h1>行程</h1>
        <Form id="FormAll" v-width="700" ref="moreDetail" :model="data[Memindex]" :rules="ruleValidate" :label-width="80">
        <p style="font-size: 14px;color: #515a6e; padding-bottom: 8px;">編號:{{ data[Memindex].itinerary_no }}</p>
        <FormItem label="行程名稱:" prop="precautions" :label-width="47" >
            <Input v-model="data[Memindex].content_title"  ></Input>
        </FormItem>
        <FormItem  :label-width="60" label="星球名稱" placeholder="輸入名稱" prop="title">
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
        <FormItem   :label-width="73"  label="行程簡介:" >
          
            <Input v-model="data[Memindex].introduction " type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <!-- <FormItem     label="注意事項:" prop="max">
               <Input v-model="moreDetail.precautions" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem> -->
          <div style="font-size: 18px;color: #515a6e; padding-left: 2px;padding-bottom: 10px;">行程內容</div>
          <FormItem     label="日程標題1:" prop="max">
            <Input v-model="data[Memindex].itinerary_day[0]"  ></Input>          
          </FormItem>
          <FormItem label="照片1" prop="img1" :label-width="50">
            <input  type="file" multiple  @change=" FilesChange($event, 0)" />
          </FormItem>
          <FormItem     label="日程內容1:" prop="max">
               <Input v-model="data[Memindex].itinerary_day[1]" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題2:" prop="max">
            <Input v-model="data[Memindex].itinerary_day[2]"  ></Input>          
          </FormItem>
          <FormItem label="照片2" prop="img1"  @change=" FilesChange($event, 3)" :label-width="50">
            <input  type="file" multiple />
          </FormItem>
          <FormItem     label="日程內容2:" prop="max">
               <Input v-model="data[Memindex].itinerary_day[3]" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題3:" prop="max">
            <Input v-model="data[Memindex].itinerary_day[4]"  ></Input>          
          </FormItem>
          <FormItem label="照片3" prop="img1"  @change=" FilesChange($event, 6)" :label-width="50">
            <input  type="file" multiple />
          </FormItem>
          <FormItem     label="日程內容3:"  prop="max">
               <Input v-model="data[Memindex].itinerary_day[5]" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem   :label-width="100"  label="日程標題4、5:" prop="max">
            <Input v-model="data[Memindex].itinerary_day[6]"  ></Input>          
          </FormItem>
          <FormItem label="照片4、5" prop="img4"  @change="FilesChange($event, 9)" :label-width="70">
            <input  type="file" multiple />
          </FormItem>
          <FormItem    :label-width="100"  label="日程內容4、5:" prop="max">
               <Input v-model="data[Memindex].itinerary_day[7]" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題6:" prop="max">
            <Input v-model="data[Memindex].itinerary_day[8]"  ></Input>          
          </FormItem>
          <FormItem label="照片6" prop="img6"   @change=" FilesChange($event, 12)" :label-width="50">
            <input  type="file" multiple />
          </FormItem>
          <FormItem     label="日程內容6:" prop="max">
               <Input v-model="data[Memindex].itinerary_day[9]" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <FormItem     label="日程標題7:" prop="max">
            <Input v-model="data[Memindex].itinerary_day[10]"  ></Input>          
          </FormItem>
          <FormItem label="照片7" prop="img6"  @change=" FilesChange($event, 15)" :label-width="50">
            <input  type="file" multiple />
          </FormItem>
          <FormItem     label="日程內容7:" prop="max">
               <Input v-model="data[Memindex].itinerary_day[11]" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem>
          <!-- <FormItem     label="日程標題7:" prop="max">
            <Input v-model="moreDetail.day7Title"  ></Input>          
          </FormItem>
          <FormItem label="照片7" prop="img7" :label-width="40">
            <input  type="file" multiple />
          </FormItem>
          <FormItem     label="日程內容7:" prop="max">
               <Input v-model="moreDetail.day7Title" type="textarea" :autosize="{minRows: 4,maxRows: 8}" ></Input>
          </FormItem> -->
      
        <FormItem v-width="700">
            <Button  size="small" style="margin-right: 5px; float: right;" @click="reTable()">返回</Button>
            <Button  size="small" style="margin-right: 5px;  float: right;" @click="ProcessEditPhp(Memindex)">確定</Button>
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
          Memindex:null,
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
            
            ],
            filesArray: new Array(18).fill(null),
            itinerary_photo_noData :[],
            addProcess:{
             
        // itinerary_no: "1",
            planet_name : "",
            planet_subtitle : "",
            content_title : "",
            introduction : "",
            itinerary_day : [ ],
       
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
     
          FilesChange(event, offset) {
    let inputElement = event.target;
    let selectedFiles = inputElement.files;

    // 確定只有三個文件被選中
    if (selectedFiles.length > 3) {
        alert("不能超過三張圖片");
        inputElement.value = '';  
        return;
    }

    // 更新 filesArray
    for (let i = 0; i < selectedFiles.length; i++) {
      this.filesArray[offset + i] = selectedFiles[i];
        
        }
    },

          
        
        More(index){
            this.showMore=2;
            let itinerary_no = this.data[index].itinerary_no;
            const fd = new FormData();
            fd.append('itinerary_no',itinerary_no);
            axios.post(`${this.$store.state.phpPublicPath}ProcessGetPhoto.php`, fd)
          .then(response => {
            this.itinerary_photo_noData= response.data;
            console.log(this.itinerary_photo_noData);
          })
          .catch(error => {
            console.log(error);
            console.log(error.response);
          });


        },
        reTable(){
            this.showMore=1;
            
        },
        remove (index) {
          const fd = new FormData()
           let itinerary_no = this.data[index].itinerary_no;
           fd.append('itinerary_no',itinerary_no);
            axios.post(`${this.$store.state.phpPublicPath}ProcessDelete.php`,fd)
          .then(response => {
            console.log(response.data);
            this.data.splice(index, 1);  // 從前端數據中移除該筆訂單
          })
          .catch(error => {
            console.log(error);
            console.log(error.response);
          });
      },
        getProcess(){
          axios.get(`${this.$store.state.phpPublicPath}Process.php`)
            .then(response => {
         
                this.data = response.data;
            })
            .catch(error => {
                console.error(error);
            });
        },
      
        ProcessEditPhp(Memindex){ 
          this.showMore=1;   
          // if (!this.addProcess.planet_name ||
          //   !this.addProcess.planet_subtitle ||
          //   !this.addProcess.content_title ||
          //   !this.addProcess.introduction ||
          //   !itinerary_dayString) {
          //   window.alert('全部欄位都要填');
          //   return;  // 退出函數，不執行後續的axios請求
          //   }
          const fd = new FormData()
          let files;
          let dayString=this.data[Memindex].itinerary_day.join('\r\n');
          console.log(dayString);
          let itinerary_dayString;
          itinerary_dayString=[dayString];
          //  files =Array.from(this.filesArray);

          // files.forEach((file) => {
          //    fd.append("ProcessimageFile", file);
          // });
          fd.append('itinerary_no', this.data[Memindex].itinerary_no);
          fd.append('planet_name', this.data[Memindex].planet_name);
          fd.append('planet_subtitle', this.data[Memindex].planet_subtitle);
          fd.append('content_title', this.data[Memindex].content_title);
          fd.append('introduction', this.data[Memindex].introduction);
          for(let i=0; i<this.filesArray.length; i++){
            fd.append(`ProcessimageFile${i}`, this.filesArray[i]);
          }
          fd.append('itinerary_day', itinerary_dayString);
          fd.append('photo_noData' ,JSON.stringify(this.itinerary_photo_noData));
          console.log(itinerary_dayString);
          console.log(this.filesArray);
       
        
          axios.post(`${this.$store.state.phpPublicPath}ProcessEdit.php`, fd, {
         headers: { "Content-Type": "multipart/form-data" }
         })
        .then(response => {
          console.log(response);
          this.getProcess()
        })
        .catch(error => {
          console.log(error);
        });

        
     
        },
      },
      created() {
      this.getProcess()
    }
  }

  
    


</script>