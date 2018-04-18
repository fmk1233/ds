
<!-- 申请提现记录 -->
<div class="page" id='recharge_list' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back"><i class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>充值记录</span>
                </div>

            </div>
        </section>
    </header>
    <div class="content">
        <!--列表-->
        <ul class="n-user-acc-log">
            <li class="dis-shop-list p-r padding-all m-top10 bg-white  "  v-for="recharge in recharge_list">
                <div class="dis-box">
                    <div class="box-flex">
                        <h5 class="f-05 col-7">{{ timer(recharge.add_time,true) }}</h5>
                        <h6 class="f-05 col-7  m-top04">{{ recharge.recharge_sn }}</h6>
                    </div>
                    <div class="box-flex">
                        <p class="f-04 color-money text-right" v-if="recharge.status==2">拒绝</p>
                        <p class="f-04 color-article text-right" v-else-if="recharge.status==1">通过</p>
                        <p class="f-04 color-discount text-right" v-else>审核</p>
                        <h6 class="f-05 col-3 text-right m-top04">￥{{ recharge.money }}元</h6>
                    </div>
                </div>
                 <p class="f-03 m-top02"><span class="col-7 f-05">备注 : </span><span class="col-3">{{ recharge.memo }}</span></p>
<!--                <p class="f-03 m-top04"><span class="col-7 f-05">银行信息 : </span><span class="col-3"></span></p>-->
            </li>
        </ul>
        <a href="javascript:;" class="get-more" v-if="loading==1">
            <div class="preloader"></div>正在努力加载中！
        </a>

    </div>

</div>