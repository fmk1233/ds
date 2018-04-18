<!-- 会员中心 -->
<div class="page" id='user' v-cloak="">
    <!--底部导航-->
    <nav class="bar bar-tab">
        <a class="tab-item no-transition " href="#index">
            <span class="icon iconfont icon-shouye"></span>
            <span class="tab-label">首页</span>
        </a>
        <a class="tab-item no-transition" href="#category">
            <span class="icon iconfont icon-all"></span>
            <span class="tab-label">分类</span>

        </a>
        <a class="tab-item no-transition" href="#cart">
            <span class="icon iconfont icon-cart"></span>
            <span class="tab-label">购物车</span>
            <span class="badge">{{ cart_num }}</span>
        </a>
        <a class="tab-item no-transition active" href="#user">
            <span class="icon iconfont icon-account"></span>
            <span class="tab-label">我的</span>
        </a>
    </nav>
    <div class="content">
        <!--个人信息-->
        <div class="my-admin-header-box">
            <div class="admin-bg-box">
                <div class="my-user-box com-header">
                    <div class="padding-all dis-box">
                        <div class="user-head-img-box">
                            <a href="#user_info"><img src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/img/idx_user.png"></a>
                        </div>

                        <div class="box-flex">
                            <div class="g-s-i-title-a">
                                <a href="#user_info">
                                    <h4 class="ellipsis-one user-admin-size">{{ d.user_name }}</h4></a>
                                <a href="#user_info">
                                    <p class="user-reg-top color-whie f-03">您的等级是 <em class="em-promotion bg-discount">{{ d.rank_name }}</em> </p>
                                </a>
                            </div>
                        </div>
                       <div class="user-right-maxbox">
                            <a href="#setting">
                                <div class="user-right-box">
                                    <i class="iconfont icon-set is-shezi my-user-right-cont" ></i>
                                   <!-- <p class="my-user-right-cont"><span class="my-t-remark color-whie" >设置</span></p>-->
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-nav-box my-shoucang-bg">
                <div class="user-nav-box n-g-s-i-title-1 dis-box text-center">
                    <a href="#wallet" class="box-flex" class="box-flex" v-for="(bonus_name ,key) in bonus_names"
                       :data-bonus="key" :data-user="JSON.stringify(d)" :data-name="name" :data-bonus_name="bonus_name">
                        <h4 class="color-whie ellipsis-one">{{ d[name+key] }}</h4>
                        <p class="color-whie t-remark3">{{ bonus_name }}</p>
                    </a>
                </div>
            </div>
        </div>
        <!--我的订单-->
        <section class="my-nav-box bg-white m-top10">
            <div class="dis-box padding-all bg-white  g-evaluation-title">
                <div class="box-flex t-goods1"><i class="iconfont icon-copy is-user-size color-money"></i><label class="my-u-title-size">我的订单</label></div>
                <div class="t-goods1"><a href="#order" data-state="0" > <span class="t-jiantou">全部订单<i class="icon icon icon-right  "></i></span></a></div>

            </div>
            <ul class="user-money-list g-s-i-title-2 dis-box text-center my-dingdan">
                <a href="#order" data-state="1" class="box-flex">
                    <li>
                        <h4 class="ellipsis-one"><i class="iconfont icon-signboard my-img-size"></i></h4>
                        <p class="t-remark3">待付款</p>
                        <div class="user-list-num bg-discount">{{ order.wait_pay }}</div>
                    </li>
                </a>
                <a href="#order" data-state="2"  class="box-flex">
                    <li>
                        <h4 class="ellipsis-one"><i class="iconfont icon-auto my-img-size"></i></h4>
                        <p class="t-remark3">待发货</p>
                        <div class="user-list-num bg-discount">{{ order.payed }}</div>
                    </li>
                </a>
                <a href="#order" data-state="3"  class="box-flex">
                    <li>
                        <h4 class="ellipsis-one"><i class="iconfont icon-box my-img-size"></i></h4>
                        <p class="t-remark3">已发货</p>
                        <div class="user-list-num bg-discount">{{ order.shipping }}</div>
                    </li>
                </a>
                <a href="#order" data-state="4"  class="box-flex">
                    <li>
                        <h4 class="ellipsis-one"><i class="iconfont icon-templatedefault my-img-size"></i></h4>
                        <p class="t-remark3">已完成</p>
                    </li>
                </a>
            </ul>
        </section>

        <!--我的钱包-->
        <section class="my-nav-box bg-white m-top10">
            <div class="dis-box padding-all bg-white  g-evaluation-title">
                <div class="box-flex t-goods1"><i class="iconfont icon-shuffling-banner is-user-size my-qianbao-color"></i><label class="my-u-title-size">我的钱包</label></div>
            </div>
            <ul class="user-money-list g-s-i-title-2 dis-box text-center">
                <a href="#wallet" class="box-flex" v-for="(bonus_name ,key) in bonus_names" :data-bonus="key" :data-user="JSON.stringify(d)" :data-name="name" :data-bonus_name="bonus_name">
                    <li>
                        <h4 class="f-2">{{ d[name+key] }}</h4>
                        <p class="t-remark3">{{ bonus_name }}</p>
                    </li>
                </a>
            </ul>
        </section>
        <footer class="bg-white user-fu-box m-top10">
            <div class="box text-c b-color-f dis-box">
                <a href="#message" class="box-flex">
                    <i class="iconfont icon-comments color-money"></i>
                    <p class="f-03 col-6">信息中心</p>
                </a>


                <a href="#address" class="box-flex">
                    <i class="iconfont icon-map color-kf"></i>
                    <p class="f-03 col-6">地址管理</p>
                </a>

            </div>
        </footer>
        <!--退出-->
        <div class="flow-no-pro">
            <a type="button" @click="logout" class=" btn-submit" >退出登录</a>
        </div>




    </div>
</div>