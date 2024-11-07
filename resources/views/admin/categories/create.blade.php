 <!-- Modal -->
 <form action="{{ route('admin.categories.store') }}" method="post">
    @csrf
    <div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
                <br>
                <select name="status" class="form-control">
                    <option disabled selected>Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Not Active</option>
                </select>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create Category</button>
            </div>
        </div>
    </div>
</div>
</form>
