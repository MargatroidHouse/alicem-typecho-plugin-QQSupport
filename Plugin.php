<?php

/**
 * 个人信息QQ支持
 * 
 * @package QQSupport
 * @author Suika
 * @version 1.0.0
 * @link https://www.kagasama.in
 */
class QQSupport_Plugin implements Typecho_Plugin_Interface
{
  /**
   * 激活插件方法,如果激活失败,直接抛出异常
   * 
   * @access public
   * @return void
   * @throws Typecho_Plugin_Exception
   */
  public static function activate()
  {
  }

  /**
   * 禁用插件方法,如果禁用失败,直接抛出异常
   * 
   * @static
   * @access public
   * @return void
   * @throws Typecho_Plugin_Exception
   */
  public static function deactivate()
  {
  }

  /**
   * 获取插件配置面板
   * 
   * @access public
   * @param Typecho_Widget_Helper_Form $form 配置面板
   * @return void
   */
  public static function config(Typecho_Widget_Helper_Form $form)
  {
  }

  /**
   * 个人用户的配置面板
   * 
   * @access public
   * @param Typecho_Widget_Helper_Form $form
   * @return void
   */
  public static function personalConfig(Typecho_Widget_Helper_Form $form)
  {
    $QQNumber = new Typecho_Widget_Helper_Form_Element_Text('QQNumber', null, '', 'QQ号', '请输入你的QQ号，用于显示QQ头像');
    $form->addInput($QQNumber);
  }

  /**
   * 插件实现方法
   * 
   * @access public
   * @return void
   */
  public static function render()
  {
  }

  public function getQQ($id)
  {
    $pluginName = "QQSupport";
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    $row = $db->fetchRow($db->select()->from($prefix . 'options')->where('name=? AND user = ?', '_plugin:' . $pluginName, $id)->limit(1));
    if (isset($row["name"]) && $row["name"] == '_plugin:' . $pluginName) {
      if (
        !empty($row['value']) && false !== ($options = unserialize($row['value']))
      ) {
        return $options["QQNumber"];
      }
    }
    return "";
  }

  public function getQQAvatar($id = "1")
  {
    $QQ = QQSupport_Plugin::getQQ($id);
    $url = "https://q1.qlogo.cn/headimg_dl?bs={$QQ}&dst_uin={$QQ}&dst_uin={$QQ}&;dst_uin={$QQ}&spec=100&url_enc=0&referer=bu_interface&term_type=PC";
    echo $url;
  }
}
