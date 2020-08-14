<table class="table table-striped usertop">
    <thead>
      <tr>
        <th>用户</th>
        <th>客户</th>
        <th>线索</th>
        <th>合同</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
      <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->customers_count}}</td>
        <td>{{$user->Leads_count}}</td>
        <td>{{$user->contracts_count}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>