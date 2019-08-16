<template>
    <div>
        <div class="mb-2" v-show="par_id">
            <el-button type="primary" @click="handleAdd">为{{currentPartner}}添加客户</el-button>
        </div>

        <el-table
            :data="clients_data"
            stripe
            style="width:100%">
            <el-table-column
                prop="CLI_UID">
            </el-table-column>
            <el-table-column
                label="爱达内部编号"
                prop="CLI_内部编号"
                width="110">
            </el-table-column>
            <el-table-column
                label="电商信息"
                align="center">
                <el-table-column
                    label="名称"
                    prop="CLI_名称"
                    width="110">
                </el-table-column>
                <el-table-column
                    label="法国公司号"
                    prop="CLI_法国公司号"
                    width="110">
                </el-table-column>
                <el-table-column
                    label="中国地址"
                    prop="CLI_中国地址"
                    width="110">
                </el-table-column>
                <el-table-column
                    label="联系方式"
                    prop="CLI_联系方式"
                    width="110">
                </el-table-column>
            </el-table-column>

            <el-table-column
                label="报价"
                prop="CLI_报价">
            </el-table-column>
            <el-table-column
                label="要求首付款"
                align="center">
                <el-table-column
                    label="金额"
                    prop="CLI_首付金额">
                </el-table-column>
                <el-table-column
                    label="到账日"
                    :formatter="pipeDate"
                    prop="CLI_首付到帐日"
                    width="110">
                </el-table-column>
            </el-table-column>
            <el-table-column
                label="余额"
                align="center">
                <el-table-column
                    label="金额"
                    prop="CLI_余款金额">
                </el-table-column>
                <el-table-column
                    label="到账日"
                    :formatter="pipeDate"
                    prop="CLI_余款到帐日"
                    width="110">
                </el-table-column>
                <el-table-column
                    label="汇率或手续费损失"
                    prop="CLI_汇率或手续费损失">
                </el-table-column>
            </el-table-column>

            <el-table-column
                label="申请VAT号跟踪"
                align="center">
                <el-table-column
                    label="要求税号生效日"
                    :formatter="pipeDate"
                    prop="CLI_要求税号生效日"
                    width="120">
                </el-table-column>
                <el-table-column
                    label="要求EROI"
                    :formatter="pipeEROI"
                    prop="CLI_要求EROI"
                    width="110">
                </el-table-column>
                <el-table-column
                    label="有效材料到达日"
                    :formatter="pipeDate"
                    prop="CLI_有效材料到达日"
                    width="120">
                </el-table-column>
                <el-table-column
                    label="提交税务日"
                    :formatter="pipeDate"
                    prop="CLI_提交税务日"
                    width="110">
                </el-table-column>
                <el-table-column
                    label="INSEE建档日"
                    :formatter="pipeDate"
                    prop="CLI_INSEE建档日"
                    width="110">
                </el-table-column>
                <el-table-column
                    label="VAT号下发日"
                    :formatter="pipeDate"
                    prop="CLI_VAT号下发日"
                    width="110">
                </el-table-column>
                <el-table-column
                    label="EROI申请日"
                    :formatter="pipeDate"
                    prop="CLI_EROI申请日"
                    width="110">
                </el-table-column>
                <el-table-column
                    label="SIE网上申请日"
                    :formatter="pipeDate"
                    prop="CLI_SIE网上申请日"
                    width="120">
                </el-table-column>
                <el-table-column
                    label="SIE网上开通日"
                    :formatter="pipeDate"
                    prop="CLI_SIE网上开通日"
                    width="120">
                </el-table-column>
                <el-table-column
                    label="银行划账开通日"
                    :formatter="pipeDate"
                    prop="CLI_银行划帐开通日"
                    width="120">
                </el-table-column>
                <el-table-column
                    label="首次申报月"
                    :formatter="pipeDate"
                    prop="CLI_首次申报月"
                    width="110">
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
                            @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <ClientDialog
            :client="client"
            ref="clientDialog"
            :title="dialogTitle"
            v-on:dialogFormSubmit="postOrUpdateClient">
        </ClientDialog>

    </div>
</template>

<script>
    import { store} from "@/js/store";
    import ClientDialog from "@/js/components/infomation/ClientDialog";

    export default {
        name: "Clients",
        components:{
            ClientDialog,
        },
        data(){
            return {
                clients_data:[],
                dialogFormVisible : false,
                dialogTitle : "",
                client:'',
            }
        },
        computed:{
            par_id(){
                return store.partnerID
            },
            currentPartner(){
                return store.partner===""?'':store.partner.PAR_partner;
            }
        },
        watch:{
            par_id(newID){
                this.getClients(newID);
            }
        },
        methods:{
            getClients(par_id){
                axios.get(store.APIVersion+'/clients/'+par_id)
                    .then(({data})=> {
                        this.clients_data=[];
                        this.clients_data.push(...data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },

            postOrUpdateClient(client){
                axios.post(store.APIVersion+'/clients',client)
                    .then( (response) =>{
                        this.getClients(store.partnerID);
                        this.message('success','添加或修改成功!');
                    })
                    .catch( (error)=> {
                        console.log(error);
                        this.$message.error('出错了。。。');
                    });
            },
            deleteClient(id){
                axios.delete(store.APIVersion+'/client/'+id)
                    .then((response)=>{
                        this.getClients(store.partnerID);
                        this.message('success','删除成功!');
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                },
            handleDelete(index, row) {
                this.$confirm('确认删除该客户?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning',
                    center: true
                }).then(() => {
                    this.deleteClient(row.CLI_UID)

                }).catch(() => {
                    this.message('info','已取消删除')
                });

                console.table(index, row);
            },
            showDialog(){
                this.$refs.clientDialog.dialogFormShow=true;
            },
            handleAdd(){
                this.dialogTitle=`为${this.currentPartner}添加客户`;
                this.showDialog();
                this.client = {PAR_UID : store.partnerID};
            },
            handleEdit(index, row) {
                console.table(index, row);
                this.dialogTitle = "修改客户信息";
                row.CLI_要求EROI = row.CLI_要求EROI !== 0;
                this.showDialog();
                this.client = {...row};
            },
            pipeEROI(row){
                return row.CLI_要求EROI == 1 ? '是' : '否';
            },
            pipeDate(row, column, cellValue, index){
                if(!cellValue) {
                    return ''
                }
                let date = new Date(cellValue);
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