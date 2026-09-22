@extends('user.layouts.account')

@section('title', 'Add Property')

@section('content')
    <div class="widget-box-2 mb-20">
        <h3 class="title">Submit Your Property</h3>
        <p style="color: #6b7280; margin-top: 8px;">
            Aap property add kar sakte hain. Admin activate karega, uske baad hi public website par show hogi.
        </p>
    </div>

    @include('user.properties._form', [
        'formAction' => route('property.store'),
        'formMethod' => 'POST',
        'submitLabel' => 'Submit Property'
    ])
@endsection
