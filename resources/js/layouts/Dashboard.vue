<template>
    <div>
        <el-container>
            <el-header>

                <el-row>
                    <el-col :span="22">
                        <div class="title">ETAS 税代 管理程序</div>
                    </el-col>
                    <el-col :span="2">
                        <el-link :underline="false">退出登录</el-link>
                    </el-col>
                </el-row>


            </el-header>
            <el-container>
                <el-aside width="200px">
                    <el-menu
                            default-active="2"
                            class="el-menu-vertical-demo"
                            @select="handleSelect"
                            @open="handleOpen"
                            @close="handleClose">
                        <el-menu-item index="clients">
                            <i class="el-icon-menu"></i>
                            <span slot="title"> 客户  </span>
                        </el-menu-item>
                        <el-menu-item index="vat">
                            <i class="el-icon-document"></i>
                            <span slot="title">VAT</span>
                        </el-menu-item>
                        <el-submenu index="setting">

                            <template slot="title">
                                <i class="el-icon-setting"></i>
                                <span>设置</span>
                            </template>
                            <el-menu-item index="setPartner">
                                合作方
                            </el-menu-item>
                        </el-submenu>
                    </el-menu>
                </el-aside>

                <el-main>
                    <div class="mb-3">
                        <Partner></Partner>
                    </div>
                    <router-view></router-view>
                </el-main>
            </el-container>
        </el-container>
    </div>
</template>

<script>
    import Information from '@/js/pages/Information'
    import Partner from '@/js/components/Partner'
    export default {
        name: "Dashboard",
        components:{
            Information,
            Partner
        },
        data() {
            return {
                visible: false
            }
        },
        methods: {
            handleOpen(key, keyPath) {
                console.log(key, keyPath);
            },
            handleClose(key, keyPath) {
                console.log(key, keyPath);
            },
            handleSelect(key, keyPath) {
                this.$router.push({name:key})
            },
        }
    }
</script>

<style scoped>
    .title{
        font-size: 2rem;
    }
    .el-header, .el-footer {
        background-color: #B3C0D1;
        color: #333;
        text-align: center;
        line-height: 60px;
    }

    .el-aside {
        background-color: #D3DCE6;
        color: #333;
        height: 100vh
    }
</style>