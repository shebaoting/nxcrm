<h1>{{$customer['name']}}<span>（#{{$customer['id']}}）</span></h1>
<div class="row" style="margin-top: 20px; color:#666">
    <div class="col-md-4 col-sm-3 col-12"><i
            class="feather icon-map"></i>{{$customer['address']}}</div>
    <div class="col-md-3 col-sm-3 col-12"><i
            class="feather icon-link"></i>{{$customer['url']}}
    </div>
    <div class="col-md-3 col-sm-3 col-12"><i
            class="feather icon-mail"></i>{{$customer['email']}}
    </div>
</div>