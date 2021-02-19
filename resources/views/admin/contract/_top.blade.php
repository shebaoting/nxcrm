<h1>{{$contract['title']}}<span>（#{{$contract['id']}}）</span></h1>
<div class="row" style="margin-top: 20px; color:#666">
    <div class="col-md-4 col-sm-3 col-12"><i class="feather icon-package"></i>客户：{{$customer['name']}}</div>
    @if ($contract['fields'])
    @php
    $contract_fields = json_decode($contract['fields'],true);
    @endphp
    @foreach ($contractfields as $field)
    @php
    $field_options = json_decode($field['options'],true);
    @endphp
    <div class="col-md-4 col-sm-4 col-12">
        <i class="fa {{$field['icon']}}"></i>{{$field['name']}}:

        @if (in_array($field['type'],['select','radio']))
        {{$field_options[$contract_fields[$field['field']]]}}


        @elseif (in_array($field['type'],['checkbox','multipleSelect']))
        @foreach ($contract_fields[$field['field']] as $key => $value)
        @if ($value)
        {{$field_options[$value]}}
        @endif
        @endforeach
        @else
        @isset($contract_fields[$field['field']])
           {{$contract_fields[$field['field']]}}
        @endisset
        @endif


    </div>
    @endforeach
    @endif
</div>
