@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-4 sale">
            <h4>Raporty</h4>
            <form action="/salesReport/saleStat" method="GET">
              <div class="form-group">
                <label>Data od: </label>
                 <div class="input-group date" id="from" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" name="from" data-target="from"/>
                      <div class="input-group-append" data-target="#from" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
              </div>

              <div class="form-group">
                 <label>Data do: </label>
                 <div class="input-group date" id="to" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" name="to" data-target="#to"/>
                      <div class="input-group-append" data-target="#to" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
              </div>
              <input class="btn btn-primary" type="submit" value="Generuj">
        </form>
      </div>
  </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#from').datetimepicker();
        $('#to').datetimepicker({
            useCurrent: false
        });
        $("#from").on("change.datetimepicker", function (e) {
            $('#to').datetimepicker('minDate', e.date);
        });
        $("#to").on("change.datetimepicker", function (e) {
            $('#from').datetimepicker('maxDate', e.date);
        });
    });
</script>
@endsection
