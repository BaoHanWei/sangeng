<?php if (!defined('THINK_PATH')) exit();?><select class="form-control" name="province" id="J_province"></select>
<select class="form-control"  name="city" id="J_city" style="display:none;"></select>
<select class="form-control"  name="district" id="J_district" style="display:none;"></select>

<script type="text/javascript">



$(function(){
	var pid=<?php if($param["province"] != ''): echo ($param["province"]); else: ?>0<?php endif; ?>;  //默认省份id
	var cid=<?php if($param["city"] != ''): echo ($param["city"]); else: ?>0<?php endif; ?>;  //默认城市id
	var did=<?php if($param["district"] != ''): echo ($param["district"]); else: ?>0<?php endif; ?>;  //默认区县市id

    /*修复联动不及时的bug，陈一枭*/
function change_province(pid){
        $.post("<?php echo addons_url('ChinaCity://ChinaCity/getProvince');?>", {pid: pid}, function(result){
            $("#J_province").html(result);
        });
    }

function change_city(p_pid,p_cid){
    $.post('<?php echo addons_url("ChinaCity://ChinaCity/getCity");?>', {pid: p_pid, cid: p_cid}, function(result){
        $("#J_city").show().html(result);
    });

}
function change_district(p_cid,p_did){
    $.post('<?php echo addons_url("ChinaCity://ChinaCity/getDistrict");?>', {cid: p_cid, did: p_did}, function(result){
        $("#J_district").show().html(result);
    });
}

    change_province(pid);
    change_city(pid,cid);
    change_district(cid,did);


	$('#J_province').change(function(){
		var pid_g=$(this).children('option:selected').val();
		change_city(pid_g)
        change_district(0);

	});

	$('#J_city').change(function(){
		var cid_g=$(this).children('option:selected').val();
		change_district(cid_g)


	});

	$('#J_district').change(function(){
		var did_g=$(this).children('option:selected').val();
	});

});
/*修复联动不及时的bug，陈一枭end*/
</script>