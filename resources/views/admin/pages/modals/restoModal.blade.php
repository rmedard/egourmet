<div class="modal fade" id="resto-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Créer un restaurant</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    @include('admin.data.restos.form')
                </div>
            </div>
            <div class="modal-footer clearfix">
                <div class="pull-left">
                    <a id="all-tasks" class="btn btn-xs btn-default filter-btn active">All</a>
                    <a id="active-tasks" class="btn btn-xs btn-default filter-btn">Active</a>
                    <a id="completed-tasks" class="btn btn-xs btn-default filter-btn">Completed</a>
                </div>
                <div class="pull-right">
                    <small id="active-tasks-counter"></small>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->