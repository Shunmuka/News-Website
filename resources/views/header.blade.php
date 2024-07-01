<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">News App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    @auth
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/newsListings">News Listings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/createPost">Create Post</a>
        </li>
      </ul>
    </div>
    @else
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/registerPage">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Login</a>
        </li>
      </ul>
    </div>
    @endauth
  </div>
</nav>