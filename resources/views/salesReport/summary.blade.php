@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-12 sale">
            <h3>Raporty</h3>
            <div class="card">
              <div class="card-body">
                <div class="report">
                <form action="/salesReport/repStat" method="POST">
                  @csrf
                  <div class="form-group repc">
                    <select name="reportType"class="custom-select">
                      <option value="1">Najpopularniejsze produkty</option>
                      <option value="2">Sprzedaż</option>
                      <option value="3">Aktywność pracowników</option>
                    </select>
                  </div>
                  <div class="form-group repa">
                     <div class="input-group date" id="from" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" name="from" placeholder="Data od:" data-target="from"/>
                          <div class="input-group-append" data-target="#from" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                    </div>
                </div>
              <div class="form-group repb">
                 <div class="input-group date" id="to" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" name="to" placeholder="Data do:" data-target="#to"/>
                      <div class="input-group-append" data-target="#to" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
              </div>
            <div class="form-group repd">
            <input class="btn btn-primary" type="submit" value="Generuj">
          </div>
            </form>
          </div>
        </div>
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
