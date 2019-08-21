<template>
    <div>
        <router-view></router-view>
<!--        <template v-if="logged">-->
<!--            <Dashboard></Dashboard>-->
<!--        </template>-->
<!--        <template v-else>-->
<!--            <Login></Login>-->
<!--        </template>-->
    </div>

</template>

<script>
    import { getters} from "@/js/store";

    import Dashboard from '@/js/layouts/Dashboard'
    import Login from '@/js/layouts/Login'
    export default {
        name: "App",
        components:{
            Dashboard,
            Login
        },
        data() {
            return {
            }
        },
        computed:{
            logged(){
                return getters.isLoggedIn()
            }
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>