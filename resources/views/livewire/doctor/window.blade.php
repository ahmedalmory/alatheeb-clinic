<div>
    {{-- Be like water. --}}
    <div class="row">
        <div class="col-md-12">
            @php
                $doc_id = auth()->id();
                $appoints =  doctor()->todayAppointments();
                $appoints_waiting = doctor()->waitingAppointments();
            @endphp
            <div class="col-md-4" id="layout_1">
                <h5 style="margin-top: 20px !important;">{{trans('admin.patients')}}</h5>
                <div class="tab">
                    <button class="tablinks1" wire:click="$set('appointments_type','today')" > مواعيد اليوم  <span>{{$appoints->count()}}</span>  </button>

                    <button class="tablinks1"  wire:click="$set('appointments_type','waiting')" >مرضي بالانتظار  <span>{{$appoints_waiting->count()}}</span> </button>

                </div>

                <div id="mawjoodon" class="tabcontent1">
                    @switch($appointments_type)
                        @case('waiting')
                        @forelse($appoints_waiting as $item)
                            <li>
                                <a onclick="get_detail('<?=$item->patient_id?>','<?=$item->id?>')">  {{get_status($item->appoint_status)}} : {{$item->patient->name}} -- (<?=$item->in_time?>) </a>
                            </li>
                        @empty
                            <h4>
                                لا يوجد
                            </h4>
                        @endforelse
                        @break
                        @case('today')
                        @forelse($appoints as $item)
                            <li>
                                <a onclick="get_detail('<?=$item->patient_id?>','<?=$item->id?>')">  {{get_status($item->appoint_status)}} : {{$item->patient->name}} -- (<?=$item->in_time?>) </a>
                            </li>
                        @empty
                                <h4>
                                    لا يوجد
                                </h4>
                        @endforelse
                        @break
                    @endswitch

                </div>

            </div>
            <div class="col-md-8" id="pat_detail">
                <h5 style="margin-top: 20px !important;">{{trans('admin.patient_name')}}: </h5>
                <div class="tab">
                    <button class="tablinks"
                            onclick="openCity(event, 'tashkhees')">{{trans('admin.Current diagnosis')}}</button>
                    <button class="tablinks"
                            onclick="openCity(event, 'isdar')">{{trans('admin.Issuing an invoice')}}</button>
                    <button class="tablinks"
                            onclick="openCity(event, 'bayanat')">{{trans('admin.Patient data')}}</button>
                    <button class="tablinks"
                            onclick="openCity(event, 'sabiqa')">{{trans('admin.previous diagnoses')}}</button>
                    <button class="tablinks"
                            onclick="openCity(event, 'tahveel')">{{trans('admin.Transfer the patient')}}</button>
                </div>

                <div id="tashkhees" class="tabcontent">
                    <h3>{{trans('admin.Please_click_on_the_patients_name')}} </h3>

                </div>

                <div id="isdar" class="tabcontent">
                    <h3>{{trans('admin.Please_click_on_the_patients_name')}} </h3>

                </div>

                <div id="bayanat" class="tabcontent">
                    <h3>{{trans('admin.Please_click_on_the_patients_name')}}  </h3>

                </div>
                <div id="sabiqa" class="tabcontent">
                    <h3>{{trans('admin.Please_click_on_the_patients_name')}}  </h3>

                </div>
                <div id="tahveel" class="tabcontent">
                    <h3>{{trans('admin.Please_click_on_the_patients_name')}}  </h3>

                </div>


            </div><!-- end div 8 -->
        </div><!-- end content -->
    </div><!-- end block4 -->
</div>
