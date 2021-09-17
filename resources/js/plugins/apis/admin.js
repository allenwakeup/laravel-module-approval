const baseUrl = window.baseUrl;

export default {

    /**
     * 后台接口
     */

    "adminLogin" : baseUrl + "Admin/login", // 登录
    "adminLogout" : baseUrl + "Admin/logout", // 登出
    "adminCheckLogin" : baseUrl + "Admin/check_login", // 验证是否登录

    // 菜单处理
    'adminMenus' : baseUrl + 'Admin/menus', // 后台菜单

    /**
     * 模块化接口
     */

    // "moduleApprovalDepartment": baseUrl + "Admin/goodcatch/m/approval/departments", // 部门
};
