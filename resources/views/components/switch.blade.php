<div class="btn-group btn-group-lg d-flex" role="group">
    <button type="button" class="btn btn-primary d-flex justify-content-center align-items-center" data-bs-theme-value="light" title="Theme: Light">
        <svg fill="currentColor" width="25" height="25">
            <use href="#icon-light"></use>
        </svg>
    </button>
    <button type="button" class="btn btn-primary d-flex justify-content-center align-items-center" data-bs-theme-value="dark" title="Theme: Dark">
        <svg fill="currentColor" width="25" height="25">
            <use href="#icon-dark"></use>
        </svg>
    </button>
    <button type="button" class="btn btn-primary d-flex justify-content-center align-items-center active" data-bs-theme-value="auto" title="Theme: System default">
        <svg fill="currentColor" width="25" height="25">
            <use href="#icon-auto"></use>
        </svg>
    </button>
</div>

@include('components.layout.utils.theme')