

<template>
  <div class=" layout" >
    <Side  :activePage='1' /> 
    <h1>管理員管理</h1>
    <button  class="out" style="width: 42px;height:32px;line-height: 35px; ">
     登出
    </button>

      <Layout v-width="700" :style="{marginLeft: '300px'} ">
          
              <Table class="Table" border :columns="columns" :data="data">
                  <template #action="{ row, index }">
                        <Button  v-if="show(index)" size="small" style="margin-right: 5px" @click="stop(row,index)">{{row.state}}</Button>
                  </template>
              </Table>
     
      </Layout>
  </div>
</template>
<style scoped lang="scss">
@import "~@/assets/sass/style.scss";

.layout{
    background: #F5F7F9;
  width: 100vw;
  min-height: 100vh;
 
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
    

}



</style>
<script>
import Side from '@/components/SideNav.vue'

  export default {
      data () {
          return {
                // stopText:"停權",
              columns: [
                  {
                      title: '管理員帳號',
                      key: 'name'
                  },
                  {
                      title: '管理者密碼',
                      key: 'password'
                  },
                  {
                      title: '管理員權限',
                      key: 'permissions'
                  },
                  {
                      title:'管理員狀態',
                      key:'state'
                  },
                  {   title:'',
                      slot: 'action',
                      width: 90,

                  }
              ],
              data: [
                  {
                      name: 'John Brown',
                      password: 18,
                      permissions: '最高',
                      state: '啟用'
                  },
                  {
                      name: 'Jim Green',
                      password: 24,
                      permissions: '一般',
                      state: '停權'
                  },
                  {
                      name: 'Joe Black',
                      password: 30,
                      permissions: '一般',
                      state: '啟用'
                  },
                  {
                      name: 'Jon Snow',
                      password: 26,
                      permissions: '一般',
                      state: '停權'
                  },
                  {
                      name: '',
                      password: '',
                      permissions: '',
                      state: ''
                  },
                  {
                      name: '',
                      password: '',
                      permissions: '',
                      state: ''
                  },
                  {
                      name: '',
                      password: '',
                      permissions: '',
                      state: ''
                  },
                  {
                      name: '',
                      password: '',
                      permissions: '',
                      state: ''
                  },
              ]
          }
      },
      components: {
        Side
    },methods:{
        stop(row,index){
            if(this.data[index].state=="停權")
            {
                this.data[index].state="啟用"
            }else{
                
                this.data[index].state = "停權";
            }
        }, show(index){
          
          if(this.data[index].permissions=='最高')
      {     
          return false;
      }else{
          
          return true;
      }
      }
      // return this.data.map(index => index.permissions !== '最高');
     
  }

    }


</script>