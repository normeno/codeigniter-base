<div class="alert alert-danger">
    <strong>Whoops!</strong> Some Problems<br><br>
    <ul>
        @if(validation_errors())
            {!! validation_errors() !!}
        @endif
    </ul>
    @if(isset($errors))
        {!! $errors !!}
    @endif
</div>