<div class="container">
    <div class="row">
        <div class="col-md-10 col-lg-10">
            <div class="card animated fadeIn w-100 p-3 shadow">
                <div class="card-body">
                    <h4>User Profile</h4>
                    <hr />
                    <div class="container-fluid m-0 p-0">
                        <div class="row">
                            <div class="col-md-12">
                                <img src="" alt="" id="profile-img" class="img-fluid">
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email"
                                    readonly />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text" readonly />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile" readonly />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Address</label>
                                <input id="address" placeholder="Address" class="form-control" type="text" readonly />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control"
                                    type="password" readonly />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    getProfile();
    async function getProfile() {
        showLoader();
        let res = await axios.get("/user-profile");
        hideLoader();

        if (res.status === 200 && res.data['status'] === 'success') {
            let data = res.data['data'];
            document.getElementById('email').value = data['email'];
            document.getElementById('firstName').value = data['name'];
            document.getElementById('mobile').value = data['mobile'];
            document.getElementById('address').value = data['address'];
            document.getElementById('password').value = data['password'];
            document.getElementById('profile-img').src = data['image'];
        } else {
            errorToast(res.data['message']);
        }
    }
</script>