<style>
    .card {
        margin-bottom: 3rem;
        border: 0px solid transparent;
    }

    .card-body {
        padding: 1.875rem;
    }

    .font-w600 {
        font-weight: 600;
    }

    .fs-20 {
        font-size: 20px !important;
        line-height: 1.5;
    }

    .fs-14 {
        font-size: 14px !important;
        line-height: 1.5;
    }

    .contact-bx ul {
        display: flex;
        margin-left: 0;
        padding-left: 0;
    }

    .contact-bx ul li a {
        /* color: #2953E8; */
        font-size: 14px;
        padding-right: 20px;
    }

    .contact-bx {
        border-width: 2px;
        border-color: #fff;
    }

    .contact-bx:hover {
        /* border-color: #2953E8; */
        box-shadow: 0px 0px 20px rgb(41 83 232 / 10%);
    }

</style>



{!! $grid->renderFilter() !!}

{!! $grid->renderHeader() !!}

<div class="row">
    <div class="col-xl-12 col-xxl-12 col-lg-12">
        <div class="tab-content">
            <div class="tab-pane fade active show">
                <div class="row loadmore-content {{ $grid->formatTableClass() }}" id="{{ $tableId }}">


                    @foreach($grid->rows() as $row)

                    <div class="col-xl-3 col-xxl-6 col-sm-6">
                        <div class="card contact-bx">
                            <div class="card-body">
                                <div class="media">
                                    <div class="image-bx mr-3">
                                        <img src="/storage/{!! $row->column('avatar') !!}" alt="" class="rounded-circle"
                                            width="90">
                                        <span class="active"></span>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="fs-20 font-w600 mb-0"><a
                                                href="#"
                                                class="text-black">{!! $row->column('name') !!}</a></h6>
                                        <p class="fs-14">{!! $row->column('username') !!}</p>
                                        <ul>
                                            <li><a href="tel:{!! $row->column('mobile') !!}"><i class="fa fa-phone"
                                                        aria-hidden="true"></i>   {!! $row->column('mobile') !!}</a></li>
                                            {{-- <li><a href="javascript:void(0)"><i class="fa fa-video-camera"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="#"><i
                                                        class="fa fa-comment-o"></i></a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach



                </div>



                {!! $grid->renderFooter() !!}

                @include('admin::grid.table-pagination')




            </div>
        </div>
    </div>

</div>
