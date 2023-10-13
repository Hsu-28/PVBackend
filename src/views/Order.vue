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
          <p  class="ivu-mb">乘客 {{index+1}}</p>
          <p class="ivu-mb">旅客編號：  <span>{{passengerMore.id}}</span></p>
              <p class="ivu-mb">姓名： <span>{{passengerMore.name}}</span></p>
              <p class="ivu-mb">性別： <span>{{passengerMore.gender}}</span></p>
              <p class="ivu-mb">生日： <span>{{passengerMore.birthday }}</span></p>
              <p class="ivu-mb">國籍： <span>{{passengerMore.nationality}}</span></p>
              <p class="ivu-mb">護照號碼：<span>{{passengerMore.passport}}</span></p>
              <div style="width:600px; ">
                <p>健康審核</p>
                 
                  <Select v-model="modelHealth" style="width:200px; "  class="ivu-mb" >
                    <Option value="審核中" label="審核中">
                        <span>審核中</span>
                      
                      </Option>
                      <Option value="通過" label="通過">
                          <span>通過</span>
                      </Option>
                      <Option value="未通過" label="未通過">
                          <span>未通過</span>
                      </Option>
                  </Select>
              </div>
             
              <Space  class="ivu-mb" wrap>
                  <Button :size="buttonSize" icon="ios-download-outline" type="primary">體檢報告</Button>
              </Space>
              <p class="ivu-mb">報名狀態： <span>{{passengerMore.status}}</span></p>
              <p class="ivu-mb">候補順位： <span>{{passengerMore.alternate_order}}</span></p>
              <p class="ivu-mb">座位編號： <span>{{passengerMore.seat_no}}</span></p>
              <p class="ivu-mb">訓練審核： <span>{{passengerMore.training_result}}</span></p>
              <p class="ivu-mb">訓練服尺寸： <span>{{passengerMore.shirt_size}}</span></p>
              <p class="ivu-mb">飲食備註: <span>{{passengerMore.diet}}</span></p>
              <!-- <FormItem    label="飲食備註:" prop="exp" :label-width="45" class="ivu-mb">
                 <Input v-model="passengerMore.diet" type="textarea" :autosize="{minRows: 5,maxRows: 5}" placeholder="經歷"></Input>
              </FormItem>  -->
        </div>
            <div>
                <Button  size="small" style="margin-right: 5px" @click="More()">返回</Button>
                <Button  size="small" style="margin-right: 5px;  " @click="reTable()">確定</Button>

            </div>
      </div>

    </Layout>
  </div>
</template>
<style scoped lang="scss">
@import "~@/assets/sass/page/_Order.scss";
</style>
<script src="@/views/js/Order"></script>

