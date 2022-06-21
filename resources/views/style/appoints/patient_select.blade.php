<div class="row">
    <div class="col-md-12">
    <!--<select name="pat_id" id="pat_id" class="form-control">
            <option value="">اختر المريض</option>
            @foreach($patient AS $pat)
        <option value="{{ $pat->id }}">{{ $pat->first_name }} </option>
            @endforeach
        </select> -->

        <p class="col-md-6">
            <input
                type="text"
                placeholder="البحث برقم الملف ..."
                class="form-control"
                onchange="searchPatient('dossier')"
                id="dossier"
            />
        </p>

        <p class="col-md-6">
            <input
                type="text"
                placeholder="البحث برقم الهوية ..."
                class="form-control"
                onchange="searchPatient('number_id')"
                id="number_id"
            />
        </p>

        <p class="col-md-6">
            <input
                type="text"
                placeholder="البحث برقم الهاتف ..."
                class="form-control"
                onchange="searchPatient('phone')"
                id="phone"
            />
        </p>
        <p class="col-md-6">
            <select name="appoint_status_id" id="appoint_status_id" class="form-control">
                <option value="">اختر الحالة</option>
                <option value="4"> موكد</option>
                <option value="5"> غير موكد</option>
                <option value="1"> حضر</option>
                <option value="2"> في الانتظار</option>
                <option value="3"> تمت التشخيص</option>
            </select>
        </p>
        <p class="col-md-6">
            <select name="dep_id" id="patient_dep_id" class="form-control" onchange="get_doctors('#patient_dep_id')">
                <option value="">اختر العيادة</option>
                @foreach(\App\Models\Department::all() as $dep)
                    <option value="{{$dep->id}}">{{$dep->dep_name}}</option>
                @endforeach
            </select>
        </p>
        <p class="col-md-6">
            <select name="doc_id" id="doc_id" class="form-control">

            </select>
        </p>
        <br>


        <div
            class="alert alert-success"
            id="successMessage"
            style="display: none;
            margin-top: 125px;"
        ></div>

        <input type="number" value="" class="" name="pat_id" id="pat_id" hidden/>
    </div>

    <div class="col-md-12" style="text-align:center">
        <button
            type="button"
            class="btn btn-success"
            style="margin-top:10px"
            id="buttonConfirm"
            onclick="confirm_booking('<?php echo $time; ?>','<?php echo $clinic; ?>',
                '<?php echo $doctor; ?>','<?php echo $period; ?>','<?php echo $appoint_date; ?>')"
            disabled
        >
            حفظ

        </button>
    </div>
</div>

<script>
    function searchPatient(type) {
        if (type === "dossier") {
            var value = document.getElementById("dossier").value;
            document.getElementById("number_id").value = null;
            document.getElementById("phone").value = null;
        }
        if (type === "number_id") {
            var value = document.getElementById("number_id").value;
            document.getElementById("dossier").value = null;
            document.getElementById("phone").value = null;
        }
        if (type === "phone") {
            var value = document.getElementById("phone").value;
            document.getElementById("number_id").value = null;
            document.getElementById("phone").value = null;
        }

        $.ajax({
            url: '{{ url("/search/patient") }}',
            type: "get",
            dataType: "json",
            data: {type, value, _token: "{{ csrf_token() }}"},
            success: function (data) {
                if (data.ok) {
                    document.getElementById("successMessage").innerHTML =
                        data.message;
                    document.getElementById("successMessage").style.display =
                        "block";
                    document.getElementById("pat_id").value = data.data.id;
                    $("#buttonConfirm").prop("disabled", false);
                } else {
                    $.notify(data.message);
                    $("#buttonConfirm").prop("disabled", true);
                }
            }
        });
    }
</script>
