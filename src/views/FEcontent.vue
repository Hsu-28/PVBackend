
<template>
  <div class=" layout" >
    <Side  :activePage='3' /> 
    <button  class="out" style="width: 42px;height:32px;line-height: 35px; ">
     登出
    </button>
      <Layout v-width="900" :style="{marginLeft: '300px'} ">
        <h1>會員資料</h1>
        <div class="buttonAll">
            <div  direction="vertical" v-for="(item,index) in changePageText">
                <div  @click="changeButton(index)" :class="[changePage == index ? 'thisPage' : 'buttonPage' ]">{{item.text}}</div>
            </div>
         </div>
        <div v-if="changePage == 0">
          <div class="demo-upload-list" v-for="item in uploadList">
              <template  class="upimg" v-if="item.status === 'finished'">
                  <Image :src="item.url" fit="cover" width="100%" height="100%" />
                  <div class="demo-upload-list-cover">
                      <Icon type="ios-eye" @click="handleView(item.name)"></Icon>
                      <Icon type="ios-trash-outline" @click="handleRemove(item)"></Icon>
                  </div>
              </template>
              <template v-else>
                  <Progress v-if="item.showProgress" :percent="item.percentage" hide-info></Progress>
              </template>   
            </div>

              <Upload
                  ref="upload"
                  :show-upload-list="false"
                  :default-file-list="defaultList"
                  :on-success="handleSuccess"
                  :format="['jpg','svg','png']"
                  :max-size="4096"
                  :on-format-error="handleFormatError"
                  :on-exceeded-size="handleMaxSize"
                  :before-upload="handleBeforeUpload"
                  multiple
                  type="drag"
                  action="//jsonplaceholder.typicode.com/posts/"
                  style="display: inline-block;width:58px;">
                  <Button  icon="md-camera" style="width: 58px;height:58px;line-height: 58px;">
                      <!-- <Icon icon="md-camera" size="20"/> -->
                  </Button>

              </Upload>
              <Button   style="width: 58px;height:58px;line-height: 58px; margin-bottom: 52px; margin-left: 20px;">
              確認                  
              </Button>
              <ImagePreview class="wwww" v-model="visible" :preview-list="['https://file.iviewui.com/images/' + imgName]" />
       </div>
       <div v-if="changePage==1">
        <Button @click="modal1 = true" class="add">新增 +</Button> 
          <Table class="Table" border :columns="columnsMem" :data="dataMem">
            <template #action="{ row, index }">
                   <Button  size="small" style="margin-right: 5px" @click="clickEditBtnT">編輯</Button>
                   <!-- @click="clickEditBtn(index, row)" -->
                   <Button  size="small" @click="remove(index ,'Mem')">刪除</Button>
                   <!-- <Modal
                        v-model="clickEditBtnT"
                        :id="row.name"
                        title="編輯歷史故事"
                        ok-text="確認修改"
                        cancel-text="取消"
                        width="700px"
                        class="editnews-popup"
                        :styles="{ top: '30px' }"
                        @on-ok="replaceItem(row.name)"
                        @on-cancel="cancelEdit"
                    >
                        <Form
                          :model="addItem"
                          :label-width="80"
                          :rules="ruleValidate1"
                          ref="updateForm1"
                        >
                          <FormItem label="故事編號" prop="number">
                              <text>{{ addItem.number }}</text>
                          </FormItem>
                          <FormItem label="故事名稱" prop="story_name">
                          <Input
                            v-model="addItem.name"
                            placeholder="請輸入故事標題"
                          ></Input>
                           </FormItem>
                        
                        </Form>
                    </Modal> -->
             </template>

            </Table>
         

        </div>
        <div v-if="changePage==2">
          <Button @click="modal1 = true" class="add">新增 +</Button> 

          <Table class="Table" border :columns="columnsNews" :data="dataNews">
                  <template #action="{ row, index }">
                        
                    <Button  size="small" style="margin-right: 5px" >編輯</Button>
                   <Button  size="small" @click="remove(index ,'News')">刪除</Button>
                  
                  </template>
          </Table>
          </div>
          <div v-if="changePage==3">
            <Button @click="modal1 = true" class="add">新增 +</Button> 

          <Table class="Table" border :columns="columnsQA" :data="dataQA">
                  <template #action="{ row, index }">
                    <Button  size="small" style="margin-right: 5px" >編輯</Button>
                   <Button  size="small" @click="remove(index ,'QA')">刪除</Button>
                  </template>
          </Table>



        </div>
         <!-- <img  v-width="60" src="../assets/image/more.svg" alt="more"> -->
           
      </Layout>
      
  </div>
</template>
<style scoped lang="scss">
@import "~@/assets/sass/page/_FEcontent.scss";

</style>

<script>
import Side from '@/components/SideNav.vue';

  export default {
      data () {
          return {
            clickEditBtnT:false,
            memore:0,
            changePage: 0,
            changePageText:[
                  {text:'首頁照片'},
                  {text:'團隊介紹'},
                  {text:'最新消息'},
                  {text:'Q&A'},

            ],
            // modEdit:[],
            // addItem:{
            //   number:'',
            //   name:'',
            //   img:'',
            //   job:'',
            //   exp:'',
            // },
            // ruleValidate1:[
            //   {  required: true,
            //       type: "date",
            //       message: "請選擇確切穿越日期",
            //       trigger: "blur",
            //     },
            //   {  required: true,
            //   type: "date",
            //   message: "請選擇確切穿越日期",
            //   trigger: "blur",},

            //   { 
            //      required: true,
            //   type: "date",
            //   message: "請選擇確切穿越日期",
            //   trigger: "blur",},
              
            //   { 
            //      required: true,
            //   type: "date",
            //   message: "請選擇確切穿越日期",
            //   trigger: "blur",},
              
            //   { 
            //      required: true,
            //   type: "date",
            //   message: "請選擇確切穿越日期",
            //   trigger: "blur",},                        
            // ],

            defaultList: [
                    {
                        'name': 'image-demo-1.jpg',
                        'url': 'https://file.iviewui.com/images/image-demo-1.jpg'
                    },
                    
                ],
                imgName: '',
                visible: false,
                uploadList: [],
            columnsMem:[
                {
                  title: '團隊成員編號',
                  key: 'number'
                },      
                {
                  title: '成員名稱',
                  key: 'name'
                },      
                {
                  title: '成員照片路徑',
                  key: 'img'
                },      
                {
                  title: '成員職位',
                  key: 'job'
                },      
                {
                  title: '成員經歷',
                  key: 'exp'
                }, 
                {
                  title: '編輯',
                  slot: 'action',
                },           
            ],
            dataMem:[
                {
                  number: 1,
                  name: '李曉如',
                  img: '../assets/image/more.svg',
                  job:`工程師`,
                  exp:`111111`,
                },
            ],
            columnsNews:[
                {
                  title: '消息編號',
                  key: 'number_News'
                },      
                {
                  title: '消息標題',
                  key: 'title_news'
                },      
                {
                  title: '消息照片路徑',
                  key: 'img'
                },      
                {
                  title: '日期',
                  key: 'date'
                },      
                {
                  title: '內容',
                  key: 'content'
                }, 
                {
                  title: '編輯',
                  slot: 'action',
                },           
            ],
            dataNews:[
                {
                  number_News: 1,
                  title_news: '李曉如',
                  img: '../assets/image/more.svg',
                  date:`1111/11/1`,
                  content:`111111`,
                },
            ],
            columnsQA:[
                {
                  title: '問題編號',
                  key: 'number_QA'
                },      
                {
                  title: '問題標題',
                  key: 'title_QA'
                },      
                {
                  title: '問題答案',
                  key: 'QA_anwer'
                },      
              
                {
                  title: '編輯',
                  slot: 'action',
                },           
            ],

            dataQA:[
                {
                  number_QA: 1,
                  title_QA: '問題標題',
             
                  QA_anwer:`QA_anwerQA_anwerQA_anwerQA_anwer`,
                
                },
            ],
          }
        },  
        
        methods: {
            handleView (name) {
                this.imgName = name;
                this.visible = true;
            },
            handleRemove (file) {
                const fileList = this.$refs.upload.fileList;
                this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
            },
            handleSuccess (res, file) {
              
                // this.uploadList = [];

                file.url = 'https://file.iviewui.com/images/image-demo-3.jpg';
                file.name = 'image-demo-3.jpg';
                // this.uploadList.push(file);
                this.uploadList = [file];

            },
            handleFormatError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
                });
            },
            handleMaxSize (file) {
                this.$Notice.warning({
                    title: 'Exceeding file size limit',
                    desc: 'File  ' + file.name + ' is too large, no more than 2M.'
                });
            },
            handleBeforeUpload () {
                const check = this.uploadList.length < 5;
                if (!check) {
                    this.$Notice.warning({
                        title: 'Up to five pictures can be uploaded.'
                    });
                }
                return check;
            },
            changeButton(index){

              this.changePage=index;
              console.log(this.changePage);
            },   
            remove (index,type) {
              if(type==='Mem'){
                   this.dataMem.splice(index, 1);
              }else if(type==='News'){

                    this.dataNews.splice(index, 1);
              }else if(type==='QA'){
                      this.dataQA.splice(index, 1);
              }
             
            
            },
          
            replaceItem(index) {
              this.$refs["updateForm1"].validate((valid) => {
              if (valid) {
                this.addItem.itinerary_number_of_years =
                    this.addItem.itinerary_number_of_years
                      .toLocaleDateString()
                      .replace(/\//g, "-");

                this.updateData(index);
              } else {
                alert("修改失敗，請確認表格是否輸入正確");
              }
               });
          },
                cancelEdit() {
         this.addItem = { ...this.resetItem };
          },
      
      //     cancelEdit() {
      //    this.addItem = { ...this.resetItem };
      //     },
      //     clickEditBtn(index, row) {
      //    this.modal3[index] = true;
      //    const story_id = row.story_id;
      //    // console.log(row.story_id);

      //    fetch(`${BASE_URL}/getHistoryArticles.php`, {
      //       method: "POST",
      //       body: JSON.stringify({
      //          story_id: story_id,
      //       }),
      //    })
      //       .then((res) => res.json())
      //       .then((result) => {
      //          // console.log(result);
      //          const articles = {
      //             story_title_01: result[0].story_title,
      //             story_title_02: result[1].story_title,
      //             story_title_03: result[2].story_title,
      //             story_title_04: result[3].story_title,
      //             story_title_05: result[4].story_title,
      //             story_content_01: result[0].story_content,
      //             story_content_02: result[1].story_content,
      //             story_content_03: result[2].story_content,
      //             story_content_04: result[3].story_content,
      //             story_content_05: result[4].story_content,
      //          };
      //          // console.log(articles);
      //          this.addItem = { ...this.dataList[index], ...articles };
      //          // console.log(this.addItem);
      //       });
      // },
        },
      
        mounted () {
            if (this.$refs.upload) {
        this.uploadList = this.$refs.upload.fileList;
        }
      },
        components: {
        Side
        },
    }

</script>
