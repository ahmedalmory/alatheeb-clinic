<?php
$patient = App\Model\Patient::find($patient_id);
?>
{{ $patient->f_number }}
