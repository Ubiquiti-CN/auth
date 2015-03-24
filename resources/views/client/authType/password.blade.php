@extends('client/global/app')
@section('content')
<style>
    .passwordContainer{
        text-align: center;
    }

</style>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 passwordContainer">
            {!! Notification::showAll() !!}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(array()) !!}
            <div class="form-group">
                <label for="authTime">密码</label>
                <input value="" type="password" class="form-control" id="clientPassword" name="clientPassword" placeholder="">
            </div>
            <input type="hidden" name="clientMac" value="{{ $client_mac }}"/>
            <input type="hidden" name="authType" value="{{ $site_config['auth_type'] }}" />
            <button type="submit" class="btn btn-default">提交</button>
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
