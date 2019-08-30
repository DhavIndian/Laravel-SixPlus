<template>
    <div class="wrapper">
        <Header />
         <slot />
    </div>
</template>
<script>
import Vue from 'vue'
import Header from '@/components/inc/header'
import Footer from '@/components/inc/footer'
export default {
    mounted() {},
    name: "HomeVue",
    components: {
        'Header': Header,
        'Footer': Footer
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
