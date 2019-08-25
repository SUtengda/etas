<template>
    <div class="login">
        <el-form ref="loginForm" :model="form" :rules="rules" label-width="80px" class="login-box">
            <h3 class="login-title">欢迎登录</h3>
            <el-form-item label="账号" prop="username">
                <el-input type="text" placeholder="请输入账号" v-model="form.username"/>
            </el-form-item>
            <el-form-item label="密码" prop="password">
                <el-input type="password" placeholder="请输入密码" v-model="form.password"/>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" v-on:click="onSubmit('loginForm')">登录</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                form: {
                    username: '',
                    password: ''
                },
                // 表单验证，需要在 el-form-item 元素中增加 prop 属性
                rules: {
                    username: [
                        {required: true, message: '账号不可为空', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '密码不可为空', trigger: 'blur'}
                    ]
                },
                // 对话框显示和隐藏
                dialogVisible: false
            }
        },
        methods: {
            onSubmit(formName) {
                // 为表单绑定验证功能
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.login(this.form.username,this.form.password)
                    } else {
                        return false;
                    }
                });
            },
            login(user,pass){
                axios.post('login',{email:user,password:pass})
                    .then( (response) =>{
                        // 使用 vue-router 路由到指定页面，该方式称之为编程式导航
                        // this.$router.push("/main");
                        this.$router.push('dashboard');
                        this.$message({
                            type: 'success',
                            message: '登陆成功'
                        });
                    })
                    .catch( (error)=> {
                        this.$message({
                            type: 'error',
                            message: '登陆失败，账号密码不匹配'
                        });
                    });
            }
        }
    }
</script>

<style scoped>
    .login{
        width: 50%;
        height: 50%;
        text-align: center;
        position: absolute;
        top:0;
        bottom: 0;
        left: 0;
        right: 0;

        margin: auto;
    }
</style>