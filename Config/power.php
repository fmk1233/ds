<?php   
return array (
  1 => 
  array (
    'id' => 1,
    'dep_name' => '总管',
    'power' => 'DIndex.Main,DUser.UnConfirmUsers,DUser.Users,DUser.Userreg,DUser.UserList,DUser.UserRegAC,DUser.UserInfo,DUser.UserView,DUser.ChangeUserInfo,DUser.LoginHome,DUser.PreNet,DUser.TjNet,DUser.Net,DUser.ActivateMember,DUser.openMember,DUser.DelMember,DUser.cashMember,DUser.upgradeList,DUser.GetUpgradeList,DUser.dealUpgrade,DUser.EditRank,DUser.applyCenterList,DUser.GetApplyCenterList,DUser.dealApplyCenter,DUser.EditBdcenter,DBonus.BonusList,DBonus.BonusListAC,DBonus.Recharge,DBonus.RechargeList,DBonus.DoRecharge,DBonus.DealRecharge,DCash.CashList,DCash.GetCashList,DCash.DealCash,DNews.News,DNews.NewsAdd,DNews.NewsDelete,DNews.NewsInsert,DNews.NewsList,DProtocol.Protocol,DProtocol.ProtocolAdd,DProtocol.ProtocolDelete,DProtocol.ProtocolInsert,DProtocol.ProtocolList,DMsg.MsgList,DMsg.GetMsgList,DMsg.MsgDetail,DMsg.MsgReply,Setting.Setting,Setting.DoSetting,Setting.ClearData,Reward.RewardList,Reward.RewardDetail,Reward.GetRewardList,Reward.RewardTotal,Reward.GetRewardTotalList,Reward.RewardRatio,Admin.AdminInfo,Admin.AdminList,Admin.GetAdminList,Admin.ChangeAdminInfo,Admin.DelAdmin,Admin.PowerList,Admin.GetPowerList,Admin.AddPower,Admin.PowerAddAC,Admin.DelPower,Log.logListView,Log.logList,Admin.adminSecPower,Admin.addAdminSecPower,Admin.UserPower,Admin.UserPowerAc,Setting.SysSetting,Setting.DoSysSetting,Area.area,Area.areaList,Area.doAreaView,Area.doArea,Area.delArea,Setting.SettingUserReg,Setting.DoUserReg,Setting.ClearCache,DB.Dbbackup,DB.DbbackupList,DB.Backup,DB.Download,DB.Restore,DB.Del,Goods.Setting,Goods.DoSetting,Goods.AddCategory,Goods.AddGoodsCategoryAC,Goods.AddGoods,Goods.AddGoodsAC,Goods.DelCategory,Goods.DelGoods,Goods.ChangeStatusGoods,Goods.GoodsList,Goods.GetGoodsList,Goods.GoodsCategory,Goods.GoodsCategoryList,Payment.PaymentListView,Payment.PaymentList,Payment.PaymentInfoView,Payment.DoPaymentInfo,Icon.IconList,Icon.GetIconList,Icon.DelIcon,Icon.IconAdd,Icon.IconAddAc,Icon.ChageStatus,Logistics.GetLogcomList,Logistics.LogcomList,Logistics.LogcomAdd,Logistics.AddLogcomAC,Logistics.DelLogcom,GoodOrders.CancelOrder,GoodOrders.ConfirmOrder,GoodOrders.GetOrderList,GoodOrders.OrdersList,GoodOrders.LookDelivery,GoodOrders.Orderinfo,GoodOrders.PayOrder,GoodOrders.SendGoods,GoodOrders.SendGoodsAc,Export.Reward,Export.Cash,Export.UserList,Export.OrderList,Bank.ListView,Bank.ListData,Bank.InfoView,Bank.Update,Bank.Del,Setting.Search,Setting.HotSearch,Setting.DoSearch,Setting.DelSearch,ArticleClass.ListView,ArticleClass.ListData,ArticleClass.InfoView,ArticleClass.DoInfo,ArticleClass.DelInfo,Article.ListView,Article.ListData,Article.InfoView,Article.DoInfo,Article.DelInfo,Navigation.ListView,Navigation.ListData,Navigation.InfoView,Navigation.DoInfo,Navigation.DelInfo',
    'menu' => 
    array (
      '会员管理' => 
      array (
        '系统概况' => 'DIndex.Main',
        '会员注册' => 'DUser.Userreg',
        '待审核会员' => 'DUser.UnConfirmUsers',
        '已审核会员' => 'DUser.Users',
        '安置网络图' => 'DUser.PreNet',
        '推荐网络图' => 'DUser.TjNet',
        '会员升级管理' => 'DUser.upgradeList',
        '报单中心管理' => 'DUser.applyCenterList',
      ),
      '财务管理' => 
      array (
        '会员充值管理' => 'DBonus.Recharge',
        '会员提现管理' => 'DCash.CashList',
        '财务明细管理' => 'DBonus.BonusList',
      ),
      '奖金管理' => 
      array (
        '会员奖金明细' => 'Reward.RewardList',
        '会员奖金汇总' => 'Reward.RewardTotal',
        '奖金总拨出率' => 'Reward.RewardRatio',
      ),
      '平台管理' => 
      array (
        '文章分类' => 'ArticleClass.ListView',
        '文章管理' => 'Article.ListView',
        '页面导航' => 'Navigation.ListView',
        '幻灯片管理' => 'Icon.IconList',
        '系统协议管理' => 'DProtocol.Protocol',
        '新闻公告管理' => 'DNews.News',
        '留言信息管理' => 'DMsg.MsgList',
        '地区信息管理' => 'Area.area',
        '银行信息管理' => 'Bank.ListView',
      ),
      '商城管理' => 
      array (
        '商城设置' => 'Goods.Setting',
        '商品管理' => 'Goods.GoodsList',
        '商品分类' => 'Goods.GoodsCategory',
        '订单管理' => 'GoodOrders.OrdersList',
        '物流管理' => 'Logistics.LogcomList',
        '搜索设置' => 'Setting.Search',
        '支付方式' => 'Payment.PaymentListView',
      ),
      '平台设置' => 
      array (
        '部门管理' => 'Admin.PowerList',
        '管理员管理' => 'Admin.AdminList',
        '数据库备份' => 'DB.Dbbackup',
        '系统参数设置' => 'Setting.SysSetting',
      ),
      '安全中心' => 
      array (
        '日志管理' => 'Log.logListView',
        '奖金参数' => 'Setting.Setting',
        '安全页面设置' => 'Admin.adminSecPower',
        '会员使用权限' => 'Admin.UserPower',
        '会员注册设置' => 'Setting.SettingUserReg',
        '系统初始化' => 'Setting.ClearData',
        '清除缓存' => 'Setting.ClearCache',
      ),
    ),
  ),
  3 => 
  array (
    'id' => 3,
    'dep_name' => '财务',
    'power' => 'DBonus.BonusList,DBonus.BonusListAC,DBonus.Recharge,DBonus.RechargeList,DBonus.DoRecharge',
    'menu' => 
    array (
      '财务管理' => 
      array (
        '会员充值管理' => 'DBonus.Recharge',
        '财务明细管理' => 'DBonus.BonusList',
      ),
    ),
  ),
  7 => 
  array (
    'id' => 7,
    'dep_name' => '财务',
    'power' => 'DUser.Users,DUser.Userreg,DUser.UserList,DUser.UserRegAC,DUser.Userinfo,DUser.ChangeUserInfo,DUser.LoginHome,DBonus.Recharge,DBonus.BonusList,DBonus.BonusListAC,DBonus.DoRecharge,DBonus.RechargeList,DNews.News,DNews.NewsAdd,DNews.NewsDelete,DNews.NewsInsert,DNews.NewsList,DMsg.CheckMsg,DMsg.UncheckMsg,DMsg.MsgList,DMsg.MsgDetail,DMsg.MsgReply,Setting.Setting,Setting.DoSetting',
  ),
  5 => 
  array (
    'id' => 5,
    'dep_name' => '财务',
    'power' => 'DBonus.BonusList,DBonus.BonusListAC,DBonus.Recharge,DBonus.RechargeList,DBonus.DoRecharge,DBonus.DealRecharge,DCash.CashList,DCash.GetCashList,DCash.DealCash,DNews.News,DNews.NewsAdd,DNews.NewsDelete,DNews.NewsInsert,DNews.NewsList',
    'menu' => 
    array (
      '财务管理' => 
      array (
        '会员充值管理' => 'DBonus.Recharge',
        '会员提现管理' => 'DCash.CashList',
        '财务明细管理' => 'DBonus.BonusList',
      ),
      '平台管理' => 
      array (
        '新闻公告管理' => 'DNews.News',
      ),
    ),
  ),
  6 => 
  array (
    'id' => 6,
    'dep_name' => '测试部门',
    'power' => 'DIndex.Main,DUser.ExpUsers,DUser.UnConfirmUsers,DUser.Users,DUser.Userreg,DUser.UserList,DUser.ExpUserList,DUser.UserRegAC,DUser.Userinfo,DUser.ChangeUserInfo,DUser.LoginHome,DUser.PreNet,DUser.TjNet,DUser.Net,DUser.ActivateMember,DUser.DelMember,DUser.upgradeList,DUser.GetUpgradeList,DUser.dealUpgrade,DUser.EditRank,DUser.applyCenterList,DUser.GetApplyCenterList,DUser.dealApplyCenter',
    'menu' => 
    array (
      '会员管理' => 
      array (
        '系统概况' => 'DIndex.Main',
        '市场注册' => 'DUser.Userreg',
        '会员注册' => 'DUser.Userreg',
        '异常会员' => 'DUser.ExpUsers',
        '待审核会员' => 'DUser.UnConfirmUsers',
        '已审核会员' => 'DUser.Users',
        '安置网络图' => 'DUser.PreNet',
        '推荐网络图' => 'DUser.TjNet',
        '会员升级管理' => 'DUser.upgradeList',
        '报单中心管理' => 'DUser.applyCenterList',
      ),
    ),
  ),
);