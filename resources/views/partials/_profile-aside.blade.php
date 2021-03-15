<div class="col-lg-4 col-md-4 col-sm-12">

    <div class="user-account-box">
        <div class="header clearfix">
            <div class="edit-profile-photo">
                <img src="{{ asset('images/avatar.png') }}" alt="agent-1" class="img-responsive">
            </div>
            <h3 class="override-text-transform">{{ auth()->user()->name }}</h3>
            <p>{{ auth()->user()->email }}</p>

        </div>
        <div class="content">
            <ul>
                <li>
                    <a href="{{ route('home') }}">
                        <i class="flaticon-social"></i>My Profile
                    </a>
                </li>
                <li>
                    <a href="{{ route('booking.index') }}">
                        <i class="flaticon-apartment"></i>My Bookings
                    </a>
                </li>
                <li>
                    <a href="favorited-properties.html">
                        <i class="fa fa-heart"></i>Favorited Properties
                    </a>
                </li>
                <li>
                    <a href="{{ route('change-password') }}">
                        <i class="flaticon-security"></i>Change Password
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="flaticon-sign-out-option"></i>Log Out
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>
