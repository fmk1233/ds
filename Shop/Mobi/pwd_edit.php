
<!-- 账户充值 -->
<div class="page" id='pwd_edit' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back"><i class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>{{ title }}</span>
                </div>
            </div>
        </section>
    </header>
    <div class="content">
        <!--表单-->
        <div class="list-block">
            <ul>
                <p class="flow-jiesuan">原密码</p>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">原密码</div>
                            <div class="item-input">
                                <input type="password" :value="d.old_pass" v-model="d.old_pass"  placeholder="请输入原密码" >
                            </div>
                        </div>
                    </div>
                </li>
                <p class="flow-jiesuan">新密码</p>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">新密码</div>
                            <div class="item-input">
                                <input type="password" :value="d.password"  v-model="d.password"  placeholder="请输入新密码" >
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="item-content">
                        <div class="item-inner">
                            <div class="item-title label">确认新密码</div>
                            <div class="item-input">
                                <input type="password" :value="d.confirm_password"  v-model="d.confirm_password"  placeholder="请输入新密码" >
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <!--新增-->
        <div class="flow-no-pro">
            <a type="button" class="btn-submit" @click="finished" >修改</a>
        </div>

    </div>

</div>
