<div class="col-lg-4 col-md-4 col-sm-12">

    <div class="user-account-box">
        <div class="header clearfix">
            <div class="edit-profile-photo">
                <img src="{{ asset('images/avatar.png') }}" alt="agent-1" class="img-responsive">
            </div>
            <h3>{{ auth()->user()->name }}</h3>
            <p>{{ auth()->user()->email }}</p>

        </div>
        <div class="content">
            <ul>
                <li>
                    <a href="user-profile.html">
                        <i class="flaticon-social"></i>Profile
                    </a>
                </li>
                <li>
                    <a href="my-properties.html">
                        <i class="flaticon-apartment"></i>My Properties
                    </a>
                </li>
                <li>
                    <a href="favorited-properties.html">
                        <i class="fa fa-heart"></i>Favorited Properties
                    </a>
                </li>
                <li>
                    <a href="submit-property.html">
                        <i class="fa fa-plus"></i>Submit New Property
                    </a>
                </li>
                <li>
                    <a href="change-password.html">
                        <i class="flaticon-security"></i>Change Password
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="flaticon-sign-out-option"></i>Log Out
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>
