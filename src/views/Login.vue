<template>
    <div id="backGround">
        <div class="imgSvg">
            <img src="../assets/image/icon.svg" alt="icon" />
        </div>
        <div id="allIn">
            <!-- <router-view/>  -->

            <p>{{ textP }}</p>
            <form id="backstageIN" @submit.prevent="login">
                <!-- <label for="accountIn">帳號</label> -->
                <input id="accountIn" type="text" placeholder="輸入帳號" v-model="adminid" name="adminid" /><br>
                <!-- <label for="accountPass">帳號</label> -->
                <input id="accountPass" type="password" placeholder="輸入密碼" v-model="adminpsw" name="adminpsw" />
                <button type="submit">
                    <svg width="250" height="40">
                        <!-- <polygon points="1,1 98%,1 98%,98% 95%,98% 94%,90% 85%,90% 85%,98% 8%,98% 1,70%" fill="#5B13EC" /> -->
                        <polygon points="0,0 250,0 250,40 230,40 230,28 213.52,28 213.52,40 19.44,40 0,26.5"
                            fill="#5B13EC" />
                        <text x="49%" y="60%" class="textGo">登入</text>
                        <text x="85.5%" y="99%" class="smallText">-pv-</text>
                    </svg>
                </button>

            </form>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import "~@/assets/sass/style.scss";

#backGround {
    position: relative;
    margin: 0 auto;
    width: 90%;
    height: 150vh;
    background-image: url(../assets/image/backGsvg.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;

    &::before {
        position: absolute;
        content: '';
        // width: 100vw;
        z-index: -1;
        top: 0;
        left: -5%;
        ;
        width: 110%;
        height: 100%;
        background: $black;
    }

    // z-index: 0;

    .imgSvg {

        width: 40%;
        margin: 0 auto;
        padding-top: 80px;

        img {
            width: 100%;
        }
    }

    #allIn {
        height: 80%;
        width: 580px;
        margin: 60px auto;

        p {
            text-align: center;
            font-size: 24px;

            font-weight: 700;

            letter-spacing: 7.2px;
            color: $white;

        }

        #backstageIN {
            margin: 50px auto;

            input {
                width: 50%;
                padding: 5px;
                margin: 20px auto;
                display: block;
                border-radius: 10px;
            }

            button {
                display: block; // 讓button成為區塊級元素
                width: 250px; // 確保其寬度小於其容器寬度
                margin: 50px auto;
                background: transparent;
                border: none;
                outline: transparent;
                cursor: pointer;

                // width: 150px;
                svg {
                    font-size: 16px;
                    overflow: visible;

                    .textGo {
                        fill: $white;
                        font-size: 16px;
                        font-weight: 700;
                        letter-spacing: 10px;
                        text-align: center;


                    }

                    .smallText {

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

export default {
    components: {
    },
    data() {
        return {
            textP: "BACKSTAGE MANAGEMENT",
            adminid: '',
            adminpsw: '',
        }
    },
    methods: {
        login() {
            if (this.adminid == '' || this.adminpsw == '') {
                alert('請輸入帳號和密碼')
            } else {
                const info = new FormData();
                info.append("adminid", this.adminid);
                info.append("adminpsw", this.adminpsw);

                fetch('http://localhost/PV/PVBackend/public/php/adminLogin.php', {
                    method: 'POST',
                    body: info,
                })
                    .then(res => res.json())
                    .then((result) => {
                        if (result.adminid == this.adminid && result.adminpsw == this.adminpsw && !result.admin_status === "停權") {
                            alert("登入成功！");
                            this.$router.push('/Administrator')
                         } else if(result.admin_status === "停權"){
                            alert("沒有權限");
                        }else{
                            alert("帳號或密碼錯誤");
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    })
            }
        }
    }
}
</script>
