@extends('admin.base')

@section('content')
    <div class="approval-app" id="app">
        <div class="layui-card">

            @include('admin.breadcrumb')

            <div class="layui-card-body">
                <team
                        treereq="{{ route ('admin::' . module_route_prefix ('.') . 'core.department.tree') }}"
                        firstselectreq="{{ route ('admin::' . module_route_prefix ('.') . 'core.department.list') }}"
                        firstselectlabel="部门"
                        firstselectreqparam="department_id"
                        secondselectreq="{{ route ('admin::' . module_route_prefix ('.') . 'approval.project.list') }}"
                        secondselectlabel="项目"
                        secondselectreqparam="project_id"
                        pidname="department_id"
                        datareq="{{ route ('admin::' . module_route_prefix ('.') . 'approval.team.list') }}"
                        updatereq="{{ route ('admin::' . module_route_prefix ('.') . 'approval.team.update', ['id'=>':id']) }}"
                        postreq="{{ route ('admin::' . module_route_prefix ('.') . 'approval.team.save') }}"
                        deletereq="{{ route ('admin::' . module_route_prefix ('.') . 'approval.team.delete', ['id'=>':id']) }}"
                        selectadminuserreq="{{ route ('admin::' . module_route_prefix ('.') . 'approval.staff.list') }}?type=user"
                        selectdepartmentreq="{{ route ('admin::' . module_route_prefix ('.') . 'core.department.list') }}"
                ></team>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ mix('public/admin/js/approval.js') }}"></script>
@endsection
