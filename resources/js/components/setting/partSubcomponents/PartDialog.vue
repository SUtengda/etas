<template>
    <div>
        <el-dialog
                :title="title"
                :visible.sync="dialogFormVisible"
        >
            <el-form :label-position="labelPosition"
                     label-width="80px"
                     ref="formPartner"
                     :model="formPartner"
                     :rules="formRules"
            >
                <el-form-item label="合作方" prop="PAR_partner">
                    <el-input v-model="formPartner.PAR_partner"></el-input>
                </el-form-item>
                <el-form-item label="联系人" prop="PAR_contact">
                    <el-input v-model="formPartner.PAR_contact"></el-input>
                </el-form-item>
                <el-form-item label="地址" prop="PAR_address">
                    <el-input v-model="formPartner.PAR_address"></el-input>
                </el-form-item>
                <el-form-item label="座机" prop="PAR_telephone">
                    <el-input v-model="formPartner.PAR_telephone"></el-input>
                </el-form-item>
                <el-form-item label="手机" prop="PAR_mobilePhone">
                    <el-input v-model="formPartner.PAR_mobilePhone"></el-input>
                </el-form-item>
                <el-form-item label="电邮" prop="PAR_email">
                    <el-input v-model="formPartner.PAR_email"></el-input>
                </el-form-item>
            </el-form>

            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormClose">取 消</el-button>
                <el-button type="primary" @click="submitForm('formPartner')">确 定</el-button>
            </div>
        </el-dialog>
    </div>

</template>

<script>
    export default {
        name: "PartDialog",
        props: ['title','partner'],
        data(){
            return {
                dialogFormVisible:false,
                labelPosition: 'left',
                formPartner: {
                    PAR_partner: '',
                    PAR_contact: '',
                    PAR_address: '',
                    PAR_telephone:'',
                    PAR_mobilePhone:'',
                    PAR_email:''
                },
                formRules:{
                    PAR_partner: [
                        {required:true,message:'请输入合作方',trigger:'blur'}
                    ],
                    PAR_contact: [
                        {required:true,message:'请输入联系人',trigger:'blur'}
                    ],
                    PAR_address: [
                        {required:true,message:'请输入地址',trigger:'blur'}
                    ],
                    PAR_mobilePhone:[
                        {required:true,message:'请输入手机号',trigger:'blur'}
                    ],
                    PAR_email:[
                        { type: 'email',required:true,message:'请输入有效电子邮件',trigger:'blur'}
                    ]
                }

            }
        },
        watch:{
            partner(newPartner){
                this.formPartner = {...newPartner};
            }
        },
        methods:{
            dialogFormClose(){
                this.dialogFormVisible=false;
            },
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                      this.$emit('dialogFormSubmit',this.formPartner);
                      this.dialogFormClose();
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