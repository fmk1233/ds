
<body>

<!-- 个人资料 -->
<div class="page" id='user_info' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back"><i class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>个人资料</span>
                </div>
<!--                <a href="password.html" class="a-sequence j-a-sequence"><i class="iconfont icon-edit" data="1"> </i></a>-->

            </div>
        </section>
    </header>
    <div class="content">
        <!--表单-->
        <form onsubmit="return false;">
            <input type="hidden" value="User.DoUserInfo" name="service"/>
        <div class="list-block">
            <ul>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">会员编号</div>
                            <div class="item-input">
                                <input type="text" placeholder="会员编号" readonly :value="d.user_name">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">会员姓名</div>
                            <div class="item-input">
                                <input type="text" placeholder="会员姓名" readonly :value="d.true_name">
                            </div>
                        </div>
                    </div>
                </li>

                <li class="mui-table-view-cell ui-on-back">
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">省市区</div>
                            <div class="item-input">
                                <input type="text"  id='user_area'  :data-value="d.province+' '+d.city+' '+d.area" />
                                <input type="hidden" name="province" :value="d.province">
                                <input type="hidden" name="city" :value="d.city">
                                <input type="hidden" name="area" :value="d.area">
                            </div>
                        </div>
                    </div>

                </li>
                <li class="mui-table-view-cell ui-on-back">
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">性别</div>
                            <div class="item-input">
                                <input type="text" id='sexs'  :value="d.sex_name"/>
                                <input type="hidden" name="sex" :value="d.sex">
                            </div>
                        </div>
                    </div>

                </li>
                <li class="mui-table-view-cell ui-on-back">
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">注册时间</div>
                            <div class="item-input">
                                <span>{{timer(d.reg_time ,true)}}</span>
                            </div>
                        </div>
                    </div>

                </li>
                <li>
                    <div class="item-content">

                        <div class="item-inner">
                            <div class="item-title label">联系电话</div>
                            <div class="item-input">
                                <input type="text" placeholder="请输入手机号码"  readonly :value="d.mobile">
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="list-block m-top10">
            <ul>
                <li>
                    <div class="item-content">

                        <div class="item-inner">
                            <div class="item-title label">开户银行</div>
                            <div class="item-input">
                                <input type="text" name="name" placeholder="开户银行" v-model="d.bank_name"  :value="d.bank_name" >
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">

                        <div class="item-inner">
                            <div class="item-title label">银行账号</div>
                            <div class="item-input">
                                <input type="text" name="no" placeholder="请输入银行账号" v-model="d.bank_no" :value="d.bank_no">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">

                        <div class="item-inner">
                            <div class="item-title label">开户姓名</div>
                            <div class="item-input">
                                <input type="text" name="user" placeholder="请输入开户姓名" v-model="d.bank_user" :value="d.bank_user">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">

                        <div class="item-inner">
                            <div class="item-title label">开户行地址</div>
                            <div class="item-input">
                                <input type="text" name="address" placeholder="请输入开户行地址号" v-model="d.bank_address"  :value="d.bank_address">
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!--新增-->
        </form>
        <div class="flow-no-pro">
            <a type="button" href="javascript:;" @click="finished" class=" btn-submit" >提交保存</a>
        </div>


    </div>

</div>
