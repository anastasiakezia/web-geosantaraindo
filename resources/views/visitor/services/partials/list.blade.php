@forelse ($services as $service)
    <div class="col-md-4">
        <a href="{{ route('visitor.services.show', $service->slug) }}" class="text-decoration-none text-dark">
            <div class="service-card text-center h-100"
                style="border-radius:16px; background:#fff; overflow:hidden;
                box-shadow:0 4px 12px rgba(0,0,0,0.12);
                transition:all .25s ease-in-out;"
                onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 8px 18px rgba(0,0,0,0.18)';"
                onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.12)';">

                <div style="width:100%; height:230px; overflow:hidden; border-radius:16px 16px 0 0;">
                    <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->name }}"
                        style="width:100%; height:100%; object-fit:cover;">
                </div>

                <div class="p-3">
                    <h3 style="font-size:1rem; font-weight:600; line-height:1.3;">
                        {{ $service->name }}
                    </h3>
                    <p style="font-size:0.9rem; color:#555; line-height:1.4;">
                        {{ Str::limit(strip_tags($service->description), 100) }}
                    </p>
                </div>
            </div>
        </a>
    </div>
@empty
    <div class="text-center py-5">
        <div style="font-size:3rem;">😕</div>
        <p class="text-muted mt-2">Layanan tidak ditemukan. Coba kata kunci lain ya!</p>
        <a href="{{ route('visitor.services.index') }}" class="btn btn-outline-primary mt-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
@endforelse
