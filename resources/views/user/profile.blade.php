<!-- Profile -->
<div class="panel panel-default">
    <div class="panel-heading bg-warning">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#profile">
                Профил <b class="caret"></b></a>
        </h4>
    </div>
    <div id="profile" class="panel-collapse collapse in">
        <div class="panel-body">
            <ul class="list-unstyled">
                <li>
                    <h3>{{$user->username}}</h3>
                    <h4><b>{{$user->fullName}}</b></h4>
                    <a href="{{route('settings')}}">Созлаш</a>
                </li>
                <li>
                    <h4 class="color-gray">{{$user->subject}}</h4>
                    @if($user->email != null)<a>{{$user->email}}</a>@endif
                    <h6>+{{$user->phone}}</h6>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Profile -->
