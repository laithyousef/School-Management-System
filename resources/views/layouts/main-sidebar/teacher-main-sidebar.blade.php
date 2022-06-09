<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/teacher/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_translate.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_translate.Programname')}} </li>

        <!-- الاقسام-->
        <li>
            <a href="{{route('section.index')}}"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">{{ trans('main_translate.sections') }}</span></a>
        </li>

        <!-- الطلاب-->
        <li>
            <a href="{{route('student.index')}}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">{{ trans('main_translate.students') }}</span></a>
        </li>


       <!-- الاختبارات-->
       <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
            <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">{{ trans('quizzes_trans.Quizzes') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
            <li><a href="{{route('quiz.index')}}">{{ trans('quizzes_trans.Quizzes_List') }}</a></li>
            <li><a href="{{ route('question.index') }}">{{ trans('quizzes_trans.Question_List') }}</a></li>
        </ul>

    </li>

     <!-- Online classes-->
     <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
            <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{trans('main_translate.Onlineclasses')}}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('online_zoom_classes.index')}}">{{ trans('online_classes_trans.online_classes_with_zoom') }}</a> </li>
        </ul>
    </li>


        <!-- reports-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#reports">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{ trans('main_translate.Attendance') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="reports" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('attendance.report') }}">{{ trans('Attendence_trans.Student_Attendence_and_absence') }}</a></li>
                <li><a href="{{ route('quiz.index') }}">{{ trans('quizzes_trans.Quizzes_List') }}</a></li>
            </ul>

        </li>

        <!-- الملف الشخصي-->
        <li>
            <a href="{{route('settings.index')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text"> {{ trans('teachers_dahsboard_trans.Personal_file') }}</span></a>
        </li>

    </ul>
</div>