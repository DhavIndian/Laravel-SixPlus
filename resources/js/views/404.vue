<template>
  <div class="wrapper">
        <div class="error-page">
            <img src="@/assets/images/404.png">
            <h1>Page Not Found</h1>
            <div class="back-to-home">
                 <router-link class="btn" :to="{ name: $store.state.firstRoute, params: {}}">Back To Home</router-link>
            </div>
        </div>
    </div>
</template>

<script>
  import LayoutBasic from '@/components/layouts/Basic'
  export default {
    mounted() {
            
    },
    components: {
      LayoutBasic
    }
    
  }
</script>