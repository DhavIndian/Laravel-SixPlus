<!-- Modal Book -->
<template>
    <div id="dmoredata" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" >Diamond More Data</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" style="height: 515px;">
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
                                <tr :class="{'bg-success': value.btype == 'BACK', 'bg-danger': value.btype == 'LAY'}" v-for="value in dmore">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
export default {

    mounted() {

    },
    data() {
        return {};
    },

    components: {},
    methods: {},
    props: ['dmore'],
    watch: {}
}

</script>
