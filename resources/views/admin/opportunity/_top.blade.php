<h1>{{$opportunity['subject']}}<span>（#{{$opportunity['id']}}）</span>

    @switch($opportunity['tempo'])
    @case(1)
    <span class="badge badge-primary">前期接触</span>
    @break

    @case(2)
    <span class="badge badge-danger">机会评估</span>
    @break

    @case(3)
    <span class="badge badge-info">需求分析</span>
    @break

    @case(4)
    <span class="badge badge-warning">方案提供</span>
    @break

    @default
    <span class="badge badge-success">多方选择/评估</span>
    @endswitch

</h1>
<div class="row" style="margin-top: 20px; color:#666">
    <div class="col-md-4 col-sm-3 col-12"><i
            class="feather icon-layers"></i>{{$customer['name']}}</div>
</div>