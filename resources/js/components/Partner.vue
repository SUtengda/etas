<template>
    <div>
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <el-row type="flex" class="row-bg" justify="space-between">
                    <el-col :span="6">
                        <span class="font-weight-bold">合作方 - {{partner.PAR_partner}}</span>
                    </el-col>
                    <el-col :span="6">
                        <partnerSelect></partnerSelect>
                    </el-col>
                </el-row>
<!--                <el-button style="float: right; padding: 3px 0" type="text">操作按钮</el-button>-->
            </div>
            <table class="table table-striped table-sm">
                <tbody>
                    <tr>
                        <th scope="row">联系人</th>
                        <td>{{partner.PAR_contact}}</td>
                    </tr>
                    <tr>
                        <th scope="row">地址</th>
                        <td>{{partner.PAR_address}}</td>
                    </tr>
                    <tr>
                        <th scope="row">座机</th>
                        <td>{{partner.PAR_telephone}}</td>
                    </tr>
                    <tr>
                        <th scope="row"> 手机</th>
                        <td>{{partner.PAR_mobilePhone}}</td>
                    </tr>
                    <tr>
                        <th scope="row">电邮</th>
                        <td>{{partner.PAR_email}}</td>
                    </tr>
                </tbody>
            </table>
        </el-card>
    </div>
</template>

<script>
    import { store, mutations } from "@/js/store";
    import PartnerSelect from '@/js/components/infomation/PartnerSelect'

    const axios = require('axios');
    export default {
        name: "Partner",
        components:{
            PartnerSelect
        },
        data(){
            return {

            }
        },
        computed:{
            partner(){
                return store.partner;
            }
        },
        methods:{

        }
    }
</script>

<style  scoped>
    .box-card {
        width: 600px;
    }
    .table{
        margin-bottom: 0;
    }
    th{
        width:140px;
    }
</style>