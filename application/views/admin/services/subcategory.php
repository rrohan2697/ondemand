<option value="">Select Sub Category</option>
<?php
   if(!empty($subcategorys)){
    foreach($subcategorys as $subcategory){
?>
<option value="<?php echo $subcategory['id'];?>"><?php echo $subcategory['subcategory_name'];?></option>
<?php
    }}
    else{
    	echo 'No Sub Category';
    }
?>