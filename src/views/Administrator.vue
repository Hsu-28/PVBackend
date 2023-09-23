

<template>
  <div class=" layout" >
      <Sider class="SideNavigator" :style="{position: 'fixed', height: '100vh', left: 0, overflow: 'auto'}">
         
                  <Menu :theme="theme" class="allMenuItem"  :level="1" :open-names="['1']">
                      <MenuItem class="thisPage" name="1-1" to="./BackstageLongin" >管理員管理</MenuItem>
                      <MenuItem name="1-2" to="./backend/BackstageLongin.vue">會員管理</MenuItem>
                      <MenuItem name="1-3" to="./backend/BackstageLongin.vue">內容管理</MenuItem>
                      <MenuItem name="1-4" to="./backend/BackstageLongin.vue">行程管理</MenuItem>
                      <MenuItem name="1-5" to="./backend/BackstageLongin.vue">訂單管理</MenuItem>
                      <MenuItem name="1-6" to="./backend/BackstageLongin.vue">出團管理</MenuItem>
                      <MenuItem name="1-7" to="./backend/BackstageLongin.vue">捐款管理</MenuItem>
                      <MenuItem name="1-8" to="./backend/BackstageLongin.vue">聊天機器人管理</MenuItem>
                  </Menu>

      </Sider>
      <Layout v-width="700" :style="{marginLeft: '300px'} ">
        
              <Table class="Table" border :columns="columns" :data="data">
                  <template #action="{ row, index }">
                        <Button  size="small" style="margin-right: 5px" @click="stop(index)">停權</Button>
                  </template>
              </Table>
     
      </Layout>
  </div>
</template>
<style scoped lang="scss">
@import "~@/assets/sass/style.scss";

.layout{
       background: $white;
  width: 100vw;
  min-height: 100vh;
 
  position: relative;
      border-radius: 4px;
      overflow: hidden;
  .SideNavigator{
 

         
 .allMenuItem{
     width: 240px;
     &>*{
         width: 240px;
         border: 1px solid $black;
     }
     &>*:not(.thisPage )	{
         background: $white;
         color: $black;
     }
     &>*:not(.thisPage):hover{
         background : rgba(0, 0, 0, .8); 
         color: $white;
     }
 }

}



.thisPage{
// background-color :rbga(0, 0, 0, 0.4);   
background : rgba(0, 0, 0, .8);   
color: $white;

}
}


body{
  padding: 0;
}

</style>
<script>
  export default {
      data () {
          return {
              theme: 'primary',
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
                      age: 18,
                      address: '最高',
                      date: '啟用'
                  },
                  {
                      name: 'Jim Green',
                      age: 24,
                      address: '一般',
                      date: '停權'
                  },
                  {
                      name: 'Joe Black',
                      age: 30,
                      address: '一般',
                      date: '啟用'
                  },
                  {
                      name: 'Jon Snow',
                      age: 26,
                      address: '一般',
                      date: '停權'
                  },
                  {
                      name: '',
                      age: '',
                      address: '',
                      date: ''
                  },
                  {
                      name: '',
                      age: '',
                      address: '',
                      date: ''
                  },
                  {
                      name: '',
                      age: '',
                      address: '',
                      date: ''
                  },
                  {
                      name: '',
                      age: '',
                      address: '',
                      date: ''
                  },
              ]
          }
      },
    
  }
</script>