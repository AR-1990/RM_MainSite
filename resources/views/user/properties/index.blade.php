@extends('user.layouts.account')

@section('title', 'My Properties')

@push('styles')
<style>
    .portal-hero {
        position: relative;
        overflow: hidden;
        padding: 34px;
        border-radius: 28px;
        background: linear-gradient(135deg, #111827 0%, #1f2937 42%, #f1913d 180%);
        color: #fff;
        margin-bottom: 26px;
        box-shadow: 0 20px 60px rgba(17, 24, 39, 0.18);
    }

    .portal-hero::after {
        content: "";
        position: absolute;
        right: -70px;
        top: -60px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
    }

    .portal-hero-content {
        position: relative;
        z-index: 1;
    }

    .portal-hero h3 {
        color: #fff;
        margin-bottom: 10px;
        font-size: 34px;
        line-height: 1.15;
    }

    .portal-hero p {
        color: rgba(255, 255, 255, 0.84);
        max-width: 760px;
        margin-bottom: 0;
    }

    .portal-hero-actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        margin-top: 24px;
    }

    .portal-hero-actions .tf-btn {
        flex: 0 0 auto;
        min-width: max-content;
        padding: 0 28px;
    }

    .portal-hero-actions .tf-btn.style-border {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.24);
        color: #fff;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 28px;
    }

    .stats-card {
        background: #fff;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 14px 40px rgba(17, 24, 39, 0.06);
        border: 1px solid rgba(17, 24, 39, 0.05);
    }

    .stats-card .label {
        display: block;
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .stats-card .value {
        display: block;
        color: #111827;
        font-size: 34px;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 10px;
    }

    .stats-card .desc {
        color: #6b7280;
        font-size: 14px;
        margin: 0;
    }

    .properties-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .property-card {
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 16px 45px rgba(17, 24, 39, 0.07);
        border: 1px solid rgba(17, 24, 39, 0.06);
        height: 100%;
    }

    .property-card-media {
        position: relative;
    }

    .property-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        display: block;
    }

    .property-card-top {
        position: absolute;
        inset: 18px 18px auto 18px;
        display: flex;
        justify-content: space-between;
        gap: 10px;
        align-items: flex-start;
    }

    .property-category-chip {
        display: inline-flex;
        align-items: center;
        padding: 10px 14px;
        border-radius: 999px;
        background: rgba(17, 24, 39, 0.78);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        backdrop-filter: blur(10px);
    }

    .property-card-body {
        padding: 24px;
    }

    .property-card h5 {
        margin-bottom: 8px;
        font-size: 24px;
        line-height: 1.25;
    }

    .property-price {
        color: #111827;
        font-size: 28px;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 8px;
    }

    .property-location {
        color: #6b7280;
        margin-bottom: 18px;
    }

    .property-meta {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 18px;
    }

    .property-meta-item {
        padding: 14px 16px;
        border-radius: 18px;
        background: #f8fafc;
        border: 1px solid #eef2f7;
    }

    .property-meta-item .meta-label {
        display: block;
        color: #6b7280;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .property-meta-item .meta-value {
        display: block;
        color: #111827;
        font-size: 15px;
        font-weight: 700;
    }

    .property-description {
        color: #4b5563;
        margin-bottom: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 10px 15px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        backdrop-filter: blur(8px);
    }

    .status-approved {
        background: rgba(220, 252, 231, 0.94);
        color: #166534;
    }

    .status-pending {
        background: rgba(255, 237, 213, 0.96);
        color: #b45309;
    }

    .status-hidden {
        background: rgba(254, 226, 226, 0.96);
        color: #991b1b;
    }

    .pending-note {
        border-radius: 18px;
        padding: 16px 18px;
        background: rgba(241, 145, 61, 0.1);
        color: #9a6700;
        margin: 18px 0 20px;
        border: 1px solid rgba(241, 145, 61, 0.16);
    }

    .card-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .empty-state {
        background: #fff;
        border-radius: 28px;
        padding: 46px 34px;
        box-shadow: 0 16px 45px rgba(17, 24, 39, 0.06);
        text-align: center;
        border: 1px solid rgba(17, 24, 39, 0.06);
    }

    .empty-state h4 {
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #6b7280;
        max-width: 560px;
        margin: 0 auto 22px;
    }

    .portal-pagination {
        margin-top: 26px;
    }

    @media (max-width: 1199px) {
        .stats-grid,
        .properties-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 767px) {
        .portal-hero {
            padding: 24px;
        }

        .portal-hero h3 {
            font-size: 28px;
        }

        .stats-grid,
        .properties-grid,
        .property-meta {
            grid-template-columns: minmax(0, 1fr);
        }

        .property-card img {
            height: 220px;
        }
    }
</style>
@endpush

@section('content')
    <div class="portal-hero">
        <div class="portal-hero-content">
            <h3>My Properties</h3>
            <p>Aap yahan se apni listings ko manage kar sakte hain. New property submit hogi, edit ke baad dubara admin review mein jayegi, aur approved hone ke baad hi public website par live nazar aayegi.</p>

            <div class="portal-hero-actions">
                <a href="{{ route('property.add') }}" class="tf-btn bg-color-primary">Add New Property</a>
                <a href="{{ route('index') }}" class="tf-btn style-border pd-23">Back to Website</a>
            </div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stats-card">
            <span class="label">Total Listings</span>
            <span class="value">{{ $stats['total'] }}</span>
            <p class="desc">Aap ki total submitted properties</p>
        </div>
        <div class="stats-card">
            <span class="label">Live Now</span>
            <span class="value">{{ $stats['live'] }}</span>
            <p class="desc">Approved aur website par visible</p>
        </div>
        <div class="stats-card">
            <span class="label">Pending Review</span>
            <span class="value">{{ $stats['pending'] }}</span>
            <p class="desc">Admin approval ka wait kar rahi hain</p>
        </div>
        <div class="stats-card">
            <span class="label">Hidden</span>
            <span class="value">{{ $stats['hidden'] }}</span>
            <p class="desc">Inactive ya deactivated listings</p>
        </div>
    </div>

    @if($properties->isEmpty())
        <div class="empty-state">
            <h4>No property submitted yet</h4>
            <p>Apni pehli property add karein. Approval milne ke baad hi woh public site par live show hogi. User portal mein aap sirf add aur edit kar sakte hain.</p>
            <a href="{{ route('property.add') }}" class="tf-btn bg-color-primary">Submit Your First Property</a>
        </div>
    @else
        <div class="properties-grid">
            @foreach($properties as $property)
                @php
                    $detailItems = [
                        ['label' => 'Purpose', 'value' => $property->property_status === 'for_rent' ? 'For Rent' : 'For Sale'],
                        ['label' => 'Size', 'value' => $property->display_size . ' ' . $property->size_prefix],
                    ];

                    if ((int) $property->bedrooms > 0) {
                        $detailItems[] = ['label' => 'Bedrooms', 'value' => (int) $property->bedrooms];
                    }

                    if ((int) $property->bathrooms > 0) {
                        $detailItems[] = ['label' => 'Bathrooms', 'value' => (int) $property->bathrooms];
                    }

                    if ((int) $property->garages > 0) {
                        $detailItems[] = ['label' => 'Parking', 'value' => (int) $property->garages];
                    }
                @endphp

                <article class="property-card">
                    <div class="property-card-media">
                        <img src="{{ $property->primary_image ? url($property->primary_image) : asset('/images/home/house-1.jpg') }}" alt="{{ $property->title }}">

                        <div class="property-card-top">
                            <span class="property-category-chip">{{ $property->category->name ?? 'Property' }}</span>

                            @if($property->is_deactivated)
                                <span class="status-badge status-hidden">Hidden</span>
                            @elseif($property->is_active)
                                <span class="status-badge status-approved">Approved & Live</span>
                            @else
                                <span class="status-badge status-pending">Pending Approval</span>
                            @endif
                        </div>
                    </div>

                    <div class="property-card-body">
                        <h5>{{ $property->title }}</h5>
                        <div class="property-price">PKR {{ number_format($property->price) }}</div>
                        <p class="property-location">{{ $property->city }} | {{ $property->full_address }}</p>

                        <div class="property-meta">
                            @foreach($detailItems as $item)
                                <div class="property-meta-item">
                                    <span class="meta-label">{{ $item['label'] }}</span>
                                    <span class="meta-value">{{ $item['value'] }}</span>
                                </div>
                            @endforeach
                        </div>

                        @if(!empty($property->description))
                            <p class="property-description">{{ strip_tags($property->description) }}</p>
                        @endif

                        @if(!$property->is_active)
                            <div class="pending-note">Pending from admin side. We will contact you in 3 days.</div>
                        @endif

                        <div class="card-actions">
                            <a href="{{ route('user.properties.edit', $property) }}" class="tf-btn style-border pd-23">Edit Property</a>

                            @if($property->is_active && !$property->is_deactivated)
                                <a href="{{ route('properties.show', $property->id) }}" class="tf-btn bg-color-primary">View Live</a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="portal-pagination">
            {{ $properties->links() }}
        </div>
    @endif
@endsection
