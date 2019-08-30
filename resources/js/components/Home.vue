<template>
    <div class="container" style="width: 100%">
        <Bookmodal :dall="dall" />
        <BoookMall :mall="mall" />
        <Dmoredata :dmore="dmore" />
        <Mmoredata :mmore="mmore" />
        <div class="col-lg-12" style="padding: 0px">
            <form role="form" class="form-horizontal" id="frm_game" @submit.prevent="submitGame">
                <div>
                    <label class="col-sm-1" style="width:50px" for="inputEmail1">Game</label>
                    <div class="col-sm-3" style="padding: 0 8px 0 8px">
                        <select class="form-control" id="game" required v-on:change="getFancylist" v-model="gamesel">
                            <option v-for="value in gamelist" :value="value.mid">{{ value.ename }}</option>
                        </select>
                    </div>
                    <label class="col-sm-1" style="width: 55px" for="inputEmail1">Fancy</label>
                    <div class="col-sm-3" style="padding: 0 0px 0 8px">
                        <select class="form-control" id="fancy" required v-model="subgamesel" v-on:change="changeFancy">
                            <option v-for="value in subgamelist" :value="value.sid">{{ value.nation }}</option>
                        </select>
                    </div>
                    <div class="col-sm-1" style="padding: 0px 0px 0px 3px">
                        <input type="text" class="form-control" id="token" placeholder="token" v-model="scode" />
                    </div>
                    <div class="col-sm-1" style="padding: 0px 2px 0px 1px">
                        <button class="btn btn-primary" id="btn_submit" @click="submitted = true" :disabled="submitted">Submit</button>
                    </div>
                    <div class="col-sm-2" style="padding: 0px 2px 0px 1px">
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <a href="javascript:void()" @click="logout">logout</a>
            </div>
        </div>
        <div style="clear:both"></div>
        <div class="col-lg-2">
            <div style="padding:5px;">
                <h6 style="display:inline-block">Diamond</h6>
                <button style="margin-left:10px" class="btn btn-default" data-toggle="modal" id="dbk" data-target="#dbook" v-on:click="getDAllfancylist"> Book </button>
            </div>
            <div class="table-responsive" style="height:320px">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Run</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="bind_d">
                        <tr :class="{'bg-success': value.amout > 0, 'bg-danger': value.amout < 0}" v-for="value in drun">
                            <td>{{ value.run }}</td>
                            <td>{{ value.amout }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-2">
            <div style="padding:5px;">
                <h6 style="display:inline-block">Multi</h6>
                <button style="margin-left:10px" class="btn btn-default" data-toggle="modal" data-target="#mbook" id="mbk" v-on:click="getMAllfancylist"> Book </button>
            </div>
            <div class="table-responsive" style="height:320px">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Run</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="bind_ds">
                        <tr :class="{'bg-success': value.amout > 0, 'bg-danger': value.amout < 0}" v-for="value in mrun">
                            <td>{{ value.run }}</td>
                            <td>{{ value.amout }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-2">
            <div style="padding:5px">
                <h6 style="display:inline-block">D + M</h6>
                <button style="margin-left:10px" class="btn btn-default" data-toggle="modal" data-target="#dbook" id="dmbk"> Book </button>
            </div>
            <div class="table-responsive" style="height:320px">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Run</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="bind_dm">
                        <tr :class="{'bg-success': value.amout > 0, 'bg-danger': value.amout < 0}" v-for="value in dplusm">
                            <td>{{ value.run }}</td>
                            <td>{{ value.amout }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="clear:both"></div>
        <div class="col-lg-6">
            <div>
                <h6 style="display:inline-block">Diamond (<strong id="d_count">{{dcount }}</strong>)</h6>
                <button style="margin-left:10px" class="btn btn-sm btn-default" id="dfbk" data-toggle="modal" data-target="#dmoredata" v-on:click="getDAll"> View More </button>
                <span style="color:#3612A1">Back (<strong id="back_lbl"></strong>)</span> <span style="color:#C81043">Lay (<strong id="lay_lbl"></strong>)</span> <span>&nbsp;<strong id="diff_bl"></strong></span>
            </div>
            <div class="table-responsive" style="max-height:255px">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Rate</th>
                            <th>Bhav</th>
                            <th>Amount</th>
                            <th>Bettype</th>
                            <th>User Name</th>
                            <th>PlaceDate</th>
                        </tr>
                    </thead>
                    <tbody id="bind_m">
                        <tr :class="{'bg-success': value.btype == 'BACK', 'bg-danger': value.btype == 'LAY'}" v-for="value in dtrade">
                            <td>{{ value.rate }}</td>
                            <td>{{ value.bhav }}</td>
                            <td>{{ value.amount }}</td>
                            <td>{{ value.btype }}</td>
                            <td>{{ value.uname }}</td>
                            <td>{{ value.pdate }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-12" style="padding: 0px 2px 0px 1px">
                <strong style="font-size: 20px">Comm :</strong> <strong style="font-size: 20px" id="comm"></strong>
            </div>
        </div>
        <div class="col-lg-6">
            <div>
                <h6 style="display:inline-block">Multi (<strong id="m_count">{{mcount }}</strong>) </h6>
                <button class="btn btn-sm btn-default" id="mfbk" data-toggle="modal" data-target="#mmoredata" v-on:click="getMAll">View More</button>
            </div>
            <div class="table-responsive" style="max-height:255px">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Rate</th>
                            <th>Bhav</th>
                            <th>Amount</th>
                            <th>Bettype</th>
                            <th>Currency</th>
                            <th>User Name</th>
                            <th>PlaceDate</th>
                        </tr>
                    </thead>
                    <tbody id="bind_m1">
                        <tr :class="{'bg-success': value.btype == 'BACK', 'bg-danger': value.btype == 'LAY'}" v-for="value in mtrade">
                            <td>{{ value.rate }}</td>
                            <td>{{ value.bhav }}</td>
                            <td>{{ value.amount }}</td>
                            <td>{{ value.btype }}</td>
                            <td>{{ value.curr }}</td>
                            <td>{{ value.uname }}</td>
                            <td>{{ value.pdate }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
// @ is an alias to /src
import Bookmodal from './../components/modals/bookmodal'
import BoookMall from './../components/modals/multiall'
import Dmoredata from './../components/modals/dmoredata'
import Mmoredata from './../components/modals/mmoredata'

import Vue from 'vue'
import axios from 'axios'


const CancelToken = axios.CancelToken;

let dtimersource = CancelToken.source();
let mtimersource = CancelToken.source();

export default {

    mounted() {
        this.getGamelist()
    },
    data() {
        return {
            submitted: false,
            gamelist: {},
            gamesel: "",
            scode: "",
            subgamesel: "",
            subgamelist: "",
            dtimer: null,
            mtimer: null,
            drun: [],
            mrun: [],
            dplusm: [],
            druns: [],
            mruns: [],
            dtrade: [],
            mtrade: [],
            dall: [],
            mall: [],
            dmore: [],
            mmore: [],
            dcount: '',
            mcount: '',
        };
    },

    components: {
        'Bookmodal': Bookmodal,
        'BoookMall': BoookMall,
        'Dmoredata': Dmoredata,
        'Mmoredata': Mmoredata,

    },
    methods: {
        getGamelist(e) {
            axios.post('./api/getgamelist.json', {

                })
                .then((response) => {
                    if (typeof response.data.GameList != 'undefined') {
                        this.gamelist = response.data.GameList;
                    }
                })
                .catch(function(error) {
                    console.log(error)
                });
        },
        changeFancy(e) {
            this.resetHandler();

        },
        getFancylist() {
            this.subgamelist = [];
            axios.post('./api/getgamesublist.json', {
                    fancyid: this.gamesel
                })
                .then((response) => {
                    if (typeof response.data.GameList != 'undefined') {
                        this.subgamelist = response.data.GameList;
                    }
                })
                .catch((error) => {
                    console.log(error)
                });
        },
        submitGame(e) {
            this.resetHandler();
            axios.post('./api/checkgame.json', {
                    marketid: this.gamesel,
                    sectionid: this.subgamesel,
                    scode: this.scode,
                })
                .then((response) => {

                    if (response.data.status == 200) {
                        this.getDfancylist();
                        this.getMfancylist();
                    }
                    this.submitted = false;
                    this.scode = '';
                })
                .catch((error) => {
                    console.log(error)
                });
        },
        getDfancylist() {

            axios.post('./api/getDfancylist.json', {
                    marketid: this.gamesel,
                    sectionid: this.subgamesel
                }, {
                    cancelToken: dtimersource.token
                })
                .then((response) => {
                    this.drun = response.data.table1;
                    this.dtrade = response.data.table2;
                    this.dcount = response.data.count;

                    for (let o in this.drun) {

                        this.druns["" + this.drun[o].run + ""] = this.drun[o].amout;
                    }
                    this.dtimer = setTimeout(() => { this.getDfancylist() }, 1000);
                })
                .catch((error) => {

                });

        },
        getMfancylist() {
            axios.post('./api/getMfancylist.json', {
                    marketid: this.gamesel,
                    sectionid: this.subgamesel
                }, {
                    cancelToken: mtimersource.token
                })
                .then((response) => {
                    this.mrun = response.data.table1;
                    this.mtrade = response.data.table2;
                    this.mcount = response.data.count;
                    for (let o in this.mrun) {
                        this.mruns["" + this.mrun[o].run + ""] = this.mrun[o].amout;
                    }
                    this.mtimer = setTimeout(() => { this.getMfancylist() }, 1000);
                })
                .catch((error) => {

                });

        },
        updatedplusm() {

            this.dplusm = [];
            Object.entries(this.druns).forEach(([k, v]) => {

                if (this.mruns[k]) {
                    this.dplusm.push({ run: k, amout: parseInt(v) + parseInt(this.mruns[k]) });
                }

            });
        },
        getDAllfancylist() {
            axios.post('./api/getDAllfancylist.json', {
                    marketid: this.gamesel,
                    sectionid: this.subgamesel
                })
                .then((response) => {
                    this.dall = response.data.table1;
                })
                .catch((error) => {

                });
        },
        getMAllfancylist() {
            axios.post('./api/getMAllfancylist.json', {
                    marketid: this.gamesel,
                    sectionid: this.subgamesel
                })
                .then((response) => {
                    this.mall = response.data.table1;
                })
                .catch((error) => {

                });
        },
        getDAll() {
            axios.post('./api/getDAll.json', {
                    marketid: this.gamesel,
                    sectionid: this.subgamesel
                })
                .then((response) => {
                    this.dmore = response.data.table1;
                })
                .catch((error) => {

                });
        },
        getMAll() {
            axios.post('./api/getMAll.json', {
                    marketid: this.gamesel,
                    sectionid: this.subgamesel
                })
                .then((response) => {
                    this.mmore = response.data.table1;
                })
                .catch((error) => {

                });
        },
        resetHandler() {

            if (this.dtimer != null) {
                dtimersource.cancel('Dtimer Closed');
                clearTimeout(this.dtimer);

            }
            if (this.mtimer != null) {
                mtimersource.cancel('Mtimer Closed');
                clearTimeout(this.mtimer);
            }
            this.drun = [];
            this.dtrade = [];
            this.mrun = [];
            this.mtrade = [];
            this.druns = [];
            this.mruns = [];
            this.dplusm = [];
            this.dtimer = null;
            this.mtimer = null;
            dtimersource = CancelToken.source();
            mtimersource = CancelToken.source();
        }

    },
    watch: {
        drun: {
            handler: function(val, oldVal) {
                this.updatedplusm();
            },

        },
        mrun: {
            handler: function(val, oldVal) {
                this.updatedplusm(); /* not to update sum both time */
            },

        }

    }
}

</script>
