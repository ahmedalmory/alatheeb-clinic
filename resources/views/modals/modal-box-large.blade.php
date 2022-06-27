<div class="modal fade" id="{{$modal_id}}" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document" id="{{$m_id}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$boxTitle}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-b-0">
                <form id="{{$form_name}}">
                    <div  id="{{$boxid}}">

                    </div>
                </form>
            </div>
            <div class="modal-footer"> <span id="{{$status_msg}}" class="float-left"></span>
                <button type="submit" class="btn btn-primary">save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
