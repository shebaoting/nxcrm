{{-- 添加联系人开始 --}}
@if ($ifrole)
<div class="card add_contacts">
    <div class="box-body" style="text-align: center">
        <div class="row" style="padding: 20px 0">
            <div class="col-md-6 col-sm-6 col-12" style="border-right: 1px solid #e1e4e9">

                <a href="{{ admin_route('contacts.create',['id'=>$customer['id']]) }}"><span class="text-primary"><i
                            class="feather icon-plus"></i></span>添加</a>
            </div>
            <div class="col-md-6 col-sm-6 col-12"><a href=""><span class="text-primary"><i
                            class="feather icon-link"></i></span>关联</a></div>
        </div>
    </div>
</div>
@endif

{{-- 添加联系人结束 --}}

@if ($contacts->count() > 0)
@foreach ($contacts as $contact)
<div class="card contacts_card">

    <div class="box-header with-border" style="padding: .65rem 1rem">

        <div class="pull-left">
            <h3 class="box-title" style="line-height:30px;">{{$contact['name']}}</h3>
            <span class="badge badge-primary align-middle">{{$contact['position']}}</span>
        </div>

        @if ($ifrole && $customer['admin_user_id'])
        <div class="pull-right">
            <a href="{{ admin_route('contacts.edit',['contact'=>$contact['id']])}}"><i class="feather icon-edit-1"></i></a>
        </div>
        @endif

    </div>


    <div class="box-body">


        <div class="row">
            @if ($contact['phone'])
            <div class="col-md-12 col-sm-12 col-12"><i class="feather icon-phone"></i> {{$contact['phone']}}
            </div>
            @endif
            @if ($contact['fields'])
            @php
            $contact_fields = json_decode($contact['fields'],true);
            @endphp
            @foreach ($contactfields as $field)
            @php
            $field_options = json_decode($field['options'],true);
            @endphp


            <div class="col-md-12 col-sm-12 col-12">
                <i class="fa {{$field['icon']}}"></i>
                {{-- {{$field['name']}}: --}}
                @if (in_array($field['type'],['select','radio']))
                {{isset($contact_fields[$field['field']]) ? $field_options[$contact_fields[$field['field']]]:''}}

                @elseif (in_array($field['type'],['checkbox','multipleSelect']))



                @isset($contact_fields[$field['field']])
                @foreach ($contact_fields[$field['field']] as $key => $value)
                @if ($value)
                {{$field_options[$value]}}
                @endif
                @endforeach
                @endisset

                @else
                @isset($contact_fields[$field['field']])
                {{$contact_fields[$field['field']]}}
                @endisset
                @endif
            </div>
            @endforeach
            @endif

        </div>
    </div>
</div>
@endforeach
@else
<div class="card">
    <div class="box-body" style="padding:30px; text-align:center">
        没有联系人
    </div>
</div>
@endif
