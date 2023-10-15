<template>
  <div class=" layout">
    <Side :activePage='5' />
    <button class="out" style="width: 42px;height:32px;line-height: 35px;">
      登出
    </button>
    <Layout v-width="900" :style="{ marginLeft: '300px' }">
      <h1>訂單</h1>

      
      <div v-if="showMore == 1">
        <Space style="margin-bottom: 10px; margin-right: 20px;">
          訂單編號:
          <Input v-model="searchOrder" @on-change="handleSearch1"
                 placeholder="訂單編號" style="width: 150px" />
        </Space>
        <Space style="margin-bottom: 10px;">
          會員編號:
          <Input v-model="searchNumberMem" @on-change="handleSearch1" 
                placeholder="會員編號" style="width: 150px" />
        </Space>
        <Table class="Table" border :columns="columns" :data="data">
          <!-- 渲染資料 -->
          <template #action="{ row, index }">
            <Button size="small" style="margin-right: 5px" @click="oindex = index; More(oindex)">編輯</Button>
            <Button size="small" @click="remove(index)">刪除</Button>
          </template>
        </Table>
        <!-- <Page class="nextPage" :total="40" size="" /> -->
      </div>

      <!-- //第二層 -->
      <div class="showAll" v-if="showMore==2">
       
        <p>訂單編號： <span>{{data[oindex].orders_no}}</span></p>
            <p>會員編號: <span>{{data[oindex].mem_no}}</span></p>
            <p>出團編號： <span>{{data[oindex].trip_no}}</span></p>
            <p>報名人數： <span>{{data[oindex].ord_people}}</span></p>
            <p>訂購日期：<span>{{data[oindex].orders_date}}</span></p>
            <p>總金額： <span>{{data[oindex].total_amount}}</span></p>
            <!-- <p>付款狀態： <span>{{data[oindex].payState}}</span></p> -->
            <p>訂單狀態： <span>{{data[oindex].orders_stat}}</span></p>
           
            <div>
                <Button  size="small" style="margin-right: 5px" @click=" passenger()">乘客總覽</Button>
                <Button  size="small" style="margin-right: 5px" @click="reTable()">返回</Button>


            </div>
      </div>


      <!-- //第三層 -->
      <div v-if="showMore==3">
        <div v-for="(passengerMore, index) in passengerDetail" :key="index">
          <p  class="ivu-mb">乘客 {{index+1}}</p>
          <p class="ivu-mb">旅客編號：  <span>{{passengerMore.passenger_no}}</span></p>
              <p class="ivu-mb">姓名： <span>{{passengerMore.passenger_name}}</span></p>
              <p class="ivu-mb">性別： <span>{{passengerMore.passenger_gender}}</span></p>
              <p class="ivu-mb">生日： <span>{{passengerMore.birthday }}</span></p>
              <p class="ivu-mb">國籍： <span>{{passengerMore.passenger_nationality}}</span></p>
              <p class="ivu-mb">護照號碼：<span>{{passengerMore.passport}}</span></p>
              <div style="width:600px; ">
                <p>健康審核</p>
                 
                  <Select v-model="passengerMore.health_check" style="width:200px; "  class="ivu-mb" >
                    <Option value="審核中" label="審核中">
                        <span>審核中</span>
                      
                      </Option>
                      <Option value="通過" label="通過">
                          <span>通過</span>
                      </Option>
                      <Option value="未通過" label="未通過">
                          <span>未通過</span>
                      </Option>
                  </Select>
              </div>
             
              <Space  class="ivu-mb" wrap>
                  <Button :size="buttonSize" icon="ios-download-outline" type="primary">體檢報告</Button>
              </Space>
              <p class="ivu-mb">報名狀態： <span>{{passengerMore.passenger_status}}</span></p>
              <p class="ivu-mb">候補順位： <span>{{passengerMore.alternate_order}}</span></p>
              <p class="ivu-mb">座位編號： <span>{{passengerMore.seat_no}}</span></p>
              <p class="ivu-mb">訓練審核： <span>{{passengerMore.training_result}}</span></p>
              <p class="ivu-mb">訓練服尺寸： <span>{{passengerMore.shirt_size}}</span></p>
              <p class="ivu-mb">飲食備註: <span>{{passengerMore.diet}}</span></p>
              <!-- <FormItem    label="飲食備註:" prop="exp" :label-width="45" class="ivu-mb">
                 <Input v-model="passengerMore.diet" type="textarea" :autosize="{minRows: 5,maxRows: 5}" placeholder="經歷"></Input>
              </FormItem>  -->
        </div>
            <div>
                <Button  size="small" style="margin-right: 5px" @click="toOrders2()">返回</Button>
                <Button  size="small" style="margin-right: 5px;  " @click="reTable()">確定</Button>

            </div>
      </div>

    </Layout>
  </div>
</template>
<style scoped lang="scss">
@import "~@/assets/sass/page/_Order.scss";
</style>
<!-- <script src="@/views/js/Order"></script> -->
<script>


import Side from '@/components/SideNav.vue';
// import $ from 'jquery'
import axios from 'axios';


export default {

  data() {
    return {
      oindex:0,
      pindex:0,
      datac:[],
      searchOrder: '',
      searchNumberMem: '',
      showMore: 1,
      columns: [
        {
          title: '訂單編號',
          key: 'orders_no',
          width: 100
        },

        {
          title: '訂購日期',
          key: 'orders_date'
        },
        // {
        //   title: '訂單審核',
        //   key: 'check'
        // },
        {
          title: '訂單狀態',
          key: 'orders_stat',
          width: 100

        },
        {
          title: '會員編號',
          key: 'mem_no',
          width: 100
        },
        {
          title: '編輯',
          slot: 'action',
        },
      ],
   
    data: [ ],
   

              passengerDetail:[
                // {
                //   id:'111',
                //   name:'Tom Smith',
                //   gender:'男',
                //   birthday:'1999/02/11',
                //   nationality:'美國',
                //   passport:'XYZ1234567',
                //   modelHealth:'通過',
                //   status:'備取',
                //   alternate_order:null,
                //   seat_no:4,
                //   training_result:'通過',
                //   shirt_size:'M',
                //   diet:'不吃牛肉',
                // }



              ]

    }
  },
   mounted() {
    axios.get("http://localhost/PV/PVBackend/public/php/Order.php")
      .then(response => {
        this.data = response.data;
        this.datac = [...this.data];
      })
      .catch(error => {
        console.error("There was an error fetching the orders:", error);
      });

  },
  
  components: {
    Side
  },
  created() {
    this.datac = [...this.data];
  },
  methods: {
    toOrders2(){
      this.showMore = 2;
    },
    More(oindex) {
      this.showMore = 2;
      let orders_no = this.data[oindex].orders_no;
      console.log(orders_no);
        axios.post('http://localhost/PV/PVBackend/public/php/OrderPeople.php', {
        orders_no: orders_no
      })
      .then(response => {
        this.passengerDetail = response.data; 
        console.log(this.passengerDetail);
      })
      .catch(error => {
        console.log(error);
        console.log(error.response);
      });
     
      
    },
    reTable() {
      this.showMore = 1;

    },
    remove(index) {
      let orders_no = this.data[index].orders_no;
      console.log(orders_no);
      axios.post('http://localhost/PV/PVBackend/public/php/OrderDelete.php', {
        orders_no: orders_no
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
    passenger(){
      this.showMore = 3;
    },

    search(data1, argumentObj) {
     
      return data1.filter(d => {
        console.log("Searching with:", argumentObj);

        for (let argu in argumentObj) {
          if (argumentObj[argu]) {
            return `${d[argu]}`.includes(`${argumentObj[argu]}`)
            
          }
        }
        return true;
      });
    },
    handleSearch1() {
      console.log(this.datac);
      // this.datac = [...this.data];
      this.data = this.search(this.datac, { orders_no: Number(this.searchOrder),mem_no: Number(this.searchNumberMem)  });
      // const searchResult = this.search(this.datac, { number: Number(this.searchOrder), numberMem: Number(this.searchNumberMem) });
      // console.log(searchResult);
      // this.data = searchResult;
    },
  },
 

}
//舊的搜尋函數
 // let res = data1;
      // let dataClone = data1;
      // for (let argu in argumentObj) {
      //     if (argumentObj[argu].length > 0 || typeof argumentObj[argu] === 'number') {
      //         res = dataClone.filter(d => {
      //             // If the data and argument are strings, use indexOf
      //             if (typeof d[argu] === 'string' && typeof argumentObj[argu] === 'string') {
      //                 return d[argu].indexOf(argumentObj[argu]) > -1;
      //             }
      //             // If the data and argument are numbers, directly compare
      //             else if (typeof d[argu] === 'number' && typeof argumentObj[argu] === 'number') {
      //                 return d[argu] === argumentObj[argu];
      //             }
      //             return false;
      //         });
      //         dataClone = res;
      //     }
      // }
      // return res;</script>

