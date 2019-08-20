import Vue from "vue";
const axios = require('axios');

export const store = Vue.observable({
    //state ig logged
    logged : false,

    APIVersion : '/api/v1',
    partnerID: '',
    partner : '',

    //vat component
    monthSelected:'',
});

export const mutations = {
    setPartnerID(id){
        store.partnerID=id;
    },
    setPartner(id){
        axios.get(store.APIVersion+'/partner/'+id)
            .then(({data})=> {
                // handle success
                store.partner = data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
    },

    setMonthSelected(monthDate) {
        store.monthSelected = monthDate;
    }
};

export const getters = {
    isLoggedIn() {
        return store.load;
    }
};
 export const Client = {
    CLI_EROI申请日: '',
    CLI_INSEE建档日: '',
    CLI_SIE网上开通日: '',
    CLI_SIE网上申请日: '',
    CLI_VAT号下发日: '',
    CLI_中国地址: '',
    CLI_余款到帐日: '',
    CLI_余款金额: 0,
    CLI_内部编号: '',
    CLI_名称: '',
    CLI_报价: 0,
    CLI_提交税务日: '',
    CLI_有效材料到达日: '',
    CLI_法国公司号: '',
    CLI_联系方式: '',
    CLI_要求EROI: '',
    CLI_银行划帐开通日: '',
    CLI_首付到帐日: '',
    CLI_首付金额: 0,
    CLI_首次申报月: '',
    CLI_汇率或手续费损失: 0,
    CLI_要求税号生效日: '',
 };

const formPartner = {
    PAR_partner: '',
        PAR_contact: '',
        PAR_address: '',
        PAR_telephone:'',
        PAR_mobilePhone:'',
        PAR_email:''
}