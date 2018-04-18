<?php   
return array (
  'all' => 
  array (
    '我的资料' => 
    array (
      '个人中心' => 'User.Main',
      '查看资料' => 'User.UserView',
      '修改资料' => 'User.EditUser',
      '安全中心' => 'User.security',
    ),
    '团队管理' => 
    array (
      '会员升级' => 'User.Upgrade',
      '会员申请' => 'User.UserReg',
      '未审会员' => 'User.UnUserList',
      '已审会员' => 'User.UserList',
      '报单中心申请' => 'User.ApplyCenter',
    ),
    '网络管理' => 
    array (
      '安置网络结构图' => 'Net.pre',
      '推荐网络结构图' => 'Net.tj',
    ),
    '财务管理' => 
    array (
      '奖金明细' => 'Reward.RewardList',
      '会员转账' => 'Transfer.TransferList',
//      '余额提现' => 'Bonus.CashList',
      '充值申请' => 'Recharge.RechargeList',
//      '钱包互转' => 'BonusTransfer.BonusTransferList',
      '余额钱包' => 'Bonus.Balance',
//      '报单币钱包' => 'Bonus.Declaration',
//      '购物币钱包' => 'Bonus.Shopping',
    ),
    '订单管理' => 
    array (
      '产品订购' => 'Order.GoodsList',
      '订单管理' => 'Order.OrderList',
      '我的购物车' => 'Order.CartList',
    ),
    '信息管理' => 
    array (
      '新闻公告' => 'News.NewsList',
      '我要留言' => 'Msg.MsgList',
    ),
  ),
  'menu' => 
  array (
    '我的资料' => 
    array (
      '个人中心' => 'User.Main',
      '查看资料' => 'User.UserView',
      '修改资料' => 'User.EditUser',
      '安全中心' => 'User.security',
    ),
    '团队管理' => 
    array (
      '会员升级' => 'User.Upgrade',
      '会员申请' => 'User.UserReg',
      '未审会员' => 'User.UnUserList',
      '已审会员' => 'User.UserList',
      '报单中心申请' => 'User.ApplyCenter',
    ),
    '网络管理' => 
    array (
      '安置网络结构图' => 'Net.pre',
      '推荐网络结构图' => 'Net.tj',
    ),
    '财务管理' => 
    array (
      '奖金明细' => 'Reward.RewardList',
      '会员转账' => 'Transfer.TransferList',
      '充值申请' => 'Recharge.RechargeList',
      '余额钱包' => 'Bonus.Balance',
    ),
    '订单管理' => 
    array (
      '产品订购' => 'Order.GoodsList',
      '订单管理' => 'Order.OrderList',
      '我的购物车' => 'Order.CartList',
    ),
    '信息管理' => 
    array (
      '新闻公告' => 'News.NewsList',
      '我要留言' => 'Msg.MsgList',
    ),
  ),
  'total' => 
  array (
    '我的资料' => 
    array (
      '个人中心' => 'User.Main',
      '查看资料' => 'User.UserView',
      '修改资料' => 'User.EditUser',
      '修改密码' => 'User.PwdEdit',
      '修改密码提交' => 'User.PwdEditAC',
//      '修改银行信息' => 'User.BankInfoEdit',
//      '修改收货地址' => 'User.AddressEdit',
      '安全中心' => 'User.Security',
      '修改资料提交' => 'User.DoEditUser',
    ),
    '团队管理' => 
    array (
      '会员升级' => 'User.Upgrade',
      '会员升级数据' => 'User.GetUpgradeList',
      '会员申请' => 'User.UserReg',
      '会员注册提交' => 'User.Register',
      '未审会员' => 'User.UnUserList',
      '已审会员' => 'User.UserList',
      '会员管理数据' => 'User.GetUserList',
      '删除会员' => 'User.DelMember',
      '激活会员' => 'User.ActivateMember',
      '报单中心申请' => 'User.ApplyCenter',
      '报单中心申请数据' => 'User.GetApplyCenterList',
    ),
    '网络管理' => 
    array (
      '安置网络结构图' => 'Net.pre',
      '推荐网络结构图' => 'Net.tj',
      '网络结构图数据' => 'Net.net',
    ),
    '财务管理' => 
    array (
      '会员奖金详情' => 'Reward.RewardDetail',
      '奖金明细' => 'Reward.RewardList',
      '奖金明细数据' => 'Reward.GetRewardList',
      '会员转账' => 'Transfer.TransferList',
      '会员转账数据' => 'Transfer.GetTransferList',
      '会员转账提交' => 'Transfer.AddTransfer',
//      '钱包互转' => 'BonusTransfer.BonusTransferList',
//      '钱包互转数据' => 'BonusTransfer.GetBonusTransferList',
//      '钱包互转提交' => 'BonusTransfer.AddBonusTransfer',
//      '余额提现' => 'Bonus.CashList',
//      '提现数据' => 'Bonus.GetCashList',
//      '提现提交' => 'Bonus.AddCash',
      '充值申请' => 'Recharge.RechargeList',
      '充值数据' => 'Recharge.GetRechargeList',
      '充值提交' => 'Recharge.DoRecharge',
      '余额钱包' => 'Bonus.Balance',
//      '报单币钱包' => 'Bonus.Declaration',
//      '购物币钱包' => 'Bonus.Shopping',
      '钱包数据' => 'Bonus.GetBonusList',
    ),
    '订单管理' => 
    array (
      '产品订购' => 'Order.GoodsList',
      '产品订购数据' => 'Order.GetGoodsInfoList',
      '产品详情' => 'Order.GoodsDetail',
      '添加购物车' => 'Order.AddCart',
      '修改购物车' => 'Order.ChangeCart',
      '删除购物车' => 'Order.DelCart',
      '订单管理' => 'Order.OrderList',
      '订单管理数据' => 'Order.GetOrderList',
      '订单提价' => 'Order.AddOrders',
      '订单物流' => 'Order.Logistics',
      '订单详情' => 'Order.OrderInfo',
      '支付订单' => 'Order.PayOrder',
      '确认订单' => 'Order.ConfirmOrder',
      '删除订单' => 'Order.DelOrder',
      '我的购物车' => 'Order.CartList',
      '我的购物车数据' => 'Order.GetCartList',
    ),
    '信息管理' => 
    array (
      '新闻公告' => 'News.NewsList',
      '新闻公告查看' => 'News.NewsDetail',
      '新闻公告数据' => 'News.GetNewsList',
      '我要留言' => 'Msg.MsgList',
      '留言信息查看' => 'Msg.MsgDetail',
      '留言信息数据' => 'Msg.GetMsgList',
      '添加留言' => 'Msg.AddMsg',
    ),
  ),
  'power' => 'User.Main,User.UserView,User.EditUser,User.PwdEdit,User.PwdEditAC,User.BankInfoEdit,User.AddressEdit,User.Security,User.DoEditUser,User.Upgrade,User.GetUpgradeList,User.UserReg,User.Register,User.UnUserList,User.UserList,User.GetUserList,User.DelMember,User.ActivateMember,User.ApplyCenter,User.GetApplyCenterList,Net.pre,Net.tj,Net.net,Reward.RewardDetail,Reward.RewardList,Reward.GetRewardList,Transfer.TransferList,Transfer.GetTransferList,Transfer.AddTransfer,Recharge.RechargeList,Recharge.GetRechargeList,Recharge.DoRecharge,Bonus.Balance,Bonus.GetBonusList,Order.GoodsList,Order.GetGoodsInfoList,Order.GoodsDetail,Order.AddCart,Order.ChangeCart,Order.DelCart,Order.OrderList,Order.GetOrderList,Order.AddOrders,Order.Logistics,Order.OrderInfo,Order.PayOrder,Order.ConfirmOrder,Order.DelOrder,Order.CartList,Order.GetCartList,News.NewsList,News.NewsDetail,News.GetNewsList,Msg.MsgList,Msg.MsgDetail,Msg.GetMsgList,Msg.AddMsg',
);