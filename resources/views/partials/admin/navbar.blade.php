<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid d-flex justify-content-end align-items-center">
        @auth
            <span class="me-3">Hai, {{ Auth::user()->username ?? 'User' }}!</span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary">Sign out</button>
            </form>
        @endauth
    </div>
</nav>
