<template>
    <div class="reset-password">
        <el-form :model="resetPwdForm" status-icon :rules="resetPwdFormRules" ref="resetPwdForm" label-width="100px">
            <el-form-item label="新密码" prop="newpwd">
                <el-input type="password" v-model="resetPwdForm.newpwd" auto-complete="off"></el-input>
            </el-form-item>
            <el-form-item label="确认密码" prop="renewpwd">
                <el-input type="password" v-model="resetPwdForm.renewpwd" auto-complete="off"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm('resetPwdForm')">提交</el-button>
                <el-button @click="resetForm('resetPwdForm')">重置</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
    // const axios = require('axios');
    export default {
        name: "ResetPassword",
        data(){
            var validatePass = (rule, value, callback) => {
                if (value==='') {
                    callback(new Error('未输入密码'));
                }  else {
                    callback();
                }
            };
            var validatePass2 = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请再次输入新密码'));
                } else if (value !== this.resetPwdForm.newpwd) {
                    callback(new Error('两次输入密码不一致!'));
                } else {
                    callback();
                }
            };
            return {
                resetPwdForm:{
                    newpwd:'',
                    renewpwd:'',
                },
                resetPwdFormRules:{
                    newpwd: [
                        { required: true, validator: validatePass, trigger: 'blur' }
                    ],
                    renewpwd: [
                        { required: true, validator: validatePass2, trigger: 'blur' }
                    ]
                }
            }
        },
        methods:{
            resetPwd(){
                axios.post('/password/reset',this.resetPwdForm)
                  .then( (response) =>{
                      this.$message({
                          type: 'success',
                          message: '密码修改成功'
                      });
                      this.resetPwdForm.newpwd = '';
                      this.resetPwdForm.renewpwd = '';
                  })
                  .catch( (error)=> {
                  });
            },
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.resetPwd();
                    } else {
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            }
        }
    }
</script>

<style scoped>

</style>