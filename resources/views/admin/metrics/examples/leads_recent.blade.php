<style>
    .leads_recent .table td {
        padding-top: 1rem !important;
    }

    .leads_recent .mb-1 {
        margin-bottom: .25rem !important;
    }

    .leads_recent .font-size-14 {
        font-size: 14px !important;
    }

    .leads_recent .font-size-12 {
        font-size: 12px !important;
    }

    .leads_recent h5 {
        font-weight: 700;
    }

</style>
<div class="table-responsive leads_recent">
    <table class="table table-nowrap align-middle table-hover mb-0">
        <tbody>
            @foreach ($leads as $lead)
            <tr>
                <td>
                    <h5 class="text-truncate font-size-14 mb-1"><a href="#" class="text-dark">{{$lead->name}}</a></h5>
                    <p class="font-size-12 text-muted mb-0">{{$lead->created_at}}</p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
