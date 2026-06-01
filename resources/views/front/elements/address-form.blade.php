<div class="storefront-form-card mt-4">
    <h3>Add an Address</h3>
    <form action="{{ $addressFormAction ?? url('user/addresses') }}" method="post">
        @csrf
        <input type="hidden" name="mode" value="address">
        <div class="row">
            <div class="col-sm-6">
                <div class="single-form">
                    <label>Address Type *</label>
                    <select name="type" class="form-select" required><option value="BILLING">Billing</option><option value="SHIPPING">Shipping</option></select>
                </div>
            </div>
            <div class="col-sm-6"><div class="single-form"><label>Label *</label><input type="text" name="title" placeholder="Home, Office, etc." required></div></div>
            <div class="col-sm-12"><div class="single-form"><label>Street Address *</label><input type="text" name="address" required></div></div>
            <div class="col-sm-6"><div class="single-form"><label>Country *</label><input type="hidden" name="country" value="India"><input type="text" value="India" disabled></div></div>
            <div class="col-sm-6"><div class="single-form"><label>State *</label><input type="text" name="state" required></div></div>
            <div class="col-sm-6"><div class="single-form"><label>City *</label><input type="text" name="city" required></div></div>
            <div class="col-sm-6"><div class="single-form"><label>Postal Code</label><input type="text" name="zipcode"></div></div>
            <div class="col-sm-6"><div class="single-form"><label>Locality</label><input type="text" name="locality"></div></div>
            <div class="col-sm-6"><div class="single-form"><label>Street Number</label><input type="text" name="street_no"></div></div>
            <div class="col-sm-12"><div class="single-form"><button class="btn btn-primary rounded-pill" type="submit">Save Address</button></div></div>
        </div>
    </form>
</div>
