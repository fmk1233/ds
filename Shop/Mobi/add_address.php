<!-- 新增收货地址 -->
<div class="page" id='add_address' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back" href="#address" :data-from="from"><i
                            class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>新增收货地址</span>
                </div>

            </div>
        </section>
    </header>
    <div class="content">

            <div class="list-block">
                <!--表单-->
                <form onsubmit="return false;">
                <input type="hidden" value="User.DoAddress" name="service"/>
                <input type="hidden" :value="d.province" name="province"/>
                <input type="hidden" :value="d.city" name="city"/>
                <input type="hidden" :value="d.area" name="area"/>
                <input type="hidden" :value="d.id" name="addressid"/>
                <ul>
                    <li>
                        <div class="item-content">

                            <div class="item-inner">
                                <div class="item-title label">收货人</div>
                                <div class="item-input">
                                    <input type="text" v-model="d.realname" name="realname" :value="d.realname" placeholder="收货人姓名">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">

                            <div class="item-inner">
                                <div class="item-title label">手机号码</div>
                                <div class="item-input">
                                    <input type="text" name="phone" :value="d.mobile"  v-model="d.mobile" placeholder="请输入手机号码">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">

                            <div class="item-inner">
                                <div class="item-title label">地址</div>
                                <div class="item-input">
                                    <input type="text" id='city-picker'  :data-value="d.province+' '+d.city+' '+d.area" placeholder="请输入地址"/>

                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="align-top">
                        <div class="item-content">

                            <div class="item-inner">
                                <div class="item-title label">详细地址</div>
                                <div class="item-input">
                                    <textarea placeholder="详细地址"  name="address" :value="d.address"  v-model="d.address" ></textarea>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                </form>
            </div>
            <!--新增-->
            <div class="flow-no-pro">
                <a type="button" href="javascript:;" @click="finished" class=" btn-submit">提交保存</a>
            </div>


    </div>

</div>