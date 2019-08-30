<template>
  <layout-user>
    <div class="main m-t-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 p-l-5 p-r-5">
                        <div class="form-group form-inner m-b-5">
                            <div class="dropdown d-inline-block v-t">
                                <label>Label1</label>
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Dropdown button
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Link 1</a>
                                    <a class="dropdown-item" href="#">Link 2</a>
                                    <a class="dropdown-item-text" href="#">Text Link</a>
                                    <span class="dropdown-item-text">Just Text</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-inner m-b-5 v-t">
                            <div class="dropdown d-inline-block">
                                <label>Label2</label>
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Dropdown button
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Link 1</a>
                                    <a class="dropdown-item" href="#">Link 2</a>
                                    <a class="dropdown-item-text" href="#">Text Link</a>
                                    <span class="dropdown-item-text">Just Text</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-inner m-b-5 d-inline-block v-t">
                            <label>User</label>
                            <input class="form-control d-inline-block" type="text" placeholder="Search" aria-label="Search">
                            <button class="btn btn-submit v-t">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-12 p-l-5 p-r-5">
                        <div class="table-responsive">
                             <table class="table table-bordered">
                                 <thead>
                                     <tr>
                                         <th>Coumn</th>
                                         <th>Coumn</th>
                                         <th>Coumn</th>
                                         <th>Coumn</th>
                                         <th>Coumn</th>
                                         <th>Coumn</th>
                                         <th>Coumn</th>
                                         <th>Coumn</th>
                                         <th>Coumn</th>
                                         <th>Coumn</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                     </tr>
                                     <tr>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                     </tr>
                                     <tr>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                     </tr>
                                     <tr>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                     </tr>
                                     <tr>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
                                         <td>Data</td>
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
  import LayoutUser from '@/components/layouts/UserLayout'

  export default {
    mounted() {
         this.$store.state.activeTab = 'userdetail';
         this.$store.state.activeSubTab = 'logdata';
    },
    components: {
      LayoutUser
    }
  }
</script>