<template>
  <layout-user>
      <div class="main m-t-5">
          <div class="loading" v-if="udataLoading">
              <img src="images/loader.gif" alt="">
          </div>
          <div class="container-fluid userdata-container">
              <div class="row">
                  <div class="col-md-12 p-l-5 p-r-5">
                      <div class="form-group form-inner m-b-5">
                          <form role="form" class="form-horizontal" id="frm_game" @submit.prevent="submitGame">
                              <label>User</label>
                              <div class="search-box-container" style="position: relative">
                                  <input type="text" @keyup="searchUsers" v-model="uname" name="uname" required placeholder="Please Enter Atleast 3 character" class="form-control d-inline-block" autocomplete="off">
                                  <div class="search-box" v-if="susers && susersShow">
                                      <p class="m-b-0" v-for="(user, key) in filteredUsers" @click="setSearchUsername(user.uname, user.uid)">{{ user.uname }}</p>
                                  </div>
                              </div>
                              <span class="load" v-if="usearchLoading"><i class="fas fa-spinner fa-spin"></i></span>
                              <button class="btn btn-submit" id="btn_submit" :class="{ disabled : submitted }">Submit</button>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-3 p-r-0 p-l-5" v-if="t1.length>0">
                      <div class="block-title">
                          <span>Game Detail</span>
                      </div>
                      <div class="analysis-detail container-fluid" v-for="v in t1">
                          <div class="row">
                              <label class="col-md-6">Username</label>
                              <p class="m-b-0 col-md-6">{{v.uname}}</p>
                          </div>
                          <div class="row">
                              <label class="col-md-6">Full Name</label>
                              <p class="m-b-0 col-md-6">{{v.fname}}</p>
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
                          <div class="row">
                              <label class="col-md-6">User Rate</label>
                              <p class="m-b-0 col-md-6">{{v.urate}}</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3 p-l-5 p-r-0" v-if="t2.length>0">
                      <div class="block-title">
                          <span>User Lock</span>
                      </div>
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>SR No</th>
                                  <th>Username</th>
                                  <th>User Active</th>
                                  <th>Bet Active</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(v,k) in t2">
                                  <td>{{k+1}}</td>
                                  <td>{{v.uname}}</td>
                                  <td class="text-center">
                                      <div class="form-check">
                                          <label class="form-check-label">
                                              <input type="checkbox" :checked="v.uact == true" disabled="disabled">
                                              <span class="checkmark"></span>
                                          </label>
                                      </div>
                                  </td>
                                  <td class="text-center">
                                      <div class="form-check">
                                          <label class="form-check-label">
                                              <input type="checkbox" :checked="v.bact == true" disabled="disabled">
                                              <span class="checkmark"></span>
                                          </label>
                                      </div>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                  <div class="col-md-6 p-l-5 p-r-5" v-if="t3.length>0">
                      <div class="block-title">
                          <span>Bet Lock</span>
                      </div>
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>SR NO</th>
                                  <th>UserName</th>
                                  <th>Event Name</th>
                                  <th>Match Name</th>
                                  <th>Bet Lock</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(v,k) in t3">
                                  <td>{{k+1}}</td>
                                  <td>{{v.uname}}</td>
                                  <td>{{v.ename}}</td>
                                  <td>{{v.mname}}</td>
                                  <td class="text-center">
                                      <div class="form-check">
                                          <label class="form-check-label">
                                              <input type="checkbox" :checked="v.b == true" disabled="disabled">
                                              <span class="checkmark"></span>
                                          </label>
                                      </div>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
              <div class="row m-t-10">
                  <div class="col-md-12 p-l-5 p-r-5" v-if="t4.length>0">
                      <div class="market-analysis-wrapper">
                          <div class="">
                              <div class="col-md-12 p-l-0 p-r-0">
                                  <div class="card m-t-10" v-for="(marketdata, key) in t4" :key="key">
                                      <div class="card-header text-white">
                                          <h5 class="m-b-0">
                                              {{ marketdata.ename }}
                                          </h5>
                                      </div>
       <div class="card-body">
           <div class="row">
                <template v-for="(gamelist, key) in marketdata.gamelist">
               <div class="col-md-4 p-r-0 p-l-10" v-if="gamelist.gtype == 'Match' || gamelist.gtype == 'Match1'">
                   <!-- <template v-for="(gamelist, key) in marketdata.gamelist"> -->
                       <div v-if="gamelist.gtype == 'Match' || gamelist.gtype == 'Match1'">
                           <div class="table-responsive">
                               <table class="table table-bordered m-b-5" v-if="gamelist.gtype == 'Match'">
                                   <thead>
                                   </thead>
                                   <tbody v-for="(mlist, key) in gamelist.gametypelist" :key="key">
                                       <tr class="mkt-tbody-tr">
                                           <td colspan="2"> {{mlist.mname}} </td>
                                       </tr>
                                       <tr v-for="(match, key) in mlist.marketlist" :key="key">
                                           <td><b> {{match.nat}} </b></td>
                                           <td class="amt"> {{match.amt}} </td>
                                       </tr>
                                   </tbody>
                               </table>
                               <table class="table table-bordered m-b-5" v-if="gamelist.gtype == 'Match1'">
                                   <thead>
                                   </thead>
                                   <tbody v-for="(mlist, key) in gamelist.gametypelist" :key="key">
                                       <tr class="mkt-tbody-tr">
                                           <td colspan="2"> {{mlist.mname}} </td>
                                       </tr>
                                       <tr v-for="(match, key) in mlist.marketlist" :key="key">
                                           <td><b> {{match.nat}} </b></td>
                                           <td class="amt"> {{match.amt}} </td>
                                       </tr>
                                   </tbody>
                              </table>
                          </div>
                      </div> 
                  <!--</template> -->
              </div>
              </template>
              <template v-for="(gamelist, key) in marketdata.gamelist">
                  <div v-if="gamelist.gtype == 'Fancy'" class="col-md-4 p-l-5 p-r-0">
                      <table class="table table-bordered m-b-5">
                          <thead>
                          </thead>
                          <tbody v-for="(mlist, key) in gamelist.gametypelist" :key="key">
                              <tr class="mkt-tbody-tr">
                                  <td colspan="2"> {{mlist.mname}} </td>
                              </tr>
                              <tr v-for="(match, key) in mlist.marketlist" :key="key">
                                  <td><b> {{match.nat}} </b></td>
                                  <td class="amt"> {{match.amt}} </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                  <div v-if="gamelist.gtype == 'Fancy1'" class="col-md-4 p-l-5 p-r-10">
                      <table class="table table-bordered m-b-5">
                          <thead>
                          </thead>
                          <tbody v-for="(mlist, key) in gamelist.gametypelist" :key="key">
                              <tr class="mkt-tbody-tr">
                                  <td colspan="2"> {{mlist.mname}} </td>
                              </tr>
                              <tr v-for="(match, key) in mlist.marketlist" :key="key">
                                  <td><b> {{match.nat}} </b></td>
                                  <td class="amt"> {{match.amt}} </td>
                              </tr>
                          </tbody>
                      </table>
                      </div>
                  </template>
                  <!-- </div> -->
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
  </layout-user>
</template>
<script>
import axios from 'axios'

import LayoutUser from '@/components/layouts/UserLayout'

export default {
  mounted() {
     this.$store.state.activeTab = 'userdetail';
     this.$store.state.activeSubTab = 'userdata';
  },
  data() {
      return {
          usearchLoading: false,
          udataLoading: false,
          submitted: false,
          uname: '',
          susers: '',
          susersShow: false,

          showroutes: {},
          userdetails: {},
          userlist: {},
          sunmenuarr: [],
          userid: '',
          t1: {},
          t2: {},
          t3: {},
          t4: {},
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
      submitGame(e) {
          
          if(this.userid == ''){
            this.$toasted.show("Please Select Proper Username");
            return;
          }
          this.udataLoading = true;
          this.submitted = true;
          axios.post('./api/getuserdetail.json', {
                  userid: this.userid,
              })
              .then((response) => {
                this.udataLoading = false;
                this.submitted = false;
                  if (typeof response.data != 'undefined') {
                      this.t1 = response.data.t1;
                      this.t2 = response.data.t2;
                      this.t3 = response.data.t3;
                      this.t4 = response.data.t4;
                  }
              })
              .catch((error) => {
                 // console.log(error)
              });
      },
  }
}

</script>
