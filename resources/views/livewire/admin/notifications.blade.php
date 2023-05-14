<div class="dropdown dib">
    {{-- {{ dd($notifications[0]) }} --}}
    <div id="notificationsIcon" class="header-icon" data-toggle="dropdown">
        <i class="ti-bell"></i>
        <div class="drop-down dropdown-menu dropdown-menu-right" style="max-height: 200px;overflow: auto;">
            <div class="dropdown-content-body">
                <ul>
                    <li class="text-center">
                        <span wire:click="mark" class="more-link">Mark all as readed</span>
                    </li>
                    @if ($notifications->count())
                        @foreach ($notifications as $notification)
                            @if ($notification->data['type'] == 'register')
                                <li onclick="go(this)"
                                    style="
                                    @if ($notification->unread()) background:#eef5f9;border-top: 1px solid #eef5f9; @endif">
                                    <a href="{{ route('admin.users.index') }}">
                                        <img class="pull-left m-r-10 avatar-img"
                                            src="{{ asset('images/user-avatar.png') }}" alt="avatar" />
                                        <div class="notification-content">
                                            <small
                                                class="notification-timestamp pull-right">{{ $notification->created_at->diffForHumans() }}</small>
                                            <div class="notification-heading">New {{ $notification->data['role'] }}
                                                created
                                            </div>
                                            <div class="notification-text">{{ $notification->data['email'] }} </div>
                                        </div>
                                    </a>
                                </li>
                            @elseif ($notification->data['type'] == 'order')
                                <li onclick="go(this)"
                                    style="cursor: pointer;
                                    @if ($notification->unread()) background:#eef5f9;border-top: 1px solid #eef5f9; @endif">
                                    <a href="{{ route('admin.orders.show', $notification->data['order']['id']) }}">
                                        <img class="pull-left m-r-10 avatar-img"
                                            src="{{ asset('images/order-avatar.png') }}" alt="avatar" />
                                        <div class="notification-content">
                                            <small
                                                class="notification-timestamp pull-right">{{ $notification->created_at->diffForHumans() }}</small>
                                            <div class="notification-heading">New order
                                                created
                                            </div>
                                            <div class="notification-text">{{ $notification->data['user']['email'] }}
                                            </div>

                                        </div>
                                    </a>

                                </li>
                            @endif
                        @endforeach
                    @else
                        <li>
                            <p class="text-center">No notifications available</p>
                        </li>
                    @endif

                    {{-- <li>
                        <a href="#">
                            <img class="pull-left m-r-10 avatar-img" src="#" alt="avatar" />
                            <div class="notification-content">
                                <small class="notification-timestamp pull-right">02:34
                                    PM</small>
                                <div class="notification-heading">Mariam</div>
                                <div class="notification-text">likes a photo of you</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="pull-left m-r-10 avatar-img" src="#" alt="avatar" />
                            <div class="notification-content">
                                <small class="notification-timestamp pull-right">02:34
                                    PM</small>
                                <div class="notification-heading">Tasnim</div>
                                <div class="notification-text">Hi Teddy, Just wanted to let you
                                    ...</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img class="pull-left m-r-10 avatar-img" src="#" alt="avatar" />
                            <div class="notification-content">
                                <small class="notification-timestamp pull-right">02:34
                                    PM</small>
                                <div class="notification-heading">Mr. John</div>
                                <div class="notification-text">Hi Teddy, Just wanted to let you
                                    ...</div>
                            </div>
                        </a>
                    </li> --}}

                </ul>
            </div>
        </div>
    </div>
</div>
