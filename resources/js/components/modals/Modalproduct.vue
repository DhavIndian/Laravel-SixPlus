<!-- Modal Product Edit -->
<template>
    <div id="op_product" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">{{title}}</h4>
                </div>
                <div class="modal-body">
                    <form  class="form-inline" method="POST" v-on:submit.prevent="createproduct">
                        <input class="form-control" placeholder="Name" type="text" v-model="p_name" name="p_name">
                        <input class="form-control" placeholder="Details" v-model="p_detail" type="text" name="p_detail">
                        <input class="btn btn-success" type="submit" value="Submit">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="closebtn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
import axios from 'axios'
axios.defaults.headers.common['Authorization'] = "Bearer " + localStorage.getItem("token");
export default {

    mounted() {

    },
    data() {
        return {
            p_name: '',
            p_detail: '',
            op_type: '',
            title: 'Data Insert',
            dynurl : './api/products',
            dynmethod : "POST"
        };
    },

    components: {},
    methods: {
        createproduct: function() {
            axios({ url: this.dynurl, data: { 'name': this.p_name, 'detail': this.p_detail }, method: this.dynmethod })
                .then(resp => {
                    if (resp.data.success == true) {
                        this.$toasted.show(resp.data.message)
                    } else {
                        this.$toasted.error(resp.data.message)
                    }
                })
                .catch(err => {

                })
        },
        fetchbyid : function(id){
             axios({ url: './api/products/'+id, data: {}, method: 'GET' })
                .then(resp => {
                   this.p_name = resp.data.data.name
                   this.p_detail = resp.data.data.detail
                })
                .catch(err => {

                })
        },
        closebtn :function(){
            this.$emit('myEvent')
        }
    },
    props: ['dataid'],
    watch: {
        dataid: function(newVal, oldVal) { // watch it
            if (newVal != '') {
                this.title = "Data Update";
                this.dynurl = "./api/products/"+newVal;
                this.dynmethod = "PUT"
            } else {
                this.title = "Data Insert";
                this.dynurl = "./api/products/";
                this.dynmethod = "POST"
            }

            if(newVal != oldVal){
                this.fetchbyid(newVal)
            }
        }
    }
}

</script>
