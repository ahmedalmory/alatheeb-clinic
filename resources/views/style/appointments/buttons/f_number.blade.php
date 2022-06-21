<?php
$patient = App\Models\Patient::find($patient_id);
?>
{{ $patient->f_number }}
