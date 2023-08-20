<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3 shadow">
                <div class="card-body">
                    <h4>Sign Up</h4>
                    <hr />
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Full Name</label>
                                <input id="fullName" placeholder="Full Name" class="form-control" type="text" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Address</label>
                                <input id="address" placeholder="Address" class="form-control" type="text" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control"
                                    type="password" />
                            </div>
                            </div>
                        <div class="row mt-3 m-0 p-0">
                            <div class="col-md-12">
                                <img id="newImg" src="{{ asset('images/default.jpg') }}" width="100" />
                            </div>
                            <label class="form-label">Image</label>
                            <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file"
                                class="form-control" id="userImage">
                        </div>
                        <div class="row mt-3 m-0 p-0 d-flex align-items-center">
                            <div class="col-md-4 p-2">
                                <button onclick="onRegistration()" class="w-100 btn btn-success">Complete</button>
                            </div>
                            <div class="col-md-2 offset-md-4 p-2">
                                <span class="float-end">Have a Account?</span>
                            </div>
                            <div class="col-md-2 p-2">
                                <a class="text-center w-100 btn btn-primary" href="{{ url('/') }}">Sign In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function onRegistration() {

        let email = document.getElementById('email').value;
        let firstName = document.getElementById('fullName').value;
        let mobile = document.getElementById('mobile').value;
        let address = document.getElementById('address').value;
        let password = document.getElementById('password').value;
        let userImage = document.getElementById('userImage').files[0];

        if (email.length === 0) {
            errorToast('Email is required')
        } else if (fullName.length === 0) {
            errorToast('Full Name is required')
        } else if (mobile.length === 0) {
            errorToast('Mobile is required')
        } else if (address.length === 0) {
            errorToast('Address is required')
        } else if (password.length === 0) {
            errorToast('Password is required')
        } else if (!userImage) {
            errorToast("User Image Required !")
        } else {
            let formData = new FormData();
            formData.append('image', userImage)
            formData.append('name', fullName)
            formData.append('mobile', mobile)
            formData.append('address', address)
            formData.append('password', password)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            showLoader();
            let res = await axios.post("/user-registration", formData, config)
            hideLoader();
            if (res.status === 200 && res.data['status'] === 'success') {
                successToast(res.data['message']);
                setTimeout(function() {
                    window.location.href = '/login'
                }, 2000)
            } else {
                errorToast(res.data['message'])
            }
        }
    }
</script>
