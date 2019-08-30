<template>
    <layout-user>
        <div class="main m-t-5">
            <div class="loading" v-if="udataLoading==true">
                <img src="images/loader.gif" alt="">
            </div>
            <div class="container-fluid userdata-container">
                <div class="row">
                    <div class="col-md-12 p-l-5 p-r-5">
                        <div class="form-group form-inner m-b-5">
                            <form role="form" class="form-horizontal" id="frm_game" @submit.prevent="submitGame" autocomplete="off">
                                <label>User</label>
                                <input class="form-control d-inline-block" type="text" placeholder="Search" required v-model="username" aria-label="Search" autocomplete="off">
                                <button class="btn btn-submit v-t" id="btn_submit" :class="{ disabled : submitted }">Submit</button>
                            </form>
                        </div>
                        <div v-for="v in userdetails">
                            <div class="form-group form-inner m-b-5">
                                <label>Upper Level: </label>
                                <span><b>{{v.uname}}</b></span>
                                <input type="hidden" v-model="v.uid">
                            </div>
                            <div class="form-group form-inner m-b-5">
                                <label>&nbsp</label>
                                <div class="form-check d-inline-block">
                                    <label class="form-check-label">
                                        User Active
                                        <input type="checkbox" v-model="user_chk" :checked="user_chk  == 'true'">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-check d-inline-block form-inner m-b-5">
                                    <label class="form-check-label">
                                        Bet Active
                                        <input type="checkbox" v-model="bet_chk" :checked="bet_chk  == 'true'">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group form-inner m-b-5">
                                <label class="v-t">Remark</label>
                                <textarea v-model="remark"></textarea>
                            </div>
                            <div class="form-group form-inner m-b-5">
                                <label class="v-t"></label>
                                <button class="btn btn-submit v-t" :class="{ disabled : submitted1 }" @click="userlock">Lock</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header text-white m-b-5">
                    <h5 class="m-b-0">User Lock Report</h5>
                </div>
                <div class="row">
                       <div class="col-md-12 p-l-5 p-r-5">
                            <div class="form-group form-inner m-b-5">
                            <form method="POST" @submit.prevent="getlockhistorybydt" class="bydtfrm">
                                <span>From</span>
                                <input type="date" required v-model="frm_date" name="" class="form-control d-inline-block">
                                <span>To</span>
                                <input type="date" required v-model="to_date" name="" class="form-control m-l-5 d-inline-block">
                                <button class="btn btn-submit v-t" :disabled="submitted2">Search</button>
                            </form>
                            <form method="POST" @submit.prevent="getlockhistorybyuser" class="byuserfrm">
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
                                    <tr v-if="tbl_userlst.length > 0">
                                        <th width="5%"  class="text-center">SrNo</th>
                                        <th width="7%" class="text-center">Date</th>
                                        <th width="7%"  class="text-center">Master Name</th>
                                        <th width="7%"  class="text-center">Username</th>
                                        <th width="7%"  class="text-center">User Lock</th>
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
                                    <div class="form-check d-inline-block form-inner m-b-5  chkmark">
                                    <label class="form-check-label">
                                            <input type="checkbox" :checked="v.uact  == 'True'" disabled>
                                        <span class="checkmark cmark"></span>
                                    </label>
                                </div>
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
import Vue from 'vue'
import axios from 'axios'
import LayoutUser from '@/components/layouts/UserLayout'
export default {
    mounted() {
         this.$store.state.activeTab = 'userdetail';
         this.$store.state.activeSubTab = 'userlock';
    },
    data() {
        return {
            udataLoading: false,
            usearchLoading: false,
            submitted: false,
            submitted1: false,
            submitted2: false,
            submitted3: false,
            userdetails: {},
            userid: '',
            userid_lock: '',
            username: '',
            remark: '',
            user_chk: false,
            bet_chk: false,
            loguserlock: "user lock",
            loggamelock: "game lock",
            uname: '',
            susers: '',
            susersShow: false,
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
            this.frm_date = '';
            this.to_date = '';
            if (this.uname && this.uname.length > 2) {
                this.userid = '',
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
        submitGame(e) {
            this.udataLoading = true;
            this.submitted = true;
            axios.post('./api/getselectuser.json', {
                    username: this.username,
                })
                .then((response) => {
                    this.udataLoading = false;
                    this.submitted = false;
                        
                    if (typeof response.data != 'undefined') {
                        this.userdetails = response.data;
                        this.user_chk = response.data[0].uact;
                        this.bet_chk = response.data[0].bact;
                        this.userid_lock = response.data[0].uid;
                    }
                })
                .catch((error) => {
                    console.log(error)
                });
        },
        userlock(v) {
            this.udataLoading = true;
            this.submitted1 = true;
            axios.post('./api/userlock.json', {
                    userid: this.userid_lock,
                    uactive: this.user_chk,
                    bactive: this.bet_chk,
                    username: this.$store.state.username,
                    remark: this.remark
                })
                .then((response) => {
                    this.udataLoading = false;
                    this.submitted1 = false;
                        
                    if (response.data.status == 200) {
                        this.$toasted.show("Successfully Updated");
                    }
                })
                .catch((error) => {
                    console.log(error)
                });
        },
        getlockhistorybydt() {
            this.userid = '';
            this.uname = '';
            this.udataLoading = true;
            this.submitted2 = true;
            axios.post('./api/getlockhistorybydt.json', {
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
        getlockhistorybyuser() {
            if(this.userid == ''){
                this.$toasted.show("Please Select Valid Username");
                return;
            }
            this.udataLoading = true;
            this.submitted3 = true;
            axios.post('./api/getlockhistorybyuser.json', {
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
