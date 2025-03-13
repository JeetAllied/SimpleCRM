<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{asset('/resources/')}}/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									Hizrian
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="../demo1/index.html">
                                    <span class="sub-item">Dashboard 1</span>
                                </a>
                            </li>
                            <li>
                                <a href="../demo2/index.html">
                                    <span class="sub-item">Dashboard 2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item">
                    <a href="{{route('lead-sources.index')}}">
                        <i class="far fa-user-circle"></i>
                        <p>Lead Source</p>

                    </a>
                </li>
                <li class="nav-item">
                    <a  href="{{route('lead-statuses.index')}}">
                        <i class="far fa-question-circle"></i>
                        <p>Lead Status</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a  href="{{route('opportunity-stages.index')}}">
                        <i class="fas fa-box"></i>
                        <p>Opportunity Stage</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('sales-pipeline-stages.index')}}">
                        <i class="fas fa-money-check-alt"></i>
                        <p>Sales Pipeline Stage</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('ticket-statuses.index')}}">
                        <i class="fas fa-ticket-alt"></i>
                        <p>Ticket Status</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('activity-types.index')}}">
                        <i class="far fa-list-alt"></i>
                        <p>Activity Type</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('marketing-campaign-types.index')}}">
                        <i class="fas fa-chart-line"></i>
                        <p>Marketing Campaign Type</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('customers.index')}}">
                        <i class="fas fa-user-tie"></i>
                        <p>Customer</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('leads.index')}}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Lead</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('opportunities.index')}}">
                        <i class="fas fa-bullseye"></i>
                        <p>Opportunity</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('sales-pipelines.index')}}">
                        <i class="fas fa-dollar-sign"></i>
                        <p>Sales Pipeline</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('tickets.index')}}">
                        <i class="fas fa-receipt"></i>
                        <p>Ticket</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('activities.index')}}">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Activity</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('marketing-campaigns.index')}}">
                        <i class="fas fa-chart-line"></i>
                        <p>Marketing Campaign</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Base</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="components/avatars.html">
                                    <span class="sub-item">Avatars</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/buttons.html">
                                    <span class="sub-item">Buttons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/gridsystem.html">
                                    <span class="sub-item">Grid System</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/panels.html">
                                    <span class="sub-item">Panels</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/notifications.html">
                                    <span class="sub-item">Notifications</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/sweetalert.html">
                                    <span class="sub-item">Sweet Alert</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/font-awesome-icons.html">
                                    <span class="sub-item">Font Awesome Icons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/simple-line-icons.html">
                                    <span class="sub-item">Simple Line Icons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/flaticons.html">
                                    <span class="sub-item">Flaticons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/typography.html">
                                    <span class="sub-item">Typography</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
