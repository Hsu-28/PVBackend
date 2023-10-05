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
          <template #action="{ row, index }">
            <Button size="small" style="margin-right: 5px" @click="More()">編輯</Button>
            <Button size="small" @click="remove(index)">刪除</Button>
          </template>
        </Table>
        <Page class="nextPage" :total="40" size="" />
      </div>
      <div class="showAll" v-if="showMore==2">
       
        <p>訂單編號： <span>{{moreDetail.orderNumber}}</span></p>
            <p>會員編號: <span>{{moreDetail.memNumber}}</span></p>
            <p>出團編號： <span>{{moreDetail.groupNumber}}</span></p>
            <p>報名人數： <span>{{moreDetail.AppNumber}}</span></p>
            <p>訂購日期：<span>{{moreDetail.orderDate}}</span></p>
            <p>總金額： <span>{{moreDetail.moneyAll}}</span></p>
            <p>付款狀態： <span>{{moreDetail.payState}}</span></p>
            <p>訂單狀態： <span>{{moreDetail.orderState}}</span></p>
           
            <div>
                <Button  size="small" style="margin-right: 5px" @click="passenger()">乘客總覽</Button>
                <Button  size="small" style="margin-right: 5px" @click="reTable()">返回</Button>

            </div>
      </div>
      <div v-if="showMore==3">
        <div v-for="(passengerMore, index) in passengerDetail" :key="index">
          <p>乘客</p>
          <p>旅客編號：  <span>{{passengerMore.id}}</span></p>
              <p>姓名： <span>{{passengerMore.name}}</span></p>
              <p>性別： <span>{{passengerMore.gender}}</span></p>
              <p>國籍： <span>{{passengerMore.nationality}}</span></p>
              <p>護照號碼：<span>{{passengerMore.passport}}</span></p>
              <p>報名狀態： <span>{{passengerMore.status}}</span></p>
              <p>候補順位： <span>{{passengerMore.alternate_order}}</span></p>
              <p>座位編號： <span>{{passengerMore.seat_no}}</span></p>
              <p>訓練服尺寸： <span>{{passengerMore.shirt_size}}</span></p>
              <p>飲食備註: <span>{{passengerMore.diet}}</span></p>
              <!-- <FormItem    label="飲食備註:" prop="exp" :label-width="45" class="ivu-mb">
                 <Input v-model="passengerMore.diet" type="textarea" :autosize="{minRows: 5,maxRows: 5}" placeholder="經歷"></Input>
              </FormItem>  -->
        </div>
            <div>
                <Button  size="small" style="margin-right: 5px" @click="More()">返回</Button>

            </div>
      </div>

    </Layout>
  </div>
</template>
<style scoped lang="scss">
@import "~@/assets/sass/page/_Order.scss";
</style>
<script>
import Side from '@/components/SideNav.vue';

export default {

  data() {
    return {
      datac:[],
      searchOrder: '',
      searchNumberMem: '',
      showMore: 1,
      columns: [
        {
          title: '訂單編號',
          key: 'number',
          width: 100
        },

        {
          title: '訂購日期',
          key: 'date'
        },
        {
          title: '訂單審核',
          key: 'check'
        },
        {
          title: '訂單狀態',
          key: 'state',
          width: 100

        },
        {
          title: '會員編號',
          key: 'numberMem',
          width: 100
        },
        {
          title: '編輯',
          slot: 'action',
        },
      ],
      data: [
        {
          number: 1,

          date: '2022/01/21',
          check: '8/8',
          numberMem: 218,
          state: '成團',
        },
        {
          number: 21,

          date: '2022/01/21',
          check: '8/8',
          numberMem: 733,
          state: '成團',
        },
        {
          number: 3,

          date: '2022/01/21',
          check: '8/8',
          numberMem: 993,
          state: '成團',
        },

      ],
      moreDetail:{
                orderNumber:1,  
                memNumber:1,
                groupNumber:1,
                AppNumber:7,
                orderDate:"1993/04/21",

                moneyAll:'123422',
                payState:'已付款',
                orderState:'???'

              },

              passengerDetail:[
                {
                  id:'111',
                  name:'Tom Smith',
                  gender:'男',
                  nationality:'美國',
                  passport:'XYZ1234567',
                  status:'備取',
                  alternate_order:null,
                  seat_no:4,
                  shirt_size:'M',
                  diet:'不吃牛肉',
                }



              ]

    }
  },
  
  components: {
    Side
  },
  created() {
    this.datac = [...this.data];
  },
  methods: {
    More() {
      this.showMore = 2;

    },
    reTable() {
      this.showMore = 1;

    },
    remove(index) {
      this.data.splice(index, 1);
    },
    passenger(){
      this.showMore = 3;
    },

    search(data1, argumentObj) {
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
      // return res;
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
      // this.datac = [...this.data];
      this.data = this.search(this.datac, { number: Number(this.searchOrder),numberMem: Number(this.searchNumberMem)  });
      // const searchResult = this.search(this.datac, { number: Number(this.searchOrder), numberMem: Number(this.searchNumberMem) });
      // console.log(searchResult);
      // this.data = searchResult;
    },
   


  }

}
</script>