@extends('layouts.marketing')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-calendar-o"></i> Create a Conference/Event</h4>
                </div>

                <div class="panel-body">

                    @include('flash::message')

                    {!! BootForm::openHorizontal(['sm' => [4, 8], 'lg' => [2, 10]])->action(route('conferences.store')) !!}

                    {!! BootForm::text('Name', 'name') !!}

                    {!! BootForm::textarea('Description', 'description')->rows(3) !!}

                    {!! BootForm::text('Start Date', 'start_date')->addClass('datepicker') !!}

                    {!! BootForm::text('End Date', 'end_date')->addClass('datepicker') !!}

                    {!! BootForm::text('Open Date', 'open_date')->addClass('datepicker') !!}

                    {!! BootForm::text('Close Date', 'close_date')->addClass('datepicker') !!}

                    {!! BootForm::submit('Submit', 'btn-danger') !!}

                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$('.datepicker').datetimepicker({
    format: 'YYYY-MM-DD'
});
</script>
@endpush
