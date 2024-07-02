<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">News App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @auth
        <li class="nav-item">
          <a class="nav-link" href="/newsListings">News Listings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/createPost">Create Post</a>
        </li>
        <form action="/logout" method="POST" class="d-flex ms-auto">
        @csrf
        <button type="submit" class="btn btn-primary" >Logout</button>
      </form>
        @else
        <li class="nav-item">
          <a class="nav-link" href="/registerPage">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/">Login</a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
