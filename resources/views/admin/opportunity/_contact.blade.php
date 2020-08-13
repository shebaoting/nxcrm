 {{-- 联系人开始 --}}
 @if ($contacts->count() > 0)
 @foreach ($contacts as $contact)
 <div class="card contacts_card">

     <div class="box-header with-border" style="padding: .65rem 1rem">

         <div class="pull-left">
             <h3 class="box-title" style="line-height:30px;">{{$contact['name']}}</h3>
             <span class="badge badge-primary align-middle">{{$contact['position']}}</span>
         </div>
         <div class="pull-right">
             <a href="/admin/contacts/{{$contact['id']}}/edit"><i class="feather icon-edit-1"></i></a>
         </div>
     </div>


     <div class="box-body">


         <div class="row">
             <div class="col-md-12 col-sm-12 col-12"><i class="feather icon-phone"></i>{{$contact['phone']}}
             </div>
             <div class="col-md-12 col-sm-12 col-12"><i class="fa fa-wechat"></i>{{$contact['wechat']}}</div>
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
 {{-- 联系人结束 --}}
