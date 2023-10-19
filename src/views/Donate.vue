<template>
  <div class=" layout">
    <Side :activePage='7' />
    <button class="out" style="width: 42px;height:32px;line-height: 35px;">
      登出
    </button>
    <Layout v-width="900" :style="{ marginLeft: '300px' }">
      <div v-if="showMore == 1">
        <h1>捐款</h1>
        <!-- <Button @click="modal1 =true" class="add">新增 +</Button>  -->
        <Space style="margin-bottom: 10px;">
          會員編號:
          <Input v-model="donateValue" @on-change="handleSearch1" placeholder="會員編號" style="width: 150px" />
        </Space>
        <br>
        <!-- <Space size="large" style="gap :10px">
          <div style="font-size: 14px;color: #515a6e; padding: 8px 0;">日期:</div>

          <DatePicker type="date" :options="options2" placement="bottom-end" placeholder="Select date"
            style="width: 200px" @on-change="handleSearch1" v-model="dateSeah" />
        </Space> -->
        <Table class="Table" border :columns="columns" :data="myData">
          <!-- <template #action="{ row, index }">
                <Button  size="small" style="margin-right: 5px" @click="More()">編輯</Button>
                <Button  size="small" @click="remove(index ,'News')">刪除</Button>
              </template> -->
        </Table>
        <!-- <Page class="nextPage" :total="40" size="20" /> -->
      </div>


    </Layout>
  </div>
</template>
<style scoped lang="scss">
@import "~@/assets/sass/page/_Donate.scss";
</style>
<script>
import axios from 'axios';
import Side from '@/components/SideNav.vue';

export default {

  data() {
    return {
      options2: '',
      dateSeah: '',
      dateSeahC: '',
      datac: [],
      donateValue: '',
      showMore: 1,
      columns: [
        {
          title: '捐獻編號',
          key: 'donate_no',
        },
        {
          title: '捐獻日期',
          key: 'donate_date'
        },
        {
          title: '捐獻金額',
          key: 'donate_amount',

        },
        {
          title: '會員編號',
          key: 'donate_id'
        },
        {
          title: '電子郵件',
          key: 'email',

        },

        {
          title: '捐款狀態',
          key: 'donate_stat'
        },
        // {
        //   title: '編輯',
        //   slot: 'action',
        // },           
      ],
      myData: [

      ],
      moreDetail: {
        number: '1',
        numberProcess: '67',
        date: '1113/65/26',
        max: '11',
        applicants: '8/8',
        wait: '6',
        daytrain: '1117/12/06',

      },
    }
  },
  components: {
    Side
  },
  created() {
    this.datac = [...this.myData];
  },
  methods: {
    // search (data1, argumentObj) {

    //       return data1.filter(d => {
    //   for (let argu in argumentObj) {
    //       if (argumentObj[argu]) {
    //           if (typeof d[argu] === 'string' && typeof argumentObj[argu] === 'string') {
    //               if (d[argu].indexOf(argumentObj[argu]) === -1) return false;
    //           } else if (typeof d[argu] === 'number' && typeof argumentObj[argu] === 'number') {
    //               if (d[argu] !== argumentObj[argu]) return false;
    //           }
    //       }
    //   }
    //   return true;
    //    });
    //   },
    search(data1, argumentObj) {
    //   return data1.filter(d => {
    //     console.log("Searching with:", argumentObj);

    //     for (let argu in argumentObj) {
    //       if (argumentObj[argu]) {
    //         return `${d[argu]}`.includes(`${argumentObj[argu]}`)

    //       }
    //     }
    //     return true;
    //   });
    // },
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
      // if (this.dateSeah) {
      //   this.dateSeahC = this.dateSeah.toLocaleDateString()
      //     .replace(/\//g, "-");
      // } else {
      //   this.dateSeah = '';
      //   this.dateSeahC = '';
      // }
      // console.log(this.dateSeah.toLocaleDateString());
      this.myData = this.search(this.datac, { donate_id: Number(this.donateValue)});
      // , donate_date: this.dateSeahC 
    },
  },
  created() {
    // 發起HTTP GET 請求
    axios.get(`${this.$store.state.phpPublicPath}donate.php`)
      .then(response => {
        this.myData = response.data;
        this.datac = [...this.myData];
      })
      .catch(error => {
        console.error(error);
      });
  }



}


</script>
