{{-- Breadcrumb --}}
<div class="row">
    <div class="col-12 text-left">
        <ol class="breadcrumb mb-0 pt-3 pb-2">
            @isset($current)
                <li class="breadcrumb-item">{{ $root }}</li>
                <li class="breadcrumb-item active">{{ $current }}</li>
            @else
                <li class="breadcrumb-item active">{{ $root }}</li>
            @endisset
        </ol>
    </div>
</div>
<hr class="mt-0">
