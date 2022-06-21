<?php
$patient = App\Models\Patient::find($patient_id);
?>
{{ $patient->first_name }} {{ $patient->father_name }} {{ $patient->grand_name }}
