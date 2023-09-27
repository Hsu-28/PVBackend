
<template>
  <div class=" layout" >
    <Side  :activePage='2'/> 
    <button  class="out" style="width: 42px;height:32px;line-height: 35px; ">
     登出
    </button>

    
      <Layout v-width="700" :style="{marginLeft: '300px'} ">
        <h1>會員資料</h1>
        <div v-if="showMore==1" >
            <Space class="search" direction=""   type="flex">
                    <Input  v-width="120" search placeholder="會員編號" />
                    <Input  v-width="120" search placeholder="email" />
            </Space>    
                <Table  class="Table" border :columns="columns" :data="data" >
                    <template  #action="{ row, index }">
                            <Button  :style="{padding:'0 5px 0 8px'}" shape="circle" 
                            icon="ios-add" 
                            @click="More()">
                                <!-- <Icon type="ios-add" />:style="{padding:' 0 5px 0 8px'}" -->
                            </Button>
                                
                    </template>
                </Table>
            <!-- <div class="nextPage"> -->
                <Page  class="nextPage" :total="40" size="" />

            <!-- </div> -->
         
        </div>
                
        <div class="showAll" v-if="showMore==2">
            <p>會員編號: <span>{{moreDetail.number}}</span></p>
            <p>會員等級: <span>{{moreDetail.level}}</span></p>
            <p>姓名: <span>{{moreDetail.name}}</span></p>
            <p>性別: <span>{{moreDetail.gender}}</span></p>
            <p>生日: <span>{{moreDetail.birthday}}</span></p>
            <p>電子信箱: <span>{{moreDetail.birthday}}</span></p>
            <p>地址: <span>{{moreDetail.address}}</span></p>
            <p>護照號碼: <span>{{moreDetail.passportNumber}}</span></p>
            <p>捐款累計金額: <span>{{moreDetail.donate}}</span></p>
            <div>
                <Button  size="small" style="margin-right: 5px" @click="reTable()">返回</Button>
                <Button  size="small" style="margin-right: 5px" @click="stop(row,index)">停權</Button>
            </div>
        </div>
      </Layout>
      
  </div>
</template>
<style scoped lang="scss">
@import "~@/assets/sass/style.scss";

.layout{
  background: #F5F7F9;
  width: 100vw;
  min-height: 100vh;
  color: $black;
  position: relative;
      border-radius: 4px;
      h1{
        color: $black;
        font-size: 24px;
        padding: 20px 0 20px 0;
      }
      .out{
        float: right;
        margin-top: 15px;
        margin-right:20px ;
        font-size: 16px;
        border-radius: 10px;
        border: 1px solid $black;
        cursor: pointer;

      }
      div{
        .showAll{

           & a{
                font-weight: 500;
            }
            
        }
      }
      .Table{
        color: $black;
        
         
      }
    .showAll{

        &>*{
        margin-bottom: 30px;
        color:$black;

        }
    }
    .search{
        margin-bottom: 30px;
    }
    .nextPage{
       margin-top: 10px;
        // display: flex;
        // justify-content: center;
        float: right;
    }
    }




</style>
<script>
import Side from '@/components/SideNav.vue';

  export default {
      data () {
          return {

             showMore:1,
              columns: [
                  {
                      title: '會員編號',
                      key: 'number'
                  },
                  {
                      title: '姓名',
                      key: 'name'
                  },
                  {
                      title: '電子郵件',
                      key: 'email'
                  },
                 
                  {   title:'詳細資訊',
                      slot: 'action',
                      width: 100,

                  }
              ],
              data: [
                  {
                      number: 1,
                      name: '李曉如',
                      email: '111@gmail.com',
                      
                  },
                  {
                      number: 2,
                      name: '邱琬庭',
                      email: '222@gmail.com',
                      
                  },
                  {
                      number: 3,
                      name: '許時諭',
                      email: '333@gmail.com',
                      
                  },
                  {
                      number: 4,
                      name: '謝順',
                      email: '444@gmail.com',
                    
                  },
                  {
                      number: 5,
                      name: '周琬雅',
                      email: '555@gmail.com',
                      state: ''
                  },
                  {
                      number: 6,
                      name: '譚郁亭',
                      email: '666@gmail.com',
                      state: ''
                  },
                  {
                      number: '',
                      name: '',
                      email: '',
                      state: ''
                  },
                  {
                      number: '',
                      name: '',
                      email: '',
                      state: ''
                  },
              ],
              moreDetail:{
                number:'1',  
                level:2,
                name:'謝順',
                gender :'男',
                birthday:"1993/04/21",
                email:'444@gmail.com',
                donate:'1234',
                passportNumber:'11111111111',
                address:'920 屏東縣潮州鎮西巿路25號'

              }
               

              
          }
      },
      components: {
        Side
    },
    methods:{
        More(){
            this.showMore=2;
          
        },
        reTable(){
            this.showMore=1;
            
        }

    }
  }


</script>
