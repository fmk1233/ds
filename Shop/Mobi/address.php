<!-- 收货人信息 -->
<div class="page" id='address' v-cloak="">

    <!--头部-->
    <header class="bar bar-nav bg-white">
        <section class="dttop-box">
            <div class="text-all dis-box j-text-all">
                <a class="a-icon-back j-close-search back"><i
                            class="icon icon-left is-left-font"></i></a>
                <div class="box-flex ect-header">
                    <span>收货人信息</span>
                </div>

            </div>
        </section>
    </header>
    <div class="bar bar-footer bg-white">
        <div class="flow-no-pro">
            <a type="button" href="#add_address"
               :data-info="JSON.stringify({id:0,province:0,city:0,area:0,realname:'',mobile:'',address:''})"
               class=" btn-submit" :data-from="from">新增收货地址</a>
        </div>
    </div>
    <div class="content infinite-scroll" data-distance="100">
        <!--收货信息-->
        <div class="m-top10 bg-white" v-for="(address ,index) in address_list"  @click="select(index,$event)">
            <div class="flow-set-adr of-hidden padding-all ">
                <div class="ect-select fl">
                    <label class="dis-box label-checkbox" style="background-color: #fff" v-if="address.is_default==1">
                        <div class="iradio_flat-red checked" style="position: relative;"><input type="radio" name="default" class="icheck_input" checked></div>
                        <span class="box-flex">默认</span>
                    </label>

                    <label class="dis-box label-checkbox" style="background-color: #fff" v-else-if="!from" @click.stop="setDefault(index)">
                        <div class="iradio_flat-red" style="position: relative;"><input type="radio" name="default" class="icheck_input"></div>
                        <span class="box-flex">设为默认</span>
                    </label>

                </div>
                <div class="flow-checkout-adr fr">
                    <a href="#add_address"  :data-info="JSON.stringify(address)" :data-from="from">
                        <i class="iconfont icon-edit col-9"></i>编辑
                    </a>
                    <span v-if="!from">
                        <a class="" @click.stop="delAddress(index)">
                            <i class="iconfont icon-delete col-9"></i>删除
                        </a>
                    </span>
                </div>
            </div>
            <div class="order-address">
                <div class="flow-have-adr padding-all" >
                    <div class="dis-box">
                        <div class="box-flex">
                            <p class="f-h-adr-title t-remark">
                                <label class="color-dark">{{ address.realname }}</label> <span class="color-money">{{ address.mobile }}</span>
                            </p>
                            <p class="f-h-adr-con t-remark m-top04">{{addressInfo(address)}} {{ address.address }}</p>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!--新增-->
        <div class="infinite-scroll-preloader" v-if="loading==1">
            <div class="preloader"></div>
        </div>
    </div>

</div>
