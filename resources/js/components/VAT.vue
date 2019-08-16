<template>
    <div class="mb-3">
        <el-table
            :data="vat_data"
            style="width: 100%">
            <el-table-column
                prop="CLI_UID">
            </el-table-column>
            <el-table-column
                label="爱达内部编号"
                prop="CLI_爱达内部编号"
                width="120">
            </el-table-column>
            <div v-for="o in 3">
                <el-table-column
                    :label="'月份'+ o"
                    header-align="center">
                    <el-table-column
                        label="亚马逊月销售收入"
                        header-align="center">
                        <el-table-column
                            label="电商计算数据"
                            width="120">
                        </el-table-column>
                        <el-table-column
                            label="审核数据"
                            width="120">
                        </el-table-column>
                    </el-table-column>
                    <el-table-column
                        label="亚马逊月VAT金额"
                        header-align="center">
                        <el-table-column
                            label="电商计算数据"
                            width="120">
                        </el-table-column>
                        <el-table-column
                            label="审核数据"
                            width="120">
                        </el-table-column>
                    </el-table-column>
                    <el-table-column
                        label="收到VAT税金"
                        header-align="center">
                        <el-table-column
                        label="实收金额"
                        width="120">
                        </el-table-column>
                        <el-table-column
                        label="到帐日期"
                        width="120">
                        </el-table-column>
                    </el-table-column>
                    <el-table-column
                        label="税务申报"
                        header-align="center">
                        <el-table-column
                            label="网上申报日"
                            width="120">
                        </el-table-column>
                        <el-table-column
                            label="网上付款日"
                            width="120">
                        </el-table-column>
                    </el-table-column>
                </el-table-column>

            </div>
        </el-table>

    </div>
</template>

<script>
    export default {
        name: "VAT",
        data(){
            return {
                vat_data:[{CLI_UID:1,CLI_爱达内部编号:"EFB001"}],
            }
        }
    }
</script>

<style scoped>

</style>