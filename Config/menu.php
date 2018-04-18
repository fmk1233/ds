<?php

return array(
    'total' => array(
        '会员管理' => array(
            '系统概况' => 'DIndex.Main',
//            '异常会员' => 'DUser.ExpUsers',
            '待审核会员' => 'DUser.UnConfirmUsers',
            '已审核会员' => 'DUser.Users',
            '会员注册' => 'DUser.Userreg',
            '会员管理数据' => 'DUser.UserList',
//            '异常会员数据' => 'DUser.ExpUserList',
            '会员注册提交' => 'DUser.UserRegAC',
            '会员信息' => 'DUser.UserInfo',
            '会员信息查看' => 'DUser.UserView',
            '会员信息修改' => 'DUser.ChangeUserInfo',
            '登陆前台' => 'DUser.LoginHome',
            '安置网络图' => 'DUser.PreNet',
            '推荐网络图' => 'DUser.TjNet',
            '网络图数据' => 'DUser.Net',
            '激活会员' => 'DUser.ActivateMember',
            '封停会员' => 'DUser.openMember',
            '删除会员' => 'DUser.DelMember',
            '设置会员提现' => 'DUser.cashMember',
            '会员升级管理' => 'DUser.upgradeList',
            '会员升级数据' => 'DUser.GetUpgradeList',
            '会员升级处理' => 'DUser.dealUpgrade',
            '会员等级修改' => 'DUser.EditRank',
            '报单中心管理' => 'DUser.applyCenterList',
            '报单中心数据' => 'DUser.GetApplyCenterList',
            '报单中心处理' => 'DUser.dealApplyCenter',
            '设置报单中心' => 'DUser.EditBdcenter',
        ),
        '财务管理' => array(
            '财务明细' => 'DBonus.BonusList',
            '财务明细数据' => 'DBonus.BonusListAC',
            '充值管理' => 'DBonus.Recharge',
            '充值管理数据' => 'DBonus.RechargeList',
            '充值提交' => 'DBonus.DoRecharge',
            '充值订单处理' => 'DBonus.DealRecharge',
            '提现管理' => 'DCash.CashList',
            '提现管理数据' => 'DCash.GetCashList',
            '提现订单处理' => 'DCash.DealCash',
        ),
        '新闻管理' => array(
            '新闻管理' => 'DNews.News',
            '新闻添加' => 'DNews.NewsAdd',
            '新闻删除' => 'DNews.NewsDelete',
            '新闻添加提交' => 'DNews.NewsInsert',
            '新闻管理数据' => 'DNews.NewsList',
        ),
        '协议管理' => array(
            '协议管理' => 'DProtocol.Protocol',
            '协议添加' => 'DProtocol.ProtocolAdd',
            '协议删除' => 'DProtocol.ProtocolDelete',
            '协议添加提交' => 'DProtocol.ProtocolInsert',
            '协议管理数据' => 'DProtocol.ProtocolList',
        ),
        '留言管理' => array(
            '留言信息管理' => 'DMsg.MsgList',
            '留言数据' => 'DMsg.GetMsgList',
            '留言详情' => 'DMsg.MsgDetail',
            '回复留言' => 'DMsg.MsgReply',
        ),
        '奖金管理' => array(
            '奖金参数' => 'Setting.Setting',
            '奖金参数设置' => 'Setting.DoSetting',
            '系统初始化' => 'Setting.ClearData',
            '会员奖金明细' => 'Reward.RewardList',
            '会员奖金详情' => 'Reward.RewardDetail',
            '会员奖金数据' => 'Reward.GetRewardList',
            '会员奖金汇总' => 'Reward.RewardTotal',
            '奖金汇总数据' => 'Reward.GetRewardTotalList',
            '奖金总拨出率' => 'Reward.RewardRatio',
        ),
        /* '匹配管理' => array(
             '自动匹配' => 'DOrders.AutoMatch',
             '匹配系统' => 'DOrders.CashManager',
             '删除匹配' => 'DOrders.DeletePP',
             '手动匹配' => 'DOrders.MatchOrder',
             '退出抢单池' => 'DOrders.OutQOrder',
             '进入抢单池' => 'DOrders.InQOrder',
             '订单信息' => 'DOrders.OrderList',
             '匹配订单信息' => 'DOrders.PPOrderList',
             '解冻订单' => 'DOrders.UnfrezzeOrder',
         ),*/
        '后台管理' => array(
            '管理员信息' => 'Admin.AdminInfo',
            '管理员管理' => 'Admin.AdminList',
            '管理员管理数据' => 'Admin.GetAdminList',
            '管理员信息修改' => 'Admin.ChangeAdminInfo',
            '删除管理员' => 'Admin.DelAdmin',
            '部门管理' => 'Admin.PowerList',
            '部门管理数据' => 'Admin.GetPowerList',
            '部门添加' => 'Admin.AddPower',
            '部门添加提交' => 'Admin.PowerAddAC',
            '删除部门' => 'Admin.DelPower',
            '日志管理' => 'Log.logListView',
            '日志管理数据' => 'Log.logList',
            '安全页面设置' => 'Admin.adminSecPower',
            '安全页面设置修改' => 'Admin.addAdminSecPower',
            '会员使用权限' => 'Admin.UserPower',
            '会员使用权限修改' => 'Admin.UserPowerAc',
            '系统参数设置' => 'Setting.SysSetting',
            '系统参数设置提交' => 'Setting.DoSysSetting',
            '地区信息管理' => 'Area.area',
            '地区信息管理数据' => 'Area.areaList',
            '变更地区信息视图' => 'Area.doAreaView',
            '变更地区信息' => 'Area.doArea',
            '删除地区信息' => 'Area.delArea',
            '会员注册设置' => 'Setting.SettingUserReg',
            '会员注册设置修改' => 'Setting.DoUserReg',
            '清除缓存' => 'Setting.ClearCache'

        ),
        '数据库管理' => array(
            '数据库备份管理' => 'DB.Dbbackup',
            '数据库备份管理数据' => 'DB.DbbackupList',
            '数据库备份' => 'DB.Backup',
            '数据库备份下载' => 'DB.Download',
            '数据库备份还原' => 'DB.Restore',
            '数据库备份删除' => 'DB.Del',
        ),
        '商品管理' => array(
            '商城设置页面' => 'Goods.Setting',
            '商城设置' => 'Goods.DoSetting',
            '添加商品分类' => 'Goods.AddCategory',
            '商品分类提交' => 'Goods.AddGoodsCategoryAC',
            '添加商品' => 'Goods.AddGoods',
            '添加商品提交' => 'Goods.AddGoodsAC',
            '删除分类' => 'Goods.DelCategory',
            '删除商品' => 'Goods.DelGoods',
            '商品上下架' => 'Goods.ChangeStatusGoods',
            '商品管理' => 'Goods.GoodsList',
            '商品管理数据' => 'Goods.GetGoodsList',
            '商品分类管理' => 'Goods.GoodsCategory',
            '商品分类管理数据' => 'Goods.GoodsCategoryList',//Goods.UploadFile,Goods.RemoveFile默认都拥有权限
            '支付方式' => 'Payment.PaymentListView',
            '支付方式数据' => 'Payment.PaymentList',
            '支付方式修改' => 'Payment.PaymentInfoView',
            '支付方式修改确认' => 'Payment.DoPaymentInfo',

        ),
        '幻灯片管理' => array(
            '幻灯片管理' => 'Icon.IconList',
            '幻灯片管理数据' => 'Icon.GetIconList',
            '删除幻灯片' => 'Icon.DelIcon',
            '添加幻灯片' => 'Icon.IconAdd',
            '添加幻灯片提交' => 'Icon.IconAddAc',
            '幻灯片推荐' => 'Icon.ChageStatus',
        ),
        '物流管理' => array(
            '物流管理数据' => 'Logistics.GetLogcomList',
            '物流管理' => 'Logistics.LogcomList',
            '物流添加' => 'Logistics.LogcomAdd',
            '物流添加提交' => 'Logistics.AddLogcomAC',
            '删除物流' => 'Logistics.DelLogcom',//默认都可以下载 Logistics.DownComcode
        ),
        '订单管理' => array(
            '取消订单' => 'GoodOrders.CancelOrder',
            '确认收货' => 'GoodOrders.ConfirmOrder',
            '订单管理数据' => 'GoodOrders.GetOrderList',
            '订单管理' => 'GoodOrders.OrdersList',
            '查询物流' => 'GoodOrders.LookDelivery',
            '订单详情' => 'GoodOrders.Orderinfo',
            '支付订单' => 'GoodOrders.PayOrder',
            '订单发货' => 'GoodOrders.SendGoods',
            '订单发货提交' => 'GoodOrders.SendGoodsAc',
        ),
        '数据导出' => array(
            '奖金明细导出' => 'Export.Reward',
            '提现明细导出' => 'Export.Cash',
            '会员管理导出' => 'Export.UserList',
            '订单数据导出' => 'Export.OrderList',
        ),
        '平台银行信息' => array(
            '银行信息管理' => 'Bank.ListView',
            '银行信息管理数据' => 'Bank.ListData',
            '银行信息' => 'Bank.InfoView',
            '银行信息添加' => 'Bank.Update',
            '银行信息删除' => 'Bank.Del',
        ),
        '搜索设置' => array(
            '搜索设置' => 'Setting.Search',
            '热门搜索数据' => 'Setting.HotSearch',
            '热门搜索添加' => 'Setting.DoSearch',
            '热门搜索删除' => 'Setting.DelSearch',
        ),
        '文章管理' => array(
            '文章分类' => 'ArticleClass.ListView',
            '文章分类数据' => 'ArticleClass.ListData',
            '文章分类信息' => 'ArticleClass.InfoView',
            '文章分类添加修改' => 'ArticleClass.DoInfo',
            '文章分类删除' => 'ArticleClass.DelInfo',
            '文章管理' => 'Article.ListView',
            '文章数据' => 'Article.ListData',
            '文章' => 'Article.InfoView',
            '文章添加修改' => 'Article.DoInfo',
            '文章删除' => 'Article.DelInfo',
        ),
        '页面导航' => array(
            '页面导航' => 'Navigation.ListView',
            '页面导航数据' => 'Navigation.ListData',
            '页面导航信息' => 'Navigation.InfoView',
            '页面导航添加修改' => 'Navigation.DoInfo',
            '页面导航删除' => 'Navigation.DelInfo',
        )

    ),
    'menu' => array(
        '会员管理' => array(
            '系统概况' => 'DIndex.Main',
            '会员注册' => 'DUser.Userreg',
//            '异常会员' => 'DUser.ExpUsers',
            '待审核会员' => 'DUser.UnConfirmUsers',
            '已审核会员' => 'DUser.Users',
            '安置网络图' => 'DUser.PreNet',
            '推荐网络图' => 'DUser.TjNet',
            '会员升级管理' => 'DUser.upgradeList',
            '报单中心管理' => 'DUser.applyCenterList',
        ),
        '财务管理' => array(
            '会员充值管理' => 'DBonus.Recharge',
            '会员提现管理' => 'DCash.CashList',
            '财务明细管理' => 'DBonus.BonusList',
        ),
        '奖金管理' => array(
            '会员奖金明细' => 'Reward.RewardList',
            '会员奖金汇总' => 'Reward.RewardTotal',
            '奖金总拨出率' => 'Reward.RewardRatio',
        ),
        '平台管理' => array(
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
        '匹配管理' => array(
            '匹配管理系统' => 'DOrders.CashManager',
        ),
        '商城管理' => array(
            '商城设置' => 'Goods.Setting',
            '商品管理' => 'Goods.GoodsList',
            '商品分类' => 'Goods.GoodsCategory',
            '订单管理' => 'GoodOrders.OrdersList',
            '物流管理' => 'Logistics.LogcomList',
            '搜索设置' => 'Setting.Search',
            '支付方式' => 'Payment.PaymentListView',
        ),
        '平台设置' => array(
            '部门管理' => 'Admin.PowerList',
            '管理员管理' => 'Admin.AdminList',
            '数据库备份' => 'DB.Dbbackup',
            '系统参数设置' => 'Setting.SysSetting',
        ),
        '安全中心' => array(
            '日志管理' => 'Log.logListView',
            '奖金参数' => 'Setting.Setting',
            '安全页面设置' => 'Admin.adminSecPower',
            '会员使用权限' => 'Admin.UserPower',
            '会员注册设置' => 'Setting.SettingUserReg',
            '系统初始化' => 'Setting.ClearData',
            '清除缓存' => 'Setting.ClearCache',
        )

    ),
    'icon' => array(
        '会员管理' => array(
            'icon' => 'fa-user',
            'icons' => array(
                '系统概况' => 'fa-bar-chart',
                '会员注册' => 'fa-users',
                '异常会员' => 'fa-users',
                '待审核会员' => 'fa-user-times',
                '已审核会员' => 'fa-users',
                '安置网络图' => 'fa-bar-chart',
                '推荐网络图' => 'fa-bar-chart',
                '会员升级管理' => 'fa-cloud-upload',
                '报单中心管理' => 'fa-cloud-upload',
            )
        ),
        '财务管理' => array(
            'icon' => 'fa-money',
            'icons' => array(
                '会员充值管理' => 'fa-money',
                '会员提现管理' => 'fa-clone',
                '财务明细管理' => 'fa-bar-chart',
            )

        ),
        '奖金管理' => array(
            'icon' => 'fa-cc',
            'icons' => array(
                '会员奖金明细' => 'fa-rmb',
                '会员奖金汇总' => 'fa-dollar',
                '奖金总拨出率' => 'fa-btc',
            )
        ),
        '平台管理' => array(
            'icon' => 'fa-desktop',
            'icons' => array(
                '文章分类' => 'fa-newspaper-o',
                '文章管理' => 'fa-newspaper-o',
                '页面导航' => 'fa-sticky-note',
                '幻灯片管理' => 'fa-photo',
                '系统协议管理' => 'fa-sticky-note',
                '新闻公告管理' => 'fa-newspaper-o',
                '留言信息管理' => 'fa-commenting',
                '地区信息管理' => 'fa-sticky-note',
                '银行信息管理' => 'fa-credit-card',
            )

        ),
        '匹配管理' => array(
            'icon' => 'fa-home',
            'icons' => array(
                '匹配管理系统' => 'fa-home',
            )
        ),
        '商城管理' => array(
            'icon' => 'fa-shopping-cart',
            'icons' => array(
                '商城设置' => 'fa-pinterest',
                '商品管理' => 'fa-pinterest',
                '商品分类' => 'fa-ra',
                '订单管理' => 'fa-shopping-cart',
                '物流管理' => 'fa-truck',
                '搜索设置' => 'fa-search',
                '支付方式' => 'fa-paypal',
            )
        ),
        '平台设置' => array(
            'icon' => 'fa-cogs',
            'icons' => array(
                '部门管理' => 'fa-yelp',
                '管理员管理' => 'fa-user-secret',
                '数据库备份' => 'fa-database',
                '系统参数设置' => 'fa-cog',
            )
        ),
        '安全中心' => array(
            'icon' => 'fa-cogs',
            'icons' => array(
                '日志管理' => 'fa-yelp',
                '奖金参数' => 'fa-cogs',
                '安全页面设置' => 'fa-cog',
                '会员使用权限' => 'fa-cog',
                '会员注册设置' => 'fa-cog',
                '系统初始化' => 'fa-cog',
                '清除缓存' => 'fa-trash',
            )
        )

    )
);
