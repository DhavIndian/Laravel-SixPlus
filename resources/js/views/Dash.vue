<template>
    <layout-basic>
        <modal-product v-on:myEvent="getallproducts" :dataid="dataid"></modal-product>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">Product Data <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#op_product" @click="dataid=''">Insert</button></div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tr v-for="d in dash.data">
                            <td>{{ d.id }}</td>
                            <td>{{ d.name }}</td>
                            <td>{{ d.detail }}</td>
                            <td>
                                <button class="btn btn-info" data-toggle="modal" data-target="#op_product" @click="dataid=d.id">Edit</button>
                                <button class="btn btn-danger" @click="removeproducts(d.id)" data-toggle="modal">Remove</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </layout-basic>
</template>
<script>
import LayoutBasic from './../components/layouts/Basic'
import ModalProduct from './../components/modals/Modalproduct'

import axios from 'axios'
axios.defaults.headers.common['Authorization'] = "Bearer " + localStorage.getItem("token");
export default {
    mounted() {
        this.getallproducts();
    },
    data() {
        return {
            dash: {},
            dataid: ''
        }
    },
    components: {
        LayoutBasic,
        ModalProduct
    },
    methods: {
        getallproducts: function() {
            axios({ url: './api/products', data: {}, method: 'GET' })
                .then(resp => {
                    this.dash = resp.data
                })
                .catch(err => {

                })
        },
        removeproducts: function(id) {
            axios({ url: './api/products/' + id, data: {}, method: 'DELETE' })
                .then(resp => {
                    if (resp.data.success == true) {
                        this.$toasted.show(resp.data.message);
                        this.getallproducts();
                    } else {
                        this.$toasted.error(resp.data.message)
                    }
                })
                .catch(err => {

                })
        }
    }
}

</script>
