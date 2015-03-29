CREATE OR REPLACE PACKAGE pack_PERSONA AS
    
    TYPE personaRowCursor IS REF CURSOR RETURN sismatpersona%ROWTYPE;
    
    PROCEDURE matSelectById(
      numPersonaIN IN NUMBER,
      c_persona_cursos OUT personaRowCursor
    );
    
    PROCEDURE matMakePersonaUser(
      cedPersonaIn IN sismatpersona.CEDPERSONA%TYPE,
      nomPersonaIn IN sismatpersona.NOMPERSONA%TYPE,
      ape1PersonaIn IN sismatpersona.APE1PERSONA%TYPE,
      ape2PersonaIn IN sismatpersona.APE2PERSONA%TYPE,
      fecNaciPersonaIn IN sismatpersona.FECNACIMIENTO%TYPE,
      telPersonaIn IN sismatpersona.TELPERSONA%TYPE,
      domiPersonaIn IN sismatpersona.DOMIPERSONA%TYPE,
      correoPersonaIn IN sismatpersona.CORREOPERSONA%TYPE,
      numBecaPersonaIn IN sismatpersona.NUMCONVEBECA%TYPE,
      numPaisPersonaIn IN sismatpersona.NUMPAIS%TYPE,
      tipPersonaIn IN sismatpersona.TIPPERONA%TYPE,
      numCatPersonaIn IN sismatpersona.NUMCATEDRA%TYPE,
      numGraAcaPersonaIn IN sismatpersona.NUMGRADOACADE%TYPE,
      numNotaPersonaIn IN sismatpersona.NUMNOTA%TYPE,
      codUser IN sismatusuario.CODUSUARIO%TYPE,
      passUser IN sismatusuario.PASSUSUARIO%TYPE,
      resultOut OUT VARCHAR2
    );
    
END pack_PERSONA;
/


CREATE OR REPLACE PACKAGE BODY pack_PERSONA AS

    /*Procedure para selecionar una persona en especifico*/
    PROCEDURE matSelectById(
      numPersonaIN IN NUMBER,
      c_persona_cursos OUT personaRowCursor
    ) AS
        BEGIN
            OPEN c_persona_cursos FOR
            SELECT * FROM sismatpersona mat WHERE mat.numpersona = numPersonaIN;
            --select numPersona from dual;
    END matSelectById;
    
    /*Procedure para insertar una nueva Pesona y Usuario*/
    PROCEDURE matMakePersonaUser(
      cedPersonaIn IN sismatpersona.CEDPERSONA%TYPE,
      nomPersonaIn IN sismatpersona.NOMPERSONA%TYPE,
      ape1PersonaIn IN sismatpersona.APE1PERSONA%TYPE,
      ape2PersonaIn IN sismatpersona.APE2PERSONA%TYPE,
      fecNaciPersonaIn IN sismatpersona.FECNACIMIENTO%TYPE,
      telPersonaIn IN sismatpersona.TELPERSONA%TYPE,
      domiPersonaIn IN sismatpersona.DOMIPERSONA%TYPE,
      correoPersonaIn IN sismatpersona.CORREOPERSONA%TYPE,
      numBecaPersonaIn IN sismatpersona.NUMCONVEBECA%TYPE,
      numPaisPersonaIn IN sismatpersona.NUMPAIS%TYPE,
      tipPersonaIn IN sismatpersona.TIPPERONA%TYPE,
      numCatPersonaIn IN sismatpersona.NUMCATEDRA%TYPE,
      numGraAcaPersonaIn IN sismatpersona.NUMGRADOACADE%TYPE,
      numNotaPersonaIn IN sismatpersona.NUMNOTA%TYPE,
      codUser IN sismatusuario.CODUSUARIO%TYPE,
      passUser IN sismatusuario.PASSUSUARIO%TYPE,
      resultOut OUT VARCHAR2
    )AS
    
      v_maxNumPersona sismatpersona.NUMPERSONA%TYPE;
      v_maxNumUsuario sismatusuario.NUMUSUARIO%TYPE;
    
    BEGIN
      /*Crear Persona*/
    
      SELECT MAX(numpersona) + 1 INTO v_maxNumPersona FROM sismatpersona;

      INSERT INTO sismatpersona VALUES (v_maxNumPersona, cedPersonaIn, nomPersonaIn, ape1PersonaIn, ape2PersonaIn, 
                                     fecNaciPersonaIn, telPersonaIn, domiPersonaIn, correoPersonaIn, CASE numBecaPersonaIn WHEN 0 THEN NULL ELSE numBecaPersonaIn END,
                                     SYSDATE, numPaisPersonaIn, tipPersonaIn, NULL, NULL, NULL);
                                   
      /*Crear Usuario*/                             
                                   
      SELECT MAX(numusuario) + 1 INTO v_maxNumUsuario FROM sismatusuario;                             
                                     
      INSERT INTO sismatusuario VALUES (v_maxNumUsuario, v_maxNumPersona, codUser, passUser, tipPersonaIn);                         

      resultOut := 'Win';

      EXCEPTION  
        
        WHEN OTHERS THEN 
          resultOut := 'Error';

    END matMakePersonaUser;

END pack_PERSONA;
/
