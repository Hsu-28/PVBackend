"use strict";(self["webpackChunkpvbackend"]=self["webpackChunkpvbackend"]||[]).push([[509],{9263:function(e,l,a){a.r(l),a.d(l,{default:function(){return I}});var t=a(3396),d=a(7139),o=a(9242);const i={id:"layoutFE"},m=(0,t._)("button",{class:"out",style:{width:"42px",height:"32px","line-height":"35px"}}," 登出 ",-1),n=(0,t._)("h1",null,"內容管理",-1),s={class:"buttonAll"},u={direction:"vertical"},p=["onClick"],w={key:0},c={class:"demo-upload-list"},r={class:"demo-upload-list-cover"},h={key:1},_=(0,t._)("input",{type:"file",multiple:""},null,-1),b=(0,t._)("input",{type:"file",multiple:""},null,-1),g={key:2},f=(0,t._)("input",{type:"file",multiple:""},null,-1),k=(0,t._)("div",{style:{"font-size":"14px",color:"#515a6e",padding:"8px 0","margin-left":"20px"}},"日期:",-1),V={for:"imageEditInput"},x=["src"],y=(0,t._)("div",{style:{"font-size":"14px",color:"#515a6e",padding:"8px 0","margin-left":"2px"}},"日期:",-1),W={key:3};function v(e,l,a,v,A,Q){const N=(0,t.up)("Side"),U=(0,t.up)("Image"),T=(0,t.up)("Icon"),I=(0,t.up)("Button"),C=(0,t.up)("Upload"),E=(0,t.up)("ImagePreview"),z=(0,t.up)("Input"),j=(0,t.up)("FormItem"),P=(0,t.up)("Form"),O=(0,t.up)("Modal"),D=(0,t.up)("Table"),F=(0,t.up)("DatePicker"),R=(0,t.up)("Space"),M=(0,t.up)("Layout"),B=(0,t.Q2)("width");return(0,t.wg)(),(0,t.iD)("div",i,[(0,t.Wm)(N,{activePage:3}),m,(0,t.wy)(((0,t.wg)(),(0,t.j4)(M,{style:{marginLeft:"300px"}},{default:(0,t.w5)((()=>[n,(0,t._)("div",s,[((0,t.wg)(!0),(0,t.iD)(t.HY,null,(0,t.Ko)(A.changePageText,((e,l)=>((0,t.wg)(),(0,t.iD)("div",u,[(0,t._)("div",{onClick:e=>Q.changeButton(l),class:(0,d.C_)([A.changePage==l?"thisPage":"buttonPage"])},(0,d.zw)(e.text),11,p)])))),256))]),0==A.changePage?((0,t.wg)(),(0,t.iD)("div",w,[((0,t.wg)(!0),(0,t.iD)(t.HY,null,(0,t.Ko)(A.uploadList,(e=>((0,t.wg)(),(0,t.iD)("div",c,[(0,t.Uk)("url "),"finished"===e.status?((0,t.wg)(),(0,t.iD)(t.HY,{key:0},[(0,t.Wm)(U,{src:e.url,fit:"cover",width:"100%",height:"100%"},null,8,["src"]),(0,t._)("div",r,[(0,t.Wm)(T,{type:"ios-eye",onClick:l=>Q.handleView(e.name)},null,8,["onClick"]),(0,t.Wm)(T,{type:"ios-trash-outline",onClick:l=>Q.handleRemove(e)},null,8,["onClick"])])],64)):(0,t.kq)("",!0)])))),256)),(0,t.Wm)(C,{ref:"upload","show-upload-list":!1,"default-file-list":A.defaultList,"on-success":Q.handleSuccess,format:["jpg","jpeg","png"],"max-size":2048,"on-format-error":Q.handleFormatError,"on-exceeded-size":Q.handleMaxSize,"before-upload":Q.handleBeforeUpload,multiple:"",type:"drag",action:"//jsonplaceholder.typicode.com/posts/",style:{display:"inline-block",width:"58px"}},{default:(0,t.w5)((()=>[(0,t.Wm)(I,{icon:"md-camera",style:{width:"58px",height:"58px","line-height":"58px"}})])),_:1},8,["default-file-list","on-success","on-format-error","on-exceeded-size","before-upload"]),(0,t.Wm)(I,{style:{width:"58px",height:"58px","line-height":"58px","margin-bottom":"52px","margin-left":"20px"}},{default:(0,t.w5)((()=>[(0,t.Uk)(" 確認 ")])),_:1}),(0,t.Wm)(E,{class:"wwww",modelValue:A.visible,"onUpdate:modelValue":l[0]||(l[0]=e=>A.visible=e),"preview-list":["https://file.iviewui.com/images/"+A.imgName]},null,8,["modelValue","preview-list"])])):(0,t.kq)("",!0),1==A.changePage?((0,t.wg)(),(0,t.iD)("div",h,[(0,t.Wm)(I,{onClick:l[1]||(l[1]=e=>A.modalTeam=!0),class:"add ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Uk)("新增 +")])),_:1}),(0,t.Wm)(O,{title:"新增團隊",modelValue:A.modalTeam,"onUpdate:modelValue":l[5]||(l[5]=e=>A.modalTeam=e),width:"700px",closable:!0},{default:(0,t.w5)((()=>[(0,t.Wm)(P,{model:A.addTeamItem,"label-width":80,enctype:"multipart/form-data",method:"post"},{default:(0,t.w5)((()=>[(0,t.wy)(((0,t.wg)(),(0,t.j4)(j,{label:"姓名:",prop:"precautions","label-width":45,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{modelValue:A.addTeamItem.name,"onUpdate:modelValue":l[2]||(l[2]=e=>A.addTeamItem.name=e),placeholder:"aa"},null,8,["modelValue"])])),_:1})),[[B,200]]),(0,t.Wm)(j,{label:"照片",prop:"mem_img","label-width":40},{default:(0,t.w5)((()=>[_])),_:1}),(0,t.wy)(((0,t.wg)(),(0,t.j4)(j,{label:"職稱:",prop:"job","label-width":45,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{modelValue:A.addTeamItem.job,"onUpdate:modelValue":l[3]||(l[3]=e=>A.addTeamItem.job=e),placeholder:"職稱"},null,8,["modelValue"])])),_:1})),[[B,200]]),(0,t.Wm)(j,{label:"經歷:",prop:"exp","label-width":45,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{modelValue:A.addTeamItem.exp,"onUpdate:modelValue":l[4]||(l[4]=e=>A.addTeamItem.exp=e),type:"textarea",autosize:{minRows:5,maxRows:5},placeholder:"經歷"},null,8,["modelValue"])])),_:1})])),_:1},8,["model"])])),_:1},8,["modelValue"]),(0,t.Wm)(D,{id:"TableFE",border:"",columns:A.columnsMem,data:A.dataMem},{action:(0,t.w5)((({row:e,index:a})=>[(0,t.Wm)(I,{size:"small",style:{"margin-right":"5px"},onClick:e=>Q.clickTeamEdit(a)},{default:(0,t.w5)((()=>[(0,t.Uk)("編輯")])),_:2},1032,["onClick"]),(0,t.Wm)(O,{title:"編輯團隊資訊","ok-text":"確認修改","cancel-text":"取消",modelValue:A.TeamEdit[a],"onUpdate:modelValue":e=>A.TeamEdit[a]=e,width:"700px",closable:!0,onOnOk:Q.ok,onOnCancel:Q.cancel},{default:(0,t.w5)((()=>[(0,t.Wm)(P,{model:A.addTeamItem,"label-width":80,enctype:"multipart/form-data",method:"post"},{default:(0,t.w5)((()=>[(0,t.Wm)(j,{label:"團隊編號","label-width":68},{default:(0,t.w5)((()=>[(0,t._)("text",null,(0,d.zw)(A.addTeamItem.number),1)])),_:1}),(0,t.wy)(((0,t.wg)(),(0,t.j4)(j,{label:"姓名:",prop:"precautions","label-width":45,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{modelValue:A.addTeamItem.name,"onUpdate:modelValue":l[6]||(l[6]=e=>A.addTeamItem.name=e),placeholder:"aa"},null,8,["modelValue"])])),_:1})),[[B,200]]),(0,t.Wm)(j,{label:"照片",prop:"mem_img","label-width":40},{default:(0,t.w5)((()=>[b])),_:1}),(0,t.wy)(((0,t.wg)(),(0,t.j4)(j,{label:"職稱:",prop:"job","label-width":45,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{modelValue:A.addTeamItem.job,"onUpdate:modelValue":l[7]||(l[7]=e=>A.addTeamItem.job=e),placeholder:"職稱"},null,8,["modelValue"])])),_:1})),[[B,200]]),(0,t.Wm)(j,{label:"經歷:",prop:"exp","label-width":45,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{modelValue:A.addTeamItem.exp,"onUpdate:modelValue":l[8]||(l[8]=e=>A.addTeamItem.exp=e),type:"textarea",autosize:{minRows:5,maxRows:5},placeholder:"經歷"},null,8,["modelValue"])])),_:1})])),_:1},8,["model"])])),_:2},1032,["modelValue","onUpdate:modelValue","onOnOk","onOnCancel"]),(0,t.Wm)(I,{size:"small",onClick:e=>Q.remove(a,"Mem")},{default:(0,t.w5)((()=>[(0,t.Uk)("刪除")])),_:2},1032,["onClick"])])),_:1},8,["columns","data"])])):(0,t.kq)("",!0),2==A.changePage?((0,t.wg)(),(0,t.iD)("div",g,[(0,t.Wm)(I,{onClick:l[9]||(l[9]=e=>A.modalNews=!0),class:"add ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Uk)("新增 +")])),_:1}),(0,t.Wm)(O,{title:"新增最新消息",modelValue:A.modalNews,"onUpdate:modelValue":l[13]||(l[13]=e=>A.modalNews=e),width:"700px",closable:!0},{default:(0,t.w5)((()=>[(0,t.Wm)(P,{model:A.addNews,"label-width":80,enctype:"multipart/form-data",method:"post"},{default:(0,t.w5)((()=>[(0,t.wy)(((0,t.wg)(),(0,t.j4)(j,{label:"最新消息標題:",prop:"precautions","label-width":120,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{modelValue:A.addNews.news_title,"onUpdate:modelValue":l[10]||(l[10]=e=>A.addNews.news_title=e),placeholder:"aa"},null,8,["modelValue"])])),_:1})),[[B,300]]),(0,t.Wm)(j,{label:"最新消息照片:",prop:"img","label-width":120},{default:(0,t.w5)((()=>[f])),_:1}),(0,t.Wm)(R,{size:"large",wrap:"",class:"ivu-mb"},{default:(0,t.w5)((()=>[k,(0,t.Wm)(F,{modelValue:A.addNews.news_date,"onUpdate:modelValue":l[11]||(l[11]=e=>A.addNews.news_date=e),type:"date",placement:"bottom-end",placeholder:"Select date",style:{width:"200px"}},null,8,["modelValue"])])),_:1}),(0,t.Wm)(j,{label:"內容:",prop:"content","label-width":65,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{modelValue:A.addNews.news_content,"onUpdate:modelValue":l[12]||(l[12]=e=>A.addNews.news_content=e),type:"textarea",autosize:{minRows:5,maxRows:5},placeholder:"內容"},null,8,["modelValue"])])),_:1})])),_:1},8,["model"])])),_:1},8,["modelValue"]),(0,t.Wm)(D,{class:"Table",border:"",columns:A.columnsNews,data:A.dataNews},{action:(0,t.w5)((({row:e,index:a})=>[(0,t.Wm)(I,{size:"small",style:{"margin-right":"5px"},onClick:e=>Q.clickNewsEdit(a)},{default:(0,t.w5)((()=>[(0,t.Uk)("編輯")])),_:2},1032,["onClick"]),(0,t.Wm)(O,{title:"編輯最新消息資訊","ok-text":"確認修改","cancel-text":"取消",modelValue:A.NewsEdit[a],"onUpdate:modelValue":e=>A.NewsEdit[a]=e,width:"700px",closable:!0,onOnOk:Q.ok,onOnCancel:Q.cancel},{default:(0,t.w5)((()=>[(0,t.Wm)(P,{action:"http://localhost/PV/PVBackend/public/php/newsUpdateToDb.php",method:"post",model:A.addNews,"label-width":80,enctype:"multipart/form-data"},{default:(0,t.w5)((()=>[(0,t.Wm)(j,{label:"消息編號","label-width":73},{default:(0,t.w5)((()=>[(0,t._)("text",null,(0,d.zw)(A.addNews.news_no),1)])),_:1}),(0,t.wy)(((0,t.wg)(),(0,t.j4)(j,{label:"消息標題:",prop:"title_news","label-width":73,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{name:"news_title",modelValue:A.addNews.news_title,"onUpdate:modelValue":l[14]||(l[14]=e=>A.addNews.news_title=e),placeholder:"aa"},null,8,["modelValue"])])),_:1})),[[B,300]]),(0,t.Wm)(j,{label:"消息照片",prop:"img","label-width":73},{default:(0,t.w5)((()=>[(0,t._)("label",V,[(0,t.wy)((0,t._)("input",{id:"imageEditInput",name:"news_image",type:"image","onUpdate:modelValue":l[15]||(l[15]=e=>A.tempImageFile=e)},null,512),[[o.nr,A.tempImageFile]]),(0,t.wy)((0,t._)("img",{width:"200",height:"200",src:`/${A.addNews.news_image}`,alt:""},null,8,x),[[o.F8,!A.tempImageFile]])])])),_:1}),(0,t.Wm)(R,{size:"large",wrap:"",class:"ivu-mb"},{default:(0,t.w5)((()=>[y,(0,t.Wm)(F,{name:"news_date",modelValue:A.addNews.news_date,"onUpdate:modelValue":l[16]||(l[16]=e=>A.addNews.news_date=e),type:"date",placement:"bottom-end",placeholder:"Select date",style:{width:"200px"}},null,8,["modelValue"])])),_:1}),(0,t.Wm)(j,{label:"內容:",prop:"content","label-width":45,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{name:"news_content",modelValue:A.addNews.news_content,"onUpdate:modelValue":l[17]||(l[17]=e=>A.addNews.news_content=e),type:"textarea",autosize:{minRows:5,maxRows:5},placeholder:"內容"},null,8,["modelValue"])])),_:1})])),_:1},8,["model"])])),_:2},1032,["modelValue","onUpdate:modelValue","onOnOk","onOnCancel"]),(0,t.Wm)(I,{size:"small",onClick:e=>Q.remove(a,"News")},{default:(0,t.w5)((()=>[(0,t.Uk)("刪除")])),_:2},1032,["onClick"])])),_:1},8,["columns","data"])])):(0,t.kq)("",!0),3==A.changePage?((0,t.wg)(),(0,t.iD)("div",W,[(0,t.Wm)(I,{onClick:l[18]||(l[18]=e=>A.modalQA=!0),class:"add ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Uk)("新增 +")])),_:1}),(0,t.Wm)(O,{title:"新增Q&A",modelValue:A.modalQA,"onUpdate:modelValue":l[21]||(l[21]=e=>A.modalQA=e),width:"700px",closable:!0},{default:(0,t.w5)((()=>[(0,t.Wm)(P,{model:A.addQA,"label-width":80,enctype:"multipart/form-data",method:"post"},{default:(0,t.w5)((()=>[(0,t.wy)(((0,t.wg)(),(0,t.j4)(j,{label:"問題標題:",prop:"title_QA","label-width":70,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{modelValue:A.addNews.title_QA,"onUpdate:modelValue":l[19]||(l[19]=e=>A.addNews.title_QA=e),placeholder:"標題"},null,8,["modelValue"])])),_:1})),[[B,300]]),(0,t.Wm)(j,{label:"問題答案:",prop:"QA_anwer","label-width":70,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{modelValue:A.addNews.QA_anwer,"onUpdate:modelValue":l[20]||(l[20]=e=>A.addNews.QA_anwer=e),type:"textarea",autosize:{minRows:5,maxRows:5},placeholder:"內容"},null,8,["modelValue"])])),_:1})])),_:1},8,["model"])])),_:1},8,["modelValue"]),(0,t.Wm)(D,{class:"Table",border:"",columns:A.columnsQA,data:A.dataQA},{action:(0,t.w5)((({row:e,index:a})=>[(0,t.Wm)(I,{size:"small",style:{"margin-right":"5px"},onClick:e=>Q.clickQAEdit(a)},{default:(0,t.w5)((()=>[(0,t.Uk)("編輯")])),_:2},1032,["onClick"]),(0,t.Wm)(O,{title:"編輯問題資訊","ok-text":"確認修改","cancel-text":"取消",modelValue:A.QAEdit[a],"onUpdate:modelValue":e=>A.QAEdit[a]=e,width:"700px",closable:!0,onOnOk:Q.ok,onOnCancel:Q.cancel},{default:(0,t.w5)((()=>[(0,t.Wm)(P,{model:A.addQA,"label-width":80,enctype:"multipart/form-data",method:"post"},{default:(0,t.w5)((()=>[(0,t.Wm)(j,{label:"問題編號:","label-width":75},{default:(0,t.w5)((()=>[(0,t._)("text",null,(0,d.zw)(A.addQA.number_QA),1)])),_:1}),(0,t.wy)(((0,t.wg)(),(0,t.j4)(j,{label:"問題標題:",prop:"title_QA","label-width":75,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{modelValue:A.addQA.title_QA,"onUpdate:modelValue":l[22]||(l[22]=e=>A.addQA.title_QA=e),placeholder:"標題"},null,8,["modelValue"])])),_:1})),[[B,300]]),(0,t.Wm)(j,{label:"問題答案:",prop:"QA_anwer","label-width":75,class:"ivu-mb"},{default:(0,t.w5)((()=>[(0,t.Wm)(z,{modelValue:A.addQA.QA_anwer,"onUpdate:modelValue":l[23]||(l[23]=e=>A.addQA.QA_anwer=e),type:"textarea",autosize:{minRows:5,maxRows:5},placeholder:"內容"},null,8,["modelValue"])])),_:1})])),_:1},8,["model"])])),_:2},1032,["modelValue","onUpdate:modelValue","onOnOk","onOnCancel"]),(0,t.Wm)(I,{size:"small",onClick:e=>Q.remove(a,"QA")},{default:(0,t.w5)((()=>[(0,t.Uk)("刪除")])),_:2},1032,["onClick"])])),_:1},8,["columns","data"])])):(0,t.kq)("",!0)])),_:1})),[[B,900]])])}var A=a(114),Q=a(4161),N={data(){return{tempImageFile:null,clickEditBtnT:!1,memore:0,changePage:0,changePageText:[{text:"首頁照片"},{text:"團隊介紹"},{text:"最新消息"},{text:"Q&A"}],banner:[],defaultList:[{name:"image-demo-1.jpg",url:"https://file.iviewui.com/images/image-demo-1.jpg"}],imgName:"",visible:!1,uploadList:[],modalTeam:!1,TeamEdit:[],columnsMem:[{title:"團隊成員編號",key:"number"},{title:"成員名稱",key:"name"},{title:"成員照片路徑",key:"mem_img"},{title:"成員職稱",key:"job"},{title:"成員經歷",key:"exp"},{title:"編輯",slot:"action"}],addTeamItem:{number:null,name:"",mem_img:"",job:"",exp:""},dataMem:[{number:1,name:"李曉如",mem_img:"../assets/image/more.svg",job:"工程師",exp:"111111"}],NewsEdit:[],modalNews:!1,columnsNews:[{title:"消息編號",key:"news_no",width:70},{title:"消息標題",key:"news_title",width:120},{title:"消息照片路徑",key:"news_image",width:100},{title:"日期",key:"news_date",width:120},{title:"內容",key:"news_content"},{title:"編輯",slot:"action",width:80}],dataNews:[],addNews:[{news_no:null,news_title:"",news_image:"",news_date:"",news_content:""}],modalQA:!1,QAEdit:[],columnsQA:[{title:"問題編號",key:"number_QA"},{title:"問題標題",key:"title_QA"},{title:"問題答案",key:"QA_anwer"},{title:"編輯",slot:"action",width:140}],dataQA:[{number_QA:1,title_QA:"問題標題",QA_anwer:"QA_anwerQA_anwerQA_anwerQA_anwer"}],addQA:[{number_QA:null,title_QA:"",QA_anwer:""}]}},methods:{ok(){console.log(this.addNews);const e=new FormData,l=new Date(this.addNews.news_date);e.append("news_no",this.addNews.news_no),e.append("news_title",this.addNews.news_title),e.append("news_content",this.addNews.news_content),e.append("news_image",this.tempImageFile),e.append("news_date",`${l.getFullYear()}-${l.getMonth()+1}-${l.getDate()}`),Q.Z.post("http://localhost/PV/PVBackend/public/php/newsUpdateToDb.php",e).then((e=>{console.log(e)})).catch((e=>{console.error(e)}))},cancel(){},handleView(e){this.imgName=e,this.visible=!0},handleRemove(e){const l=this.$refs.upload.fileList;this.$refs.upload.fileList.splice(l.indexOf(e),1)},handleSuccess(e,l){},handleFormatError(e){this.$Notice.warning({title:"The file format is incorrect",desc:"File format of "+e.name+" is incorrect, please select jpg or png."})},handleMaxSize(e){this.$Notice.warning({title:"Exceeding file size limit",desc:"File  "+e.name+" is too large, no more than 2M."})},handleBeforeUpload(){const e=this.uploadList.length<5;return e||this.$Notice.warning({title:"Up to five pictures can be uploaded."}),e},changeButton(e){this.changePage=e,console.log(this.changePage)},clickTeamEdit(e){this.TeamEdit[e]=!0,this.addTeamItem={...this.dataMem[e]}},clickNewsEdit(e){this.NewsEdit[e]=!0,this.addNews={...this.dataNews[e]}},clickQAEdit(e){this.QAEdit[e]=!0,this.addQA={...this.dataNews[e]}},remove(e,l){"Mem"===l?this.dataMem.splice(e,1):"News"===l?this.dataNews.splice(e,1):"QA"===l&&this.dataQA.splice(e,1)},replaceItem(e){this.$refs["updateForm1"].validate((l=>{l?(this.addItem.itinerary_number_of_years=this.addItem.itinerary_number_of_years.toLocaleDateString().replace(/\//g,"-"),this.updateData(e)):alert("修改失敗，請確認表格是否輸入正確")}))},cancelEdit(){this.addItem={...this.resetItem}}},mounted(){},components:{Side:A.Z},created(){Q.Z.get("http://localhost/PV/PVBackend/public/php/banner.php").then((e=>{this.banner=e.data,console.log(this.banner)})).catch((e=>{console.error(e)})),Q.Z.get("http://localhost/PV/PVBackend/public/php/news.php").then((e=>{this.dataNews=e.data,console.log(this.dataNews)})).catch((e=>{console.error(e)}))}},U=a(89);const T=(0,U.Z)(N,[["render",v]]);var I=T}}]);
//# sourceMappingURL=FEcontent.js.map