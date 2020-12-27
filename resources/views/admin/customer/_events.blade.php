<div class="markdown-body editormd-html-preview">

    <form id="add-events" action="{{ route('events.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="row events">
            <div class="col-md-1 col-sm-1 col-12 time_y">
                {{date("Y")}}</div>
            <div class="col-md-1 col-sm-1 col-12 time_md"
                style="border-left: 1px solid {{Admin::color()->get('primary')}}">
                <i class="fa fa-circle text-primary"></i>
                <span>{{date("m-d")}}</span>
                <span class="time_hi">{{date("H:i")}}</span>
            </div>
            <div class="col-md-2 col-sm-2 col-12"><img class="avatar" src="/{{Admin::user()->avatar}}"
                    alt="{{Admin::user()->name}}"></div>
            <div class="col-md-8 col-sm-8 col-12 content">
                <div class="row">
                    <div class="col-md-10 col-sm-19 col-12">
                        <div class="row">
                            <textarea class="form-control" rows="3" placeholder="发布跟进记录..."
                                name="content">{{ old('content') }}</textarea>
                            <input type="hidden" name="crm_customer_id" value="{{$customer['id']}}">
                            <input type="hidden" name="admin_user_id" value="{{Admin::user()->id}}">
                        </div>
                        <div class="row eventsforminfo">
                            <select class="form-control " name="crm_contact_id" id="selectcontact">
                                <option value="" selected>选择联系人</option>
                                @if ($contacts->count() > 0)
                                @foreach ($contacts as $contact)
                                <option value="{{$contact['id']}}">{{$contact['name']}}</option>
                                @endforeach
                                @endif

                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-12"><button type="submit" class="btn btn-primary">发布</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    @foreach ($events as $event)
    <div class="row events contentlist">
        <div class="col-md-1 col-sm-1 col-12 time_y">
            {{$event['updated_at']->format('Y')}}</div>
        <div class="col-md-1 col-sm-1 col-12 time_md" style="border-left: 1px solid {{Admin::color()->get('primary')}}">
            <i class="fa fa-circle"></i>
            <span>{{$event['updated_at']->format('m-d')}}</span>
            <span class="time_hi">{{$event['updated_at']->format('H:i')}}</span></div>
        <div class="col-md-2 col-sm-2 col-12"><img class="avatar" src="{{$event['admin_user_id']!=null ? '/'.$event->Admin_user->avatar : '/static/img/logo.png'}}"
                alt="{{$event['admin_user_id']}}"></div>
        <div class="col-md-8 col-sm-8 col-12 content">
            <div class="row">

                <div class="col-md-11 col-sm-11 col-12">
                    <div class="row">
                        {{$event['content']}}
                    </div>
                    <div class="row eventsviewinfo">

                        <span>联系人：{{$event['crm_contact_id']!=null ? optional($event->CrmContact)->name : '未知'}}</span>
                    </div>
                </div>



                @if ($ifrole )
                <div class="col-md-1 col-sm-1 col-12 tools">
                    <form id="del-events" action="{{ route('events.destroy', $event->id) }}" method="post"
                        class="float-right">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-danger delete-btn"><i
                                class="feather icon-trash"></i></button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>


    @endforeach

</div>

<script>
    Dcat.ready(function () {
        // ajax表单提交
        $('#add-events').form({
            validate: true,
        });
        $('#del-events').form({
            validate: true,
        });
    });

</script>
