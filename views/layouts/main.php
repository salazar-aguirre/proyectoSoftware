<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                
                'brandLabel' => 'ASWTEST',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            if (!(Yii::$app->user->isGuest)) {
                $rol = Yii::$app->user->identity->rol;
            } else {
                $rol = null;
            }
            if ($rol == 1) {
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Inicio', 'url' => ['/site/index']],
                        ['label' => 'Usuarios', 'url' => ['/usuario/index']],
                        ['label' => 'Examenes', 'url' => ['/site/examenespresentados']],
                        //['label' => 'About', 'url' => ['/site/about']],
                        //['label' => 'Contact', 'url' => ['/site/contact']],
                        Yii::$app->user->isGuest ? (
                                ['label' => 'iniciar sesión ', 'url' => ['/site/login']]
                                ) : (
                                '<li>'
                                . Html::beginForm(['/site/logout'], 'post')
                                . Html::submitButton(
                                        'cerrar sesión (' . Yii::$app->user->identity->nombre . ')', ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm()
                                . '</li>'
                                )
                    ],
                ]);
                NavBar::end();
            } elseif ($rol == 2) {
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Inicio', 'url' => ['/site/index']],
                        //['label' => 'About', 'url' => ['/site/about']],
                        //['label' => 'Contact', 'url' => ['/site/contact']],
                        ['label' => 'Realizar examen  ', 'url' => ['/site/inglesformulario']],
                        ['label' => 'Historial examen  ', 'url' => ['/site/examenesestudiante']],
                        Yii::$app->user->isGuest ? (
                                ['label' => 'iniciar sesión ', 'url' => ['/site/login']]
                                ) : (
                                '<li>'
                                . Html::beginForm(['/site/logout'], 'post')
                                . Html::submitButton(
                                        'cerrar sesión  (' . Yii::$app->user->identity->nombre . ')', ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm()
                                . '</li>'
                                )
                    ],
                ]);
                NavBar::end();
            } elseif ($rol == null) {
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Inicio', 'url' => ['/site/index']],
                        ['label' => 'Registrarse', 'url' => ['/usuario/create']],
                        //['label' => 'About', 'url' => ['/site/about']],
                        //['label' => 'Contact', 'url' => ['/site/contact']],
                        Yii::$app->user->isGuest ? (
                                ['label' => 'Iniciar sesión', 'url' => ['/site/login']]
                                ) : (
                                '<li>'
                                . Html::beginForm(['/site/logout'], 'post')
                                . Html::submitButton(
                                        'cerrar sesión (' . Yii::$app->user->identity->usernamenombre . ')', ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm()
                                . '</li>'
                                )
                    ],
                ]);
                NavBar::end();
            }
            ?>







            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; ASWTEST<?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
