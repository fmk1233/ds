<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <a href="javascript:;" class="mui-btn mui-btn-link mui-pull-right" @click="finished" >完成</a>
    <h1 class="mui-center mui-title">申请会员</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <form onsubmit="return false">
                <div class="ui-list-title">注册新会员 （打<span class="ui-text-danger">*</span>号为必填项）</div>
                <input type="hidden" :value="d.sex" name="sex"/>
                <input type="hidden" :value="d.pos" name="pos"/>
                <input type="hidden" :value="d.province" name="province"/>
                <input type="hidden" :value="d.city" name="city"/>
                <input type="hidden" :value="d.area" name="area"/>
                <input type="hidden" :value="d.rank" name="rank"/>
                <input type="hidden" value="User.Register" name="service"/>
                <ul class="mui-input-group">
                    <li class="mui-input-row">
                        <label>会员编号<span class="ui-text-danger">*</span></label>
                        <input type="text" readonly name="username" placeholder="请输入内容" v-model="d.user_name"  :value="d.user_name">
                    </li>
                    <li class="mui-input-row">
                        <label>会员姓名<span class="ui-text-danger">*</span></label>
                        <input type="text" name="realname" placeholder="请输入内容">
                    </li>

                </ul>
                <div class="ui-list-title">默认为密码：123456</div>
                <ul class="mui-input-group">
                    <li class="mui-input-row mui-password">
                        <label>一级密码<span class="ui-text-danger">*</span></label><input value="123456"
                                                                                       type="password" name="password"
                                                                                       class="mui-input-password"
                                                                                       placeholder="请输入新密码">
                    </li>
                    <li class="mui-input-row mui-password">
                        <label>重复密码<span class="ui-text-danger">*</span></label><input value="123456"
                                                                                       type="password" name="repassword"
                                                                                       class="mui-input-password"
                                                                                       placeholder="请输入新密码">
                    </li>
                    <li class="mui-input-row mui-password">
                        <label>二级密码<span class="ui-text-danger">*</span></label><input value="123456"
                                                                                       type="password" name="password2"
                                                                                       class="mui-input-password"
                                                                                       placeholder="请输入新密码">
                    </li>
                    <li class="mui-input-row mui-password">
                        <label>重复密码<span class="ui-text-danger">*</span></label><input value="123456"
                                                                                       type="password" name="repassword2"
                                                                                       class="mui-input-password"
                                                                                       placeholder="请输入新密码">
                    </li>
                </ul>
                <ul class="mui-input-group">
                    <li class="mui-input-row">
                        <label>推荐编号<span class="ui-text-danger">*</span></label>
                        <input type="text" :value="d.user_pid" name="p_user_name" v-model="d.user_pid"    placeholder="请输入内容">
                    </li>
                    <li class="mui-input-row">
                        <label>接点编号<span class="ui-text-danger">*</span></label>
                        <input type="text" :value="d.user_rid" name="r_user_name"   v-model="d.user_rid" placeholder="请输入内容">
                    </li>
                    <li class="mui-input-row" id='Position'>
                        <label>市场位置<span class="ui-text-danger">*</span></label>
                        <div class="ui-option mui-navigate-right" id='PositionTxt'><span>{{pos_name}}</span></div>
                    </li>
                    <li class="mui-input-row" id='NTorank'>
                        <label>会员级别<span class="ui-text-danger">*</span></label>
                        <div class="ui-option mui-navigate-right"><span>{{rank_name}}</span></div>
                    </li>
                </ul>
                <div class="ui-list-title">账号信息注册</div>
                <ul class="mui-input-group">
                    <li class="mui-input-row" id="sexs">
                        <label>性别</label>
                        <div class="ui-option mui-navigate-right" ><span>{{sex_name}}</span></div>
                    </li>
                    <li class="mui-input-row" id="showCityPicker">
                        <label>省市区<span class="ui-text-danger">*</span></label>
                        <div class="ui-option mui-navigate-right" ><span>{{address}}</span></div>
                    </li>
                    <li class="mui-input-row">
                        <label>手机号码</label>
                        <input type="text" name="phone" placeholder="请输入内容">
                    </li>
                    <li class="mui-input-row" v-if="d.can_bd">
                        <label>报单中心</label>
                        <input type="text" name="zmdname" placeholder="请输入内容">
                    </li>
                </ul>


            </form>


        </div>
    </div>
</div>