@if ($program_info)
<button class="btn btn-primary edit-form" data-url={{$editPage}}>
    <i class="feather icon-plus"></i>
    <span class="d-none d-sm-inline">&nbsp; 业绩目标</span>
</button>
@else
<button class="btn btn-primary create-form">
    <i class="feather icon-plus"></i>
    <span class="d-none d-sm-inline">&nbsp; 业绩目标</span>
</button>
@endif

