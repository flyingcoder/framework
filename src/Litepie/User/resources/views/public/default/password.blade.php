<div class="container">
    <div class="row profile">
        <div class="col-md-6  col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Reset <small>Password</small></div>
                <div class="panel-body">
                    {!!Form::vertical_open()
                    ->method('POST')
                    ->action('password/email')!!}
                    {!! csrf_field() !!}
                    @if (Session::has('status'))
                    <div class="alert alert-info">
                        <strong>Info!</strong> {!!  Session::pull('status'); !!}
                    </div>
                    @else
                    If you have forgotten your password - reset it.
                    @endif
                    {!!Form::text('email')!!}
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-xs-6">
                            {!! Form::hidden(config('user.params.type'))!!}
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Send password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    {!!Form::Close()!!}
                    <br>
                    <a href="{{trans_url("/login?role=$guard")}}">Back to login</a><br>
                </div>
            </div>
        </div>
    </div>
</div>
