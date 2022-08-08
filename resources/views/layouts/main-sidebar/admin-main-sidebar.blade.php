

<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_translate.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_translate.Programname')}} </li>

        <!-- Grades-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{trans('main_translate.Grades')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('grades.index')}}">{{trans('main_translate.Grades_list')}}</a></li>

            </ul>
        </li>
        <!-- classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                <div class="pull-left"><i class="fa fa-building"></i><span
                        class="right-nav-text">{{trans('main_translate.classes')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('class_rooms.index')}}">{{trans('main_translate.List_classes')}}</a></li>
            </ul>
        </li>


        <!-- sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                        class="right-nav-text">{{trans('main_translate.sections')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('sections.index')}}">{{trans('main_translate.List_sections')}}</a></li>
            </ul>
        </li>


        <!-- students-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i class="fas fa-user-graduate"></i>{{trans('main_translate.students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
            <ul id="students-menu" class="collapse">
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">{{trans('main_translate.Student_information')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                    <ul id="Student_information" class="collapse">
                        <li> <a href="{{route('students.create')}}">{{trans('main_translate.add_student')}}</a></li>
                        <li> <a href="{{route('students.index')}}">{{trans('main_translate.list_students')}}</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">{{trans('main_translate.Students_Promotions')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                    <ul id="Students_upgrade" class="collapse">
                        <li> <a href="{{route('promotions.create')}}">{{trans('main_translate.add_Promotion')}}</a></li>
                        <li> <a href="{{route('promotions.index')}}">{{trans('main_translate.list_Promotions')}}</a> </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate students">{{trans('main_translate.Graduate_students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                    <ul id="Graduate students" class="collapse">
                        <li> <a href="{{route('graduated.create')}}">{{trans('main_translate.add_Graduate')}}</a> </li>
                        <li> <a href="{{route('graduated.index')}}">{{trans('main_translate.list_Graduate')}}</a> </li>
                    </ul>
                </li>
            </ul>
        </li>



        <!-- Teachers-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i></i><span
                        class="right-nav-text">{{trans('main_translate.Teachers')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('teachers.index')}}">{{trans('main_translate.List_Teachers')}}</a> </li>
            </ul>
        </li>


        <!-- Parents-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                <div class="pull-left"><i class="fas fa-user-tie"></i><span
                        class="right-nav-text">{{trans('main_translate.Parents')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{url('add_parent')}}">{{trans('main_translate.List_Parents')}}</a> </li>
            </ul>
        </li>

        <!-- Accounts-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                        class="right-nav-text">{{trans('main_translate.Accounts')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('fees.index') }}">{{ trans('Accounts.Study_fees') }}</a> </li>
                <li> <a href="{{ route('fees.create') }}">{{ trans('Accounts.Add_Fees_Invoice') }}</a> </li>
                <li> <a href="{{route('fees_invoices.index')}}">{{ trans('Accounts.Invoices') }}</a> </li>
                <li> <a href="{{route('students_receipt.index')}}">{{ trans('Accounts.Reciept') }}</a> </li>
                <li> <a href="{{route('Fee_Processing.index')}}"> {{ trans('Accounts.Fee_Execlusion_Bonds') }}</a> </li>
                <li> <a href="{{route('students_payment.index')}}"> {{ trans('Accounts.Vouchers') }} </a> </li>
            </ul>
            
        </li>

        <!-- Attendance-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                <div class="pull-left"><i class="fas fa-calendar-alt"></i><span class="right-nav-text">{{trans('main_translate.Attendance')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('attendance.index')}}">{{ trans('Attendence_trans.Student_List') }}</a> </li>
            </ul>
        </li>

        <!-- Subjects-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subjects">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{ trans('main_translate.Subjects') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Subjects" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('subjects.index')}}">{{ trans('main_translate.Subjects_List') }}</a> </li>
            </ul>
        </li>

        <!-- Quizzes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{ trans('quizzes_trans.Quizzes') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('quizzes.index')}}">{{ trans('quizzes_trans.Quizzes_List') }}</a> </li>
                <li> <a href="{{route('questions.index')}}">{{ trans('quizzes_trans.Question_List') }}</a> </li>
            </ul>
        </li>


        <!-- library-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
                <div class="pull-left"><i class="fas fa-book"></i><span class="right-nav-text">{{trans('main_translate.library')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('libraries.index')}}">{{ trans('library_trans.Books_List') }}</a> </li>
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
                <li> <a href="{{route('online_classes.index')}}">  {{ trans('online_classes_trans.online_classes_with_zoom') }} </a> </li>
            </ul>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{route('settings.index')}}"><i class="fas fa-cogs"></i><span class="right-nav-text">{{trans('main_translate.Settings')}} </span></a>
        </li>



        <!-- Users-->
        {{-- <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-icon">
                <div class="pull-left"><i class="fas fa-users"></i><span class="right-nav-text">{{trans('main_translate.Users')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Users-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                <li> <a href="themify-icons.html">Themify icons</a> </li>
                <li> <a href="weather-icon.html">Weather icons</a> </li>
            </ul>
        </li> --}}

    </ul>
</div>