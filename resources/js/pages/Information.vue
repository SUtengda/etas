<template>
    <div>
        <div class="mb-3">
            <Partner></Partner>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
    import Partner from '@/js/components/Partner'
    export default {
        name: "Information",
        components:{
            Partner,
        },
    }
</script>

<style scoped>

</style>