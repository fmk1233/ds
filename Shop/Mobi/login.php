<!-- 登录 -->
<div class="page" id='login' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-default color-whie">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back"><i class="icon icon-left is-left-font color-whie"></i></a>
                <div class="box-flex ect-header">
                    <span>登录</span>
                </div>
                <a href="#index" class="a-sequence j-a-sequence"><i class="iconfont icon-shouye color-whie"
                                                                    data="1"></i></a>
            </div>
        </section>
    </header>
    <div class="content bg-white">
        <!--表单-->
        <form onsubmit="return false;">
            <div class="list-block login-block">
                <input type="hidden" value="Default.DoLogin" name="service"/>
                <ul>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <i class="iconfont icon-account col-8"></i>
                                <div class="item-input">
                                    <input type="text" name="username" placeholder="用户名/手机号">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <i class="iconfont icon-suo col-8"></i>
                                <div class="item-input">
                                    <input type="password" name="password" class="login-password" placeholder="请输入密码">
                                </div>
                                <label class="login-switch label-switch">
                                    <input type="checkbox">
                                    <div class="checkbox"></div>
                                </label>
                            </div>
                        </div>

                    </li>

                </ul>
            </div>
            <div class="padding-all login-checkbox">
                        <div class="icheckbox_flat-red" :class="{checked:remember}" style="position: relative;">
                            <input type="checkbox" name="remember" v-model="remember" value="1" class="icheck_input"/>
                        </div>
                        <label>记住本次登录</label>
            </div>
        </form>


        <!--新增-->
        <div class="flow-no-pro">
            <a type="button" @click="login" class="btn-submit">立即登录</a>
        </div>
        <!--<div class="login-info text-right padding-all">
            <a href="get_password.html">忘记密码</a>
            <a href="register.html">免费注册</a>
        </p>-->


    </div>

</div>
