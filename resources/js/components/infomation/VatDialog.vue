<template>
    <div>
        <el-dialog
                :title="'添加或修改该客户'+month+'月记录'"
                :visible.sync="dialogFormShow"
                :close-on-press-escape="false"
                :close-on-click-modal="false"
        >
            <el-form :label-position="labelPosition"
                     :label-width=formLabelWidth
                     ref="formPartner"
                     :model="formVats"
            >
                <el-form-item label="月销计算数据">
                    <el-input-number
                            v-model="formVats.VAT_月销计算数据"
                            :precision="2" :controls="false">
                    </el-input-number>
                </el-form-item>
                <el-form-item label="月销审核数据">
                    <el-input-number
                            v-model="formVats.VAT_月销审核数据"
                            :precision="2" :controls="false">
                    </el-input-number>
                </el-form-item>

                <el-form-item label="VAT计算数据">
                    <el-input-number
                            v-model="formVats.VAT_VAT计算数据"
                            :precision="2" :controls="false">
                    </el-input-number>
                </el-form-item>
                <el-form-item label="VAT审核数据">
                    <el-input-number
                            v-model="formVats.VAT_VAT审核数据"
                            :precision="2" :controls="false">
                    </el-input-number>
                </el-form-item>

                <el-form-item label="VAT实收金额">
                    <el-input-number
                            v-model="formVats.VAT_VAT实收金额"
                            :precision="2" :controls="false">
                    </el-input-number>
                </el-form-item>

                <el-form-item label="VAT到帐日期">
                    <el-date-picker
                            type="date"
                            placeholder="选择日期"
                            value-format="yyyy-MM-dd"
                            v-model="formVats.VAT_VAT到帐日期"
                            style="width: 100%;">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="税务网上申报日">
                    <el-date-picker
                            type="date"
                            placeholder="选择日期"
                            value-format="yyyy-MM-dd"
                            v-model="formVats.VAT_税务网上申报日"
                            style="width: 100%;">
                    </el-date-picker>
                </el-form-item>
                <el-form-item label="税务网上付款日">
                    <el-date-picker
                            type="date"
                            placeholder="选择日期"
                            value-format="yyyy-MM-dd"
                            v-model="formVats.VAT_税务网上付款日"
                            style="width: 100%;">
                    </el-date-picker>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormClose">取 消</el-button>
                <el-button type="primary" @click="submitForm('formVats')">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    import { store} from "@/js/store";
    export default {
        name: "VatDialog",
        props:['month','vats','clientId'],
        data(){
            return{
                dialogFormShow : false,

                formLabelWidth: '150px',
                labelPosition: 'left',
                formVats :{
                    VAT_UID : '',
                    PAR_UID : '',
                    CLI_UID : '',
                    VAT_月份 : '',
                    VAT_月销计算数据 :'',
                    VAT_月销审核数据 :'',
                    VAT_VAT计算数据 :'',
                    VAT_VAT审核数据 :'',
                    VAT_VAT实收金额 :'',
                    VAT_VAT到帐日期 : '',
                    VAT_税务网上申报日 : '',
                    VAT_税务网上付款日 : '',
                }
            }
        },
        watch:{
            vats(newVats){
                if(newVats.hasOwnProperty('VAT_UID')){
                    this.formVats = {...newVats};
                }else{
                    this.formVats.PAR_UID = store.partnerID;
                    this.formVats.CLI_UID = this.clientId;
                    this.formVats.VAT_月份 = this.month;
                }
            }
        },
        methods:{
            dialogFormClose(){
                this.dialogFormShow=false;
            },
            submitForm(formName) {
                this.$emit('dialogFormSubmit',this.formVats);
                this.dialogFormClose();
            },

        }
    }
</script>

<style scoped>

</style>