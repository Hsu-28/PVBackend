<template>
  <div class=" layout">
    <Side :activePage='8' />
    <button class="out" style="width: 42px;height:32px;line-height: 35px;">
      登出
    </button>
    <Layout v-width="900" :style="{ marginLeft: '300px' }">
      <div v-if="showMore == 1">
        <h1>聊天機器人</h1>
        <!-- <Button @click="news = true" class="add">新增 +</Button> -->
        <!-- <Button @click="news(index)" class="add">新增 +</Button> -->
        <Button @click="news(index)" class="add">新增 +</Button>
        <!-- 彈窗 -->
        <Modal title="新增聊天機器人" ok-text="確認新增" cancel-text="取消" v-model="RTnews[index]" width="700px" :closable="true"
          @on-ok="RTaddok" @on-cancel="cancel">
          <!-- 新增資料 v-model="RTnews[index]" -->
          <Form :model="addRobot" :label-width="80" enctype="multipart/form-data" method="post">
            <FormItem label="關鍵字:" prop="keyword" :label-width="70" class="ivu-mb" v-width="300">
              <Input v-model="addRobot.keyword" type="text" placeholder="關鍵字"></Input>
            </FormItem>
            <FormItem label="回覆:" prop="chat_ans" :label-width="70" class="ivu-mb">
              <Input v-model="addRobot.chat_ans" type="textarea" :autosize="{ minRows: 5, maxRows: 5 }"
                placeholder="內容"></Input>
            </FormItem>
          </Form>
        </Modal>
        <Table class="Table" border :columns="columns" :data="data">
          <template #action="{ row, index }">
            <Button size="small" style="margin-right: 5px" @click="clickRtEdit(index)">編輯</Button>
            <Modal title="編輯問題資訊" ok-text="確認修改" cancel-text="取消" v-model="RTEdit[index]" width="700px" :closable="true"
              @on-ok="RTeditok" @on-cancel="cancel">
              <Form :model="addRobot" :label-width="80" enctype="multipart/form-data" method="post">
                <FormItem label="編號:" :label-width="75">
                  <text>{{ addRobot.chat_no }}</text>
                  <!-- <text name="chat_no" v-text="addRobot.faq_no"></text> -->
                </FormItem>
                <FormItem label="問題標題:" prop="keyword" :label-width="75" class="ivu-mb" v-width="300">
                  <Input name="keyword" v-model="addRobot.keyword" type="textarea" placeholder="標題"></Input>
                </FormItem>
                <FormItem label="問題答案:" prop="chat_ans" :label-width="75" class="ivu-mb">
                  <Input name="chat_ans" v-model="addRobot.chat_ans" type="textarea"
                    :autosize="{ minRows: 5, maxRows: 5 }" placeholder="內容"></Input>
                </FormItem>
              </Form>
            </Modal>

            <Button size="small" @click="remove(index)">刪除</Button>
          </template>
        </Table>
        <!-- <Page class="nextPage" :total="40" size="20" /> -->
      </div>
    </Layout>
  </div>
</template> 
<style scoped lang="scss">
@import "~@/assets/sass/page/_Robot.scss";
</style>
<script>
import Side from '@/components/SideNav.vue';
import axios from 'axios';

export default {
  data() {
    return {
      showMore: 1,
      // news: false,
      RTEdit: [],
      RTnews: [], //新增資料
      columns: [
        {
          title: '編號',
          key: 'chat_no',
          width: 80
        },
        {
          title: '問題',
          key: 'keyword',
          width: 190
        },
        {
          title: '回覆',
          key: 'chat_ans',
        },
        {
          title: '編輯',
          slot: 'action',
          width: 150
        },
      ],
      data: [],
      addRobot: {
        chat_no: null,
        keyword: '',
        chat_ans: '',
      },
    }
  },
  components: {
    Side
  },
  methods: {
    clickRtEdit(index) {
      this.RTEdit[index] = true;
      this.addRobot = { ...this.data[index] };
    },
    RTeditok() {
      console.log(this.addRobot)
      const fd = new FormData()
      fd.append('chat_no', this.addRobot.chat_no);
      fd.append('keyword', this.addRobot.keyword);
      fd.append('chat_ans', this.addRobot.chat_ans);

      // axios.post('http://localhost/PV/PVBackend/public/php/chatbotUpdateToDb.php', fd)
      axios.post(`${this.$store.state.phpPublicPath}chatbotUpdateToDb.php`, fd)
        .then(response => {
          console.log(response)
          // axios.get('http://localhost/PV/PVBackend/public/php/chatbot.php')
          axios.get(`${this.$store.state.phpPublicPath}chatbot.php`)
            .then(response => {
              this.data = response.data;
              console.log(this.data);
            })
            .catch(error => {
              console.error(error);
            });
        })
        .catch(error => {
          console.error(error);
        });
    },

    // 新增資料
    news(index) {
      this.RTnews[index] = true;
      // this.addRobot = { ...this.data[index] };
    },
    // 新增資料-確認按鈕
    RTaddok() {
      // 傳送
      const data = {
        keyword: this.addRobot.keyword,
        chat_ans: this.addRobot.chat_ans
      };
      axios.post(`${this.$store.state.phpPublicPath}addChatbot.php`, data, {
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
    More() {
      this.showMore = 2;

    },
    reTable() {
      this.showMore = 1;

    },
    remove(index) {
      // this.data.splice(index, 1);
      let chat_no = this.data[index].chat_no;
      console.log(chat_no);
      axios.post(`${this.$store.state.phpPublicPath}chatDelete.php`, {
        chat_no: chat_no
      })
        .then(response => {
          console.log(response.data);
          this.data.splice(index, 1);  // 從前端數據中移除該筆訂單
        })
        .catch(error => {
          console.log(error);
          console.log(error.response);
        });
    },
  },
  created() {
    axios.get(`${this.$store.state.phpPublicPath}chatbot.php`)
      .then(response => {
        this.data = response.data;
        console.log(this.data);
      })
      .catch(error => {
        console.error(error);
      });
  }
}
</script>