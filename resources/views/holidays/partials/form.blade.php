<div class="row">
    <div class="col-md-8 col-sm-8">
        <div class="form-group">
            {{ Form::label('name', '*Holiday Name:') }}
            {{ Form::text('name', $holiday->name, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3 col-sm-4">
        {{ Form::label('holiday_date', '*Holiday Date:') }}
        <div class="input-group">
            {{ Form::text('holiday_date', date('Y-m-d'), ['class' => 'form-control', 'readonly' => 'readonly']) }}
            <div class="input-group-append">
                <label for="holiday_date" class="input-group-text">
                    <i class="fas fa-calendar"></i>
                </label>
            </div>

        </div>
    </div>
</div>