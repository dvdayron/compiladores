<?php 

include_once('helpers.php');

// default vars
$error = '';
$result = [];

if (isset($_POST['process'])) { // if form is summited

    $text = $_POST['text']; // get text

    if ($text) {
        // process text
        $result = getLexicalAnalysis($text);
    } else { // validation error
        $error = 'El texto es requerido.';
    }
}

?>
<html lang="es">
    <head>
        <title>Analizador léxico</title>
        <link rel="stylesheet" href="assets/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/styles.css" />
    </head>
    <body>
        <div class="container">
            <h1>Analizador léxico</h1>
            <br>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-xs-4">
                        <h4 class="text-warning">
                            Introduzca el texto a analizar
                        </h4>
                        <div class="alert alert-warning">
                            Se permiten solo letras y espacios.
                        </div>
                    </div>
                    <div class="col-xs-8">
                        <?php if (!empty($error)) {?>
                        <div class="alert alert-danger">
                            <?php echo $error?>
                        </div>
                        <?php }?>
                        <div class="input-group">
                            <textarea name="text" rows="4" class="form-control"><?php echo $text?></textarea>
                        </div>
                        <input name="process" type="submit" class="btn btn-primary" value="Analizar"/>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-xs-6">
                `   <?php if (isset($result['validTokens'])) {?>
                    <h2>Tabla de tokens</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Token</td>
                                <th>Posicion</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result['validTokens'] as $token) {?>
                            <tr class="<?php echo !$token['valid'] ? 'bg-danger text-danger' : ''?>">
                                <td><?php echo $token['value']?></td>
                                <td><?php echo $token['position']?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <?php }?>
                </div>
                <div class="col-xs-5 col-xs-offset-1">
                    <?php if (isset($result['words'])) {?>
                    <h2>Palabras encontradas <span class="label label-success"><?php echo getValidWords($result['words'])?></span></h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Palabra</td>
                                <th>Cantidad de caracteres</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result['words'] as $word) {
                                $length = strlen($word);
                            ?>
                            <tr class="<?php echo $length >= 5 ? 'bg-success' : ''?>">
                                <td><?php echo $word?></td>
                                <td><?php echo $length?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <?php }?>
                </div>
            </div>
        </div>
        
        <script src="assets/jquery.js"></script>
        <script src="assets/bootstrap.min.js"></script>
    </body>
</html>