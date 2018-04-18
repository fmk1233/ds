<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <a href="javascript:;"  class="mui-btn mui-btn-link mui-pull-right" @click="finished">完成</a>
    <h1 class="mui-center mui-title">修改资料</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <form onsubmit="return false">
                <input type="hidden" :value="d.sex" name="sex"/>
                <input type="hidden" :value="d.province" name="province"/>
                <input type="hidden" :value="d.city" name="city"/>
                <input type="hidden" :value="d.area" name="area"/>
                <input type="hidden" value="User.DoUserInfo" name="service"/>
                <div class="ui-list-title">基本资料</div>
                <ul class="mui-input-group">
                    <li class="mui-input-row">
                        <label>会员编号</label>
                        <div class="ui-option">{{d.user_name}}</div>
                    </li>
                    <li class="mui-input-row" id="sex">
                        <label>性别</label>
                        <div class="ui-option mui-navigate-right" id='sex_txt'><span>{{d.sex_name}}</span></div>
                    </li>
                    <li class="mui-input-row" id="diqu">
                        <label>省市区</label>
                        <div class="ui-option mui-navigate-right" id='diqu_txt'><span>{{address(d.province,d.city,d.area)}}</span></div>
                    </li>
                </ul>
                <div class="ui-list-title">银行信息</div>
                <ul class="mui-input-group">
                    <li class="mui-input-row">
                        <label>开户银行</label>
                        <input type="text" name="name" :value="d.bank_name" v-model="d.bank_name"  placeholder="请输入内容">
                    </li>
                    <li class="mui-input-row">
                        <label>银行卡号</label>
                        <input type="text" name="no" :value="d.bank_no"  v-model="d.bank_no"  placeholder="请输入内容">
                    </li>
                    <li class="mui-input-row">
                        <label>开户姓名</label>
                        <input type="text" name="user" :value="d.bank_user"  v-model="d.bank_user" placeholder="请输入内容">
                    </li>
                    <li class="mui-input-row">
                        <label>银行地址</label>
                        <input type="text" name="address" :value="d.bank_address" v-model="d.bank_address" placeholder="请输入内容">
                    </li>
                </ul>
                <div class="ui-list-title">联系方式</div>
                <ul class="mui-input-group">
                    <li class="mui-input-row">
                        <label>手机号码</label>
                        <div class="ui-option">{{d.mobile}}</div>
                    </li>
                </ul>


            </form>


        </div>
    </div>
</div>