
<template>
  <div id="layoutFE">
    <Side :activePage='3' />
    <button class="out" style="width: 42px;height:32px;line-height: 35px; ">
      登出
    </button>
    <Layout v-width="900" :style="{ marginLeft: '300px' }">
      <h1>內容管理</h1>
      <div class="buttonAll">
        <div direction="vertical" v-for="(item, index) in changePageText">
          <div @click="changeButton(index)" :class="[changePage == index ? 'thisPage' : 'buttonPage']">{{ item.text }}
          </div>
        </div>
      </div>
      <div v-if="changePage == 0">
        <div class="demo-upload-list" v-for="item in uploadList">
          <template class="upimg" v-if="item.status === 'finished'">
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

        <Upload ref="upload" :show-upload-list="false" :default-file-list="defaultList" :on-success="handleSuccess"
          :format="['jpg', 'svg', 'png']" :max-size="4096" :on-format-error="handleFormatError"
          :on-exceeded-size="handleMaxSize" :before-upload="handleBeforeUpload" multiple type="drag"
          action="//jsonplaceholder.typicode.com/posts/" style="display: inline-block;width:58px;">
          <Button icon="md-camera" style="width: 58px;height:58px;line-height: 58px;">
            <!-- <Icon icon="md-camera" size="20"/> -->
          </Button>

        </Upload>
        <Button style="width: 58px;height:58px;line-height: 58px; margin-bottom: 52px; margin-left: 20px;">
          確認
        </Button>
        <ImagePreview class="wwww" v-model="visible" :preview-list="['https://file.iviewui.com/images/' + imgName]" />
      </div>
      <!-- 團隊介紹 -->
      <div v-if="changePage == 1">
        <!-- <Button @click="modalTeam = true" class="add ivu-mb">新增 +</Button> -->
        <!-- 彈窗 -->
        <Modal title="新增團隊" v-model="modalTeam" width="700px" :closable="true">
          <Form :model="addTeamItem" :label-width="80" enctype="multipart/form-data" method="post">
            <FormItem label="姓名:" prop="precautions" :label-width="45" class="ivu-mb" v-width="200">
              <Input v-model="addTeamItem.name" placeholder="aa"></Input>

            </FormItem>

            <FormItem label="照片" prop="mem_img" :label-width="40">
              <input type="file" />
            </FormItem>
            <FormItem v-width="200" label="職稱:" prop="job" :label-width="45" class="ivu-mb">
              <Input v-model="addTeamItem.job" placeholder="職稱"></Input>
            </FormItem>
            <FormItem label="經歷:" prop="exp" :label-width="45" class="ivu-mb">
              <Input v-model="addTeamItem.exp" type="textarea" :autosize="{ minRows: 5, maxRows: 5 }"
                placeholder="經歷"></Input>
            </FormItem>
          </Form>
        </Modal>
        <Table id="TableFE" border :columns="columnsMem" :data="dataMem">
          <template #action="{ row, index }">
            <Button size="small" style="margin-right: 5px" @click="clickTeamEdit(index)">編輯</Button>
            <Modal title="編輯團隊資訊" ok-text="確認修改" cancel-text="取消" v-model="TeamEdit[index]" width="700px" :closable="true"
              @on-ok="TeamEditPhp" @on-cancel="cancel">
              <Form :model="addTeamItem" :label-width="80" enctype="multipart/form-data" method="post">
                <FormItem label="團隊編號" :label-width="68">
                  <text>{{ addTeamItem.team_memno }}</text>
                </FormItem>
                <FormItem label="姓名:" prop="precautions" :label-width="45" class="ivu-mb" v-width="200">
                  <Input v-model="addTeamItem.team_memname" placeholder="aa"></Input>
                </FormItem>
                <!-- 照片上傳 -->
                <FormItem label="照片" prop="mem_img" :label-width="40">
                  <input type="file" @change="addTeamItem.TeamImageFile = $event.target.files[0]" id="TeamImageFile"
                    name="TeamImageFile" />

                </FormItem>
                <FormItem v-width="200" label="職稱:" prop="job" :label-width="45" class="ivu-mb">
                  <Input v-model="addTeamItem.team_memjob" placeholder="職稱"></Input>
                </FormItem>
                <FormItem label="經歷:" prop="exp" :label-width="45" class="ivu-mb">
                  <Input v-model="addTeamItem.team_memexperience" type="textarea" :autosize="{ minRows: 5, maxRows: 5 }"
                    placeholder="經歷"></Input>
                </FormItem>
              </Form>
            </Modal>
            <!-- @click="clickEditBtn(index, row)" -->
            <!-- <Button size="small" @click="remove(index, 'Mem')">刪除</Button> -->

          </template>

        </Table>


      </div>
      <!-- 最新消息 -->
      <div v-if="changePage == 2">
        <Button @click="modalNews = true" class="add ivu-mb">新增 +</Button>
        <!-- 新增的彈窗 -->
        <Modal title="新增最新消息" v-model="modalNews" width="700px" :closable="true">
          <Form :model="addNews" :label-width="80" enctype="multipart/form-data" method="post">

            <FormItem label="最新消息標題:" prop="precautions" :label-width="120" class="ivu-mb" v-width="300">
              <Input v-model="addNews.news_title" placeholder="aa"></Input>
            </FormItem>
            <FormItem label="最新消息照片:" prop="img" :label-width="120">
              <input type="file" multiple />
            </FormItem>
            <Space size="large" wrap class="ivu-mb">
              <div style="font-size: 14px;color: #515a6e; padding: 8px 0; margin-left: 20px;">日期:</div>
              <DatePicker v-model="addNews.news_date" type="date" placement="bottom-end" placeholder="Select date"
                style="width: 200px" />
            </Space>
            <FormItem label="內容:" prop="content" :label-width="65" class="ivu-mb">
              <Input v-model="addNews.news_content" type="textarea" :autosize="{ minRows: 5, maxRows: 5 }"
                placeholder="內容"></Input>
            </FormItem>
          </Form>
        </Modal>

        <!-- news欄位抬頭 -->
        <Table class="Table" border :columns="columnsNews" :data="dataNews">
          <template #action="{ row, index }">

            <Button size="small" style="margin-right: 5px" @click="clickNewsEdit(index)">編輯</Button>
            <!-- 編輯的程式@on-ok="newseditok" -->
            <Modal title="編輯最新消息資訊" ok-text="確認修改" cancel-text="取消" v-model="NewsEdit[index]" width="700px"
              :closable="true" @on-ok="newseditok" @on-cancel="cancel">

              <Form @submit.prevent :model="addNews" :label-width="80">
                <FormItem label="消息編號" :label-width="73">
                  <text>{{ addNews.news_no }}</text>
                </FormItem>
                <FormItem label="消息標題:" prop="title_news" :label-width="73" class="ivu-mb" v-width="300">
                  <Input name="news_title" v-model="addNews.news_title" type="textarea" placeholder="內容"></Input>
                  <!-- 編輯的程式 name="news_title"-->
                </FormItem>

                <FormItem label="消息照片" prop="img" :label-width="73">
                  <!-- <input name="news_image" @change="tempImageFile = $event.target.files[0]" type="file"
                    style="width: 150px; height: 40px;"> -->
                  <input type="file" id="theFile" @change="tempImageFile" />
                  <img :src="addNews.news_image" :alt="addNews.news_image" id="img1" width="100">
                  <textarea name="news_image" id="photoname" cols="70" rows="5">{{ addNews.news_image }}</textarea>

                  <!-- <img width="200" height="200" v-show="!tempImageFile" :src="`/${addNews.news_image}`" alt=""> -->
                </FormItem>
                <Space size="large" wrap class="ivu-mb">
                  <div style="font-size: 14px;color: #515a6e; padding: 8px 0; margin-left: 2px;">日期:</div>
                  <DatePicker name="news_date" v-model="addNews.news_date" type="date" placement="bottom-end"
                    placeholder="Select date" style="width: 200px" />
                </Space>
                <FormItem label="內容:" prop="content" :label-width="45" class="ivu-mb">
                  <Input name="news_content" v-model="addNews.news_content" type="textarea"
                    :autosize="{ minRows: 5, maxRows: 5 }" placeholder="內容"></Input>
                </FormItem>
              </Form>
            </Modal>
            <Button size="small" @click="remove(index, 'News')">刪除</Button>

          </template>
        </Table>
      </div>
      <!-- Q&A -->
      <div v-if="changePage == 3">
        <Button @click="newQA(index)" class="add ivu-mb">新增 +</Button>
        <!-- 彈窗 -->
        <Modal title="新增Q&A" ok-text="確認新增" cancel-text="取消" v-model="QAnew[index]" width="700px" :closable="true"
          @on-ok="QAaddok" @on-cancel="cancel">
          <Form :model="editQA" :label-width="80" enctype="multipart/form-data" method="post">
            <FormItem label="編號:" prop="faq_no" :label-width="70" class="ivu-mb" v-width="300">
              <Input v-model="editQA.faq_no" placeholder="編號"></Input>
            </FormItem>
            <FormItem label="標題:" prop="question" :label-width="70" class="ivu-mb" v-width="300">
              <Input v-model="editQA.question" placeholder="標題"></Input>
            </FormItem>
            <FormItem label="回覆:" prop="question_ans" :label-width="70" class="ivu-mb">
              <Input v-model="editQA.question_ans" type="textarea" :autosize="{ minRows: 5, maxRows: 5 }"
                placeholder="內容"></Input>
            </FormItem>
          </Form>
        </Modal>
        <Table class="Table" border :columns="columnsQA" :data="dataQA">
          <template #action="{ row, index }">
            <Button size="small" style="margin-right: 5px" @click="clickQAEdit(index)">編輯</Button>
            <Modal title="編輯問題資訊" ok-text="確認修改" cancel-text="取消" v-model="QAEdit[index]" width="700px" :closable="true"
              @on-ok="QAeditok" @on-cancel="cancel">
              <Form :model="editQA" :label-width="80" enctype="multipart/form-data" method="post">
                <FormItem label="問題編號:" :label-width="75">
                  <text name="faq_no" v-text="editQA.faq_no"></text>
                </FormItem>
                <FormItem label="問題標題:" :label-width="75" class="ivu-mb" v-width="300">
                  <Input name="question" v-model="editQA.question" type="textarea" placeholder="標題"></Input>
                </FormItem>
                <FormItem label="問題答案:" :label-width="75" class="ivu-mb">
                  <Input name="question_ans" v-model="editQA.question_ans" type="textarea"
                    :autosize="{ minRows: 5, maxRows: 5 }" placeholder="內容"></Input>
                </FormItem>
              </Form>
            </Modal>
            <Button size="small" @click="remove(index, 'QA')">刪除</Button>
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
  data() {
    return {
      tempImageFile: null,
      clickEditBtnT: false,
      memore: 0,
      changePage: 0,
      banner: [],
      changePageText: [
        { text: '首頁照片' },
        { text: '團隊介紹' },
        { text: '最新消息' },
        { text: 'Q&A' },
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
      TeamEdit: [],
      columnsMem: [
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
        team_memjob: '',
        team_memexperience: '',
      },

      dataMem: [],
      NewsEdit: [],
      modalNews: false, //彈窗
      columnsNews: [
        {
          title: '消息編號',
          key: 'news_no',
          width: 70,
        },
        {
          title: '消息標題',
          key: 'news_title',
          width: 120,
        },
        {
          title: '消息照片路徑',
          key: 'news_image',
          width: 100,
        },
        {
          title: '日期',
          key: 'news_date',
          width: 120,
        },
        {
          title: '內容',
          key: 'news_content'
        },
        {
          title: '編輯',
          slot: 'action',
          width: 80,
        },
      ],
      dataNews: [],
      // dataNews: [
      //   {
      //     number_News: 1,
      //     title_news: 'aaaa',
      //     img: '../assets/image/more.svg',
      //     date: `1111/11/1`,
      //     content: `111111`,
      //   },
      // ],
      addNews: [
        {
          news_no: null,
          news_title: '',
          news_image: '',
          news_date: ``,
          news_content: ``,
        },
      ],
      // newQA: false, //彈窗
      dataQA: [], //新增資料
      QAEdit: [],
      QAnew: [],
      columnsQA: [
        {
          title: '問題編號',
          key: 'faq_no',
          width: 100
        },
        {
          title: '問題標題',
          key: 'question',
          width: 300
        },
        {
          title: '問題答案',
          key: 'question_ans',
        },
        {
          title: '編輯',
          slot: 'action',
          width: 90
        },
      ],
      editQA: [
        {
          faq_no: '',
          question: '',
          question_ans: ''
        }
      ]
    }
  },


  methods: {
    tempImageFile() {
      const fileInput = document.getElementById('theFile');
      if (fileInput.files.length > 0) {
        this.addNews.news_image = fileInput.files[0].name;
      } else {
        this.addNews.news_image = ''; // 如果未選擇檔案，清空資料
      }
    },

    //編輯的程式
    newseditok() {
      console.log(this.addNews)
      const fd = new FormData()
      const date = new Date(this.addNews.news_date)
      fd.append('news_no', this.addNews.news_no);
      fd.append('news_title', this.addNews.news_title);
      fd.append('news_content', this.addNews.news_content);
      //fd.append('news_image', this.addNews.news_image);
      let theFile = document.getElementById('theFile').files[0];
      fd.append('news_image', theFile);
      fd.append('news_date', `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`);

      axios.post('http://localhost/PV/PVBackend/public/php/newsUpdateToDb.php', fd)
        .then(response => {
          console.log(response)

          axios.get('http://localhost/PV/PVBackend/public/php/news.php')
            .then(response => {
              this.dataNews = response.data;
              console.log(this.dataNews);
            })
            .catch(error => {
              console.error(error);
            });
        })
        .catch(error => {
          console.error(error);
        });
    },
    QAeditok() {
      console.log(this.editQA)
      const fd = new FormData()
      fd.append('faq_no', this.editQA.faq_no);
      fd.append('question', this.editQA.question);
      fd.append('question_ans', this.editQA.question_ans);

      axios.post('http://localhost/PV/PVBackend/public/php/faqUpdateToDb.php', fd)
        .then(response => {
          console.log(response)
          axios.get('http://localhost/PV/PVBackend/public/php/faq.php')
            .then(response => {
              this.dataQA = response.data;
              console.log(this.dataQA);
            })
            .catch(error => {
              console.error(error);
            });
        })
        .catch(error => {
          console.error(error);
        });
    },
    newQA(index) {
      this.QAnew[index] = true;
    },
    QAaddok() {
      // 傳送
      const dataQA = {
        faq_no: this.editQA.faq_no,
        question: this.editQA.question,
        question_ans: this.editQA.question_ans,
      };
      axios.post('http://localhost/PV/PVBackend/public/php/addFaq.php', dataQA, {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })
        .then(response => {
          console.log(response)
        })
        .catch(error => {
          console.log(error)
        });
    },
    cancel() { },
    handleView(name) {
      this.imgName = name;
      this.visible = true;
    },
    handleRemove(file) {
      const fileList = this.$refs.upload.fileList;
      this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
    },
    handleSuccess(res, file) {

      //   // this.uploadList = [];

      //   file.url = 'https://file.iviewui.com/images/image-demo-3.jpg';
      //   file.name = 'image-demo-3.jpg';
      //   // this.uploadList.push(file);
      //   this.uploadList = [file];

    },
    handleFormatError(file) {
      this.$Notice.warning({
        title: 'The file format is incorrect',
        desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
      });
    },
    handleMaxSize(file) {
      this.$Notice.warning({
        title: 'Exceeding file size limit',
        desc: 'File  ' + file.name + ' is too large, no more than 2M.'
      });
    },
    handleBeforeUpload() {
      const check = this.uploadList.length < 5;
      if (!check) {
        this.$Notice.warning({
          title: 'Up to five pictures can be uploaded.'
        });
      }
      return check;
    },
    changeButton(index) {

      this.changePage = index;
      console.log(this.changePage);
    },
    clickTeamEdit(index) {
      this.TeamEdit[index] = true;
      this.addTeamItem = { ...this.dataMem[index] };
    },
    clickNewsEdit(index) {
      this.NewsEdit[index] = true;
      this.addNews = { ...this.dataNews[index] };
    },
    clickQAEdit(index) {
      this.QAEdit[index] = true;
      this.editQA = { ...this.dataQA[index] };
    },
    remove(index, type) {
      if (type === 'Mem') {
        this.dataMem.splice(index, 1);
      } else if (type === 'News') {

        this.dataNews.splice(index, 1);
      } else if (type === 'QA') {
        // this.dataQA.splice(index, 1);
        let faq_no = this.dataQA[index].faq_no;
        console.log(faq_no);
        axios.post('http://localhost/PV/PVBackend/public/php/faqDelete.php', {
          faq_no: faq_no
        })
          .then(response => {
            console.log(response.dataQA);
            this.dataQA.splice(index, 1);  // 從前端數據中移除該筆訂單
          })
          .catch(error => {
            console.log(error);
            console.log(error.response);
          });
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
    getTeamMem() {
      axios.get("http://localhost/PV/PVBackend/public/php/TeamMem.php")
        .then(response => {
          this.dataMem = response.data;
        })
        .catch(error => {
          console.error("There was an error fetching the TeamMem:", error);
        });
    },
    TeamEditPhp() {
      const fd = new FormData()
      fd.append('team_memno', this.addTeamItem.team_memno);
      fd.append('team_memname', this.addTeamItem.team_memname);
      fd.append('team_memimageFile', this.addTeamItem.TeamImageFile);
      fd.append('team_memimage', this.addTeamItem.team_memimage);
      fd.append('team_memjob', this.addTeamItem.team_memjob);
      fd.append('team_memexperience', this.addTeamItem.team_memexperience);
      axios.post('http://localhost/PV/PVBackend/public/php/TeamMemEdit.php', fd
        // headers: {
        //     'Content-Type': 'multipart/form-data'
        // }
      )
        .then(response => {
          console.log(response);
          // this.dataMem = response.data; 
        })
        .catch(error => {
          console.log(error);
        });

      // this.getTeamMem();
    },

  },

  mounted() {
    this.getTeamMem();
    if (this.$refs.upload) {
      this.uploadList = this.$refs.upload.fileList;
    }
  },

  cancelEdit() {
    this.addItem = { ...this.resetItem };
  },
  getTeamMem() {
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

  mounted() {
    this.getTeamMem();
    if (this.$refs.upload) {
      this.uploadList = this.$refs.upload.fileList;
    }
  },
  components: {
    Side
  },


  created() {
    axios.get('http://localhost/PV/PVBackend/public/php/banner.php')
      .then(response => {
        this.banner = response.data;
        console.log(this.banner);
        // this.defaultList[0].url =this.banner.banner_pic; 
      })
      .catch(error => {
        console.error(error);
      });


    axios.get('http://localhost/PV/PVBackend/public/php/news.php')
      .then(response => {
        this.dataNews = response.data;
        console.log(this.dataNews);
      })
      .catch(error => {
        console.error(error);
      });

    axios.get('http://localhost/PV/PVBackend/public/php/faq.php')
      .then(response => {
        this.dataQA = response.data;
        console.log(this.dataQA)
      })
      .catch(error => {
        console.error(error);
      });
  }
}

</script>