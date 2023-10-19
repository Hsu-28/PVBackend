
<template>
  <div id="layoutFE">
    <Side :activePage='3' />
    <Button  to="/" class="out" style="width: 42px;height:32px;line-height: 35px; ">
      登出
    </Button>
    <Layout v-width="900" :style="{ marginLeft: '300px' }">
      <h1>內容管理</h1>
      <div class="buttonAll">
        <div direction="vertical" v-for="(item, index) in changePageText">
          <div @click="changeButton(index)" :class="[changePage == index ? 'thisPage' : 'buttonPage']">{{ item.text }}
          </div>
        </div>
      </div>
      <!-- 首頁輪播 -->
      <div v-if="changePage == 0">
        <Button @click="modalCarouse = true" class="add ivu-mb">新增 +</Button>
        <!-- 新增的彈窗 -->
        <Modal title="新增輪播照片" v-model="modalCarouse" width="700px" :closable="true" @on-ok="Carouseaddok"
          @on-cancel="cancel">
          <Form :model="addCarouse" :label-width="80" enctype="multipart/form-data" method="post">

            <FormItem label="照片標題:" prop="precautions" :label-width="120" class="ivu-mb" v-width="300">
              <Input v-model="addCarouse.carouse_title" placeholder="aa"></Input>
            </FormItem>

            <FormItem label="輪播照片:" prop="img" :label-width="120">
              <input type="file" id="theFile" class="theFile"
                @change="addCarouse.CarouseImageFile = $event.target.files[0]" />
            </FormItem>
          </Form>
        </Modal>

        <!-- 輪播欄位抬頭 -->
        <Table class="Table" border :columns="columnsCarouse" :data="dataCarouse">
          <template #action="{ row, index }">

            <Button size="small" style="margin-right: 5px" @click="clickCarouseEdit(index)">編輯</Button>
            <!-- 編輯的程式@on-ok="newseditok" -->
            <Modal title="輪播照片資訊" ok-text="確認修改" cancel-text="取消" v-model="CarouseEdit[index]" width="700px"
              :closable="true" @on-ok="carouseeditok" @on-cancel="cancel">
              <Form @submit.prevent :model="addCarouse" :label-width="80">
                <FormItem label="照片編號" :label-width="73">
                  <text>{{ addCarouse.carouse_no }}</text>
                </FormItem>
                <FormItem label="照片標題:" prop="carouse_title" :label-width="73" class="ivu-mb" v-width="300">
                  <Input name="carouse_title" v-model="addCarouse.carouse_title" type="textarea" placeholder="內容"></Input>
                  <!-- 編輯的程式 name="news_title"-->
                </FormItem>
                <FormItem label="輪播照片" prop="carouse_img" :label-width="73">
                  <input type="file" id="theFile" class="theFile"
                    @change="addCarouse.CarouseImageFile = $event.target.files[0]" />
                </FormItem>
              </Form>
            </Modal>
            <Button size="small" @click="remove(index, 'Carouse')">刪除</Button>

          </template>
        </Table>
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
        <Modal title="新增最新消息" v-model="modalNews" width="700px" :closable="true" @on-ok="Newsaddok" @on-cancel="cancel">
          <Form :model="addNews" :label-width="80" enctype="multipart/form-data" method="post">

            <FormItem label="最新消息標題:" prop="precautions" :label-width="120" class="ivu-mb" v-width="300">
              <Input v-model="addNews.news_title" placeholder="aa"></Input>
            </FormItem>
            <FormItem label="最新消息照片:" prop="img" :label-width="120">
              <input type="file" class="theFile" @change="addNews.NewsImageFile = $event.target.files[0]" />
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

                <FormItem label="消息照片" prop="news_img" :label-width="73">
                  <input type="file" id="theFile" class="theFile"
                    @change="addNews.NewsImageFile = $event.target.files[0]" />
                  <img class="img1" src="" :alt="addNews.news_image" width="100">
                  <textarea name="news_image" class="photoname" cols="70" rows="5">{{ addNews.news_image }}</textarea>
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
      // tempImageFile: null,
      clickEditBtnT: false,
      memore: 0,
      changePage: 0,
      banner: [],
      changePageText: [
        { text: '首頁輪播' },
        { text: '團隊介紹' },
        { text: '最新消息' },
        { text: 'Q&A' },
      ],

      CarouseEdit: [],
      modalCarouse: false, //彈窗
      columnsCarouse: [
        {
          title: '消息編號',
          key: 'carouse_no',
          width: 100,
        },
        {
          title: '消息標題',
          key: 'carouse_title',
          width: 250,
        },
        {
          title: '消息照片路徑',
          key: 'carouse_image',
          width: 250,
        },
        {
          title: '編輯',
          slot: 'action',

        },
      ],
      dataCarouse: [],

      addCarouse:
      {
        carouse_no: null,
        CarouseImageFile: null,
        carouse_title: '',
        carouse_image: '',
      },

      imgName: '',
      visible: false,
      modalTeam: false,//彈窗
      TeamEdit: [],
      columnsMem: [
        {
          title: '成員編號',
          key: 'team_memno',
          width: 70,

        },
        {
          title: '成員名稱',
          key: 'team_memname',
          width: 180,
        },
        {
          title: '成員照片路徑',
          key: 'team_memimage',
          width: 165,
        },
        {
          title: '成員職稱',
          key: 'team_memjob',
          width: 165,
        },
        {
          title: '成員經歷',
          key: 'team_memexperience'

        },
        {
          title: '編輯',
          slot: 'action',
          width: 90
        },
      ],
      // 彈窗資料
      addTeamItem:
      {
        team_memimage: '',
        TeamImageFile: null,
        team_memno: null,
        team_memname: '',
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

      addNews:
      {
        news_no: null,
        NewsImageFile: null,
        news_title: '',
        news_image: '',
        news_date: ``,
        news_content: ``,
      },

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

    //  addNews(event) {
    //     let fileInput = event.target;
    //     if (fileInput.files.length > 0) {
    //       let photo = fileInput.files[0];

    //       let img = fileInput.nextElementSibling;
    //       let textarea = img.nextElementSibling;

    //       textarea.value = photo.name;

    //       let reader = new FileReader();
    //       reader.onload = function (e) {
    //         img.src = e.target.result;
    //       }
    //       reader.readAsDataURL(photo);
    //     }
    //   },

    //編輯的程式
    carouseeditok() {
      console.log(this.addCarouse)
      const fd = new FormData()
      fd.append('carouse_no', this.addCarouse.carouse_no);
      fd.append('carouse_title', this.addCarouse.carouse_title);
      fd.append('carouse_image', this.addCarouse.carouse_image);
      fd.append('carouse_imageFile', this.addCarouse.CarouseImageFile);

      axios.post('http://localhost/PV/PVBackend/public/php/carouseUpdateToDb.php', fd)
        .then(response => {
          console.log(response)
          axios.get('http://localhost/PV/PVBackend/public/php/carouse.php')
            .then(response => {
              this.dataCarouse = response.data;
              console.log(this.dataCarouse);
            })
            .catch(error => {
              console.error(error);
            });
        })
        .catch(error => {
          console.error(error);
        });
    },
    Carouseaddok() {
      const fd = new FormData()
      fd.append('carouse_title', this.addCarouse.carouse_title);
      fd.append('carouse_image', this.addCarouse.CarouseImageFile);

      axios.post('http://localhost/PV/PVBackend/public/php/addCarouse.php', fd)
        .then(response => {
          axios.get('http://localhost/PV/PVBackend/public/php/carouse.php')
            .then(response => {
              this.dataCarouse = response.data;
              console.log(this.dataCarouse);
            })
            .catch(error => {
              console.error(error);
            });
        })
        .catch(error => {
          console.log(error)
        });
    },
    cancel() { },

    newseditok() {
      console.log(this.addNews)
      const fd = new FormData()
      const date = new Date(this.addNews.news_date)
      fd.append('news_no', this.addNews.news_no);
      fd.append('news_title', this.addNews.news_title);
      fd.append('news_content', this.addNews.news_content);
      fd.append('news_image', this.addNews.news_image);
      fd.append('news_imageFile', this.addNews.NewsImageFile);
      // let theFile = document.getElementById('theFile').files[0];
      // fd.append('news_image', theFile);
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
    Newsaddok() {
      const fd = new FormData()
      const date = new Date(this.addNews.news_date)
      fd.append('news_title', this.addNews.news_title);
      fd.append('news_content', this.addNews.news_content);
      fd.append('news_image', this.addNews.NewsImageFile);
      fd.append('news_date', `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`);

      axios.post('http://localhost/PV/PVBackend/public/php/addNews.php', fd)
        .then(response => {
          axios.get('http://localhost/PV/PVBackend/public/php/news.php')
            .then(response => {
              this.dataNews = response.data;
            })
            .catch(error => {
              console.error(error);
            });
        })
        .catch(error => {
          console.log(error)
        });
    },
    cancel() { },

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
              axios.get('http://localhost/PV/PVBackend/public/php/faq.php')
                .then(response => {
                  this.dataQA = response.data;
                  console.log(this.dataQA)
                })
                .catch(error => {
                  console.error(error);
                });
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
          axios.get('http://localhost/PV/PVBackend/public/php/faq.php')
            .then(response => {
              this.dataQA = response.data;
              console.log(this.dataQA)
            })
            .catch(error => {
              console.error(error);
            });
        })
        .catch(error => {
          console.log(error)
        });
    },
    cancel() { },


    changeButton(index) {

      this.changePage = index;
      console.log(this.changePage);
    },
    clickCarouseEdit(index) {
      this.CarouseEdit[index] = true;
      this.addCarouse = { ...this.dataCarouse[index] };
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
      } else if (type === 'Carouse') {
        let carouse_no = this.dataCarouse[index].carouse_no;
        console.log(carouse_no);
        axios.post('http://localhost/PV/PVBackend/public/php/carouseDelete.php', {
          carouse_no: carouse_no
        })
          .then(response => {
            console.log(response.dataCarouse);
            this.dataCarouse.splice(index, 1);  // 從前端數據中移除該筆訂單
          })
          .catch(error => {
            console.log(error);
            console.log(error.response);
          });
      } else if (type === 'News') {
        let news_no = this.dataNews[index].news_no;
        console.log(news_no);
        axios.post('http://localhost/PV/PVBackend/public/php/newsDelete.php', {
          news_no: news_no
        })
          .then(response => {
            console.log(response.dataNews);
            this.dataNews.splice(index, 1);  // 從前端數據中移除該筆訂單
          })
          .catch(error => {
            console.log(error);
            console.log(error.response);
          });

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

      axios.post('http://localhost/PV/PVBackend/public/php/TeamMemEdit.php', fd, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
        .then(response => {
          console.log(response);
          this.getTeamMem();
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
    axios.get('http://localhost/PV/PVBackend/public/php/carouse.php')
      .then(response => {
        this.dataCarouse = response.data;
        console.log(this.dataCarouse);
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