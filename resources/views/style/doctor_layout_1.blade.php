<h5 style="margin-top: 20px !important;">{{trans('admin.patients')}}</h5>
<div class="tab">
  <button class="tablinks1" id="add_count" onclick="openCity2(event, 'mawjoodon')">{{trans('admin.Available')}}   </button>

  <button class="tablinks1" onclick="openCity2(event, 'mawaeed')">{{trans("admin.Today's dates")}}  <span>{{$appoints_waiting->count()}}</span> </button>

</div>
<div id="mawjoodon" class="tabcontent1">
 <?php
 foreach ($appoints as $item) { ?>
 <li>
 <a onclick="get_detail('<?=$item->patient_id?>','<?=$item->id?>')">  {{get_status($item->appoint_status)}} : {{patient_name($item->patient_id)}} -- (<?=$item->in_time?>) </a>
   <?php
	 }
	 ?>
	 </li>
</div>
<script>
    var count_li = document.querySelectorAll("#mawjoodon li").length;
     document.getElementById("add_count").innerHTML+= count_li;

</script>
<div id="mawaeed" class="tabcontent1">
   <?php
 foreach ($appoints_waiting as $item) { ?>
 <li>
 <a onclick="get_detail('<?=$item->patient_id?>','<?=$item->id?>')">  {{get_status($item->appoint_status)}} : {{patient_name($item->patient_id)}} -- (<?=$item->in_time?>) </a>
   </li>
   <?php
	 }
	 ?>
</div>
