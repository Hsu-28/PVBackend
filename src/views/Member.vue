
<template>
    <div class=" layout">
        <Side :activePage='2' />
        <Button to="/" class="out" style="width: 42px;height:32px;line-height: 35px; ">
            登出
        </Button>


        <Layout v-width="700" :style="{ marginLeft: '300px' }">
            <h1>會員資料</h1>
            <div v-if="showMore == 1">
                <Space class="search" direction="" type="flex">
                    <Input v-width="120" v-model="searchConNumber" @on-change="handleSearch1" placeholder="會員編號" />
                    <Input v-width="120" v-model="searchEmail" @on-change="handleSearch1" placeholder="email" />
                </Space>
                <Table class="Table" border :columns="columns" :data="myData">
                    <template #action="{ row, index }">
                        <Button :style="{ padding: '0 5px 0 8px' }" shape="circle" icon="ios-add" @click="dindex = index; More()">
                            <!-- <Icon type="ios-add" />:style="{padding:' 0 5px 0 8px'}" -->
                        </Button>
                    </template>
                </Table>
                <!-- <div class="nextPage"> -->
                <Page class="nextPage" :total="40" size="" />

                <!-- </div> -->

            </div>

            <div class="showAll" v-if="showMore == 2">
                <p>會員編號: <span>{{ myData[dindex].mem_no }}</span></p>
                <p>姓名: <span>{{ myData[dindex].mem_name }}</span></p>
                <p>暱稱: <span>{{ myData[dindex].mem_nickname }}</span></p>
                <p>性別: <span>{{ myData[dindex].mem_gender }}</span></p>
                <p>生日: <span>{{ myData[dindex].mem_birthday }}</span></p>
                <p>護照號碼: <span>{{ myData[dindex].mem_passport }}</span></p>
                <p>電子信箱: <span>{{ myData[dindex].email }}</span></p>
                <p>地址: <span>{{ myData[dindex].address }}</span></p>
                <p>會員等級: <span>{{ myData[dindex].mem_level }}</span></p>
                <p>捐款累計金額: <span>{{ myData[dindex].donate_sum }}</span></p>
                <div>
                    <Button size="small" style="margin-right: 5px" @click="reTable()">返回</Button>
                    <Button size="small" style="margin-right: 5px" @click="stop(row, index)">停權</Button>
                </div>
            </div>
        </Layout>

    </div>
</template>
<style scoped lang="scss">
@import "~@/assets/sass/style.scss";

.layout {
    background: #F5F7F9;
    width: 100vw;
    min-height: 100vh;
    color: $black;
    position: relative;
    border-radius: 4px;
    h1 {
        color: $black;
        font-size: 24px;
        padding: 20px 0 20px 0;
    }
    .out {
        float: right;
        margin-top: 15px;
        margin-right: 20px;
        font-size: 16px;
        border-radius: 10px;
        border: 1px solid $black;
        cursor: pointer;
    }
    div {
        .showAll {
            & a {
                font-weight: 500;
            }
        }
    }
    .Table {
        color: $black;
    }
    .showAll {
        &>* {
            margin-bottom: 30px;
            color: $black;
        }
    }
    .search {
        margin-bottom: 30px;
    }
    .nextPage {
        margin-top: 10px;
        // display: flex;
        // justify-content: center;
        float: right;
    }
}
</style>
<script>
import axios from 'axios';
import Side from '@/components/SideNav.vue';
export default {
    data() {
        return {
            dindex:0,
            datac: [],
            searchEmail: '',
            searchConNumber: '',
            showMore: 1,
            columns: [
                {
                    title: '會員編號',
                    key: 'mem_no',

                },
                {
                    title: '姓名',
                    key: 'mem_name'
                },
                {
                    title: '電子郵件',
                    key: 'email'
                },
                {
                    title: '密碼',
                    key: 'mem_pw'
                },

                {
                    title: '詳細資訊',
                    slot: 'action',
                    width: 100,

                }
            ],
            myData: [

            ],
            // moreDetail: {
            //     number: '1',
            //     level: 2,
            //     nickname: 'shun',
            //     name: '謝順',
            //     gender: '男',
            //     birthday: "1993/04/21",
            //     email: '444@gmail.com',
            //     donate: '1234',
            //     passportNumber: '11111111111',
            //     address: '920 屏東縣潮州鎮西巿路25號'
            // }



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
            this.myData = this.search(this.datac, { mem_no: Number(this.searchConNumber), email: this.searchEmail });
        },



    },
    created() {
        // 發起HTTP GET 請求
        axios.get('http://localhost/PV/PVBackend/public/php/Member.php')
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
