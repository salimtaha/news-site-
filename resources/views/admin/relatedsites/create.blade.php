 <!-- Modal -->
 <form action="{{ route('admin.related-site.store') }}" method="post">
    @csrf
    <div class="modal fade" id="add-site" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New site</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                <input type="text" name="name" placeholder="Enter site Name" class="form-control">
                <br>
                <input type="text" name="url" placeholder="Enter site Url" class="form-control">
                <br>

               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create site</button>
            </div>
        </div>
    </div>
</div>
</form>
