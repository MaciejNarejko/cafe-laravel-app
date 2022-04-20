@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <div class="container-fluid order">
    <div class="row">
      <div class="col-12 col-lg-7">
        <div class="card tab">
          <div class="card-header">
            Wolne stoliki

          </div>
          <div class="card-body tab">
            <div class="tables text-center">
            </div>
          </div>
        </div>

        <!--- Collapse  --->
        <div class="col-12" id="accordion">
          @foreach ($categories as $allCategories)
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link item" data-toggle="collapse" data-target="#collapse{{$allCategories->id}}" aria-expanded="true" aria-controls="collapseOne" data-id="{{$allCategories->id}}">
          {{$allCategories->name}}
        </button>
      </h5>
    </div>
    <div id="collapse{{$allCategories->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <div  class="row types">
        </div>
      </div>
    </div>
  </div>
  @endforeach
    </div>
    </div>
    <div class="col-12 col-lg-5">
      <div class="card">
      <div class="card-header selected-table">
        <h4> Stolik:</h4>
      </div>
      <div class="card-body" id="information">
      </div>
    </div>
    </div>
  </div>
  <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Szczegóły</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body order">
      </div>
      <div class="modal-footer" id="confirmation">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Wróć</button>
        <button type="button" class="btn btn-primary confirm" data-dismiss="modal">Potwierdź</button>
      </div>
    </div>
  </div>
</div>


  <script>
  $(document).ready(function(){
    $.get("/orders/showTables", function(data){
      $("div.tables").html(data);
  })});


  $(".item").click(function(){
    $.get("/orders/typesWithCategory/"+$(this).data("id"),function(data){
      $("div.types").hide();
      $("div.types").html(data);
      $("div.types").fadeIn('fast');

});
  })
  let IdTable = "";
  let TableName = "";
  let Type ="";

  $(".card-body.tab").on("click",".btn.tab",function(){
     IdTable = $(this).data("id");
     TableName = $(this).attr("name");
    $(".selected-table").html('<h4>Stolik: '+TableName +'</h4>')
    $.get("orders/displayOrderPositions/"+IdTable,function(data){
      $("#information").html(data);
    })
  })

  $(".row.types").on("click",".btn-link",function(){
    if (IdTable ==""){
      $("div.modal-body.order").html("Nie wybrano stołu dla którego przyjmujesz zamówienie");
    }
    else {
      Type = $(this).data("id");
      $.get("/orders/getMenuSizes/"+Type,function(data){
        $("div.modal-body.order").html(data);
    })}
  });

  $("#confirmation").on("click",".confirm",function(){
    let quantity = $("#inputQuantity").val();
    let idItem = $("#itemFormControlSelect1").val();
    $.ajax({
      type: "post",
      url: "/orders/buyItem" ,
      data: {
        "_token" : $('meta[name="csrf-token"]').attr('content'),
        "id_type": Type,
        "id_item": idItem,
        "id_table": IdTable,
        "quantity": quantity
      },
      success: function(data){
        $("#information").html(data);
        $( "#" + TableName ).addClass( "btn-warning" );
        $( "#" + TableName ).removeClass( "btn-success" );
      }
    });
  })

  $("#information").on("click",'.position',function(){
    let IdPosition = $(this).data("id");
    $.ajax({
      type: "post",
      url: "/orders/cancelPosition",
      data: {
        "_token" : $('meta[name="csrf-token"]').attr('content'),
        "IdPosition" : IdPosition
      },
      success: function(data){
        $("#information").html(data);
      }
    })
  })
  $("#information").on("click",'.pay',function(){
    let idOrder = $(this).data("id");
    let paymentMethod = $("#method").val();
    $.ajax({
      type: "post",
      url: "/orders/getBill",
      data: {
        "_token" : $('meta[name="csrf-token"]').attr('content'),
        "idOrder" : idOrder,
        "paymentMethod" : paymentMethod
      },
      success: function(data) {
         window.location.href=data;
      }
    })
  })
  function incrementValue(){
    let quantity = parseInt(document.getElementById('inputQuantity').value);
    quantity = isNaN(quantity) ? 0 : quantity;
    quantity++;
    document.getElementById('inputQuantity').value = quantity;
}
  function decrementValue(){
    let quantity = parseInt(document.getElementById('inputQuantity').value);
    quantity = isNaN(quantity) ? 0 : quantity;
    quantity--;
    if (quantity > 0){
    document.getElementById('inputQuantity').value = quantity;
  }}

  </script>
@endsection
