@php
    $nav = [
        ['title' => 'Overview', 'view' => 'account/overview'],
        ['title' => 'Settings', 'view' => 'account/settings'],
        // array('title' => 'Security', 'view' => ''),
    ];
@endphp

<!--begin::Navbar-->
<div class="card {{ $class }}">
    <div class="pb-0 card-body pt-9">
        <!--begin::Details-->
        <div class="flex-wrap mb-3 d-flex flex-sm-nowrap">
            <!--begin: Pic-->
            <div class="mb-4 me-7">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="{{ auth()->user()->avatar_url }}" alt="image" />
                    <div
                        class="bottom-0 mb-6 border border-4 border-white position-absolute translate-middle start-100 bg-success rounded-circle h-20px w-20px">
                    </div>
                </div>
            </div>
            <!--end::Pic-->

            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="flex-wrap mb-2 d-flex justify-content-between align-items-start">
                    <!--begin::User-->
                    <div class="d-flex flex-column">
                        <!--begin::Name-->
                        <div class="mb-2 d-flex align-items-center">
                            <a href="#"
                                class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1">{{ auth()->user()->name }}</a>
                            <a href="#">
                                {!! theme()->getSvgIcon('icons/duotune/general/gen026.svg', 'svg-icon-1 svg-icon-primary') !!}
                            </a>

                            <a href="#" class="px-3 py-1 btn btn-sm btn-light-success fw-bolder ms-2 fs-8"
                                data-bs-toggle="modal"
                                data-bs-target="#kt_modal_upgrade_plan">{{ __('Upgrade to Pro') }}</a>
                        </div>
                        <!--end::Name-->

                        <!--begin::Info-->
                        <div class="flex-wrap mb-4 d-flex fw-bold fs-6 pe-2">
                            <a href="#"
                                class="mb-2 text-gray-400 d-flex align-items-center text-hover-primary me-5">
                                {!! theme()->getSvgIcon('icons/duotune/communication/com006.svg', 'svg-icon-4 me-1') !!}
                                Developer
                            </a>
                            <a href="#"
                                class="mb-2 text-gray-400 d-flex align-items-center text-hover-primary me-5">
                                {!! theme()->getSvgIcon('icons/duotune/general/gen018.svg', 'svg-icon-4 me-1') !!}
                                SF, Bay Area
                            </a>
                            <a href="#" class="mb-2 text-gray-400 d-flex align-items-center text-hover-primary">
                                {!! theme()->getSvgIcon('icons/duotune/communication/com011.svg', 'svg-icon-4 me-1') !!}
                                {{ auth()->user()->email }}
                            </a>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User-->

                    <!--begin::Actions-->
                    <div class="my-4 d-flex">
                        <a href="#" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                            {!! theme()->getSvgIcon('icons/duotune/arrows/arr012.svg', 'svg-icon-3 d-none') !!}
                            {{ theme()->getView('partials/general/_button-indicator', ['label' => 'Follow']) }}
                        </a>

                        <a href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="tooltip"
                            data-bs-placement="left" data-bs-trigger="hover" title="Coming soon">Hire Me</a>

                        <!--begin::Menu-->
                        <div class="me-0">
                            <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="bi bi-three-dots fs-3"></i>
                            </button>
                            {{ theme()->getView('partials/menus/_menu-3') }}
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Title-->

                <!--begin::Stats-->
                <div class="flex-wrap d-flex flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <!--begin::Stats-->
                        <div class="flex-wrap d-flex">
                            <!--begin::Stat-->
                            <div class="px-4 py-3 mb-3 border border-gray-300 border-dashed rounded min-w-125px me-6">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    {!! theme()->getSvgIcon('icons/duotune/arrows/arr066.svg', 'svg-icon-3 svg-icon-success me-2') !!}
                                    <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="4500"
                                        data-kt-countup-prefix="$">0</div>
                                </div>
                                <!--end::Number-->

                                <!--begin::Label-->
                                <div class="text-gray-400 fw-bold fs-6">{{ __('Earnings') }}</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->

                            <!--begin::Stat-->
                            <div class="px-4 py-3 mb-3 border border-gray-300 border-dashed rounded min-w-125px me-6">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    {!! theme()->getSvgIcon('icons/duotune/arrows/arr065.svg', 'svg-icon-3 svg-icon-danger me-2') !!}
                                    <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="75">0
                                    </div>
                                </div>
                                <!--end::Number-->

                                <!--begin::Label-->
                                <div class="text-gray-400 fw-bold fs-6">{{ __('Projects') }}</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->

                            <!--begin::Stat-->
                            <div class="px-4 py-3 mb-3 border border-gray-300 border-dashed rounded min-w-125px me-6">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    {!! theme()->getSvgIcon('icons/duotune/arrows/arr066.svg', 'svg-icon-3 svg-icon-success me-2') !!}
                                    <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="60"
                                        data-kt-countup-prefix="%">0</div>
                                </div>
                                <!--end::Number-->

                                <!--begin::Label-->
                                <div class="text-gray-400 fw-bold fs-6">{{ __('Success Rate') }}</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Progress-->
                    <div class="mt-3 d-flex align-items-center w-200px w-sm-300px flex-column">
                        <div class="mt-auto mb-2 d-flex justify-content-between w-100">
                            <span class="text-gray-400 fw-bold fs-6">{{ __('Profile Completion') }}</span>
                            <span class="fw-bolder fs-6">50%</span>
                        </div>

                        <div class="mx-3 mb-3 h-5px w-100 bg-light">
                            <div class="rounded bg-success h-5px" role="progressbar" style="width: 50%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--end::Progress-->
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::Details-->

        <!--begin::Navs-->
        <div class="overflow-auto d-flex h-55px">
            <ul class="border-transparent nav nav-stretch nav-line-tabs nav-line-tabs-2x fs-5 fw-bolder flex-nowrap">
                @foreach ($nav as $each)
                    <!--begin::Nav item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6 {{ theme()->getPagePath() === $each['view'] ? 'active' : '' }}"
                            href="{{ $each['view'] ? theme()->getPageUrl($each['view']) : '#' }}">
                            {{ $each['title'] }}
                        </a>
                    </li>
                    <!--end::Nav item-->
                @endforeach
            </ul>
        </div>
        <!--begin::Navs-->
    </div>
</div>
<!--end::Navbar-->
