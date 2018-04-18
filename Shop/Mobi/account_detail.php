
<!-- 账户明细 -->
<div class="page" id='account_detail' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back"><i class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>账户明细</span>
                </div>

            </div>
        </section>
    </header>
    <div class="content infinite-scroll">
        <!--列表-->
        <ul class="n-user-acc-log m-top10">
            <li class="dis-shop-list p-r padding-all  bg-white" v-for="bonus in bonus_list">
                <div class="dis-box">
                    <div class="box-flex row no-gutter">
                            <h5 class="f-05 col-7 col-50">{{ timer(bonus.add_time,true) }}</h5>
                        <p class="f-05 color-discount text-right col-50">
                            {{ bonus.money }}
                        </p>
                        <h6 class="f-05 col-7  m-top04 col-100">{{ bonus.memo }}</h6>
                    </div>
                </div>
            </li>
        </ul>

        <a href="javascript:;" class="get-more" v-if="loading==1">
            <div class="preloader"></div>正在努力加载中！
        </a>

    </div>

</div>