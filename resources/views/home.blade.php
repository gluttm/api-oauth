@extends('layouts.app')

@section('content')
<dashboard-index :access_token="{{ isset($token) ? $token : 0 }}" />
@endsection
