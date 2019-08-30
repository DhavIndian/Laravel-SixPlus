<template>
  <layout-basic>
        <div class="main m-t-5">
            
            <div class="container-fluid userdata-container">
                <div class="row">
                    <div class="col-md-12 p-l-5 p-r-5">
                        <div class="form-group form-inner m-b-5">
                            <label>User</label>
                            <form role="form" class="form-horizontal" id="frm_game" @submit.prevent="submitGame">
                            <input class="form-control d-inline-block" v-on:change="getuserlist()" type="text" placeholder="Search" id="userid" v-model="userid" aria-label="Search">
                            <button class="btn btn-submit" id="btn_submit" @click="submitted = true">Submit</button>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 p-r-0 p-l-5">
                        <div class="block-title">
                            <span>Game Detail</span>
                        </div>
                        <div class="analysis-detail container-fluid" v-for="v in t1">
                            <div class="row">
                                <label class="col-md-6">Username</label>
                                <p class="m-b-0 col-md-6">{{v.uname}}</p>
                            </div>
                            <div class="row">
                                <label class="col-md-6">Account Type</label>
                                <p class="m-b-0 col-md-6">{{v.atype}}</p>
                            </div>
                            <div class="row">
                                <label class="col-md-6">Currency</label>
                                <p class="m-b-0 col-md-6">{{v.curr}}</p>
                            </div>
                            <div class="row">
                                <label class="col-md-6">General</label>
                                <p class="m-b-0 col-md-6">{{v.gen}}</p>
                            </div>
                            <div class="row">
                                <label class="col-md-6">Exposure</label>
                                <p class="m-b-0 col-md-6">{{v.exp}}</p>
                            </div>
                            <div class="row">
                                <label class="col-md-6">Exposure Limit</label>
                                <p class="m-b-0 col-md-6">{{v.elim}}</p>
                            </div>
                            <div class="row">
                                <label class="col-md-6">Credit Reference</label>
                                <p class="m-b-0 col-md-6">{{v.cref}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 p-l-5 p-r-0">
                        <div class="block-title">
                            <span>User Lock</span>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SR No</th>
                                    <th>Username</th>
                                    <th>Master Name</th>
                                    <th>User Active</th>
                                    <th>Bet Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="(v,k) in t2">
                                    <td>{{k++}}</td>
                                    <td>{{v.uname}}</td>
                                    <td>{{v.mname}}</td>
                                    <td class="text-center">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" :checked="v.uact == 'True'" >
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" :checked="v.bact == 'True'">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 p-l-5 p-r-5">
                        <div class="block-title">
                            <span>Bet Lock</span>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <th>SR NO</th>
                                <th>UserName</th>
                                <th>Bet Lock</th>
                                <th>Match Name</th>
                                <th>Event Name</th>
                            </thead>
                            <tbody>
                                <tr v-for="(v,k) in t3">
                                    <td>{{k++}}</td>
                                    <td>{{v.uname}}</td>
                                    <td class="text-center">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                              <input type="checkbox" :checked="v.b == 'True'">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{v.mname}}</td>
                                    <td>{{v.ename}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-12 p-l-5 p-r-5">
                        <div class="market-analysis-wrapper">
                            <div class="">
                                <div class="col-md-12 p-l-0 p-r-0">
                                    <div class="card">
                                        <div class="card-header text-white">
                                            <h5 class="m-b-0">India Vs Australia</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 p-r-0 p-l-10">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered m-b-5">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="2">Match Odds</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><b>Ind VS Aus</b></td>
                                                                    <td class="amount">100000000000000</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Ind VS Aus</b></td>
                                                                    <td class="amount">100000000000000</td>
                                                                </tr>
                                                               
                                                            </tbody>
                                                        </table>
                                                        <table class="table table-bordered m-b-5">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="2">Match Odds</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><b>Ind VS Aus</b></td>
                                                                    <td class="amount">100000000000000</td>
                                                                </tr>
                                                               
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 p-l-5 p-r-0">
                                                    <table class="table table-bordered m-b-5">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="2">Fancy Market</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Ind VS Aus</b></td>
                                                                <td class="amount">100000000000000</td>
                                                            </tr>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-4 p-l-5 p-r-10">
                                                    <table class="table table-bordered m-b-5">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="2">Fancy Market 1</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Ind VS Aus</b></td>
                                                                <td class="amount">100000000000000</td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </layout-basic>
</template>

<script>
import axios from 'axios'
import LayoutBasic from '@/components/layouts/Basic'
export default {
    mounted() {

        this.$store.dispatch('showsubnenu', { 'flag': true });
        this.getsubmenu()
    },
    data() {
        return {
            showroutes: {},
            userdetails: {},
            userlist:{},
            sunmenuarr: [],
            userid : '',
            t1: {},
            t2: {},
            t3: {},
            t4: {},
        };
    },
    components: {
        LayoutBasic
    },
    methods: {
        getsubmenu() {
            axios.post('./api/getsubmenu.json', {
                    username: this.username,
                    menutype: 'userdetail'
                }, {

                })
                .then((response) => {
                    this.$store.dispatch('sunmenuarr', { 'data': response.data });
                })
                .catch((error) => {

                });

        },

        getuserlist() {
                axios.post('./api/getuserlist.json', {
                    userid: this.userid,
                })
                .then((response) => {
                    console.log(response.data);
                    if (typeof response.data != 'undefined') {
                        this.userlist = response.data;
                    }
                })
                .catch((error) => {
                    console.log(error)
                });
        },

        submitGame(e) {
            this.submitted = true;
            axios.post('./api/getuserdetail.json', {
                    userid: this.userid,
                })
                .then((response) => {
                    this.submitted = false;
                    if (typeof response.data != 'undefined') {
                        this.t1 = response.data.t1;
                        
                        this.t2 = response.data.t2;
                        
                        this.t3 = response.data.t3;
                        this.t4 = response.data.t4;
                        console.log(this.t3)
                        
                    }
                })
                .catch((error) => {
                    console.log(error)
                });
        },
    }
}

</script>