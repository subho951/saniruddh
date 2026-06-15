<?php
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductVariation;
use App\Models\VariationAttribute;
use App\Helpers\Helper;

$parentAttrs = [];
if(!empty($attributes)){
    for($a=0;$a<count($attributes);$a++){
        $attr           = explode("/", $attributes['attribute' . ($a + 1)][0]);
        $attr_id        = $attr[0];
        $getAttr        = Attribute::select('name')->where('id', '=', $attr_id)->first();
        $attr_name      = (($getAttr)?$getAttr->name:'');
        $parentAttrs[]   = [
            'attr_id'       => $attr_id,
            'attr_name'     => $attr_name,
        ];
    }
}
$attr_count         = count($parentAttrs);
$variation_sku      = [];
$variation_qty      = [];
$getVariationDatas = ProductVariation::select('sku', 'qty')->where('product_id', '=', $product_id)->get();
if($getVariationDatas){
    foreach($getVariationDatas as $getVariationData){
        $variation_sku[]      = $getVariationData->sku;
        $variation_qty[]      = $getVariationData->qty;
    }
}
?>
<input type="hidden" name="attr_count" value="<?=$attr_count?>">
<?php if(!empty($variations)){?>
    <table class="table">
        <thead>
        <tr>
            <!-- <th><input type="checkbox" id="checkAllVariation"></th> -->
            <?php if($parentAttrs){ foreach($parentAttrs as $parentAttr){?>
                <th><?=$parentAttr['attr_name']?></th>
            <?php } }?>
            <th>SKU</th>
            <th>Qty</th>
            <th>Visible</th>
        </tr>
        </thead>
        <tbody>
            <?php if(!empty($variations)){ for($v=0;$v<count($variations);$v++){?>
                <tr>
                    <!-- <td>
                        <input type="checkbox" id="checkAllVariation">
                    </td> -->
                    <?php
                    $variationData = $variations[$v];
                    if(!empty($variationData)){
                        for($a=0;$a<count($variationData);$a++){
                            $attrVal            = explode("/", $variationData['attribute' . ($a + 1)]);
                            $attr_val_id        = $attrVal[1];
                            $getAttrVal         = AttributeValue::select('attr_value')->where('id', '=', $attr_val_id)->first();
                            $attr_val_name          = (($getAttrVal)?$getAttrVal->attr_value:'');
                    ?>
                        <td>
                            <?=$attr_val_name?>
                            <input type="hidden" name="attribute_id<?=($a + 1)?>[]" value="<?=$attr_val_id?>" class="form-control">
                            <input type="hidden" name="value_id<?=($a + 1)?>[]" value="<?=$attr_val_name?>" class="form-control">
                        </td>
                    <?php } }?>
                    <?php
                    if($product_id == 0){
                        $sku    = $product_sku;
                        $qty    = $product_qty;
                    } else {
                        $sku    = ((count($variation_sku) > 0)?$variation_sku[$v]:$product_sku);
                        $qty    = ((count($variation_qty) > 0)?$variation_qty[$v]:$product_qty);
                    }
                    ?>
                    <td>
                        <input type="text" name="variationSKU[]" class="form-control" value="<?=$sku?>" required>
                    </td>
                    <td>
                        <input type="text" name="variationQTY[]" class="form-control" value="<?=$qty?>" required>
                    </td>
                    <td>
                        <div class="form-check form-switch form-switch-lg">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_visible" name="is_visible<?=($v)?>" checked>
                        </div>
                    </td>
                </tr>
            <?php } }?>
        </tbody>
    </table>
<?php }?>
