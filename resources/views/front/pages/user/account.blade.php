@include('front.elements.user-page-title', ['userPageTitle' => 'Account Details', 'userPageCopy' => 'Keep your contact details current for smoother checkout.'])

<div class="storefront-form-card">
    @php($profileImageUrl = $getUser->profile_image ? asset('public/uploads/user/'.$getUser->profile_image) : asset('public/uploads/no-image.jpg'))
    <form action="{{ url('user/account') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="mode" value="profile">
        <div class="row">
            <div class="col-sm-6"><div class="single-form"><label>First Name *</label><input type="text" name="first_name" value="{{ $getUser->first_name }}" required></div></div>
            <div class="col-sm-6"><div class="single-form"><label>Last Name *</label><input type="text" name="last_name" value="{{ $getUser->last_name }}" required></div></div>
            <div class="col-sm-6"><div class="single-form"><label>Display Name *</label><input type="text" name="display_name" value="{{ $getUser->display_name ?: $getUser->first_name }}" required></div></div>
            <div class="col-sm-6"><div class="single-form"><label>Phone *</label><input type="text" name="phone" value="{{ $getUser->phone }}" required></div></div>
            <div class="col-sm-12"><div class="single-form"><label>Email</label><input type="email" value="{{ $getUser->email }}" disabled></div></div>
            <div class="col-sm-12">
                <div class="single-form">
                    <label>Profile Image</label>
                    <div class="storefront-profile-upload">
                        <img id="profile-image-preview" src="{{ $profileImageUrl }}" alt="{{ $getUser->display_name ?: $getUser->first_name }}">
                        <div>
                            <input id="profile-image-input" type="file" name="profile_image" accept="image/*">
                            <p>Choose a JPG, PNG, GIF, WEBP, or AVIF image.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12"><div class="single-form"><button class="btn btn-primary rounded-pill" type="submit">Update Account</button></div></div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var input = document.getElementById('profile-image-input');
    var preview = document.getElementById('profile-image-preview');

    input.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            preview.src = URL.createObjectURL(this.files[0]);
        }
    });
});
</script>
