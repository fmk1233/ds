<div class="spec_item_item" style="float:left;margin:5px;width:250px; position: relative">
    <input type="hidden" class="form-control spec_item_show" name="spec_item_show_<?php echo $spec['id']; ?>[]"
           value="<?php echo $spec_item['show']; ?>"/>
    <input type="hidden" class="form-control spec_item_id" name="spec_item_id_<?php echo $spec['id']; ?>[]"
           value="<?php echo $spec_item['id']; ?>"/>

    <div class="input-group">
		<span class="input-group-addon">
			<input type="checkbox" <?php if ($spec_item['show'] == 1) echo 'checked'; ?> value="<?php echo $spec_item['show']; ?>"
                   onclick='showItem(this)'>
		</span>
        <input type="text" class="form-control spec_item_title" name="spec_item_title_<?php echo $spec['id']; ?>[]"
               VALUE="<?php echo $spec_item['title']; ?>"/>


        <span class="input-group-addon">
			<a href="javascript:;" onclick="removeSpecItem(this)" title='删除'><i class="fa fa-times"></i></a>
	  		<a href="javascript:;" class="fa fa-arrows" title="拖动调整显示顺序"></a>
		</span>
    </div>

</div>