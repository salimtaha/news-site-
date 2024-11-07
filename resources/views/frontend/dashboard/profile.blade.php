@extends('layouts.fronend.app')
@section('title')
    Profile
@endsection
@section('body')
    <!-- Profile Start -->
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar' , ['profile_active'=>'active'])


        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <h2>User Profile</h2>
                <div class="user-profile mb-3">
                    <img src="{{ asset(Auth::guard('web')->user()->image) }}" alt="User Image"
                        class="profile-img rounded-circle" style="width: 100px; height: 100px;" />
                    <span class="username"> {{ Auth::guard('web')->user()->name }}</span>
                </div>
                <br>

                @if (session()->has('errors'))
                    <div class="alert alert-danger">
                        @foreach (session('errors')->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('frontend.dashboard.post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Add Post Section -->
                    <section id="add-post" class="add-post-section mb-5">
                        <h2>Add Post</h2>
                        <div class="post-form p-3 border rounded">
                            <!-- Post Title -->
                            <input name="title" type="text" id="postTitle" class="form-control mb-2"
                                placeholder="Post Title" />

                            <!-- Post Content -->
                            <textarea name="small_desc" class="form-control mb-2" rows="3" placeholder="Enter Small Description"></textarea>
                            <textarea name="desc" id="postContent" class="form-control mb-2" rows="3" placeholder="What's on your mind?"></textarea>

                            <!-- Image Upload -->
                            <input name="images[]" type="file" id="postImage" class="form-control mb-2" accept="image/*"
                                multiple />
                            <div class="tn-slider mb-2">
                                <div id="imagePreview" class="slick-slider"></div>
                            </div>

                            <!-- Category Dropdown -->
                            <select name="category_id" id="postCategory" class="form-control">
                                <option value="" selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select><br>

                            <!-- Enable Comments Checkbox -->
                            <label class="lable">
                                Enable Comments : <input name="comment_able" type="checkbox" class="" />
                            </label><br>

                            <!-- Post Button -->
                            <button type="submit" class="btn btn-primary post-btn">Post</button>
                        </div>
                    </section>
                </form>

                <!-- Show Posts-->
                <section id="posts" class="posts-section">
                    <h2>Recent Posts</h2>
                    <div class="post-list">
                        <!-- Post Item -->
                        @forelse ($posts as $post)
                            <div class="post-item mb-4 p-3 border rounded">
                                <div class="post-header d-flex align-items-center mb-2">
                                    <img src="{{ asset('default.jpg') }}" alt="User Image" class="rounded-circle"
                                        style="width: 50px; height: 50px;" />
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ auth()->user()->name }} </h5>
                                    </div>
                                </div>
                                <h4 class="post-title">{{ $post->title }}</h4>
                                <p class="post-content">{!! chunk_split($post->desc, 40) !!}</p>

                                <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#newsCarousel" data-slide-to="1"></li>
                                        <li data-target="#newsCarousel" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">

                                        @foreach ($post->images as $image)
                                            <div class="carousel-item @if ($loop->index == 0) active @endif ">
                                                <img src="{{ asset($image->path) }}" class="d-block w-100"
                                                    alt="First Slide">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>{{ $post->title }}</h5>

                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Add more carousel-item blocks for additional slides -->
                                    </div>
                                    <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#newsCarousel" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                                <div class="post-actions d-flex justify-content-between">
                                    <div class="post-stats">
                                        <!-- View Count -->
                                        <span class="me-3">
                                            <i class="fas fa-eye"></i> {{ $post->num_of_views }}
                                        </span>
                                    </div>

                                    <div>
                                        <a href="{{ route('frontend.dashboard.post.edit', $post->slug) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="javascript:void(0)"
                                            onclick="if(confirm('Are U Sure To Delete This Post?')){getElementById('deleteForm_{{ $post->id }}').submit()} return false"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>

                                        <button id="commentbtn_{{ $post->id }}" class="getComments" post-id="{{ $post->id }}"
                                            class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-comment"></i> Comments
                                        </button>

                                        <button id="hideCommentId_{{ $post->id }}" class="hideComments" post-id="{{ $post->id }}"
                                            class="btn btn-sm btn-outline-secondary" style="display: none">
                                            <i class="fas fa-comment"></i> Hide Comments
                                        </button>

                                        <form id="deleteForm_{{ $post->id }}"
                                            action="{{ route('frontend.dashboard.post.delete') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input name="slug" value="{{ $post->slug }}" hidden>
                                        </form>
                                    </div>
                                </div>

                                <!-- Display Comments -->
                                <div id="displayComments_{{ $post->id }}" class="comments" style="display: none">

                                    <!-- Add more comments here for demonstration -->
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                No Posts !
                            </div>
                        @endforelse

                        <!-- Add more posts here dynamically -->
                    </div>
                </section>
            </section>
        </div>
    </div>
    <!-- Profile End -->
@endsection

@push('js')
    <script>
        $(function() {
            $('#postImage').fileinput({
                theme: 'fa5',
                allowedFileTypes: ['image'],
                maxFileCount: 5,
                enableResumableUpload: false,
                showUpload: false,

            });

            $('#postContent').summernote({
                height: 300,
            });
        });


        //    get post comments
        $(document).on('click', '.getComments', function(e) {
            e.preventDefault();
            var post_id = $(this).attr('post-id');

            $.ajax({
                type: "GET",
                url: '{{ route('frontend.dashboard.post.getComments', ':post_id') }}'.replace(':post_id', post_id),
                success: function(response) {
                    $('#displayComments_'+post_id).empty();

                    $.each(response.data, function(indexInArray, comment) {
                        $('#displayComments_'+post_id).append(`<div class="comment">
                                        <img src="${comment.user.image}" alt="User Image" class="comment-img" />
                                        <div class="comment-content">
                                            <span class="username">${comment.user.name}</span>
                                            <p class="comment-text">${comment.comment}</p>
                                        </div>
                                    </div>`).show();
                    });
                    $('#commentbtn_'+post_id).hide();
                    $('#hideCommentId_'+post_id).show();
                }
            });

        });

        // hide post comments
        $(document).on('click',  '.hideComments' , function(e){
            e.preventDefault();
            var post_id = $(this).attr('post-id');

            // 1- hide comments
            $('#displayComments_'+post_id).hide();
            // 2- hide (hide comment btn)
            $('#hideCommentId_'+post_id).hide();

            // 3- Apper btn (comment)
            $('#commentbtn_'+post_id).show();

        });
    </script>
@endpush
