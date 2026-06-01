<div class="storefront-checkout-address">
    <div class="checkout-title"><h4 class="title">{{ $heading }}</h4></div>
    <div class="row">
        <div class="col-sm-6"><div class="single-form"><label class="form-label">First name *</label><input type="text" name="{{ $prefix }}_fname" value="{{ old($prefix.'_fname', $user->first_name ?? '') }}" required></div></div>
        <div class="col-sm-6"><div class="single-form"><label class="form-label">Last name *</label><input type="text" name="{{ $prefix }}_lname" value="{{ old($prefix.'_lname', $user->last_name ?? '') }}" required></div></div>
        <div class="col-sm-6"><div class="single-form"><label class="form-label">Phone *</label><input type="text" name="{{ $prefix }}_phone" value="{{ old($prefix.'_phone', $user->phone ?? '') }}" required></div></div>
        <div class="col-sm-6"><div class="single-form"><label class="form-label">Email address *</label><input type="email" name="{{ $prefix }}_email" value="{{ old($prefix.'_email', $user->email ?? '') }}" required></div></div>
        <div class="col-sm-12"><div class="single-form"><label class="form-label">Company / Address Label</label><input type="text" name="{{ $prefix }}_company" value="{{ old($prefix.'_company') }}"></div></div>
        <div class="col-sm-12"><div class="single-form"><label class="form-label">Country *</label><input type="hidden" name="{{ $prefix }}_country" value="India"><input type="text" value="India" disabled></div></div>
        <div class="col-sm-12"><div class="single-form"><label class="form-label">Street address *</label><input type="text" name="{{ $prefix }}_street" value="{{ old($prefix.'_street') }}" placeholder="House number and street name" required></div></div>
        <div class="col-sm-6"><div class="single-form"><label class="form-label">Town / City *</label><input type="text" name="{{ $prefix }}_suburb" value="{{ old($prefix.'_suburb') }}" required></div></div>
        <div class="col-sm-6"><div class="single-form"><label class="form-label">State *</label><input type="text" name="{{ $prefix }}_state" value="{{ old($prefix.'_state') }}" required></div></div>
        <div class="col-sm-6"><div class="single-form"><label class="form-label">Pin code *</label><input type="text" name="{{ $prefix }}_postcode" value="{{ old($prefix.'_postcode') }}" required></div></div>
    </div>
</div>
