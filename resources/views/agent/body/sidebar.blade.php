@php
    $id = Auth::user()->id;
    $agent_id = App\Models\User::find($id);
    $status = $agent_id->status;
@endphp
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            For<span>Agent</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('agent.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            @if ($status === 'active')
            <li class="nav-item nav-category">Real Estate</li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button"
                    aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Property Type</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.type') }}" class="nav-link">All Type</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.type') }}" class="nav-link">Add Type</a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button"
                    aria-expanded="false" aria-controls="uiComponents">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">Amenities</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.amenities') }}" class="nav-link">All Amenities</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.amenities') }}" class="nav-link">Add Amenities</a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button"
                    aria-expanded="false" aria-controls="advancedUI">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Property</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="advancedUI">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('agent.all.property') }}" class="nav-link">All Property</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('agent.add.property') }}" class="nav-link">Add Property</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('buy.package') }}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Buy Package</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('package.history') }}" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">Package History</span>
                </a>
            </li>
            <li class="nav-item nav-category">Components</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#forms" role="button"
                    aria-expanded="false" aria-controls="forms">
                    <i class="link-icon" data-feather="inbox"></i>
                    <span class="link-title">Property Message</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="forms">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('agent.property.message') }}"
                                class="nav-link">Property Message</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#charts" role="button"
                    aria-expanded="false" aria-controls="charts">
                    <i class="link-icon" data-feather="pie-chart"></i>
                    <span class="link-title">Schedule Request</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="charts">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('agent.schedule.request') }}" class="nav-link">Schedule Request </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('agent.live.chat') }}"
                    class="nav-link">
                    <i class="link-icon" data-feather="hash"></i>
                    <span class="link-title">Live Chat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#tables" role="button"
                    aria-expanded="false" aria-controls="tables">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Table</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="tables">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ asset('backend/pages') }}/tables/basic-table.html"
                                class="nav-link">Basic Tables</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#icons" role="button"
                    aria-expanded="false" aria-controls="icons">
                    <i class="link-icon" data-feather="smile"></i>
                    <span class="link-title">Icons</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="icons">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ asset('backend/pages') }}/icons/feather-icons.html"
                                class="nav-link">Feather Icons</a>
                        </li>
                    </ul>
                </div>
            </li>
            @else

            @endif
            <li class="nav-item nav-category">pages</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#general-pages"
                    role="button" aria-expanded="false"
                    aria-controls="general-pages">
                    <i class="link-icon" data-feather="book"></i>
                    <span class="link-title">Special pages</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="general-pages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ asset('backend/pages') }}/general/blank-page.html"
                                class="nav-link">Blank page</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#authpages"
                    role="button" aria-expanded="false" aria-controls="authpages">
                    <i class="link-icon" data-feather="unlock"></i>
                    <span class="link-title">Authentication</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="authpages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ asset('backend/pages') }}/auth/login.html" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('backend/pages') }}/auth/register.html"
                                class="nav-link">Register</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#errorpages"
                    role="button" aria-expanded="false" aria-controls="errorpages">
                    <i class="link-icon" data-feather="cloud-off"></i>
                    <span class="link-title">Error</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="errorpages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ asset('backend/pages') }}/error/404.html" class="nav-link">404</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('backend/pages') }}/error/500.html" class="nav-link">500</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Docs</li>
        </ul>
    </div>
</nav>
