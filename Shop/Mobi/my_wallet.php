<!-- 我的钱包 -->
<div class="page" id='wallet' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-default color-whie purse-header">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back"><i class="icon icon-left is-left-font color-whie"></i></a>
                <div class="box-flex ect-header">
                    <span>{{ bonus_name }}</span>
                </div>
            </div>
        </section>
    </header>
    <div class="content">
        <!--余额信息-->
        <section class="purse-header-box text-center purse-f">
            <p>可用余额:</p>
            <h2>￥{{ user[name+bonus] }}元</h2>
            <img src="<?php echo URL_ROOT.'..'; ?>/Shop/Mobi/img/pur-bg.png">
            <div class="user-pur-box">
                <div class="user-nav-1-box g-s-i-title-4 dis-box text-center">
                    <a href="#recharge" :data-type="bonus" class="box-flex">
                        <h4 class="ellipsis-one purse-f"><i class="iconfont icon-trade is-money-color"></i>账户充值</h4>
                    </a>
                    <a href="#account_raply" class="box-flex" v-if="bonus==0">
                        <h4 class="ellipsis-one purse-f"><i class="iconfont icon-jifen is-money-color"></i>余额提现</h4>
                    </a>
                    <a href="#recharge_list" :data-type="bonus" class="box-flex" v-else>
                        <h4 class="ellipsis-one purse-f"><i class="iconfont icon-jifen is-money-color"></i>充值明细</h4>
                    </a>
                </div>
            </div>
        </section>
        <!--其他-->
        <section class="my-nav-box bg-white m-top10">
            <a href="#account_detail" :data-type="bonus">
                <div class="dis-box padding-all bg-white  g-evaluation-title">
                    <div class="box-flex t-goods1"><label class="my-u-title-size">账户明细</label></div>
                    <div class="t-goods1"><span class="t-jiantou"><i class="icon icon icon-right  "></i></span></div>

                </div>
            </a>
            <a href="#cash_detail" v-if="bonus==0">
                <div class="dis-box padding-all bg-white  g-evaluation-title">
                    <div class="box-flex t-goods1"><label class="my-u-title-size">提现记录</label></div>
                    <div class="t-goods1"><span class="t-jiantou"><i class="icon icon icon-right  "></i></span></div>
                </div>
            </a>
            <a href="#recharge_list" :data-type="bonus" v-if="bonus==0">
                <div class="dis-box padding-all bg-white  g-evaluation-title">
                    <div class="box-flex t-goods1"><label class="my-u-title-size">充值明细</label></div>
                    <div class="t-goods1"><span class="t-jiantou"><i class="icon icon icon-right  "></i></span></div>
                </div>
            </a>
        </section>


    </div>

</div>