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
                    <form class="form-inline" method="POST" v-on:submit.prevent="createproduct">
                        <input type="file" v-if="uploadReady" @change="onFileChanged">
                        <input class="form-control" placeholder="Name" type="text" v-model="p_name" name="p_name" required="">
                        <input class="form-control" placeholder="Details" v-model="p_detail" type="text" name="p_detail" required="">
                        <input class="btn btn-success" type="submit" value="Submit">
                    </form>
                    <div id="preview">
                        <img v-if="url" :src="url" />
                    </div>
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
            p_image: '',
            p_name: '',
            p_detail: '',
            op_type: '',
            title: 'Data Insert',
            dynurl: './api/products',
            dynmethod: "POST",
            selectedFile: '',
            url: '',
            uploadReady: true

        };
    },

    components: {},
    methods: {
        onFileChanged(event) {
            this.selectedFile = event.target.files[0]
            this.url = URL.createObjectURL(this.selectedFile);
        },
        createproduct: function() {

            const formData = new FormData()
            formData.append('image', this.selectedFile)
            formData.append('name', this.p_name)
            formData.append('detail', this.p_detail)
            formData.append('_method', this.dynmethod)

            axios({
                    method: 'POST',
                    url: this.dynurl,
                    data: formData,
                    config: { headers: { 'Content-Type': 'multipart/form-data' } }
                })
                .then(resp => {
                    if (resp.data.success == true) {
                        this.$toasted.show(resp.data.message);
                        this.$emit('myEvent');
                    } else {
                        this.$toasted.error(resp.data.message)
                    }
                })
                .catch(err => {

                })
        },
        fetchbyid: function(id) {
            this.title = "Data Update";
            this.dynurl = "./api/products/" + id;
            this.dynmethod = "PUT"
            axios({ url: './api/products/' + id, data: {}, method: 'GET' })
                .then(resp => {
                    this.p_name = resp.data.data.name
                    this.p_detail = resp.data.data.detail
                    this.url = resp.data.data.image
                })
                .catch(err => {

                })
        },
        closebtn: function() {
            this.selectedFile = ''
            this.dataid = ''
            this.p_name = ''
            this.p_detail = ''
            this.url = ''
            this.uploadReady = false
            this.$nextTick(() => {
                this.uploadReady = true
            })
        },
        changetitile: function() {
            this.closebtn()
            this.title = "Data Insert"
            this.dynurl = "./api/products"
            this.dynmethod = "POST"
        }
    },
    props: ['dataid'],
    watch: {}
}

</script>
