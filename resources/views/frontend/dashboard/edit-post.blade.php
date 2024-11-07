@extends('layouts.fronend.app')
@section('title')
    Edit : {{ $post->title }}
@endsection
@section('body')
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar' , ['profile_active'=>'active'])


        <!-- Main Content -->
        <div class="main-content col-md-9">
            @if (session()->has('errors'))
            <div class="alert alert-danger">
                @foreach (session('errors')->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
            <!-- Show/Edit Post Section -->
            <form action="{{ route('frontend.dashboard.post.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <section id="posts-section" class="posts-section">
                    <h2>Your Posts</h2>
                    <ul class="list-unstyled user-posts">
                        <!-- Example of a Post Item -->
                        <li class="post-item">
                            <input hidden name="post_id" value="{{$post->id}}">
                            <!-- Editable Title -->
                            <input name="title" type="text" class="form-control mb-2 post-title"
                                value="{{ $post->title }}" />
                          <textarea name="small_desc" class="form-control mb-2" rows="3" placeholder="Enter Small Description">{{ $post->small_desc??'' }}</textarea>


                            <!-- Editable Content -->
                            <textarea name="desc" id="post-desc" class="form-control mb-2 post-content">
                                {!! $post->desc !!}
                             </textarea>


                            <!-- Image Upload Input for Editing -->
                            <input name="images[]" id="post-images" type="file" class="form-control mt-2 edit-post-image"
                                accept="image/*" multiple />

                            <!-- Editable Category Dropdown -->
                            <select name="category_id" class="form-control mb-2 post-category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == $post->category_id)>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Editable Enable Comments Checkbox -->
                            <div class="form-check mb-2">
                                <input name="comment_able" @checked($post->comment_able == 1)
                                    class="form-check-input enable-comments" type="checkbox" />
                                <label class="form-check-label">
                                    Enable Comments
                                </label>
                            </div>

                            <!-- Post Meta: Views and Comments -->
                            <div class="post-meta d-flex justify-content-between">
                                <span class="views">
                                    <i class="fa fa-eye"></i> {{ $post->num_of_views }}
                                </span>
                                <span class="post-comments">
                                    <i class="fa fa-comment"></i> {{ $post->comments->count() }}
                                </span>
                            </div>

                            <!-- Post Actions -->
                            <div class="post-actions mt-2">
                                <button type="submit" class="btn btn-success save-post-btn">
                                    Save
                                </button>
                                <a href="{{ route('frontend.dashboard.profile') }}"
                                    class="btn btn-secondary cancel-edit-btn">
                                    Cancel
                                </a>
                            </div>

                        </li>
                        <!-- Additional posts will be added dynamically -->
                    </ul>
                </section>


            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
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
                @if($post->images->count() > 0)
                    @foreach ($post->images as $image)
                        {
                            caption: "{{ $image->path }}",
                            width: '120px',
                            url: "{{ route('frontend.dashboard.post.image.delete' , [$image->id , '_token'=>csrf_token()]) }}",
                            key: "{{ $image->id }}",

                        },
                    @endforeach
            @endif
        ]


        });

        // summenote
        $('#post-desc').summernote({
            height: 300,
        });
    </script>
@endpush
