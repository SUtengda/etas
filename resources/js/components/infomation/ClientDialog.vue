<template>
    <div>
        <el-dialog
                :title="title"
                :visible.sync="dialogFormShow"
                :close-on-press-escape="false"
                :close-on-click-modal="false"
        >
            <el-form :label-position="labelPosition"
                     :label-width=formLabelWidth
                     ref="formPartner"
                     :model="formClient"
                     :rules="formRules"
            >

                <el-form-item label="内部编号">
                    <el-input v-model="formClient.CLI_内部编号"></el-input>
                </el-form-item>
                <el-form-item label="名称">
                    <el-input v-model="formClient.CLI_名称"></el-input>
                </el-form-item>
                <el-form-item label="法国公司号">
                    <el-input v-model="formClient.CLI_法国公司号"></el-input>
                </el-form-item>
                <el-form-item label="中国地址">
                    <el-input v-model="formClient.CLI_中国地址"></el-input>
                </el-form-item>
                <el-form-item label="联系方式">
                    <el-input v-model="formClient.CLI_联系方式"></el-input>
                </el-form-item>
                <el-form-item label="报价">
                    <el-input-number v-model="formClient.CLI_报价"
                                     :precision="2" :controls="false"
                                    placeholder="报价">
                    </el-input-number>
                </el-form-item>
                <el-form-item label="要求首付款">
                    <el-col :span="9">
                        <el-input-number
                                v-model="formClient.CLI_首付金额"
                                :precision="2" :controls="false"
                                placeholder="首付金额">
                        </el-input-number>
                    </el-col>
                    <el-col class="line" :span="2"> - </el-col>
                    <el-col :span="11">
                        <el-date-picker
                                v-model="formClient.CLI_首付到帐日"
                                value-format="yyyy-MM-dd"
                                type="date"
                                placeholder="首付到帐日">
                        </el-date-picker>
                    </el-col>
                </el-form-item>

                <el-form-item label="余款">
                    <el-col :span="9">
                        <el-input-number
                                v-model="formClient.CLI_余款金额"
                                :precision="2" :controls="false"
                                placeholder="余款金额">
                        </el-input-number>
                    </el-col>
                    <el-col class="line" :span="2"> - </el-col>
                    <el-col :span="11">
                        <el-date-picker
                                placeholder="余款到帐日"
                                value-format="yyyy-MM-dd"
                                v-model="formClient.CLI_余款到帐日"
                                type="date">
                        </el-date-picker>
                    </el-col>
                </el-form-item>

                <el-form-item label="汇率或手续费损失">
                    <el-input-number
                            v-model="formClient.CLI_汇率或手续费损失"
                            :precision="2" :controls="false">
                    </el-input-number>
                </el-form-item>
                <el-form-item label="要求税号生效日">
                    <el-date-picker
                            v-model="formClient.CLI_要求税号生效日"
                            value-format="yyyy-MM-dd"
                            type="date">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="要求EROI">
                    <el-switch
                            v-model="formClient.CLI_要求EROI"
                            active-text="是"
                            inactive-text="否">
                    </el-switch>
                </el-form-item>
                <el-form-item label="有效材效到达日">
                    <el-date-picker
                            value-format="yyyy-MM-dd"
                            v-model="formClient.有效材料到达日"
                            type="date">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="提交税务日">
                    <el-date-picker
                            value-format="yyyy-MM-dd"
                            v-model="formClient.CLI_提交税务日"
                            type="date">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="INSEE建档日">
                    <el-date-picker
                            value-format="yyyy-MM-dd"
                            v-model="formClient.CLI_INSEE建档日"
                            type="date">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="VAT号下发日">
                    <el-date-picker
                            value-format="yyyy-MM-dd"
                            v-model="formClient.CLI_VAT号下发日"
                            type="date">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="EROI申请日">
                    <el-date-picker
                            value-format="yyyy-MM-dd"
                            v-model="formClient.CLI_EROI申请日"
                            type="date">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="SIE网上申请日">
                    <el-date-picker
                            value-format="yyyy-MM-dd"
                            v-model="formClient.CLI_SIE网上申请日"
                            type="date">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="SIE网上开通日">
                    <el-date-picker
                            value-format="yyyy-MM-dd"
                            v-model="formClient.CLI_SIE网上开通日"
                            type="date">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="银行划帐开通日">
                    <el-date-picker
                            value-format="yyyy-MM-dd"
                            v-model="formClient.CLI_银行划帐开通日"
                            type="date">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="首次申报月">
                    <el-date-picker
                            value-format="yyyy-MM-dd"
                            v-model="formClient.CLI_首次申报月"
                            type="date">
                    </el-date-picker>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormClose">取 消</el-button>
                <el-button type="primary" @click="submitForm('formClient')">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    import {store, Client } from "@/js/store";
    export default {
        name: "ClientDialog",
        props: ['dialogFormVisible','title','client'],
        data() {
            return {
                dialogFormShow:false,
                formClient: Client,
                formRules:{
                },
                formLabelWidth: '150px',
                labelPosition: 'left'
            };
        },
        watch:{
            client(newClient){
                if(newClient===''){
                    // this.formClient =  Client;
                    this.formClient.PAR_UID = store.partnerID;
                }
                 else this.formClient = {...newClient};
            }
        },
        methods:{
            dialogFormClose(){
                this.dialogFormShow=false;
            },
            submitForm(formName) {
                this.$emit('dialogFormSubmit',this.formClient);
                this.dialogFormClose();
                // this.$refs[formName].validate((valid) => {
                //     if (valid) {
                //         this.$emit('dialogFormSubmit',this.formClient);
                //         this.dialogFormClose();
                //     } else {
                //         console.log('error submit!!');
                //         return false;
                //     }
                // });
            },

        }
    }
</script>

<style scoped>

</style>