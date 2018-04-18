
<!-- 账户充值-确认 -->
<div class="page" id='order_logistics' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-default color-whie purse-header">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back"><i class="icon icon-left is-left-font color-whie"></i></a>
                <div class="box-flex ect-header">
                    <span>物流信息</span>
                </div>
            </div>
        </section>
    </header>
    <div class="content">
        <div class="lgst-cnt">
            <div class="lgst-cnt-title">快递公司：&nbsp;{{ com }}
                &nbsp;&nbsp;快递号&nbsp;{{ logistics.nu }}</div>
            <div class="lgst-cnt-msg">物流信息：</div>
            <div class="lgst-cnt-msg-dtl">
                <div class="fl lbox"></div>
                <div class="fl rbox">
                    <ul>
                        <li v-for="(logis,key) in logistics.data" :class="logistics.state==3&&key==0?'current':''">
                            {{ logis.context }}<br>{{ logis.time }}
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

</div>
