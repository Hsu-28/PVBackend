<template>
  <div class=" layout">
    <Side :activePage='5' />
    <button class="out" style="width: 42px;height:32px;line-height: 35px;">
      登出
    </button>
    <Layout v-width="900" :style="{ marginLeft: '300px' }">
      <div v-if="showMore == 1">
        <h1>訂單</h1>

        <Space style="margin-bottom: 10px; margin-right: 20px;">
          訂單編號:
          <Input v-model="searchOrder" @on-change="handleSearch1" placeholder="訂單編號" style="width: 150px" />
        </Space>
        <Space style="margin-bottom: 10px;">
          會員編號:
          <Input v-model="searchNumberMem" @on-change="handleSearch1" placeholder="會員編號" style="width: 150px" />
        </Space>
        <Table class="Table" border :columns="columns" :data="data">
          <template #action="{ row, index }">
            <Button size="small" style="margin-right: 5px" @click="More()">編輯</Button>
            <Button size="small" @click="remove(index, 'News')">刪除</Button>
          </template>
        </Table>
        <Page class="nextPage" :total="40" size="" />
      </div>
      <!-- <div v-if="showMore==2">
        <h1>行程</h1>
        <Form id="FormAll" v-width="700" ref="moreDetail" :model="moreDetail" :rules="ruleValidate" :label-width="80">
        <p style="font-size: 14px;color: #515a6e; padding-bottom: 8px;">編號:{{ moreDetail.number }}</p>
        <FormItem label="名稱:" prop="precautions" :label-width="45">
            <Input v-model="moreDetail.precautions" placeholder="aa" ></Input>
        </FormItem>
        <Space size="large" wrap >
          <div  style="font-size: 14px;color: #515a6e; padding: 8px 0;">日期:</div>
             <DatePicker  type="daterange" :options="options2" placement="bottom-end" placeholder="Select date" style="width: 200px" />
        </Space>
          <FormItem   v-width="150"  label="人數上限:" prop="max" :label-width="72">
              <Input v-model="moreDetail.max" placeholder="aa" ></Input>
          </FormItem>
          <FormItem   v-width="150"  label="已報名人數:" prop="max" :label-width="86">
              <Input v-model="moreDetail.max" placeholder="aa" ></Input>
          </FormItem>
          <FormItem   v-width="150"  label="候補人數:" prop="max" :label-width="72">
              <Input v-model="moreDetail.max" placeholder="aa" ></Input>
          </FormItem> 
        <FormItem v-width="700">
            <Button  size="small" style="margin-right: 5px; float: right;" @click="reTable()">返回</Button>
            <Button  size="small" style="margin-right: 5px;  float: right;" @click="reTable()">確定</Button>
        </FormItem>
        </Form>
      </div> -->

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
          number: 2,

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

    }
  },
  created() {
    this.datac = [...this.data];
  },
  components: {
    Side
  },
  methods: {
    More() {
      this.showMore = 2;

    },
    reTable() {
      this.showMore = 1;

    },
    remove(index) {
      this.dataNews.splice(index, 1);
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
            if (typeof d[argu] === 'string' && typeof argumentObj[argu] === 'string') {
              if (d[argu].indexOf(argumentObj[argu]) === -1) return false;
            } else if (typeof d[argu] === 'number' && typeof argumentObj[argu] === 'number') {
              if (d[argu] !== argumentObj[argu]) return false;
            }
          }
        }
        return true;
      });
    },
    handleSearch1() {
      // this.datac = [...this.data];
      // this.data = this.search(this.datac, { number: Number(this.searchOrder) , numberMem: Number(this.searchNumberMem) });
      const searchResult = this.search(this.datac, { number: Number(this.searchOrder), numberMem: Number(this.searchNumberMem) });
      console.log(searchResult);
      this.data = searchResult;
    },


  }

}
</script>