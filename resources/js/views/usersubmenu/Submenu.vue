<template>
<div class="header-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-md navbar-dark">
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item" v-for="sub in $store.state.sunmenuarr">
                              <router-link  @click.native="changeSubActiveTab(sub.menu)" :class="{ 'active': $store.state.activeSubTab == sub.menu }"  class="nav-link" :to="{ name: sub.menu, params: {}}">{{ fcapital(sub.menu) }}
                              </router-link>
                          </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'
export default {
    mounted() {        
    this.$store.state.activeSubTab = 'userdata';
        this.$store.dispatch('sunmenuarr', {'username' : this.$store.state.username});
    },
    data() {
        return {
            sunmenuarr: [],
        };
    },
    computed: {
      
    },
    methods: {
       changeSubActiveTab(tab) {
            this.activeTab = tab;
        },
        fcapital(value) {
         if (!value) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
      }
    }
}

</script>