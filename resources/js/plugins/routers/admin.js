export default [
    // 核心模块
    {
        path:"/Admin/goodcatch/m/approval/index",name:"goodcatch_m_approval_index",component:()=>import("@/views/Admin/index"),children:[
            {path:"/Admin/goodcatch/m/approval/index",name:"goodcatch_m_approval_default",component:()=>import("@/views/Admin/default")}, // 打开默认页面

        ]
    }
];
