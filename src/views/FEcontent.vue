
<template>
  <div id="layoutFE" >
    <Side  :activePage='3' /> 
    <button  class="out" style="width: 42px;height:32px;line-height: 35px; ">
     登出
    </button>
      <Layout v-width="900" :style="{marginLeft: '300px'} ">
        <h1>內容管理</h1>
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
       <!-- 團隊介紹 -->
       <div v-if="changePage==1">
        <!-- <Button @click="modalTeam = true" class="add ivu-mb">新增 +</Button>  -->
           <!-- 彈窗 -->
            <Modal
                  title="新增團隊"
                  v-model="modalTeam"
                  width="700px"
                  :closable="true">
                  <Form
                    :model="addTeamItem"
                    :label-width="80"
                    enctype="multipart/form-data"
                    method="post"  >
                    <FormItem label="姓名:" prop="precautions" :label-width="45" class="ivu-mb"  v-width="200" >
                      <Input v-model="addTeamItem.name" placeholder="aa" ></Input>
                    </FormItem>
                  
                    <FormItem label="照片" prop="mem_img" :label-width="40">
                        <input  type="file" id="upMemFile" name="upMemFile" />
                    </FormItem>
                    <FormItem   v-width="200"  label="職稱:" prop="job" :label-width="45" class="ivu-mb">
                        <Input v-model="addTeamItem.job" placeholder="職稱" ></Input>
                    </FormItem>
                    <FormItem    label="經歷:" prop="exp" :label-width="45" class="ivu-mb">
                      <Input v-model="addTeamItem.exp" type="textarea" :autosize="{minRows: 5,maxRows: 5}" placeholder="經歷"></Input>
                    </FormItem> 
                  </Form>
              </Modal>
          <Table id="TableFE" border :columns="columnsMem" :data="dataMem">
            <template #action="{ row, index }">
                   <Button  size="small" style="margin-right: 5px" @click="clickTeamEdit(index)">編輯</Button>
                    <Modal
                      title="編輯團隊資訊"
                      ok-text="確認修改"
                      cancel-text="取消"
                      v-model="TeamEdit[index]"
                      width="700px"
                      :closable="true"
                      @on-ok="TeamEditPhp"
                      @on-cancel="cancel">
                      <Form
                        :model="addTeamItem"
                        :label-width="80"
                        enctype="multipart/form-data"
                        method="post"  >
                        <FormItem label="團隊編號" :label-width="68">
                              <text>{{ addTeamItem.team_memno }}</text>
                        </FormItem>
                        <FormItem label="姓名:" prop="precautions" :label-width="45" class="ivu-mb"  v-width="200">
                          <Input v-model="addTeamItem.team_memname" placeholder="aa" ></Input>
                        </FormItem>
                      
                        <FormItem label="照片" prop="mem_img" :label-width="40">
                            <input  type="file" multiple />
                        </FormItem>
                        <FormItem   v-width="200"  label="職稱:" prop="job" :label-width="45" class="ivu-mb">
                            <Input v-model="addTeamItem.team_memjob" placeholder="職稱" ></Input>
                        </FormItem>
                        <FormItem    label="經歷:" prop="exp" :label-width="45" class="ivu-mb">
                          <Input v-model="addTeamItem.team_memexperience" type="textarea" :autosize="{minRows: 5,maxRows: 5}" placeholder="經歷"></Input>
                        </FormItem> 
                      </Form>
                   </Modal>
                   <!-- @click="clickEditBtn(index, row)" -->
                   <Button  size="small" @click="remove(index ,'Mem')">刪除</Button>
              
             </template>

            </Table>
         

        </div>
        <!-- 最新消息 -->
        <div v-if="changePage==2">
          <Button @click="modalNews = true" class="add ivu-mb">新增 +</Button>
            <!-- 彈窗 -->
            <Modal
                  title="新增最新消息"
                  v-model="modalNews"
                  width="700px"
                  :closable="true">
                  <Form
                    :model="addNews"
                    :label-width="80"
                    enctype="multipart/form-data"
                    method="post"  >
                    <FormItem label="最新消息標題:" prop="precautions" :label-width="120" class="ivu-mb"  v-width="300">
                      <Input v-model="addNews.title_news" placeholder="aa" ></Input>
                    </FormItem>
                  
                    <FormItem label="最新消息照片:" prop="img" :label-width="120">
                        <input  type="file" multiple />
                    </FormItem> 
                    <Space size="large" wrap class="ivu-mb">
                         <div   style="font-size: 14px;color: #515a6e; padding: 8px 0; margin-left: 20px;">日期:</div>
                         <DatePicker v-model="addNews.date" type="date" placement="bottom-end" placeholder="Select date" style="width: 200px" />
                    </Space>
                    <FormItem    label="內容:" prop="content" :label-width="65" class="ivu-mb">
                      <Input v-model="addNews.content" type="textarea" :autosize="{minRows: 5,maxRows: 5}" placeholder="內容"></Input>
                    </FormItem> 
                  </Form>
              </Modal> 

          <Table class="Table" border :columns="columnsNews" :data="dataNews">
                  <template #action="{ row, index }">
                        
                    <Button  size="small" style="margin-right: 5px" @click="clickNewsEdit(index)">編輯</Button>
                    <Modal
                      title="編輯最新消息資訊"
                      ok-text="確認修改"
                      cancel-text="取消"
                      v-model="NewsEdit[index]"
                      width="700px"
                      :closable="true"
                      @on-ok="ok"
                      @on-cancel="cancel">
                      <Form
                        :model="addNews"
                        :label-width="80"
                        enctype="multipart/form-data"
                        method="post"  >
                        <FormItem label="消息編號"  :label-width="73">
                              <text>{{ addNews.number_News }}</text>
                        </FormItem>
                        <FormItem label="消息標題:" prop="title_news" :label-width="73" class="ivu-mb"  v-width="300">
                          <Input v-model="addNews.title_news" placeholder="aa" ></Input>
                        </FormItem>
                      
                        <FormItem label="消息照片" prop="img" :label-width="73">
                            <input  type="file" multiple />
                        </FormItem>
                        <Space size="large" wrap class="ivu-mb">
                            <div   style="font-size: 14px;color: #515a6e; padding: 8px 0; margin-left: 2px;">日期:</div>
                            <DatePicker v-model="addNews.date" type="date" placement="bottom-end" placeholder="Select date" style="width: 200px" />
                        </Space>
                        <FormItem    label="內容:" prop="content" :label-width="45" class="ivu-mb">
                          <Input v-model="addNews.content" type="textarea" :autosize="{minRows: 5,maxRows: 5}" placeholder="內容"></Input>
                        </FormItem> 
                      </Form>
                   </Modal>
                   <Button  size="small" @click="remove(index ,'News')">刪除</Button>
                  
                  </template>
          </Table>
          </div>
          <!-- Q&A -->
          <div v-if="changePage==3">
            <Button @click="modalQA = true" class="add ivu-mb">新增 +</Button> 
                <!-- 彈窗 -->
            <Modal
                  title="新增Q&A"
                  v-model="modalQA"
                  width="700px"
                  :closable="true">
                  <Form
                    :model="addQA"
                    :label-width="80"
                    enctype="multipart/form-data"
                    method="post"  >
                    <FormItem label="問題標題:" prop="title_QA" :label-width="70" class="ivu-mb"  v-width="300">
                      <Input v-model="addNews.title_QA" placeholder="標題" ></Input>
                    </FormItem>
                    <FormItem    label="問題答案:" prop="QA_anwer" :label-width="70" class="ivu-mb">
                      <Input v-model="addNews.QA_anwer" type="textarea" :autosize="{minRows: 5,maxRows: 5}" placeholder="內容"></Input>
                    </FormItem> 
                  </Form>
              </Modal> 
            <Table class="Table" border :columns="columnsQA" :data="dataQA">
                    <template #action="{ row, index }">
                      <Button  size="small" style="margin-right: 5px" @click="clickQAEdit(index)">編輯</Button>
                      <Modal
                      title="編輯問題資訊"
                      ok-text="確認修改"
                      cancel-text="取消"
                      v-model="QAEdit[index]"
                      width="700px"
                      :closable="true"
                      @on-ok="ok"
                      @on-cancel="cancel">
                      <Form
                        :model="addQA"
                        :label-width="80"
                        enctype="multipart/form-data"
                        method="post"  >
                      
                        <FormItem label="問題編號:" :label-width="75">
                              <text>{{ addQA.number_QA }}</text>
                        </FormItem>
                        <FormItem label="問題標題:" prop="title_QA" :label-width="75" class="ivu-mb"  v-width="300">
                          <Input v-model="addQA.title_QA" placeholder="標題" ></Input>
                        </FormItem>
                        <FormItem    label="問題答案:" prop="QA_anwer" :label-width="75" class="ivu-mb">
                          <Input v-model="addQA.QA_anwer" type="textarea" :autosize="{minRows: 5,maxRows: 5}" placeholder="內容"></Input>
                        </FormItem> 
                      </Form>
                   </Modal>
                    <Button  size="small" @click="remove(index ,'QA')">刪除</Button>
                    </template>
            </Table>



        </div>
         <!-- <img  v-width="60" src="../assets/image/more.svg" alt="more"> -->
           
      </Layout>
      
  </div>
</template>
<style  lang="scss">
@import "~@/assets/sass/page/_FEcontent.scss";

</style>

<script>
import Side from '@/components/SideNav.vue';
import axios from 'axios';

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
          

            defaultList: [
                    {
                        'name': 'image-demo-1.jpg',
                        'url': 'https://file.iviewui.com/images/image-demo-1.jpg'
                    },
                    
                ],
            imgName: '',
            visible: false,
            uploadList: [],
            modalTeam: false,//彈窗
            TeamEdit:[],
            columnsMem:[
                {
                  title: '團隊成員編號',
                  key: 'team_memno'
                },      
                {
                  title: '成員名稱',
                  key: 'team_memname'
                },      
                {
                  title: '成員照片路徑',
                  key: 'team_memimage'
                },      
                {
                  title: '成員職稱',
                  key: 'team_memjob'
                },      
                {
                  title: '成員經歷',
                  key: 'team_memexperience'
                }, 
                {
                  title: '編輯',
                  slot: 'action',
                },           
            ],
            // 彈窗資料
            addTeamItem:
            {
              team_memno: null,
              team_memname: '',
              memteam_memimage_img: '',
              team_memjob:'',
              team_memexperience:'',
            },
            
            dataMem:[
                {
                
                },
            ],
            NewsEdit:[],
            modalNews:false, //彈窗
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
                  title_news: 'aaaa',
                  img: '../assets/image/more.svg',
                  date:`1111/11/1`,
                  content:`111111`,
                },
            ],
            addNews:[
                {
                  number_News: null,
                  title_news: '',
                  img: '',
                  date:``,
                  content:``,
                },
            ],
            modalQA:false, //彈窗
            QAEdit:[],
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
                  width:140
                },           
            ],

            dataQA:[
                {
                  number_QA: 1,
                  title_QA: '問題標題',
                  QA_anwer:`QA_anwerQA_anwerQA_anwerQA_anwer`,
                
                },
            ],
            addQA:[
                {
                  number_QA: null,
                  title_QA: '',
             
                  QA_anwer:``,
                
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
            clickTeamEdit(index) {
                this.TeamEdit[index] = true;
                this.addTeamItem = { ...this.dataMem[index] };
            },
            clickNewsEdit(index){
                this.NewsEdit[index] = true;
                this.addNews = { ...this.dataNews[index] };
            },
            clickQAEdit(index){
                this.QAEdit[index] = true;
                this.addQA = { ...this.dataNews[index] };
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
          getTeamMem(){
            axios.get("http://localhost/PV/PVBackend/public/php/TeamMem.php")
          .then(response => {
              this.dataMem = response.data;
          })
          .catch(error => {
              console.error("There was an error fetching the TeamMem:", error);
          });
          },
          TeamEditPhp() {
          axios.post('http://localhost/PV/PVBackend/public/php/TeamMemEdit.php', this.addTeamItem)
              .then(response => {
                  console.log(response);
                  // this.dataMem = response.data; 
              })
              .catch(error => {
                  console.log(error);
              });
              this.getTeamMem();
          },
          
     
      },
      
        mounted() {
          this.getTeamMem();
         
          if (this.$refs.upload) {
              this.uploadList = this.$refs.upload.fileList;
          }
        },

        components: {
        Side
        },
    }

</script>
