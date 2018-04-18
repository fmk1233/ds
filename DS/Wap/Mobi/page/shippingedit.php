<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <a href="javascript:;" class="mui-btn mui-btn-link mui-pull-right" @click="finished">完成</a>
    <h1 class="mui-center mui-title">修改收货信息</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <form onsubmit="return false">
                <input type="hidden" value="User.DoAddress" name="service"/>
                <input type="hidden" :value="d.province" name="province"/>
                <input type="hidden" :value="d.city" name="city"/>
                <input type="hidden" :value="d.area" name="area"/>
                <input type="hidden" :value="d.id" name="addressid"/>
                <div class="ui-list-title">修改信息</div>
                <ul class="mui-input-group">
                    <li class="mui-input-row">
                        <label>收货人</label>
                        <input type="text" placeholder="请输入收货人" v-model="d.realname"  name="realname" :value="d.realname">
                    </li>
                    <li class="mui-input-row" id='showCityPicker3'>
                        <label>收货地址</label>
                        <div class="ui-option mui-navigate-right"  id='cityResult3'><span>{{address(d)}}</span></div>
                    </li>
                    <li class="mui-input-row">
                        <label>详细地址</label>
                        <input type="text" name="address" v-model="d.address" :value="d.address" placeholder="请输入详细地址">
                    </li>
                    <li class="mui-input-row">
                        <label>手机号码</label>
                        <input type="text" name="phone" :value="d.mobile"  v-model="d.mobile"  placeholder="请输入手机号码">
                    </li>
                </ul>
            </form>

        </div>
    </div>
</div>