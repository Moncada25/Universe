<br>
<div class="container-fluid">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Bookverse</h3>
        </div>
        <div class="panel-body">
           <form action="<?php echo SERVERURL; ?>ajax/githubAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-4">
                        <p class="text-center">
                            <a href="https://github.com/Moncada25/Bookverse/zipball/master"><input type="button" id="linkBookverseZIP" value="Code ZIP" class="btn btn-link btn-raised btn-sm"></a>
                        </p>
                    </div>
                    <div class="col-xs-4">
                        <p class="text-center">
                            <a href="https://github.com/Moncada25/" target="_blank"><input type="button" id="linkGitHub" value="GitHub" class="btn btn-link btn-raised btn-sm"></a>
                        </p>
                    </div>
                    <div class="col-xs-4">
                        <p class="text-center">
                            <a href="https://github.com/Moncada25/Bookverse/tarball/master">
                                <input type="button" id="linkBookverseTAR" value="Code TAR" class="btn btn-link btn-raised btn-sm">
                            </a>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <div class="form-group label-floating">
                            <span class="control-label">¿Qué te parece? ¡Déjanos tu feedback!</span>
                            <textarea class="form-control" name="comentario-bookverse" id="comentario-bookverse" required=""></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <p class="text-center">
                            <button type="submit" class="btn btn-danger btn-raised btn-sm"><i class="zmdi zmdi-email"></i> &nbsp; Enviar</button>
                        </p>
                    </div>
                </div>
                <div class="RespuestaAjax"></div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title text-center">PackApps</h3>
        </div>
        <div class="panel-body">
            <form action="<?php echo SERVERURL; ?>ajax/githubAjax.php" method="POST" data-form="save" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-4">
                        <p class="text-center">
                            <a href="https://github.com/Moncada25/PackApps/zipball/master"><input type="button" id="linkPackAppsZIP" value="Code ZIP" class="btn btn-link btn-raised btn-sm"></a>
                        </p>
                    </div>
                    <div class="col-xs-4">
                        <p class="text-center">
                            <a href="https://mega.nz/#F!1E1SQKST!yBXhMg1ZHbrCHSgRm6nw3A" target="_blank"><input type="button" id="linkPackApps" value="PackApps" class="btn btn-link btn-raised btn-sm"></a>
                        </p>
                    </div>
                    <div class="col-xs-4">
                        <p class="text-center">
                            <a href="https://github.com/Moncada25/PackApps/tarball/master">
                            <input type="button" id="linkPackAppsTAR" value="Code TAR" class="btn btn-link btn-raised btn-sm"></a>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <div class="form-group label-floating">
                            <span class="control-label">¿Qué te parece? ¡Déjanos tu feedback!</span>
                            <textarea class="form-control" name="comentario-packapps" id="comentario-packapps" required=""></textarea>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <p class="text-center">
                            <button type="submit" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-email"></i> &nbsp; Enviar</button>
                        </p>
                    </div>
                </div>
                <div class="RespuestaAjax"></div>
            </form>
        </div>
    </div>
</div>