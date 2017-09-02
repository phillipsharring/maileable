{{-- copy this view to your app if you want to use this filter --}}
{{-- we don't publish it because it's just an example --}}
<p style="color: #999; border-top: 1px solid #666; margin-top: 20px;">
  <small>
    This notification email was sent to the following addresses: {{ implode($tos->keys()->toArray(), ', ') }}.
    To be removed, please contact contact@mycompany.com.
  </small>
</p>
