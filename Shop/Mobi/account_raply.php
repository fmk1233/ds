
<!-- 余额提现 -->
<div class="page" id='account_raply' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back" ><i class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>余额提现</span>
                </div>
<!--                <a href="user_info.html" class="a-sequence j-a-sequence"><i class="iconfont icon-edit" data="1"> </i></a>-->

            </div>
        </section>
    </header>
    <div class="content">
        <!--表单-->
        <form onsubmit="return false">
            <input type="hidden" value="Bonus.AddCash" name="service"/>
            <div class="list-block">
                <ul>
                    <li>
                        <div class="item-content">

                            <div class="item-inner">
                                <div class="item-title label">提现余额</div>
                                <div class="item-input">
                                    <input type="text" name="amount"  v-model="d.money" :value="d.money" placeholder="请输入提现余额" >
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">

                            <div class="item-inner">
                                <div class="item-title label">手续费</div>
                                <div class="item-input">
                                    <span>{{ d.params.fee }}%</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <p class="flow-jiesuan">确认信息</p>
                    <li>
                        <div class="item-content">

                            <div class="item-inner">
                                <div class="item-title label">开户银行</div>
                                <div class="item-input">
                                    <input type="text" name="bank_name" :value="d.user.bank_name" v-model="d.bank_name"  placeholder="开户银行">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title label">开户姓名</div>
                                <div class="item-input">
                                    <input type="text" name="bank_user" :value="d.user.bank_user"   v-model="d.bank_user" placeholder="请输入开户姓名">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">

                            <div class="item-inner">
                                <div class="item-title label">银行账号</div>
                                <div class="item-input">
                                    <input type="text" name="bank_no" :value="d.user.bank_no"  v-model="d.bank_no"    placeholder="请输入银卡账号" >
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">

                            <div class="item-inner">
                                <div class="item-title label">开户行地址</div>
                                <div class="item-input">
                                    <input type="text" name="bank_address"  v-model="d.bank_address" :value="d.user.bank_address"   placeholder="请输入开户行地址号" >
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </form>

        <!--新增-->
        <div class="flow-no-pro">
            <a type="button" href="javascript:;" @click="finished" class=" btn-submit" >确认提现</a>
        </div>





    </div>

</div>