<!-- Modal Book -->
<template>
    <div id="dbook" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" >Diamond More Book</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" style="height: 515px;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Run</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="bind_d">
                                <tr :class="{'bg-success': value.amout > 0, 'bg-danger': value.amout < 0}" v-for="value in dall">
                                    <td>{{ value.run }}</td>
                                    <td>{{ value.amout }}</td>
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
    props: ['dall'],
    watch: {}
}

</script>
