<template>
    <div>
        <div class="mb-2">
            <el-button type="primary" @click="handleAdd">添加合作方</el-button>
        </div>
        <el-table
        :data="part_data"
        stripe
        style="width:100%">
            <el-table-column
                    prop="PAR_partner"
                    label="合作方"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="PAR_contact"
                    label="联系人"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="PAR_address"
                    label="地址"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="PAR_telephone"
                    label="座机"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="PAR_mobilePhone"
                    label="手机"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="PAR_email"
                    label="电邮"
                    width="180">
            </el-table-column>
            <el-table-column label="操作" width="180">
                <template slot-scope="scope">
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

        <PartDialog
                ref="partDialog"
                :dialogFormVisible="dialogFormVisible"
                :partner = "partner"
                :title = "dialogTitle"
                v-on:dialogFormSubmit="postOrUpdatePartner"
        >
        </PartDialog>



    </div>

</template>

<script>
    const axios = require('axios');
    import { store } from "@/js/store";

    import PartDialog from './partSubcomponents/PartDialog'

    export default {
        name: "setPartner",
        components:{
            PartDialog,
        },
        computed:{
            partnerUpdated(){
                return store.partnerUpdated
            }
        },
        data(){
            return {
                part_data:[],
                dialogFormVisible: false,
                dialogTitle:'',
                partner: {},
                dialogAlertVisible:false,
            }
        },
        mounted(){
            this.getPartners();
        },
        methods:{
            getPartners(){
                axios.get(store.APIVersion+'/partners/?api_token='+etasUser.api_token)
                    .then(({data})=> {
                        this.part_data=[];
                        this.part_data.push(...data);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .finally(function () {
                        // always executed
                    });
            },
            deletePartner(id){
                axios.delete(store.APIVersion+'/partner/'+id)
                    .then((response)=>{
                        this.getPartners();
                        this.message('success','删除成功!');
                    })
                    .catch((error)=>{
                        this.$message.error('无法删除，请检查该合作方是否带有客户数据！');
                    });
            },
            postNewPartner(partner){
                axios.post(store.APIVersion+'/partners',partner)
                    .then( (response) =>{
                        this.getPartners();
                        this.message('success','添加成功!');
                    })
                    .catch( (error)=> {
                        console.log(error);
                    });
            },
            updatePartner(partner){
                axios.put(store.APIVersion+'/partner/'+partner.PAR_UID,partner)
                    .then(response=>{
                        this.getPartners();
                        this.message('success','修改成功!');
                    })
                    .catch(error=> {
                        console.log(error);
                    });
            },
            postOrUpdatePartner(partner){
                if(this.dialogTitle === '添加合作方') this.postNewPartner(partner);
                else this.updatePartner(partner);
            },
            showDialog(){
                this.$refs.partDialog.dialogFormVisible=true;
            },
            handleAdd(){
                this.dialogTitle="添加合作方";
                this.showDialog();
                this.dialogFormVisible = true;
                this.partner = {
                    PAR_partner: '',
                    PAR_contact: '',
                    PAR_address: '',
                    PAR_telephone:'',
                    PAR_mobilePhone:'',
                    PAR_email:''
                };
            },
            handleEdit(index, row) {
                console.table(index, row);
                this.dialogTitle = "修改合作方信息";
                this.showDialog();
                this.partner = {...row};
            },
            handleDelete(index, row) {
                this.$confirm('确认删除该合作方?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning',
                    center: true
                }).then(() => {
                    this.deletePartner(row.PAR_UID);
                }).catch(() => {
                    this.message('info','已取消删除')
                });

                console.table(index, row);
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