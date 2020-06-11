{!! Form::open(['url' => 'foo/bar']) !!}
@csrf
{!! Form::text('email', ''); !!}
{!! Form::close() !!}
