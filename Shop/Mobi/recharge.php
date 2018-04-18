
<!-- 账户充值 -->
<div class="page" id='recharge' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back"><i class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>账户充值</span>
                </div>

            </div>
        </section>
    </header>
    <div class="content">
        <!--表单-->
        <div class="list-block">
            <ul>
                <li>
                    <div class="item-content">

                        <div class="item-inner">
                            <div class="item-title label">充值余额</div>
                            <div class="item-input">
                                <input type="text" :value="d.money" v-model="d.money" placeholder="请输入充值余额" >
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <textarea rows="4" :value="d.memo"  v-model="d.memo" placeholder="备注" style="padding: 0px;margin: 0px"></textarea>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <!--新增-->
        <div class="flow-no-pro">
            <a type="button" class="btn-submit" @click="finished" >提交申请</a>
        </div>

    </div>

</div>
