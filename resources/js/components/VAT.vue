<template>
    <div class="mb-3">
        <div class="mb-2">
            <span class="demonstration">选择月份</span>
            <el-date-picker
                    v-model="monthSelected"
                    type="month"
                    value-format="yyyy-MM-dd"
                    placeholder="选择月">
            </el-date-picker>
        </div>
        <el-table
            :data="vats_data"
            style="width: 100%">
            <el-table-column
                label="ID"
                prop="CLI_UID"
                width="120">
            </el-table-column>
            <el-table-column
                label="名称"
                prop="CLI_名称"
                width="120">
            </el-table-column>
            <el-table-column
                label="爱达内部编号"
                prop="CLI_内部编号"
                width="120">
            </el-table-column>
            <el-table-column
                :label="month"
                header-align="center">
                <el-table-column
                    label="亚马逊月销售收入"
                    header-align="center">
                    <el-table-column
                        label="电商计算数据"
                        prop="vats[0].VAT_月销计算数据"
                        width="120">
                    </el-table-column>
                    <el-table-column
                        label="审核数据"
                        prop="vats[0].VAT_月销审核数据"
                        width="120">
                    </el-table-column>
                </el-table-column>
                <el-table-column
                    label="亚马逊月VAT金额"
                    header-align="center">
                    <el-table-column
                        label="电商计算数据"
                        prop="vats[0].VAT_VAT计算数据"
                        width="120">
                    </el-table-column>
                    <el-table-column
                        label="审核数据"
                        prop="vats[0].VAT_VAT审核数据"
                        width="120">
                    </el-table-column>
                </el-table-column>
                <el-table-column
                    label="收到VAT税金"
                    header-align="center">
                    <el-table-column
                    label="实收金额"
                    prop="vats[0].VAT_VAT实收金额"
                    width="120">
                    </el-table-column>
                    <el-table-column
                    label="到帐日期"
                    :formatter="pipeDate"
                    prop="vats[0].VAT_VAT到帐日期"
                    width="120">
                    </el-table-column>
                </el-table-column>
                <el-table-column
                    label="税务申报"
                    header-align="center">
                    <el-table-column
                        label="网上申报日"
                        :formatter="pipeDate"
                        prop="vats[0].VAT_税务网上申报日"
                        width="120">
                    </el-table-column>
                    <el-table-column
                        label="网上付款日"
                        :formatter="pipeDate"
                        prop="vats[0].VAT_税务网上付款日"
                        width="120">
                    </el-table-column>
                </el-table-column>
            </el-table-column>
            <el-table-column label="操作" align="center" width="150">
                <template slot-scope="scope" >
                    <el-button
                            size="mini"
                            @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            :disabled="scope.row.vats.length===0"
                            @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>

        <VatDialog
            ref="vatDialog"
            :month="monthSelected"
            :vats="vats"
            :clientId="clientId"
            v-on:dialogFormSubmit="postOrUpdateVat">
        </VatDialog>

    </div>
</template>

<script>
    import { store, mutations} from "@/js/store";
    import VatDialog from '@/js/components/infomation/VatDialog';

    export default {
        name: "VAT",
        components:{
            VatDialog,
        },
        data(){
            return {
                vats_data:[],
                //"2019-02-01"
                monthSelected:'',
                vats : '',
                clientId:''
            }
        },
        computed:{
            par_id(){
                return store.partnerID
            },
            month(){
                return store.monthSelected
            }
        },
        // mounted(){
        //     const today = new Date();
        //     this.monthSelected =`${today.getFullYear()}-${today.getMonth()+1}-01`
        // },
        watch:{
            par_id(newID){
                if(this.monthSelected==='') return;
                this.getVats(newID,this.monthSelected);
            },
            monthSelected(newDate){
                mutations.setMonthSelected(newDate);
                if(this.par_id==='') return;
                this.getVats(this.par_id,newDate);
            }
        },
        methods:{
            getVats(par_id,month){
                axios.get(`${store.APIVersion}/vats?PAR_UID=${par_id}&month=${month}`)
                    .then(({data})=>{
                        this.vats_data=[];
                        this.vats_data = [...data];
                    })
            },
            postOrUpdateVat(vat){
                axios.post(store.APIVersion+'/vats',vat)
                    .then( (response) =>{
                        this.getVats(store.partnerID,this.monthSelected);
                        this.message('success','添加或修改成功!');
                    })
                    .catch( (error)=> {
                        console.log(error);
                        this.$message.error('出错了。。。');
                    });
            },
            deleteVat(id){
                axios.delete(store.APIVersion+'/vat/'+id)
                    .then((res)=>{
                        this.getVats(store.partnerID,this.monthSelected);
                        this.message('success','删除成功!');
                    })
            },
            handleEdit(index, row) {
                this.$refs.vatDialog.dialogFormShow=true;
                this.vats = {...row.vats[0]};
                this.clientId=row.CLI_UID;
                console.log({index, row});
            },
            handleDelete(index, row) {
                this.$confirm('确认删除该客户?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning',
                    center: true
                }).then(() => {
                    this.deleteVat(row.vats[0].VAT_UID)
                }).catch(() => {
                    this.message('info','已取消删除')
                });
                console.log({index, row});
            },
            pipeDate(row, column, cellValue, index){
                if(!cellValue) {
                    return ''
                }
                const date = new Date(cellValue);
                return `${date.getFullYear()}-${date.getMonth()+1}-${date.getDate()}`;
            },
            message(type,message){
                this.$message({
                    type: type,
                    message: message
                });
            }
        }
    }
</script>

<style scoped>

</style>