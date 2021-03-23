@extends('layouts.app')

@section('content')
    <rate-property :property="{{ $property }}" :uuid="'{{ $uuid }}'" :ratings="{{ $ratings }}"></rate-property>
@endsection
