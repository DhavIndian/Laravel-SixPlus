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
                                    <li class="nav-item" @click.native="changeActiveTab('userdetail')" :class="{ 'active': $store.state.activeTab == 'userdetail' }" v-if="$store.state.showroutes[0].userdetail == true">
                                        <router-link class="nav-link" v-if="$store.state.showroutes[0].userdetail == true" :to="{ name: 'userdetail', params: {}}">User Detail
                                        </router-link>
                                    </li>
                                    <li class="nav-item" @click.native="changeActiveTab('beepsoda')" :class="{ 'active': $store.state.activeTab == 'beepsoda' }" v-if="$store.state.showroutes[0].beepsoda == true">
                                        <router-link class="nav-link" v-if="$store.state.showroutes[0].beepsoda == true" :to="{ name: 'beepsoda', params: {}}">BeepSoda</router-link>
                                    </li>
                                    <li class="nav-item" @click.native="changeActiveTab('bookmaker')" :class="{ 'active': $store.state.activeTab == 'bookmaker' }" v-if="$store.state.showroutes[0].bookmaker == true">
                                        <router-link class="nav-link" v-if="$store.state.showroutes[0].bookmaker == true" :to="{ name: 'bookmaker', params: {}}">BookMaker
                                        </router-link>
                                    </li>
                                    <li class="nav-item" @click.native="changeActiveTab('btmatch')" :class="{ 'active': $store.state.activeTab == 'btmatch' }" v-if="$store.state.showroutes[0].btmatch == true">
                                        <router-link class="nav-link" v-if="$store.state.showroutes[0].btmatch == true" :to="{ name: 'btmatch', params: {}}">Btmatch</router-link>
                                    </li>
                                    <li class="nav-item" @click.native="changeActiveTab('deletesoda')" :class="{ 'active': $store.state.activeTab == 'deletesoda' }" v-if="$store.state.showroutes[0].deletesoda == true">
                                        <router-link class="nav-link" v-if="$store.state.showroutes[0].deletesoda == true" :to="{ name: 'deletesoda', params: {}}"> DeleteSoda
                                        </router-link>
                                    </li>
                                    <li class="nav-item" @click.native="changeActiveTab('dplusm')" :class="{ 'active': $store.state.activeTab == 'dplusm' }" v-if="$store.state.showroutes[0].dplusm == true">
                                        <router-link class="nav-link" v-if="$store.state.showroutes[0].dplusm == true" :to="{ name: 'dplusm', params: {}}">Dplusm</router-link>
                                    </li>
                                    <li class="nav-item" @click.native="changeActiveTab('fancy1')" :class="{ 'active': $store.state.activeTab == 'fancy1' }" v-if="$store.state.showroutes[0].fancy1 == true">
                                        <router-link class="nav-link" v-if="$store.state.showroutes[0].fancy1 == true" :to="{ name: 'fancy1', params: {}}">Fancy1
                                        </router-link>
                                    </li>
                                    <li class="nav-item" @click.native="changeActiveTab('sodaexcel')" :class="{ 'active': $store.state.activeTab == 'sodaexcel' }" v-if="$store.state.showroutes[0].sodaexcel == true">
                                        <router-link class="nav-link" v-if="$store.state.showroutes[0].sodaexcel == true" :to="{ name: 'sodaexcel', params: {}}">Sodaexcel
                                        </router-link>
                                    </li>
                                    <li class="nav-item" @click.native="changeActiveTab('rules')" :class="{ 'active': $store.state.activeTab == 'rules' }" v-if="$store.state.showroutes[0].rules == true">
                                        <router-link class="nav-link" v-if="$store.state.showroutes[0].rules == true" :to="{ name: 'rules', params: {}}">Rules</router-link>
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
