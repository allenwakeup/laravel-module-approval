@extends('admin.base')

@section('content')
    <div class="approval-app" id="app">
        <div class="layui-card">

            @include('admin.breadcrumb')

            <crew
                    firstselectreq="{{ route ('admin::' . module_route_prefix ('.') . 'approval.project.list') }}"
                    firstselectlabel="项目"
                    secondselectreq="{{ route ('admin::' . module_route_prefix ('.') . 'approval.team.list') }}"
                    secondselectlabel="审批组"
                    pidname="team_id"
                    datareq="{{ route ('admin::' . module_route_prefix ('.') . 'approval.crew.list') }}"
                    updatereq="{{ route ('admin::' . module_route_prefix ('.') . 'approval.crew.update', ['id'=>':id']) }}"
                    postreq="{{ route ('admin::' . module_route_prefix ('.') . 'approval.crew.save') }}"
                    deletereq="{{ route ('admin::' . module_route_prefix ('.') . 'approval.crew.delete', ['id'=>':id']) }}"
                    selectadminuserreq="{{ route ('admin::' . module_route_prefix ('.') . 'approval.staff.list') }}"
                    ></crew>

        </div>
    </div>
@endsection

@section('js')
    <script src="{{ mix('public/admin/js/approval.js') }}"></script>
@endsection
