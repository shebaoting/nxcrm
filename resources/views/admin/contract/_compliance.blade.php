@php
$compliances = collect(json_decode($contract['compliance']));
$compliances_num = $compliances->count();
@endphp

<style>
    .compliance .feather {
        font-size: 2rem;
        margin-right: 1rem;
        margin-top: 5px;
    }

</style>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h4 class="card-title">履约进度</h4>
                </div>
                @if ($customer['admin_user_id'] == Admin::user()->id || Admin::user()->isAdministrator())
                <div class="box-tools pull-right">
                    @if ($contract['nodes'] == 0)
                    <a
                        href="{{ admin_route('contracts.nodes',['id' => $contract['id'],'nodes' => $contract['nodes']+1]) }}"><i
                            class="feather icon-arrow-right"></i></a>
                    @elseif ($contract['nodes']+1 > $compliances_num)
                    <a
                        href="{{ admin_route('contracts.nodes',['id' => $contract['id'], 'nodes' => $contract['nodes']-1]) }}"><i
                            class="feather icon-arrow-left"></i></a>
                    @else
                    <a
                        href="{{ admin_route('contracts.nodes',['id' => $contract['id'], 'nodes' => $contract['nodes']-1]) }}"><i
                            class="feather icon-arrow-left"></i></a>&nbsp;&nbsp;&nbsp;
                    <a
                        href="{{ admin_route('contracts.nodes',['id' => $contract['id'],'nodes' => $contract['nodes']+1]) }}"><i
                            class="feather icon-arrow-right"></i></a>
                    @endif

                </div>
                @endif

            </div>
            <div class="card-body">
                @foreach ($compliances->chunk(3) as $compliance)
                <div class="row">
                    @php
                    $compliance = json_decode($compliance);
                    @endphp
                    {{-- {{dd($compliance[0])}} --}}
                    @foreach ($compliance as $key => $value)
                    @if ($key < $contract['nodes']) <div class="col-xs-4 col-md-4 col-sm-4 col-12 compliance">
                        <div class="media">
                            <i class="feather icon-check-circle text-success"></i>
                            <div class="media-body">
                                <h6 class="my-0 text-success font-weight-bold">{{$value->content}}</h6>
                                <p class="text-success mb-0">{{$value->date}}</p>
                            </div>
                        </div>
                </div>
                @elseif ($key == $contract['nodes'])
                <div class="col-xs-4 col-md-4 col-sm-4 col-12 compliance">
                    <div class="media">
                        <i class="feather icon-clock text-primary"></i>
                        <div class="media-body">
                            <h6 class="my-0 text-primary font-weight-bold">{{$value->content}}</h6>
                            <p class="text-primary mb-0">{{$value->date}}</p>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-xs-4 col-md-4 col-sm-4 col-12 compliance">
                    <div class="media">
                        <i class="feather icon-alert-circle text-muted"></i>
                        <div class="media-body">
                            <h6 class="my-0 text-muted">{{$value->content}}</h6>
                            <p class="text-muted mb-0">{{$value->date}}</p>
                        </div>
                    </div>
                </div>
                @endif

                @endforeach
            </div>
            @endforeach
        </div>
    </div>


</div>

</div>
