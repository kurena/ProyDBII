/*matCatedra_Controller
  JS que controla a la vista (php) y conserva
  la lógica en un solo archivo.

  Daniel Fernandez Solano
*/

var initmatCatedra_Controls = function(){
    return {
        init: function(){
            $("#catedrasTable").dataTable();

            fnCargarCatedras();
            fnLoadProfs();

            $('#addCatedraBtn').click(function(){
                fnClearInputs();

                $('.sendNewCatedra').show();
                $('.sendUpdCatedra').hide();
                $('#newCatedraModal').modal('show');
            });

            $('.sendUpdCatedra').click(function(){
                var JSONvar = {};

                JSONvar['genericMethod'] = 'uptCatedra';
                JSONvar['numCatedra'] = $('#formcodCatedra').val();
                JSONvar['nomCatedra'] = $('#formnomCatedra').val();
                JSONvar['desCatedra'] = $('#formdesCatedra').val();
                JSONvar['corCatedra'] = $('#formCoordinador').val();

                $.ajax({
                    data:  JSONvar,
                    url:   'assets/php/matCatedra_Logic.php',
                    type:  'post',
                    beforeSend: function () {
                        //Logic Here
                    },
                    success:  function (response) {
                        console.log(response);
                        fnCargarCatedras();
                    }
                }).done(function() {});
            });

            $('.sendNewCatedra').click(function(){
                var JSONvar = {};

                JSONvar['genericMethod'] = 'createCatedra';
                JSONvar['nomCatedra'] = $('#formnomCatedra').val();
                JSONvar['desCatedra'] = $('#formdesCatedra').val();
                JSONvar['corCatedra'] = $('#formCoordinador').val();

                $.ajax({
                    data:  JSONvar,
                    url:   'assets/php/matCatedra_Logic.php',
                    type:  'post',
                    beforeSend: function () {
                        //Logic Here
                    },
                    success:  function (response) {
                        console.log(response);
                        fnCargarCatedras();
                    }
                }).done(function() {});
            });
        }
    };
}();

function fnCargarCatedras(){
    $("#catedrasTable").dataTable().fnDestroy();
    $('#catedrasTable > tbody').html("");

    var dataTable = $('#catedrasTable').dataTable();

    var JSONvar = {};
    JSONvar['genericMethod'] = 'listar';
    $.ajax({
      data:  JSONvar,
      url:   'assets/php/matCatedra_Logic.php',
      type:  'post',
      beforeSend: function () {
          //Logic Here
      },
      success:  function (response) {
          $.each(JSON.parse(response), function (idx, obj) {
              data = JSON.parse(obj);
              dataTable.fnAddData([data.NUMCATEDRA,
                                   data.NOMCATEDRA,
                                   data.DETCATEDRA,
                                   data.CORDINADOR,
                                   data.NUMCOORDINADOR]);
          });

          $(dataTable.fnGetNodes()).find('td').click(function (event) {
              currRoutePos = dataTable.fnGetPosition($(this).parent()[0]);
              currRouteData = dataTable.fnGetData(currRoutePos);
              fnGetCatedra( currRouteData );
          });
      }
    }).done(function() {});
}

function fnGetCatedra( catedraData ){
    $('.sendNewCatedra').hide();
    $('.sendUpdCatedra').show();

    $("#formCoordinador").val(catedraData[4]);

    $('#formcodCatedra').val(catedraData[0]);

    $('#formnomCatedra').val(catedraData[1]);

    $('#formdesCatedra').val(catedraData[2]);

    $('#newCatedraModal').modal('show');
}

function fnLoadProfs(){
    var JSONvar = {};
    JSONvar['genericMethod'] = 'getProfs';

    $.ajax({
        data:  JSONvar,
        url:   'assets/php/matCatedra_Logic.php',
        type:  'post',
        beforeSend: function () {
            //Logic Here
        },
        success:  function (response) {
            var itemTemplate = "<option value='{value}'>{text}</option>";
            var output = [];

            $.each(JSON.parse(response), function (idx, obj) {
                data = JSON.parse(obj);
                var option = fnMakeHTML(itemTemplate, {value: data.CEDPERSONA, text: data.CORDINADOR});
                output.push(option);
            });
            $("#formCoordinador").html(output.join(''));
        }
    }).done(function() {});
}

function fnMakeHTML(str, col) {
    col = typeof col === 'object' ? col : Array.prototype.slice.call(arguments, 1);

    return str.replace(/\{\{|\}\}|\{(\w+)\}/g, function (m, n) {
        if (m == "{{") {
            return "{";
        }
        if (m == "}}") {
            return "}";
        }
        return col[n];
    });
}

function fnClearInputs(){
    var container, inputs, index;

    container = $('#for_loop');

    inputs = container.find('input');

    for (index = 0; index < inputs.length; ++index) {
        var controlid = inputs[index].id;
        $('#' + controlid).val("");
    }

    inputs = container.find('textarea');

    for (index = 0; index < inputs.length; ++index) {
        var controlid = inputs[index].id;
        $('#' + controlid).val("");
    }
}