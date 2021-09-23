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

    "moduleApprovalCategories": baseUrl + "Admin/goodcatch/m/approval/categories", // 模版分类
    "moduleApprovalTemplates": baseUrl + "Admin/goodcatch/m/approval/templates", // 模版
};
