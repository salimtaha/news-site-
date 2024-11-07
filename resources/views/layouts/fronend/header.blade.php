  <!-- Top Bar Start -->
  <div class="top-bar">
      <div class="container">
          <div class="row">
              <div class="col-md-6">
                  <div class="tb-contact">
                      <p><i class="fas fa-envelope"></i> {{ $getSetting->email }}</p>
                      <p><i class="fas fa-phone-alt"></i> {{ $getSetting->phone }}</p>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="tb-menu text-right">
                      @guest
                          <a href="{{ route('register') }}">Register</a>
                          <a href="{{ route('login') }}">Login</a>
                      @endguest
                      @auth
                          <a href="javascript:void(0)"
                              onclick="if(confirm('Do you want to logout')){document.getElementById('formLogout').submit()} return false">Logout</a>
                          <form id="formLogout" action="{{ route('logout') }}" method="post" style="display: none;">
                              @csrf
                          </form>
                      @endauth
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Top Bar End -->

  <!-- Brand Start -->
  <div class="brand">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-3 col-md-4">
                  <div class="b-logo">
                      <a href="index.html">
                          <img src="{{ asset($getSetting->logo)}}" alt="Logo" />
                      </a>
                  </div>
              </div>
              <div class="col-lg-6 col-md-4">
                  <div class="b-ads">
                      <!-- Ad space or banner -->
                  </div>
              </div>
              <div class="col-lg-3 col-md-4">
                  <form action="{{ route('frontend.search') }}" method="post">
                      @csrf
                      <div class="b-search">
                          <input name="search" type="text" placeholder="Search" />
                          <button type="submit"><i class="fa fa-search"></i></button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <!-- Brand End -->

  <!-- Nav Bar Start -->
  <div class="nav-bar">
      <div class="container">
          <nav class="navbar navbar-expand-md bg-dark navbar-dark">
              <a href="#" class="navbar-brand">MENU</a>
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                  <div class="navbar-nav mr-auto">
                      <a href="{{ route('frontend.index') }}" class="nav-item nav-link active">Home</a>
                      <div class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                          <div class="dropdown-menu">
                              @foreach ($categories as $category)
                                  <a href="{{ route('frontend.category.posts', $category->slug) }}"
                                      class="dropdown-item" title="{{ $category->name }}">{{ $category->name }}</a>
                              @endforeach
                          </div>
                      </div>
                      <a href="{{ route('frontend.conact.index') }}" class="nav-item nav-link">Contact Us</a>
                      <a href="{{ route('frontend.dashboard.profile') }}" class="nav-item nav-link">Account</a>
                  </div>

                  <!-- Social Links and Notification Dropdown -->
                  <div class="social ml-auto">
                      <!-- Notification Dropdown -->
                      @auth('web')
                        <a href="#" class="nav-link dropdown-toggle" id="notificationDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span id="count-notification" class="badge badge-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown"
                        style="width: 300px;">
                        <h5>Notifications</h5>
                        {{-- <a href="{{ route('frontend.dashboard.notifications.readAll') }}"
                            class="dropdown-header">Mark All </a> --}}
                        @forelse (auth()->user()->unreadNotifications()->take(5)->get()  as $notify)
                            <div id="push-notification">
                                <div class="dropdown-item d-flex justify-content-between align-items-center">
                                    <span> Post Comment : {{ substr($notify->data['post_title'], 0, 9) }}...</span>
                                    <a href="{{ route('frontend.post.show', $notify->data['post_slug']) }}?notify={{ $notify->id }}"><i
                                            class="fa fa-eye"></i></a>
                                </div>
                            </div>
                        @empty

                            <div class="dropdown-item text-center">No notifications</div>
                        @endforelse


                    </div>
                      @endauth
                      <a href="{{ $getSetting->twitter }}" title="twitter"><i class="fab fa-twitter" rel="nofollow"></i></a>
                      <a href="{{ $getSetting->facebook }}" title="facebook"><i class="fab fa-facebook-f" rel="nofollow"></i></a>
                      <a href="{{ $getSetting->instagram }}" title="instagram"><i class="fab fa-instagram" rel="nofollow"></i></a>
                      <a href="{{ $getSetting->youtupe }}" title="youtube"><i class="fab fa-youtube" rel="nofollow"></i></a>


                  </div>
              </div>
          </nav>
      </div>
  </div>
  <!-- Nav Bar End -->
