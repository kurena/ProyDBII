/*cursos_Controller
  JS que controla a la vista (php) y conserva
  la lógica en un solo archivo.

  Daniel Fernandez Solano
*/

var initCursos_Controls = function(){
    return {
        init: function(){
            fnCargarCursos();

            $("#addCursoBtn").click(function(){
                $('.sendNewCurso').show();
                $('.sendUpdCurso').hide();

                fnClearInputs();

                $('#newCursoModal').modal('show');
            });

            $('.sendNewCurso').click(function(){
                var JSONvar = {};

                JSONvar['genericMethod'] = 'insCurso';
                JSONvar["nomCursoIN"] = $('#formnombreCurso').val();
                JSONvar["desCursoIN"] = $('#formdesCurso').val();
                JSONvar["creCursoIN"] = $('#formcreCurso').val();
                JSONvar["cosCursoIN"] = $('#formcostoCurso').val();
                JSONvar["catCursoIN"] = $('#formCatedra').val();
                JSONvar["corCursoIN"] = $('#formCoordinador').val();

                $.ajax({
                        data:  JSONvar,
                        url:   'assets/php/matCurso_Logic.php',
                        type:  'post',
                        beforeSend: function () {
                         //Logic Here
                    },success:  function (response) {
                        resultJSON = JSON.parse(response);
                        if(resultJSON.resultQuery == 'Win'){
                            fnCargarCursos();
                            fnShowMessage('Sistema de Matriculas', 'Transacción Exitosa.', 'assets/img/successAlert.png', false);
                        }else{
                            fnShowMessage('Sistema de Matriculas', 'Error en la Transacción.', 'assets/img/errorAlert.png', false);
                        }
                    }
                }).done(function() {});

            });

            $('.sendUpdCurso').click(function(){
                var JSONvar = {};

                JSONvar['genericMethod'] = 'uptCurso';
                JSONvar["numCursoIN"] = $('#formnumCurso').val();
                JSONvar["nomCursoIN"] = $('#formnombreCurso').val();
                JSONvar["desCursoIN"] = $('#formdesCurso').val();
                JSONvar["creCursoIN"] = $('#formcreCurso').val();
                JSONvar["cosCursoIN"] = $('#formcostoCurso').val();
                JSONvar["catCursoIN"] = $('#formCatedra').val();
                JSONvar["corCursoIN"] = $('#formCoordinador').val();

                $.ajax({
                    data:  JSONvar,
                    url:   'assets/php/matCurso_Logic.php',
                    type:  'post',
                    beforeSend: function () {
                        //Logic Here
                    },success:  function (response) {
                        resultJSON = JSON.parse(response);
                        if(resultJSON.resultQuery == 'Win'){
                            fnCargarCursos();
                            fnShowMessage('Sistema de Matriculas', 'Transacción Exitosa.', 'assets/img/successAlert.png', false);
                        }else{
                            fnShowMessage('Sistema de Matriculas', 'Error en la Transacción.', 'assets/img/errorAlert.png', false);
                        }
                    }
                }).done(function() {});
            });

            $('#formcreCurso').keyup(function () {
                this.value = this.value.replace(/[^0-9\.]/g,'');
            });

            $('#formcostoCurso').change(function () {
                this.value = this.value.replace(/[^0-9\.]/g,'');
            });

            fnGetCatedras();
            fnLoadProfs();
        }
    };
}();

function fnCargarCursos(){
    $('#cursosTable').dataTable().fnDestroy();
    $('#cursosTable > tbody').html("");

    var dataTable = $('#cursosTable').dataTable();

     var JSONvar = {};
     JSONvar['genericMethod'] = 'listar';

      $.ajax({
          data:  JSONvar,
          url:   'assets/php/matCurso_Logic.php',
          type:  'post',
          beforeSend: function () {
              //Logic Here
          },
          success:  function (response) {
              $.each(JSON.parse(response), function (idx, obj) {
                  data = JSON.parse(obj);
                  dataTable.fnAddData([data.NUMCURSO,
                                      data.NOMCURSO,
                                      data.DETCURSO,
                                      data.CREDCURSO,
                                      data.COSTCURSO,
                                      data.NOMCATEDRA,
                                      data.PERSONA,
                                      data.NUMCATEDRA,
                                      data.CEDPERSONA]);
              });

              $(dataTable.fnGetNodes()).find('td').click(function (event) {
                  currRoutePos = dataTable.fnGetPosition($(this).parent()[0]);
                  currRouteData = dataTable.fnGetData(currRoutePos);
                  fnLoadCurso(currRouteData);
              });
          }
      }).done(function() {});
}

function fnLoadCurso(dataCurso){
    $('.sendNewCurso').hide();
    $('.sendUpdCurso').show();

    $('#formnumCurso').val(dataCurso[0]);
    $('#formnombreCurso').val(dataCurso[1]);
    $('#formdesCurso').val(dataCurso[2]);
    $('#formcreCurso').val(dataCurso[3]);
    $('#formcostoCurso').val(dataCurso[4]);
    $('#formCatedra').val(dataCurso[7]);
    $('#formCoordinador').val(dataCurso[8]);

    $('#newCursoModal').modal('show');
}

function fnGetCatedras(){

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
            var itemTemplate = "<option value='{value}'>{text}</option>";
            var output = [];

            $.each(JSON.parse(response), function (idx, obj) {
                data = JSON.parse(obj);
                var option = fnMakeHTML(itemTemplate, {value: data.NUMCATEDRA, text: data.NOMCATEDRA});
                output.push(option);
            });
            $("#formCatedra").html(output.join(''));
        }
    }).done(function() {});
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
