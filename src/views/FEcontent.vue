
<template>
  <div class=" layout" >
    <Side  :activePage='2' /> 
    
      <Layout v-width="700" :style="{marginLeft: '300px'} ">
        <h1>會員資料</h1>
        <div direction="v">
          <div>首頁照片</div>
          <div>團隊介紹</div>
          <div>最新消息</div>
          <div>Q&A</div>
        </div>
        <div class="demo-upload-list" v-for="item in uploadList">
        <template v-if="item.status === 'finished'">
            <Image :src="item.url" fit="cover" width="100%" height="100%" />
            <div class="demo-upload-list-cover">
                <Icon type="ios-eye-outline" @click="handleView(item.name)"></Icon>
                <Icon type="ios-trash-outline" @click="handleRemove(item)"></Icon>
            </div>
        </template>
        <template v-else>
            <Progress v-if="item.showProgress" :percent="item.percentage" hide-info></Progress>
        </template>
    </div>
    <Upload
        ref="upload"
        :show-upload-list="false"
        :default-file-list="defaultList"
        :on-success="handleSuccess"
        :format="['jpg','svg','png']"
        :max-size="4096"
        :on-format-error="handleFormatError"
        :on-exceeded-size="handleMaxSize"
        :before-upload="handleBeforeUpload"
        multiple
        type="drag"
        action="//jsonplaceholder.typicode.com/posts/"
        style="display: inline-block;width:58px;">
        <div style="width: 58px;height:58px;line-height: 58px;">
            <Icon type="ios-camera" size="20"></Icon>
        </div>
    </Upload>
    <ImagePreview v-model="visible" :preview-list="['https://file.iviewui.com/images/' + imgName]" />
         
           
      </Layout>
      
  </div>
</template>
<style scoped lang="scss">
@import "~@/assets/sass/style.scss";

.layout{
       background: $white;
  width: 100vw;
  min-height: 100vh;
  color: $black;
  position: relative;
      border-radius: 4px;
      h1{
        color: $black;
        font-size: 24px;
        padding: 10px 0 20px 0;
      }
      
    }

    .demo-upload-list{
        display: inline-block;
        width: 160px;
        height: 160px;
        text-align: center;
        line-height: 60px;
        border: 1px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,.2);
        margin-right: 4px;
    }
    .demo-upload-list img{
        width: 100%;
        height: 100%;
    }
    .demo-upload-list-cover{
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,.6);
    }
    .demo-upload-list:hover .demo-upload-list-cover{
        display: block;
    }
    .demo-upload-list-cover i{
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        margin: 0 2px;
    }




</style>
<script>
import Side from '@/components/SideNav.vue';

  export default {
      data () {
          return {

            defaultList: [
                    {
                        'name': 'image-demo-1.jpg',
                        'url': 'https://file.iviewui.com/images/image-demo-1.jpg'
                    },
                    
                ],
                imgName: '',
                visible: false,
                uploadList: [],
            }
        },
        methods: {
            handleView (name) {
                this.imgName = name;
                this.visible = true;
            },
            handleRemove (file) {
                const fileList = this.$refs.upload.fileList;
                this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
            },
            handleSuccess (res, file) {
                file.url = 'https://file.iviewui.com/images/image-demo-3.jpg';
                file.name = 'image-demo-3.jpg';
            },
            handleFormatError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
                });
            },
            handleMaxSize (file) {
                this.$Notice.warning({
                    title: 'Exceeding file size limit',
                    desc: 'File  ' + file.name + ' is too large, no more than 2M.'
                });
            },
            handleBeforeUpload () {
                const check = this.uploadList.length < 5;
                if (!check) {
                    this.$Notice.warning({
                        title: 'Up to five pictures can be uploaded.'
                    });
                }
                return check;
            }
        },
        mounted () {
            this.uploadList = this.$refs.upload.fileList;
        }
    }

</script>
