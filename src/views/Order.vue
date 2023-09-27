<template>
  <div class=" layout" >
    <Side :activePage='5'/> 
    <button  class="out" style="width: 42px;height:32px;line-height: 35px;">
     登出
    </button>
    <Layout v-width="900" :style="{marginLeft: '300px'} ">
      <div v-if="showMore==1" >
      <h1>訂單</h1>
     
      <Space  style="margin-bottom: 10px; margin-right: 20px;" >
        訂單編號:
            <Input v-model="value" placeholder="會員編號" style="width: 150px" />           
      </Space> 
      <Space  style="margin-bottom: 10px;" >
        會員編號:
            <Input v-model="value" placeholder="會員編號" style="width: 150px" />           
      </Space> 
          <Table class="Table" border :columns="columns" :data="data">
              <template #action="{ row, index }">
                <Button  size="small" style="margin-right: 5px" @click="More()">編輯</Button>
                <Button  size="small" @click="remove(index ,'News')">刪除</Button>
              </template>
          </Table>  
          <Page  class="nextPage" :total="40" size="" />
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
      showMore:1,
      columns:[
            {
              title: '訂單編號',
              key: 'number',
              width:80
            },      
          
            {
              title: '訂購日期',
              key: 'date'
            },      
            {
              title: '訂單審核',
              key: 'check '
            },      
            {
              title: '訂單狀態',
              key: 'state',
              width: 100

            },      
            {
              title: '會員編號',
              key: 'number_Mem',
              width: 100
            },     
            {
              title: '編輯',
              slot: 'action',
            },           
        ],
        data:[
            {
              number: 1,
             
              date: '2022/01/21',
              check: '8/8',
              number_Mem: '7/8',
              state : '成團',             
            },
         
        ],
      
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
        
    }, 
     removeN (index) {
                this.dataNews.splice(index, 1);
            },

}

}
</script>