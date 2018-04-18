<style>
    .footer{background-color: rgba(225,225,225,0.1); color: #98a1b3; border-top: rgba(0,0,0,0.2);position: fixed;}
    .l-bgw{ margin-bottom: 40px;}
</style>

<div class="footer">
    <div class="pull-right">
        <strong><?php echo T('title'); ?></strong>
    </div>
    <div>
        <?php echo DI()->config->get('sys_setting.copyright'); ?>
    </div>
</div>