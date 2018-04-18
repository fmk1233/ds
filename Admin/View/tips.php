<div class="explanation" id="explanation" style="width: 100px; height: 40px;margin-top: 10px">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
        <h4 title="提示相关信息操作是应注意的要点" data-toggle="tooltip" data-placement="bottom">操作提示</h4>
        <span id="explanationZoom" style="display: none;" title="操作提示"></span>
    </div>
    <ul>
        <?php if(isset($tips)): foreach ($tips as $tip): ?>
            <li><?php echo $tip; ?></li>
        <?php endforeach;endif; ?>
    </ul>
</div>
