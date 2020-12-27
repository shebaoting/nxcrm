<div class="box-body">
@foreach ($leads as $lead)
<div class="row LeadsRecent">
<div class="col-md-2 avatar" style="border: 0"><img src="storage/{{$lead->Admin_user->avatar}}" alt=""></div>
<div class="col-md-6">{{$lead->name}}</div>
<div class="col-md-2">
    @switch($lead->state)
    @case(0)
    <span class="badge badge-secondary">未开始</span>
    @break
    @case(1)
    <span class="badge badge-success">执行中</span>
    @break
    @default
    <span class="badge badge-danger">其他</span>
    @endswitch
</div>
</div>
@endforeach
</div>
