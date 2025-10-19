<div class="sidebar p-3">
    <h1 class="fs-4 fw-bold mb-5 text-center">Undangan Admin</h1>
    <nav class="nav flex-column">
        <a href="/admin/dashboard" class="sidebar-link active">
            <i class="bi bi-house-door-fill me-2"></i> Dashboard
        </a>
        {{-- <a href="/admin/gifts" class="sidebar-link">
            <i class="bi bi-gift-fill me-2"></i> Gifts
        </a>
        <a href="/admin/memories" class="sidebar-link">
            <i class="bi bi-images me-2"></i> Memories
        </a> --}}
        <a href="{{ route('comments.index') }}" class="sidebar-link">
            <i class="bi bi-images me-2"></i> Comments
        </a>
    </nav>

    <form action="/logout" method="POST" class="mt-5">
        @csrf
        <button type="submit" class="w-100 btn-gold">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </form>
</div>
