<form action="{{ route('admin.related-site.update', $site->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit-site-{{ $site->id }}" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit site : {{$site->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="name" value="{{ $site->name }}"
                            placeholder="Enter site Name" class="form-control">
                        <br>
                    </div>
                    <div class="form-group">
                        <input type="text" name="url" value="{{ $site->url }}"
                            placeholder="Enter  url" class="form-control">
                        <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update site</button>
                </div>
            </div>
        </div>
    </div>
</form>
