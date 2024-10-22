<x-app>
    <div class="page-heading d-flex flex-wrap justify-content-between align-items-center mt-4 gap-2">
        <h2 class="d-flex align-items-center mb-0 fw-semibold">{{ __('Settings') }}</h2>
    </div>
    <div class="page-content">
        <section class="row gx-0">

            <div class="col-md-4 col-lg-4 col-xl-4 col-12 p-3">
                <div class="card rounded-8px border-custom p-3 shadow-custom mb-0 cursor-pointer card-width-custom">
                    <h6 class="text-nowrap">
                        <i class="bi bi-person-gear fs-4 me-2"></i>
                        <span>{{ __('Roles And Permissions') }}</span>
                    </h6>
                    <div class="p-1 text-center text-nowrap-custom d-flex flex-column">
                        <span>{{ __('Manage Roles & Permissions') }}</span>
                        <a href="{{ route('settings.roles') }}" class="btn btn-primary mt-4">{{ __('Manage') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 col-12 p-3">
                <div class="card rounded-8px border-custom p-3 shadow-custom mb-0 cursor-pointer card-width-custom">
                    <h6 class="text-nowrap">
                        <i class="bi bi-envelope-at fs-4 me-2"></i>
                        <span>{{ __('SMTP Settings') }}</span>
                    </h6>
                    <div class="p-1 text-center text-nowrap-custom d-flex flex-column">
                        <span>{{ __('Manage SMTP Settings') }}</span>
                        <a href="{{ route('settings.smtp') }}" class="btn btn-primary mt-4">{{ __('Manage') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 col-12 p-3">
                <div class="card rounded-8px border-custom p-3 shadow-custom mb-0 cursor-pointer card-width-custom">
                    <h6 class="text-nowrap">
                        <i class="bi bi-google fs-4 me-2"></i>
                        <span>{{ __('Google Login Settings') }}</span>
                    </h6>
                    <div class="p-1 text-center text-nowrap-custom d-flex flex-column">
                        <span>{{ __('Manage Google Login Settings') }}</span>
                        <a href="{{ route('settings.google-auth') }}"
                            class="btn btn-primary mt-4">{{ __('Manage') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 col-12 p-3">
                <div class="card rounded-8px border-custom p-3 shadow-custom mb-0 cursor-pointer card-width-custom">
                    <h6 class="text-nowrap">
                        <i class="bi bi-key fs-4 me-2"></i>
                        <span>{{ __('API Keys') }}</span>
                    </h6>
                    <div class="p-1 text-center text-nowrap-custom d-flex flex-column">
                        <span>{{ __('Manage Api Keys') }}</span>
                        <a href="{{ route('server-key') }}" class="btn btn-primary mt-4">{{ __('Manage') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 col-12 p-3">
                <div class="card rounded-8px border-custom p-3 shadow-custom mb-0 cursor-pointer card-width-custom">
                    <h6 class="text-nowrap">
                        <i class="bi bi-building fs-4 me-2"></i>
                        <span>{{ __('Company Information') }}</span>
                    </h6>
                    <div class="p-1 text-center text-nowrap-custom d-flex flex-column">
                        <span>{{ __('Manage Company Information') }}</span>
                        <a href="{{ route('company') }}" class="btn btn-primary mt-4">{{ __('Manage') }}</a>
                    </div>
                </div>
            </div>

        </section>
    </div>
</x-app>
