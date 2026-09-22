@extends('user.layouts.account')

@section('title', 'Edit Property')

@section('content')
    <div class="widget-box-2 mb-20">
        <h3 class="title">Edit Property</h3>
        <p style="color: #6b7280; margin-top: 8px;">
            Update ke baad property dobara admin approval mein chali jayegi.
        </p>

        @if($property && !$property->is_active)
            <div style="margin-top: 16px; border-radius: 14px; padding: 14px 16px; background: rgba(241, 145, 61, 0.12); color: #9a6700;">
                Pending from admin side. We will contact you in 3 days.
            </div>
        @endif
    </div>

    @include('user.properties._form', [
        'formAction' => route('user.properties.update', $property),
        'formMethod' => 'PUT',
        'submitLabel' => 'Update Property'
    ])
@endsection
