export default [
    // 核心模块
    {
        path:"/Admin/goodcatch/m/approval/index",name:"goodcatch_m_approval_index",component:()=>import("@/views/Admin/index"),children:[
            {path:"/Admin/goodcatch/m/approval/index",name:"goodcatch_m_approval_default",component:()=>import("@/views/Admin/default")}, // 打开默认页面


            // 模版分类
            {path:"/Admin/goodcatch/m/approval/categories",name:"goodcatch_m_approval_admin_categories",component:()=>import("@/views/Admin/categories/index")},
            {path:"/Admin/goodcatch/m/approval/categories/form/:id?",name:"goodcatch_m_approval_admin_categories_form",component:()=>import("@/views/Admin/categories/form")},


            // 模版
            {path:"/Admin/goodcatch/m/approval/templates",name:"goodcatch_m_approval_admin_templates",component:()=>import("@/views/Admin/templates/index")},
            {path:"/Admin/goodcatch/m/approval/templates/form/:id?",name:"goodcatch_m_approval_admin_templates_form",component:()=>import("@/views/Admin/templates/form")},


        ]
    }
];
