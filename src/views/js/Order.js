import Side from '@/components/SideNav.vue';
// import $ from 'jquery'
import axios from 'axios';


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
   
    data: [
           
          
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
                  birthday:'1999/02/11',
                  nationality:'美國',
                  passport:'XYZ1234567',
                  modelHealth:'通過',
                  status:'備取',
                  alternate_order:null,
                  seat_no:4,
                  training_result:'通過',
                  shirt_size:'M',
                  diet:'不吃牛肉',
                }



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
      console.log(this.datac);
      // this.datac = [...this.data];
      this.data = this.search(this.datac, { orders_no: Number(this.searchOrder),mem_no: Number(this.searchNumberMem)  });
      // const searchResult = this.search(this.datac, { number: Number(this.searchOrder), numberMem: Number(this.searchNumberMem) });
      // console.log(searchResult);
      // this.data = searchResult;
    },
  },
 

}