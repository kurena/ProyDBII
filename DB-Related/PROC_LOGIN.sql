--------------------------------------------------------
--  DDL for Procedure PROC_LOGIN
--------------------------------------------------------
set define off;

  CREATE OR REPLACE PROCEDURE "MATRICULADB"."PROC_LOGIN" (
  p_codusuario IN sismatusuario.CODUSUARIO%TYPE,
  p_passusuario IN sismatusuario.PASSUSUARIO%TYPE,
  userRol  OUT VARCHAR2,
  usernumPersona OUT VARCHAR2,
  state OUT VARCHAR2
) AS
  --
  in_counLogin NUMERIC(18,0);
  --
BEGIN
  --
  SELECT COUNT(*) INTO in_counLogin FROM sismatusuario mat
  WHERE mat.CODUSUARIO = p_codusuario;
  
  IF in_counLogin = 1 THEN
    SELECT COUNT(*) INTO in_counLogin FROM sismatusuario mat
    WHERE mat.CODUSUARIO = p_codusuario
    AND mat.passusuario = p_passusuario;
      
    IF in_counLogin = 1 THEN
      SELECT mat.tipusuario, mat.numpersona INTO userRol, usernumPersona FROM sismatusuario mat
      WHERE mat.CODUSUARIO = p_codusuario
      AND mat.passusuario = p_passusuario;
      
      state := 'FU'; --Found User (Succes Login)
    ELSE
      state := 'IP'; --Incorrect Password
    END IF;
  ELSE
    state := 'NFU'; --Not Found User
  END IF;
  --
END proc_login;

/
