<template>
    <layout-user>
        <div class="main m-t-5">
            <div class="loading" v-if="udataLoading">
                <img src="images/loader.gif" alt="">
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 p-l-5 p-r-5">
                        <form role="form" class="form-horizontal" id="frm_game" @submit.prevent="submitGame">
                            <div class="form-group form-inner m-b-5">
                                <div class="dropdown d-inline-block v-t">
                                    <label>Event Type</label>
                                    <select class="btn btn-primary dropdown-toggle" id="eventname" v-on:change="geteventlist" required v-model="eventname">
                                        <option disabled value="">Select Event Type</option>
                                        <option v-for="value in eventlist" :value="value.eid">{{ value.etype }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-inner m-b-5 v-t">
                                <div class="dropdown d-inline-block">
                                    <label>Event Name</label>
                                    <select class="btn btn-primary dropdown-toggle" id="subeventname" required v-model="subeventname" v-on:change="resetHandler">
                                        <option disabled value="">Select Sub Event Type</option>
                                        <option v-for="v in subeventlist" :value="v.gid+'|'+v.eid">{{ v.ename }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-inner m-b-5 v-t">
                                <div class="dropdown d-inline-block">
                                    <label>Market Name</label>
                                    <select class="btn btn-primary dropdown-toggle" id="locktype" required v-model="locktype">
                                        <option disabled value="">Select Market Name</option>
                                        <option value="match">Match</option>
                                        <option value="match1">Match1</option>
                                        <option value="fancy">Fancy</option>
                                        <option value="fancy1">Fancy1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-inner m-b-5 d-inline-block v-t">
                                <label>User</label>
                                <input class="form-control d-inline-block" type="text" placeholder="Search" v-model="euser" aria-label="Search" autocomplete="off">
                                <button class="btn btn-submit v-t" id="btn_submit" :class="{ disabled : submitted }">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-header text-white m-b-5">
                    <h5 class="m-b-0">Game Lock Report</h5>
                </div>
                <div class="row">
                       <div class="col-md-12 p-l-5 p-r-5">
                            <div class="form-group form-inner m-b-5">
                            <form method="POST" @submit.prevent="getgamehistorybydt" class="bydtfrm">
                                <span>From</span>
                                <input type="date" required v-model="frm_date" name="" class="form-control d-inline-block">
                                <span>To</span>
                                <input type="date" required v-model="to_date" name="" class="form-control m-l-5 d-inline-block">
                                <button class="btn btn-submit v-t" :disabled="submitted2">Search</button>
                            </form>
                            <form method="POST" @submit.prevent="getgamehistorybyuser" class="byuserfrm">
                                <div class="search-box-container" style="position: relative">
                                    <input type="text" @keyup="searchUsers" v-model="uname" name="uname" required placeholder="Please Enter Atleast 3 character" class="form-control d-inline-block" autocomplete="off">
                                <div class="search-box" v-if="susers && susersShow">
                                        <p class="m-b-0" v-for="(user, key) in filteredUsers" @click="setSearchUsername(user.uname, user.uid)">{{ user.uname }}</p>
                                    </div>
                                </div>
                                <span class="load" v-if="usearchLoading"><i class="fas fa-spinner fa-spin"></i></span>
                                <button class="btn btn-submit v-t" :disabled="submitted3">Search</button>
                            </form>
                            </div>
                        </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-12 p-l-5 p-r-5">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr v-if="lockdetails.length>0">
                                        <th>Username</th>
                                        <th>Game Type</th>
                                        <th>Block</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="v in lockdetails">
                                        <td>{{v.uname}}</td>
                                        <td>{{v.gtype}}</td>
                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" v-on:click="lockuserdata(v)" :checked="v.block  == true" :disabled="chkbx">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-12 p-l-5 p-r-5">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr v-if="tbl_userlst.length > 0">
                                        <th width="5%"  class="text-center">SrNo</th>
                                        <th width="7%" class="text-center">Date</th>
                                        <th width="7%"  class="text-center">Master Name</th>
                                        <th width="7%"  class="text-center">Username</th>
                                        <th width="15%"  class="text-center">Event Name</th>
                                        <th width="7%"  class="text-center">Bet Lock</th>
                                        <th width="15%"  class="text-center">Remark</th>
                                        <th width="7%"  class="text-center">Ip</th>
                                        <th  class="text-center">Browser Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v,k) in tbl_userlst">
                                        <td class="text-center">{{k+1}}</td>
                                        <td class="text-center">{{v.dt}}</td>
                                        <td class="text-center">{{v.admin}}</td>
                                        <td class="text-center">{{v.uname}}</td>
                                        <td class="text-center">
                                            {{v.ename}}
                                        </td>
                                        <td class="text-center">
                                    <div class="form-check d-inline-block form-inner m-b-5  chkmark">
                                    <label class="form-check-label">
                                            <input type="checkbox" :checked="v.bact  == 'True'" disabled>
                                        <span class="checkmark cmark"></span>
                                    </label>
                                </div>
                                    </td>
                                        <td class="text-center">{{v.remark}}</td>
                                        <td class="text-center">{{v.ip}}</td>
                                        <td class="text-center">{{v.bdetail}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </layout-user>
</template>
<script>
import axios from 'axios'
import LayoutUser from '@/components/layouts/UserLayout'
export default {
    mounted() {
        this.$store.state.activeTab = 'userdetail';
        this.$store.state.activeSubTab = 'gamelock';
        this.geteventtypelist();
        this.username = this.$store.state.username;
    },
    data() {
        return {
            udataLoading: false,
            usearchLoading: false,
            submitted: false,
            submitted1: false,
            submitted2: false,
            submitted3: false,
            chkbx: false,
            uname: '',
            username: '',
            euser: '',
            susers: '',
            susersShow: false,
            eventlist: {},
            subeventlist: {},
            lockdetails: {},
            lock_current: [],
            eventname: "",
            subeventname: "",
            locktype: "",
            userid: "",

            frm_date : '',
            to_date : '',
            tbl_userlst : []
        };
    },
    components: {
        LayoutUser
    },
    computed: {
        filteredUsers() {
            return this.susers.filter(event => {
                return event.uname.toLowerCase().includes(this.uname.toLowerCase())
            })
        }
    },
    methods: {
        searchUsers() {
            this.userid = '';
            this.frm_date = '',
            this.to_date = '',
            this.lockdetails = [];
            this.tbl_userlst = [];
            if (this.uname && this.uname.length > 2) {
                this.usearchLoading = true;
                axios.post('./api/usersearchall.json', { 'uname': this.uname }).then(response => {
                    this.usearchLoading = false;
                    if (response.status == 200) {
                        if (this.uname.length >= 3) {
                            this.susers = response.data;
                        }
                    }
                }).catch(e => {

                }).then(response => {
                    this.usearchLoading = false;
                });
            } else if (this.uname.length < 3) {
                this.susers = null;
            }
            this.susersShow = true;
        },
        setSearchUsername(uname, userid) {
            this.userid = userid;
            this.uname = uname;
            this.susersShow = false;
        },
        geteventtypelist(e) {
            this.lockdetails = [];
            this.tbl_userlst = [];
            this.subeventlist = [];
            axios.post('./api/geteventtypelist.json', {

                })
                .then((response) => {

                    if (typeof response.data != 'undefined') {
                        this.eventlist = response.data;
                    }
                })
                .catch(function(error) {
                    console.log(error)
                });
        },
        geteventlist() {
            this.lockdetails = [];
            this.tbl_userlst = [];
            this.subeventlist = [];
            axios.post('./api/geteventlist.json', {
                    eventtypeid: this.eventname
                })
                .then((response) => {
                    if (typeof response.data != 'undefined') {
                        this.subeventlist = response.data;
                    }
                })
                .catch((error) => {
                    console.log(error)
                });
        },
        submitGame(e) {
            this.lockdetails = [];
            this.tbl_userlst = [];
            if(this.chkbx == false){
                this.udataLoading = true;
                this.submitted = true;
            }
            axios.post('./api/getlockdetail.json', {
                    subeventname: this.subeventname,
                    locktype: this.locktype,
                    userid: this.euser,
                })
                .then((response) => {
                    if (typeof response.data != 'undefined') {
                        this.lockdetails = response.data;
                    }
                })
                .catch((error) => {

                }).then((response) => {
                    this.udataLoading = false;
                    this.submitted = false;
                })
        },
        resetHandler() {
            this.lockdetails = [];
        },
        lockuserdata(v) {
            this.lockdetails = [];
            this.tbl_userlst = [];
            this.udataLoading = true;
            this.chkbx = true;
            axios.post('./api/gamelock.json', {
                    userid: v.uid,
                    subeventname: this.subeventname,
                    glock: v.block == false ? true : false,
                    locktype: v.gtype,
                    username: this.username

                })
                .then((response) => {
                    if (response.data.status == 200) {
                        this.$toasted.show(response.data.msg);
                    }
                })
                .catch((error) => {
                    console.log(error);
                }).then((response) => {
                    this.submitGame();
                    this.udataLoading = false;
                    this.chkbx = false;
                })
        },
        getgamehistorybydt() {
            this.userid = '';
            this.uname = '';
            this.lockdetails = [];
            this.tbl_userlst = [];
            this.subeventlist = [];
            this.eventlist = [];
            this.udataLoading = true;
            this.submitted2 = true;
            axios.post('./api/getgamehistorybydt.json', {
                    fdt: this.frm_date,
                    tdt: this.to_date,
                })
                .then((response) => {
                    this.udataLoading = false;
                    this.submitted2 = false;
                    if (typeof response.data != 'undefined') {
                        this.tbl_userlst =  response.data.data
                    }
                })
                .catch((error) => {
                    console.log(error)
                });

        },
        getgamehistorybyuser() {
            if(this.userid == ''){
                this.$toasted.show("Please Select Valid Username");
                return;
            }
            this.lockdetails = [];
            this.tbl_userlst = [];
            this.udataLoading = true;
            this.submitted3 = true;
            axios.post('./api/getgamehistorybyuser.json', {
                    userid: this.userid
                })
                .then((response) => {
                    this.udataLoading = false;
                    this.submitted3 = false;
                    if (typeof response.data != 'undefined') {
                        this.tbl_userlst =  response.data.data
                        
                    }
                })
                .catch((error) => {
                    console.log(error)
                })

        }

    }
}

</script>
