<!-- Modal Book -->
<template>
    <header>
        <div class="header-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-md navbar-dark">
                            <div class="collapse navbar-collapse">
                                <ul class="navbar-nav float-left">
                                    <li class="nav-item">
                                        <router-link class="nav-link" :to="{ name: 'about', params: {}}">About
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link class="nav-link" :to="{ name: 'dash', params: {}}">Dash
                                        </router-link>
                                    </li>
                                    
                                </ul>
                                <div class="float-right">
                                    <ul class="m-b-0">
                                        <li class="d-inline-block"><b>{{$store.state.username}}</b></li>
                                        <li class="d-inline-block m-l-10 log-out"><a @click="logout" href="javascript:void(0)"><b>Log Out</b></a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>
<script type="text/javascript">
export default {

    mounted() {

    },
    data() {
        return {};
    },

    components: {},
    methods: {
        logout: function() {
            this.$store.dispatch('logout')
                .then(() => {
                    this.$toasted.show("You Are Logged Out")
                    this.$router.push('/logout')
                })
        },
        changeActiveTab(tab) {
            this.activeTab = tab;
        },
    },
    props: ['header'],
    watch: {},
}

</script>
