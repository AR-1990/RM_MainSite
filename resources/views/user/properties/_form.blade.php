@push('styles')
<style>
    .portal-property-form select.form-control {
        display: block !important;
        width: 100%;
        height: 52px;
        padding: 0 16px;
        border-radius: 16px;
        border: 1px solid #d9dde3;
        background-color: #fff;
        color: #111827;
        appearance: auto;
        -webkit-appearance: menulist;
        -moz-appearance: auto;
        background-image: none !important;
        box-shadow: none;
    }

    .portal-property-form .nice-select {
        display: none !important;
    }

    .portal-property-form .widget-box-2 {
        overflow: visible;
    }

    .portal-form-actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        align-items: center;
    }

    .portal-form-actions .tf-btn {
        flex: 0 0 auto;
        min-width: max-content;
        padding: 0 28px;
        white-space: nowrap;
    }
</style>
@endpush

<form action="{{ $formAction }}" method="POST" enctype="multipart/form-data" class="portal-property-form">
    @csrf
    @if($formMethod !== 'POST')
        @method($formMethod)
    @endif

    <div class="widget-box-2 mb-20">
        <h5 class="title">Property Information</h5>
        <div class="box grid-layout-2 gap-30">
            <fieldset class="box-fieldset">
                <label>Title <span>*</span></label>
                <input type="text" class="form-control" name="title" value="{{ old('title', $property?->title) }}" required>
            </fieldset>

            <fieldset class="box-fieldset">
                <label>City <span>*</span></label>
                <input type="text" class="form-control" name="city" value="{{ old('city', $property?->city) }}" required>
            </fieldset>
        </div>

        <fieldset class="box-fieldset">
            <label>Description</label>
            <textarea class="textarea" name="description" placeholder="Property details">{{ old('description', $property?->description) }}</textarea>
        </fieldset>

        <div class="box grid-layout-2 gap-30">
            <fieldset class="box-fieldset">
                <label>Full Address <span>*</span></label>
                <input type="text" class="form-control" name="full_address" value="{{ old('full_address', $property?->full_address) }}" required>
            </fieldset>

            <fieldset class="box-fieldset">
                <label>Location</label>
                <input type="text" class="form-control" name="location" value="{{ old('location', $property?->location) }}">
            </fieldset>
        </div>

        <div class="box grid-layout-3 gap-30">
            <fieldset class="box-fieldset">
                <label>Category <span>*</span></label>
                <select class="form-control" id="property_category_id" name="property_category_id" required>
                    <option value="">Select category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            data-category-name="{{ strtolower($category->name) }}"
                            {{ (string) old('property_category_id', $property?->property_category_id) === (string) $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </fieldset>

            <fieldset class="box-fieldset">
                <label>Status <span>*</span></label>
                <select class="form-control" name="property_status" required>
                    @foreach($statusOptions as $value => $label)
                        <option value="{{ $value }}" {{ old('property_status', $property?->property_status) === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </fieldset>

            <fieldset class="box-fieldset">
                <label>Price <span>*</span></label>
                <input type="number" min="0" step="0.01" class="form-control" name="price" value="{{ old('price', $property?->price) }}" required>
            </fieldset>
        </div>
    </div>

    <div class="widget-box-2 mb-20">
        <h5 class="title">Size & Status</h5>
        <div class="box grid-layout-4 gap-30">
            <fieldset class="box-fieldset">
                <label>Size Prefix <span>*</span></label>
                <select class="form-control" name="size_prefix" required>
                    @foreach($sizePrefixes as $sizePrefix)
                        <option value="{{ $sizePrefix }}" {{ old('size_prefix', $property?->size_prefix) === $sizePrefix ? 'selected' : '' }}>
                            {{ $sizePrefix }}
                        </option>
                    @endforeach
                </select>
            </fieldset>

            <fieldset class="box-fieldset">
                <label>Size <span>*</span></label>
                <input type="number" min="0" step="0.01" class="form-control" name="size" value="{{ old('size', $property?->size) }}" required>
            </fieldset>

            <fieldset class="box-fieldset">
                <label>1 Marla Value <span>*</span></label>
                <select class="form-control" name="marla_value" required>
                    @foreach($marlaValues as $marlaValue)
                        <option value="{{ $marlaValue }}" {{ (string) old('marla_value', $property?->marla_value) === (string) $marlaValue ? 'selected' : '' }}>
                            {{ $marlaValue }}
                        </option>
                    @endforeach
                </select>
            </fieldset>

            <fieldset class="box-fieldset">
                <label>Furnished Status <span>*</span></label>
                <select class="form-control" id="furnished_status" name="furnished_status" required>
                    @foreach($furnishedOptions as $option)
                        <option value="{{ $option }}" {{ old('furnished_status', $property?->furnished_status) === $option ? 'selected' : '' }}>
                            {{ $option === 'N/A' ? 'Not Applicable (Plot)' : $option }}
                        </option>
                    @endforeach
                </select>
            </fieldset>
        </div>
    </div>

    <div class="widget-box-2 mb-20">
        <h5 class="title">Room Details</h5>
        <div class="box grid-layout-4 gap-30" id="room-fields">
            <fieldset class="box-fieldset">
                <label>Number of Rooms <span>*</span></label>
                <input type="number" min="0" class="form-control" id="rooms" name="rooms" value="{{ old('rooms', $property?->rooms ?? 0) }}" required>
            </fieldset>

            <fieldset class="box-fieldset">
                <label>Number of Bedrooms <span>*</span></label>
                <input type="number" min="0" class="form-control" id="bedrooms" name="bedrooms" value="{{ old('bedrooms', $property?->bedrooms ?? 0) }}" required>
            </fieldset>

            <fieldset class="box-fieldset">
                <label>Number of Bathrooms <span>*</span></label>
                <input type="number" min="0" class="form-control" id="bathrooms" name="bathrooms" value="{{ old('bathrooms', $property?->bathrooms ?? 0) }}" required>
            </fieldset>

            <fieldset class="box-fieldset">
                <label>Parking</label>
                <input type="number" min="0" class="form-control" id="garages" name="garages" value="{{ old('garages', $property?->garages ?? 0) }}">
            </fieldset>
        </div>

        <div id="plot-note" style="display: none; margin-top: 16px; color: #6b7280;">
            Plot select hone par room fields hide rahengi aur backend par `0` save hoga.
        </div>
    </div>

    <div class="widget-box-2 mb-20">
        <h5 class="title">Media & Extras</h5>
        <div class="box grid-layout-2 gap-30">
            <fieldset class="box-fieldset">
                <label>Primary Image {{ $formMethod === 'POST' ? '*' : '' }}</label>
                <input type="file" class="form-control" name="primary_image" accept="image/*" {{ $formMethod === 'POST' ? 'required' : '' }}>
                @if($property?->primary_image)
                    <div style="margin-top: 12px;">
                        <img src="{{ url($property->primary_image) }}" alt="Primary image" style="max-width: 140px; border-radius: 12px;">
                    </div>
                @endif
            </fieldset>

            <fieldset class="box-fieldset">
                <label>Additional Images</label>
                <input type="file" class="form-control" name="images[]" accept="image/*" multiple>
                @if($property && $property->images->count())
                    <p style="margin-top: 10px; color: #6b7280;">Existing gallery images: {{ $property->images->count() }}</p>
                @endif
            </fieldset>
        </div>

        <div class="box grid-layout-2 gap-30">
            <fieldset class="box-fieldset">
                <label>Video URL</label>
                <input type="url" class="form-control" name="video_url" value="{{ old('video_url', $property?->video_url) }}">
            </fieldset>

            <fieldset class="box-fieldset">
                <label>Amenities</label>
                <input type="text" class="form-control" name="amenities_text" value="{{ old('amenities_text', $amenitiesText) }}" placeholder="Parking, Security, Electricity">
            </fieldset>
        </div>
    </div>

    <div class="widget-box-2">
        <div class="portal-form-actions">
            <button type="submit" class="tf-btn bg-color-primary">
            {{ $submitLabel }}
            </button>
        </div>
    </div>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.portal-property-form select.form-control').forEach(function (select) {
            select.style.display = 'block';
            select.style.opacity = '1';
            select.style.visibility = 'visible';

            const nextSibling = select.nextElementSibling;
            if (nextSibling && nextSibling.classList.contains('nice-select')) {
                nextSibling.remove();
            }
        });

        const categorySelect = document.getElementById('property_category_id');
        const furnishedStatus = document.getElementById('furnished_status');
        const roomFields = document.getElementById('room-fields');
        const plotNote = document.getElementById('plot-note');
        const numericFields = ['rooms', 'bedrooms', 'bathrooms', 'garages'];

        function isPlotSelected() {
            const selectedOption = categorySelect.options[categorySelect.selectedIndex];
            const categoryName = selectedOption ? (selectedOption.dataset.categoryName || '') : '';
            return categoryName === 'plot';
        }

        function togglePlotFields() {
            const plotSelected = isPlotSelected();

            roomFields.style.display = plotSelected ? 'none' : 'grid';
            plotNote.style.display = plotSelected ? 'block' : 'none';

            numericFields.forEach(function (fieldId) {
                const input = document.getElementById(fieldId);
                if (plotSelected) {
                    input.value = 0;
                }
            });

            if (plotSelected) {
                furnishedStatus.value = 'N/A';
            }
        }

        categorySelect.addEventListener('change', togglePlotFields);
        togglePlotFields();
    });
</script>
@endpush
