<template>
    <Home />
</template>
<script>
// @ is an alias to /src
import Vue from 'vue'
import Home from './../components/Home'
import axios from 'axios'


export default {

    mounted() {
            this.$store.dispatch('showsubnenu',{'flag':false});
    },
    name: "HomeVue",
    components: {
        Home,
    },
    data() {
        return {

        };
    },
    methods: {

    }
};

</script>
