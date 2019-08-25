<template>
    <div>
        <el-select v-model="value" filterable placeholder="请选择合作方">
            <el-option
                    v-for="item in options"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
            </el-option>
        </el-select>
    </div>
</template>

<script>
    import { store, mutations } from "@/js/store";
    const axios = require('axios');

    export default {
        name: "PartnerSelect",
        data() {
            return {
                // partnerUpdatedState:'',
                options: [],
                value: ''
            }
        },
        mounted(){
            this.getPartners();
        },
        watch:{
            value(PAR_UID){
                mutations.setPartnerID(PAR_UID);
                mutations.setPartner(PAR_UID);
            }
        },
        methods: {
            getPartners(){
                axios.get(store.APIVersion+'/partners/?api_token='+etasUser.api_token)
                    .then(({data})=> {
                        this.options=data.map(item =>{
                            return {value : item.PAR_UID, label:item.PAR_partner}
                        })
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })

            },
        }
    }
</script>

<style scoped>

</style>