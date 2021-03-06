<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

//不能非法包含或直接执行
if (!defined("IN_BAIGO")) {
    exit("Access Denied");
}

include_once(BG_PATH_FUNC . "http.func.php"); //载入 http
include_once(BG_PATH_CLASS . "tpl.class.php"); //载入模板类
include_once(BG_PATH_CLASS . "sso.class.php");

/*-------------管理员控制器-------------*/
class CONTROL_PROFILE {

    private $adminLogged;
    private $obj_base;
    private $config; //配置
    private $obj_tpl;
    private $tplData;

    function __construct() { //构造函数
        $this->obj_base       = $GLOBALS["obj_base"]; //获取界面类型
        $this->config         = $this->obj_base->config;
        $this->adminLogged    = $GLOBALS["adminLogged"]; //获取已登录信息
        $this->obj_tpl        = new CLASS_TPL(BG_PATH_TPL . "admin/" . BG_DEFAULT_UI); //初始化视图对象
        $this->obj_sso        = new CLASS_SSO(); //初始化单点登录
        $this->tplData = array(
            "adminLogged" => $this->adminLogged
        );
    }

    /**
     * ctl_my function.
     *
     * @access public
     * @return void
     */
    function ctl_info() {
        $_arr_ssoRow = $this->obj_sso->sso_read($this->adminLogged["admin_id"]);
        if ($_arr_ssoRow["alert"] != "y010102") {
            return $_arr_ssoRow;
        }

        $_arr_tpl = array(
            "ssoRow"   => $_arr_ssoRow,
        );

        $_arr_tplData = array_merge($this->tplData, $_arr_tpl);

        $this->obj_tpl->tplDisplay("profile_info.tpl", $_arr_tplData);

        return array(
            "alert" => "y020108",
        );
    }


    function ctl_pass() {
        $_arr_ssoRow = $this->obj_sso->sso_read($this->adminLogged["admin_id"]);
        if ($_arr_ssoRow["alert"] != "y010102") {
            return $_arr_ssoRow;
        }

        $_arr_tpl = array(
            "ssoRow"   => $_arr_ssoRow,
        );

        $_arr_tplData = array_merge($this->tplData, $_arr_tpl);

        $this->obj_tpl->tplDisplay("profile_pass.tpl", $_arr_tplData);

        return array(
            "alert" => "y020109",
        );
    }


}
