@extends('layouts.dashboard.app')
@section('title')
    Edit Post
@endsection

@section('body')
    <center>
        <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body shadow mb-4 col-10">
                <a style="margin-left: 90ch" class="btn btn-primary" href="{{ route('admin.posts.index') }}" >Show Posts</a>
                <h2>Update Post</h2>

                @if (session()->has('errors'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach (session('errors')->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <br><br>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" value="{{ @old('title', $post->title) }}" name="title"
                                placeholder="Enter Post Title" class="form-control">
                            @error('title')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea name="small_desc" placeholder="Enter Post Small Description" class="form-control">{{ $post->small_desc }}</textarea>
                            @error('small_desc')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea id="postContent" name="desc" placeholder="Enter Description" class="form-control">{!! $post->desc !!}</textarea>
                            @error('desc')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="file" multiple id="post-images" name="images[]" class="form-control">
                            @error('images')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="1" @selected($post->status == 1)>Active</option>
                                <option value="0" @selected($post->status == 0)>Not Active</option>
                            </select>
                            @error('status')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <select name="category_id" class="form-control">
                                <option selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option @selected($category->id == $post->category_id) value="{{ $category->id }}">{{ $category->name }}
                                    </option>
                                @endforeach

                            </select>
                            @error('category_id')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select name="comment_able" class="form-control">
                                <option selected>Select Comment Able Status </option>
                                <option value="1" @selected($post->comment_able == 1)>Active</option>
                                <option value="0" @selected($post->comment_able == 0)>Not Active</option>
                            </select>
                            @error('comment_able')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

                <br>
                <button type="submit" class="btn btn-primary">Update Post</button>
            </div>

        </form>
    </center>
@endsection

@push('js')
    <script>
        $(function() {


            $('#post-images').fileinput({
                theme: 'fa5',
                allowedFileTypes: ['image'],
                maxFileCount: 5,
                enableResumableUpload: false,
                showUpload: false,
                initialPreviewAsData: true,
                initialPreview: [
                    @if ($post->images->count() > 0)
                        @foreach ($post->images as $image)
                            "{{ asset($image->path) }}",
                        @endforeach
                    @endif
                ],
                initialPreviewConfig: [
                    @if ($post->images->count() > 0)
                        @foreach ($post->images as $image)
                            {
                                caption: "{{ $image->path }}",
                                width: '120px',
                                url:"{{ route('admin.posts.image.delete' , [$image->id , '_token'=>csrf_token()]) }}",
                                key: "{{ $image->id }}",

                            },
                        @endforeach
                    @endif
                ]


            });

            $('#postContent').summernote({
                height: 300,
            });
        });
    </script>
@endpush
