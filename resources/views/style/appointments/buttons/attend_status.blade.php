<span class="label
{{ $attend_status=='pending'?'label-warning':'' }}
{{ $attend_status=='confirmed'?'label-success':'' }}
{{ $attend_status=='attend'?'label-success':'' }}
{{ $attend_status=='unattended'?'label-danger':'' }}
">
{{ trans('admin.'.$attend_status) }}
</span>
