<template>
  <layout-user>
    <p>User Details Page</p>
  </layout-user>
</template>

<script>
  import axios from 'axios'
import LayoutUser from '@/components/layouts/UserLayout'

  export default {
    mounted() {
    this.$store.state.activeTab = 'userdetail';
    this.$store.state.activeSubTab = '';
    this.$store.dispatch('showsubnenu',{'flag':false});
            
    },
    components: {
      LayoutUser
    }
  }
</script>