export default [
    // 核心模块
    {
        path:"/Admin/goodcatch/m/approval/index",name:"goodcatch_m_approval_index",component:()=>import("@/views/Admin/index"),children:[
            {path:"/Admin/goodcatch/m/approval/index",name:"goodcatch_m_approval_default",component:()=>import("@/views/Admin/default")}, // 打开默认页面

            // 部门
            {path:"/Admin/goodcatch/m/approval/departments",name:"goodcatch_m_approval_admin_departments",component:()=>import("@/views/goodcatch/modules/approval/admin/departments/index")},
            {path:"/Admin/goodcatch/m/approval/departments/form/:id?",name:"goodcatch_m_approval_admin_departments_form",component:()=>import("@/views/goodcatch/modules/approval/admin/departments/form")}
        ]
    }
];
