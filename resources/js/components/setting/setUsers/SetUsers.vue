<template>
    <div>
        <el-row :gutter="20" class="mb-3">
            <el-col :span="4">
                <el-input v-model="userName" placeholder="请输入用户名"></el-input>
            </el-col>
            <el-col :span="8">
                <el-input v-model="userEmail" placeholder="请输入新用户邮箱地址"></el-input>
            </el-col>
            <el-col :span="6">
                <el-input v-model="userPsd" placeholder="请分配初始密码"></el-input>
            </el-col>
            <el-col :span="6">
                <el-button type="primary" @click="handleAddUser">添加用户</el-button>
            </el-col>
        </el-row>

        <el-table
                :data="userData"
                stripe
                style="width: 100%">
            <el-table-column
                    prop="name"
                    label="用户"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="email"
                    label="邮箱"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="created_at"
                    label="创建日期"
                    width="180">
            </el-table-column>
            <el-table-column label="操作">

            </el-table-column>
        </el-table>
    </div>
</template>

<script>
    import { store } from "@/js/store";
    const axios = require('axios');

    export default {
        name: "SetUsers",
        data(){
            return {
                userData : [],
                userEmail:'',
                userName:'',
                userPsd:'',
                newUsers:[],
            }
        },
        mounted(){
          this.getUsers();
        },
        methods: {
            getUsers(){
                axios.get(store.APIVersion+'/users?api_token='+etasUser.api_token)
                    .then(({data})=> {
                        this.userData=[];
                        this.userData.push(...data);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
            },
            postUser(){
              axios.post(store.APIVersion+'/user',
                      {
                          name:this.userName,
                          email:this.userEmail,
                          password:this.userPsd,
                          api_token:etasUser.api_token
                      }
                  )
                  .then(({data})=> {
                      // this.newUsers.push({user:data.user,pdw:data.randomPsw})
                      this.$message({
                          message: '添加用户成功',
                          type: 'success'
                      });
                      this.getUsers();

                  })
                  .catch(function (error) {
                      this.$message({
                          message: '出错了。。。请检查该用户是否已存在',
                          type: 'warning'
                      });
                  })
            },
            handleAddUser(){
              if(this.validateEmail(this.userEmail)){
                  this.postUser()
              }else{
                  this.$message({
                      message: '邮箱格式不对,或缺少用户名',
                      type: 'warning'
                  });
              }
            },
            validateEmail(email)
            {
                return /\S+@\S+\.\S+/.test(email)
                    && this.userName && this.userName !== ''
                    && this.userPsd && this.userPsd !== '';
            },
            handleEdit(index, row) {
                console.log(index, row);
            },
            handleDelete(index, row) {
                console.log(index, row);
            }
        }
    }
</script>

<style scoped>

</style>