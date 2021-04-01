<style>
    .usertop .avatar-md {
        width: 40px;
        height: 40px;
        font-size: 24px;
    }

    .usertop .main-img-user {
        display: block;
        position: relative;
        width: 36px;
        height: 36px;
        border-radius: 100%;
    }

    .usertop .main-img-user img {
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        border-radius: 100%;
    }

    .usertop .mb-1,
    .usertop .my-1 {
        margin-bottom: .25rem !important;
    }

    .usertop .mb-2,
    .usertop .my-2 {
        margin-bottom: .5rem !important;
    }

    .usertop .font-weight-semibold {
        font-weight: 600 !important;
    }

    .usertop .tx-15 {
        font-size: 15px;
    }

    .usertop td,
    .usertop th {
        border-top: 0;
    }
    .usertop .ml-3, .usertop .mx-3 {
    margin-left: 1rem!important;
}
.transcations.table td, .transcations.table th {
    padding: 14px 0;
    line-height: 1.462;
}
.wd-5p {
    width: 5%;
}
.usertop {
    padding: 0 20px 20px 0;
    display: block
}
.usertop tbody tr:hover {
    background-color: transparent;
}

</style>
<table class="table table-hover m-b-0 transcations mt-2 usertop">
    <tbody>

        @foreach ($users as $user)
        <tr>
            <td class="wd-5p">
                <div class="main-img-user avatar-md">
                    <img alt="头像" class="rounded-circle mr-3"
                        src="{{$user->avatar ? ('storage/'.$user->avatar) : ('vendor/dcat-admin/images/default-avatar.jpg')}}">
                </div>
            </td>
            <td>
                <div class="d-flex align-middle ml-3">
                    <div class="d-inline-block">
                        <h6 class="mb-1">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit; font-weight: 600;">{{$user->name}}</font>
                            </font>
                        </h6>
                        <p class="mb-0 tx-13 text-muted">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">优秀员工</font>
                            </font>
                        </p>
                    </div>
                </div>
            </td>
            <td class="text-right">
                <div class="d-inline-block">
                    <h6 class="mb-2 tx-15 font-weight-semibold">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">￥{{$user->crm_contracts_sum_total}}</font>
                        </font>
                    </h6>
                    <p class="mb-0 tx-11 text-muted">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">历史合同总量: {{$user->CrmContracts->count()}}</font>
                        </font>
                    </p>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
