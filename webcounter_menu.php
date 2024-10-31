<?php 
if(isset($_REQUEST['countercount'])){ 
$wpdb->query("UPDATE ".$wpdb->prefix."mwc_counter SET mwc_disp='".$_REQUEST['counterdisplay']."', mwc_align='".$_REQUEST['counteralign']."', mwc_withzeros='".$_REQUEST['counterzeros']."', mwc_count='".$_REQUEST['countercount']."', mwc_unique='".$_REQUEST['counterunique']."', mwc_cat='".$_REQUEST['mwc_cat']."', mwc_sub='".$_REQUEST['mwc_sub']."', mwc_displayat='".$_REQUEST['mwc_displayat']."', mwc_showlinks='".$_REQUEST['mwc_showlinks']."'");

?> <div id="message" class="updated fade">WebCounter Stats <strong>Updated</strong>.</div> <?php } ?>
<div class="wrap">
<h2>WebCounter Admin</h2>
<form method="post" action="options-general.php?page=<?php echo $_GET['page']; ?>">
<?php
$results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."mwc_counter");
foreach($results as $result)
{
?>
<table class="form-table">
	<tr valign="top">
    	<th scope="row" align="right">Set Counter To:</th>
        <td align="left"><input type="text" name="countercount" value="<?php echo $result->mwc_count; ?>" /></td>
    </tr>
    
	<tr valign="top">
    	<th scope="row" align="right">Display Web Counter:</th>
        <td align="left"><input type="checkbox" value="1" name="counterdisplay" <?php if($result->mwc_disp==1){echo "checked='checked'" ;} ?> /></td>
    </tr>
    
    
	<tr valign="top">
    	<th scope="row" align="right">Show Links?</th>
        <td align="left"><input value="1" type="checkbox" name="mwc_showlinks" <?php if($result->mwc_withzeros==1){echo "checked='checked'" ;} ?> />
        <br />
        <sup>Make sure this checkbox is always check as this is required for plugins to run</sup></td>
    </tr>
    
    
	<tr valign="top">
    	<th scope="row" align="right">Display Web Counter at:</th>
        <td align="left">
        <select name="mwc_displayat">
        	<option <?php if($result->mwc_displayat==0){echo "selected='selected'" ;} ?> value="0">footer</option>
            <option <?php if($result->mwc_displayat==1){echo "selected='selected'" ;} ?> value="1">Sidebar-meta</option>
            <option <?php if($result->mwc_displayat==2){echo "selected='selected'" ;} ?> value="2">Sidebar-Categories</option>
        </select>
        </td>
    </tr>
    
	<tr valign="top">
    	<th scope="row" align="right">Counter Alignment:</th>
        <td align="left">
        <select name="counteralign">
        	<option <?php if($result->mwc_align==0){echo "selected='selected'" ;} ?> value="0">Center</option>
            <option <?php if($result->mwc_align==1){echo "selected='selected'" ;} ?> value="1">Left</option>
            <option <?php if($result->mwc_align==2){echo "selected='selected'" ;} ?> value="2">Right</option>
        </select>
        </td>
    </tr>
    
    
	<tr valign="top">
    	<th scope="row" align="right">Pad with zeros:</th>
        <td align="left"><input value="1" type="checkbox" name="counterzeros" <?php if($result->mwc_withzeros==1){echo "checked='checked'" ;} ?> /></td>
    </tr>
    
    
	<tr valign="top">
    	<th scope="row" align="right">Count only unique visitors:</th>
        <td align="left"><input value="1" type="checkbox" name="counterunique" <?php if($result->mwc_unique==1){echo "checked='checked'" ;} ?> /></td>
    </tr>
    
	<tr valign="top">
    	<th scope="row" align="right">Selected Style:</th>
        <td align="left"><input type="hidden" name="mwc_sub" id="271987" value="<?php echo $result->mwc_sub; ?>" /><img src="http://www.mywebcounter.com/counter/<?php echo $result->mwc_sub; ?>/index.gif" alt="web counter style" title="web counter style" /></td>
    </tr>
    
</table>
<?php
}
?>


<h3>Counter Styles</h3>
<select name="mwc_cat" onchange="showstyles(this.value)">
	<option <?php if($result->mwc_cat==1){echo "selected='selected'" ;} ?> value="1">Animals and Pets</option>
    <option <?php if($result->mwc_cat==2){echo "selected='selected'" ;} ?> value="2">Any Color</option>
    <option <?php if($result->mwc_cat==3){echo "selected='selected'" ;} ?> value="3">Any Size</option>
    <option <?php if($result->mwc_cat==4){echo "selected='selected'" ;} ?> value="4">Artistic</option>
    <option <?php if($result->mwc_cat==5){echo "selected='selected'" ;} ?> value="5">Colorful</option>
	<option <?php if($result->mwc_cat==6){echo "selected='selected'" ;} ?> value="6">Cool</option>
    <option <?php if($result->mwc_cat==7){echo "selected='selected'" ;} ?> value="7">Cute</option>
    <option <?php if($result->mwc_cat==8){echo "selected='selected'" ;} ?> value="8">Flags and Politics</option>
    <option <?php if($result->mwc_cat==9){echo "selected='selected'" ;} ?> value="9">Small</option>
    <option <?php if($result->mwc_cat==10){echo "selected='selected'" ;} ?> value="10">Fonted</option>
	<option <?php if($result->mwc_cat==11){echo "selected='selected'" ;} ?> value="11">Glowing</option>
    <option <?php if($result->mwc_cat==12){echo "selected='selected'" ;} ?> value="12">Hand Made</option>
    <option <?php if($result->mwc_cat==13){echo "selected='selected'" ;} ?> value="13">Apple</option>
    <option <?php if($result->mwc_cat==14){echo "selected='selected'" ;} ?> value="14">Buttons</option>
    <option <?php if($result->mwc_cat==15){echo "selected='selected'" ;} ?> value="15">LCD</option>
	<option <?php if($result->mwc_cat==16){echo "selected='selected'" ;} ?> value="16">Odometers</option>
    <option <?php if($result->mwc_cat==17){echo "selected='selected'" ;} ?> value="17">Mix Color</option>
    <option <?php if($result->mwc_cat==18){echo "selected='selected'" ;} ?> value="18">Religious</option>
    <option <?php if($result->mwc_cat==19){echo "selected='selected'" ;} ?> value="19">Mix Design</option>
    <option <?php if($result->mwc_cat==20){echo "selected='selected'" ;} ?> value="20">Nature</option>
	<option <?php if($result->mwc_cat==21){echo "selected='selected'" ;} ?> value="21">Colored Zodiac</option>
    <option <?php if($result->mwc_cat==22){echo "selected='selected'" ;} ?> value="22">Techy</option>
    <option <?php if($result->mwc_cat==23){echo "selected='selected'" ;} ?> value="23">Travel</option>
    <option <?php if($result->mwc_cat==24){echo "selected='selected'" ;} ?> value="24">Dark Zodiac</option>
</select>

<div id="wpdbstyles" style="width:80%; height:500px; overflow:scroll; padding-left:10px; padding-bottom:10px; padding-top:10px; border:1px solid #003366; background:#EBF8FE;">

</div>

        <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
</form>
</div>


<script>
function showstyles(id){
var folderimg;
var imgcount;
var lamans;
  switch (id)
  {
	case "1": folderimg="AP";imgcount=32;break
	case "2": folderimg="AC";imgcount=44;break
	case "3": folderimg="AS";imgcount=44;break
	case "4": folderimg="AR";imgcount=32;break
	case "5": folderimg="CL";imgcount=24;break
	case "6": folderimg="CO";imgcount=32;break
	case "7": folderimg="CU";imgcount=44;break
	case "8": folderimg="FL";imgcount=11;break
	case "9": folderimg="SM";imgcount=20;break
	case "10": folderimg="FO";imgcount=46;break
	case "11": folderimg="GL";imgcount=32;break
	case "12": folderimg="HM";imgcount=40;break
	case "13": folderimg="APP";imgcount=24;break
	case "14": folderimg="BU";imgcount=31;break
	case "15": folderimg="LCD";imgcount=32;break
	case "16": folderimg="OD";imgcount=12;break
	case "17": folderimg="MC";imgcount=32;break
	case "18": folderimg="RE";imgcount=14;break
	case "19": folderimg="MX";imgcount=39;break
	case "20": folderimg="NA";imgcount=9;break
	case "21": folderimg="CZ";imgcount=96;break
	case "22": folderimg="TE";imgcount=5;break
	case "23": folderimg="TR";imgcount=3;break
	case "24": folderimg="DZ";imgcount=48;break
  }
 var newcount = parseInt(imgcount);
 lamans = "<table cellspacing='2' cellpadding='3'>";
 for (i=1;i<=newcount;i++){
	var selfol = folderimg+i;
	var selec = "";
	if(selfol=="<?php echo $result->mwc_sub; ?>"){selec = "checked='checked'";}
	lamans = lamans+"<tr><td><input type='radio' onclick='document.getElementById(271987).value=this.value;' name='mwc_sub2' "+selec+" id='mwc_sub2' value='"+folderimg+i+"' /></td><td><img src='http://www.mywebcounter.com/counter/"+folderimg+i+"/index.gif' /></td></tr>";
}
 lamans = lamans+"<table>";
 document.getElementById('wpdbstyles').innerHTML=lamans;

}

showstyles("<?php echo $result->mwc_cat; ?>")
</script>
