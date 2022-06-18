<style>
    .opportunitys_recent {
        padding-top: 1rem !important
    }

    .opportunitys_recent .table td {
        padding: 0 2rem 0 !important
    }

    .opportunitys_recent .mb-1 {
        margin-bottom: .25rem !important;
    }

</style>
<div class="table-responsive opportunitys_recent">
    <table class="table table-centered mb-0">
        <tbody>
            @foreach ($contracts as $contract)
            <tr>
                <td class="py-3">
                    <div class="media py-1 align-items-center">
                        <div class="media-body">
                            <h6 class="mb-1">{{$contract->CrmCustomer->name}}</h6>
                            <p class="text-uppercase text-muted mb-0 font-size-11">{{$contract->signdate}}</p>
                        </div>
                    </div>
                </td>
                <td class="py-3">
                    <div class="progress mb-2 mt-1" style="height: 6px;">
                        <div class="progress-bar" role="progressbar" style="width: {{round((($contract->receipt)/($contract->total)*100),2)}}%;" aria-valuenow="{{round((($contract->receipt)/($contract->total)*100),2)}}"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="text-uppercase text-muted mb-0 font-size-11">
                        {{$contract->total - $contract->receipt}}
                    </p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
