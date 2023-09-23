<template>
    <div id="backGround"> 
        <div class="imgSvg">
            <img src="../assets/image/backend/icon.png" alt="icon" />
        </div>
        <div id="allIn">
          
            <p>{{ textP }}</p>
            <form id="backstageIN" action="">
                    <!-- <label for="accountIn">帳號</label> -->
                    <input id="accountIn" type="text" placeholder="輸入帳號" v-model="name"/><br>
                    <!-- <label for="accountPass">帳號</label> -->
                    <input id="accountPass" type="password"  placeholder="輸入密碼"  v-model="password"/>
                    <button type="submit" >
                        <svg width="290" height="40"   >
                            <!-- <polygon points="1,1 98%,1 98%,98% 95%,98% 94%,90% 85%,90% 85%,98% 8%,98% 1,70%" fill="#5B13EC" /> -->
                            <polygon points="0,0 290,0 290,40 266.85,40 266.85,28 247.55,28 247.55,40 19.44,40 0,26.5" fill="#5B13EC" />
                            <text  x="49%"  y="60%" class="textGo">登入</text>
                            <text x="85.5%"  y="99%" class="smallText">-pv-</text> 
                        </svg>
                    </button>   

            </form>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import "~@/assets/sass/style.scss";

#backGround{

    margin: 0 auto ;
    width: 90%;
    height: 150vh;
    background-image:url(../assets/image/backend/backGsvg.svg) ;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    // z-index: 0;
 
    .imgSvg{

        width: 40%;
        margin: 0 auto;
        padding-top:120px;
        img{
                width: 100%;
        }
    }
    
    #allIn{
        height: 80%;
         width: 580px;
        margin: 60px auto;

        p{  
        text-align: center;
        font-size: 24px;
     
        font-weight: 700;

        letter-spacing: 7.2px;
        color: $white;

        }
        #backstageIN{
            margin: 50px auto;
           
            input{
                width: 50%;
                padding: 5px;
                margin: 20px auto;
                display: block;
                border-radius: 10px;
            }
            button{
                margin: 50px auto;
                display: block;
                background: transparent;
                border: none;
                outline: transparent;
                svg{
                font-size: 16px;
                overflow: visible;
                .textGo{
                    fill: $white;  
                    font-size: 16px;
                    font-weight: 700;
                    letter-spacing: 10px;


                }
                .smallText{
                
                    fill: $white;  
                    font-size: 12px;


                }
        }
        }
       
        

        }
    }
}
   
</style>
   
<script>
import ButtonFlashBox from '@/components/ButtonFlash.vue'

export default {
    components: {
        ButtonFlashBox: ButtonFlashBox
    },
    data () {
        return {
            textP:"BACKSTAGE MANAGEMENT",
        
        }
    }
    }
</script>
