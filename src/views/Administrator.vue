<template>
    <div class=" layout">
        <Side :activePage='1' />

        <Button to="/" class="out" style="width: 42px;height:32px;line-height: 35px; ">
            登出
        </Button>

        <Layout v-width="700" :style="{ marginLeft: '300px' }">
            <h1>管理員管理</h1>
            <Table class="Table" height="200" border :columns="columns" :data="data">
                <template #action="{ row, index }">
                    <Button v-if="show(index)" size="small" style="margin-right: 5px" @click="stop(index)"
                        @on-change="onChange(index)">
                        {{ this.data[index].admin_status }}
                </Button>
                </template>
            </Table>

        </Layout>
    </div>
</template>
<style scoped lang="scss">
@import "~@/assets/sass/style.scss";

.layout {
    background: #F5F7F9;
    width: 100vw;
    min-height: 100vh;

    position: relative;
    border-radius: 4px;

    h1 {
        color: $black;
        font-size: 24px;
        padding: 20px 0 20px 0;
    }

    .out {
        float: right;
        margin-top: 15px;
        margin-right: 20px;
        font-size: 16px;
        border-radius: 10px;
        border: 1px solid $black;
        cursor: pointer;

    }


}
</style>
<script>
import Side from '@/components/SideNav.vue'
import axios from 'axios';

export default {
    data() {
        return {
            // stopText:"停權",
            columns: [
                {
                    title: '管理員帳號',
                    key: 'admin_account'
                },
                {
                    title: '管理者密碼',
                    key: 'admin_psw'
                },
                {
                    title: '管理員權限',
                    key: 'admin_allow'
                },
                {
                    title: '管理員狀態',
                    key: 'admin_status'
                },
                {
                    title: '',
                    slot: 'action',
                    width: 90,

                }
            ],
            data: [],
            // admin: {
            //     name: '',
            //     password: '',
            //     permissions: '',
            // }
        }
    },
    components: {
        Side
    },
    methods: {
        stop(index) {
            if (this.data[index].admin_status == "停權") {
                this.data[index].admin_status = "啟用"
            } else {
                this.data[index].admin_status = "停權";
            }
        },
        show(index) {

            if (this.data[index].admin_allow == 'FullAccess') {
                return false;
            } else {

                return true;
            }
        },


        onChange(index) {
            if (this.data[index].admin_status === "啟用") {
                this.$Message.info("管理員狀態： 正常");
            } else if (this.data[index].admin_status === "停權") {
                this.$Message.info("管理員狀態： 停權");
            }

        },
    },
    watch: {

        updateStatus(row) {
            console.log(this.data[row]);
            const formData = new FormData();
            formData.append("admin_status", this.data[row].admin_status);
            formData.append("admin_account", this.data[row].admin_account);

            fetch(`http://localhost/PV/PVBackend/public/php/adminupdate.php`, {
                method: "POST",
                body: formData,
            })
                .then((res) => res.json())
                .then((res) => {
                    const result = res;
                });
        },
    },

    //     // return this.data.map(index => index.permissions !== '最高');

    // },
    created() {
        axios.get('http://localhost/PV/PVBackend/public/php/admin.php')
            .then((res) => {
                this.data = res.data;
                console.log(this.data);
            }).catch(error => {
                console.error(error);
            });

    }

}
//登入狀態驗證
// fetch('http://localhost/PV/PVBackend/public/php/verifyLogin.php')
//     .then(res => res.json())
//     .then((result) => {
//         if (result.msg === "未登入") {//跳轉回登入頁
//             this.$router.push('/');
//         }else{
//             this.$router.push('/Administrator')
//         }
//     })
//     .catch(error => {
//         console.error(error);
//     });



</script>