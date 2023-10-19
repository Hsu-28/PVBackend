
<template>
    <div class="SideNavigator" v-width="240" :style="{position: 'fixed', height: '100vh', left: 0, }">
  
        <div   v-width="240" class="allMenuItem"  :level="1" >
            <!-- <router-link :class="[activePage == 1 ? 'thisPage' : 'Page' ]"  :to="[activePage == 1 ? '#' : '/Administrator' ]">管理員管理</router-link>
            <router-link :class="[activePage == 2 ? 'thisPage' : 'Page' ]"  :to="[activePage == 2 ? '#' : '/Member' ]">會員管理</router-link>
            <router-link  :class="[activePage == 3 ? 'thisPage' : 'Page' ]"  :to="[activePage == 3 ? '#' :'/FEcontent' ]">內容管理</router-link>
            <router-link  :class="[activePage == 4 ? 'thisPage' : 'Page' ]"  :to="[activePage == 4 ? '#' :'/Process' ]">行程管理</router-link>
            <router-link  :class="[activePage == 5 ? 'thisPage' : 'Page' ]"  :to="[activePage == 5 ? '#': '/Order' ]">訂單管理</router-link>
            <router-link  :class="[activePage == 6 ? 'thisPage' : 'Page' ]"  :to="[activePage == 6 ? '#': '/Group' ]">出團管理</router-link>
            <router-link   :class="[activePage == 7 ? 'thisPage' : 'Page' ]"  :to="[activePage == 7 ? '#':'/Donate' ]">捐款管理</router-link>
            <router-link   :class="[activePage == 8 ? 'thisPage' : 'Page' ]"  :to="[activePage == 8 ? '#': '/Robot' ]">聊天機器人管理</router-link> -->
            <router-link :class="[activePage == 1 ? 'thisPage' : 'Page' ]"  :to="'/Administrator' ">管理員管理</router-link>
            <router-link :class="[activePage == 2 ? 'thisPage' : 'Page' ]"  :to="'/Member' ">會員管理</router-link>
            <router-link  :class="[activePage == 3 ? 'thisPage' : 'Page' ]"  :to="'/FEcontent' ">內容管理</router-link>
            <router-link  :class="[activePage == 4 ? 'thisPage' : 'Page' ]"  :to="'/Process' ">行程管理</router-link>
            <router-link  :class="[activePage == 5 ? 'thisPage' : 'Page' ]"  :to=" '/Order' ">訂單管理</router-link>
            <router-link  :class="[activePage == 6 ? 'thisPage' : 'Page' ]"  :to=" '/Group' ">出團管理</router-link>
            <router-link   :class="[activePage == 7 ? 'thisPage' : 'Page' ]"  :to="'/Donate'">捐款管理</router-link>
            <router-link   :class="[activePage == 8 ? 'thisPage' : 'Page' ]"  :to=" '/Robot'">聊天機器人管理</router-link>
        </div>


    </div>
</template>
<script>
export default {
    props: {
        activePage: {
            type: Number,
            default: 1
        },
        // activePage:['activePage']
      
    },
    created() {
    console.log(this.activePage)
  }
}
</script>
<style scoped lang="scss">
@import "~@/assets/sass/style.scss";


    
  .SideNavigator{
    width: 240px;
    // background: #111111 ;
    background: #4e4d4d ;
    // background : rgba(0, 0, 0, .9); 
  

         
 .allMenuItem{
     width: 240px;
     &>*{
         width: 240px;
         display: block;
         font-size: 18px;
         padding: 10px 5px;
         border: 1px solid $black;
     }
     &>.Page {
         background: $white;
         color: $black;
     }
     &>.Page:hover{
        //  background : rgba(0, 0, 0, .1); 
         background :#4e4d4d; 
         color: $white;
     }
 }

}



.thisPage{
// background-color :rbga(0, 0, 0, 0.4);   
// background : rgba(0, 0, 0, .2);   
background : #4e4d4d;   
color: $white;

}




</style>
