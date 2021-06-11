<div class="card" style="width: 100%;">
    <!--begin::Card body-->
    <div class="card-body p-0">
        <!--begin::Heading-->
        <div class="card-px text-center py-5 my-5">
            <!--begin::Title-->
            <h2 class="fs-2qx fw-boldest mb-3">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">{{ $title }}</font>
                </font>
            </h2>
            <!--end::Title-->
            <!--begin::Description-->
            <p class="text-gray-400 fs-2 fw-bold py-7">
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"> {{ $slot }}
                    </font>
                </font>
            </p>
            <!--end::Description-->
        </div>
        <!--end::Heading-->
        <!--begin::Illustration-->
        <div class="text-center px-5">
            <img src="/static/img/drawing.png" alt="" class="mw-100 mh-300px">
        </div>
        <!--end::Illustration-->
    </div>
    <!--end::Card body-->
</div>
