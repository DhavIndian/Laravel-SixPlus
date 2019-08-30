<template>
    <div class="wrapper">
        <Header />
        <Submenu />
         <slot />
    </div>
</template>
<script>
import Vue from 'vue'
import Header from '@/components/inc/header'
import Footer from '@/components/inc/footer'
import Submenu from '@/views/usersubmenu/Submenu'
export default {
    mounted() {},
    name: "HomeVue",
    components: {
        'Header': Header,
        'Footer': Footer,
        'Submenu' : Submenu,
    },
    data() {
        return {};
    },
    methods: {
        logout: function() {
            this.$store.dispatch('logout')
                .then(() => {
                    this.$router.push('/login')
                })
        }
    }
};

</script>
