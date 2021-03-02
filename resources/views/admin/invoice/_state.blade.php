<div class="box-body" style="text-align: center">
    <div class="row" style="padding: 20px 0">
        @if ($invoice['state']==1)
        <div class="col-md-6 col-sm-6 col-12" style="border-right: 1px solid #e1e4e9">
            <form method="POST" action="{{ admin_route('invoices.state',[$invoice['id']]) }}">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input type="hidden" name="state" value="2">
                <button type="submit" style="color:{{Admin::color()->get('primary')}}"> <span><i
                            class="feather icon-server"></i></span>领取</button>

            </form>
        </div>
        <div class="col-md-6 col-sm-6 col-12">
            <form method="POST" action="{{ admin_route('invoices.state',[$invoice['id']]) }}">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                <input type="hidden" name="state" value="4">
                <button type="submit" style="color:{{Admin::color()->get('primary')}}"> <span><i
                            class="feather icon-trash-2"></i></span>作废</button>
            </form>
        </div>
        @elseif ($invoice['state']==2)
        <div class="col-md-12 col-sm-12 col-12">
            <form method="POST" action="{{ admin_route('invoices.state',[$invoice['id']]) }}">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                <input type="hidden" name="state" value="4">
                <button type="submit" style="color:{{Admin::color()->get('primary')}}"> <span><i
                            class="feather icon-trash-2"></i></span>作废</button>
            </form>
        </div>
        @elseif ($invoice['state']==3)
        <div class="col-md-12 col-sm-12 col-12">
            <form method="POST" action="{{ admin_route('invoices.state',[$invoice['id']]) }}" style="width:100%">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input type="hidden" name="state" value="0">
                <button type="submit" style="color:{{Admin::color()->get('primary')}}"> <span><i
                            class="feather icon-check-circle"></i></span>改为准许</button>
            </form>
        </div>
        @elseif ($invoice['state']==4)
        <div class="col-md-12 col-sm-12 col-12">
            <form method="POST" action="{{ admin_route('invoices.state',[$invoice['id']]) }}">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input type="hidden" name="state" value="1">
                <button type="submit" style="color:{{Admin::color()->get('primary')}}"> <span><i
                            class="feather icon-refresh-cw"></i></span>改为正常</button>

            </form>
        </div>
        @else
        <div class="col-md-6 col-sm-6 col-12" style="border-right: 1px solid #e1e4e9">
            <form method="POST" action="{{ admin_route('invoices.state',[$invoice['id']]) }}">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <input type="hidden" name="state" value="1">
                <button type="submit" style="color:{{Admin::color()->get('primary')}}"> <span><i
                            class="feather icon-printer"></i></span>开票</button>

            </form>
        </div>
        <div class="col-md-6 col-sm-6 col-12">
            <form method="POST" action="{{ admin_route('invoices.state',[$invoice['id']]) }}">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                <input type="hidden" name="state" value="3">
                <button type="submit" style="color:{{Admin::color()->get('primary')}}"> <span><i
                            class="feather icon-alert-triangle"></i></span>驳回</button>
            </form>
        </div>
        @endif


    </div>
</div>
