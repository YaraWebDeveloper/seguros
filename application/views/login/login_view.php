<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <div>

            <?php echo form_open("login/iniciarSesion"); ?>
            <input type="text" class="txt_input input" placeholder="Usuario" name="text_user" />
            <input type="password" class="txt_input input" placeholder="Contraseña" name="text_contrasena" />
            <input type="submit" class="input botton_input" value="Entrar" name="ingresar">
            <?php echo form_close(); ?>
        </div>
    </body>
</html>
