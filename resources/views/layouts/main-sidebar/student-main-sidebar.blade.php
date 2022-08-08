<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('dahsboard.students') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_translate.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_translate.Programname')}} </li>


        <!-- الامتحانات-->
        <li>
            <a href="{{route('student_exams.index')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text"> </span>{{ trans('main_translate.Exams') }}</a>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{route('student_profile.index')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text"> </span>{{ trans('profile.profile') }}</a>
        </li>

    </ul>
</div>





