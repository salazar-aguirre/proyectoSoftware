<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\filters\AccessControl;
use app\models\User;
use yii\data\Pagination;
use yii\helpers\Html;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'inglesformulario', 'resultadoExamen',
                    'detalleexamen', 'examenespresentados', 'usuario/create',
                    'usuario/update', 'usuario/view', 'usuario/index','examenesestudiante'],
                'rules' => [
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['logout', 'detalleexamen', 'examenespresentados',
                            'usuario/create', 'usuario/update', 'usuario/view', 'usuario/index',],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un administrador
                            return User::isUserAdmin(Yii::$app->user->identity->cedula);
                        },
                    ],
                    [
                        //Los usuarios simples tienen permisos sobre las siguientes acciones
                        'actions' => ['logout', 'inglesformulario', 'resultadoExamen',
                            'usuario/create','examenesestudiante'],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un usuario simple
                            return User::isUserSimple(Yii::$app->user->identity->cedula);
                        },
                    ],
                ],
            ],
            //Controla el modo en que se accede a las acciones, en este ejemplo a la acción logout
            //sólo se puede acceder a través del método post
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            if (User::isUserAdmin(Yii::$app->user->identity->cedula)) {
                return $this->redirect(["/site/index/"]);
            } else {
                return $this->redirect(["/site/inglesformulario/"]);
            }
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            if (User::isUserAdmin(Yii::$app->user->identity->cedula)) {
                return $this->redirect(["/site/index/"]);
            } else {
                return $this->redirect(["/site/inglesformulario/"]);
            }
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionAyuda() {
        return $this->render("ayuda");
    }

    /**
     * Formulario para que el estudiante (usuario) pueda diligenciar un examen
     * guarda las respuestas y los resultados
     * @return type
     */
    public function actionInglesformulario() {
        $modeloRespuestaL = new \app\models\Respuesta();
        $cedulaUsuario = Yii::$app->user->identity->cedula;
        if (Yii::$app->request->post()) {
            //Crea el historial 
            $historial = new \app\models\Historial_examenes();
            $historial->fk_usuario = $cedulaUsuario;
            $historial->resultado_listen = "";
            $historial->resultado_read = "";
            $historial->resultado_general = "";
            $historial->resultado_write = "";
            $historial->fecha_historial = date('Y-m-d');
            $historial->save();
            //Buscar el historial que se acabo de gaurdar
            $historialCreado = \app\models\Historial_examenes::findBySql('SELECT * FROM historialexamen ORDER BY ' . 'id_historial DESC  limit 1')->all();
            $idHistorialCreado = null; //Id del historial que se acabo de guardar
            foreach ($historialCreado as $id) {
                $idHistorialCreado = $id->id_historial;
            }
            $historialM = \app\models\Historial_examenes::findOne($idHistorialCreado); //trae el hsitorial que se acaba de guardar, para ahcer las respectivas modificaciones
            $contadorR = 0;
            $contadorG = 0;
            $contadorW = 0;
            $contadorL = 0;

            foreach (Yii::$app->request->post('respuestasL') as $key => $value) {
                if ($value == 0) {
                    return $this->render("inglesformulario", [
                                "modeloRespuestaL" => $modeloRespuestaL
                                    ]
                    );
                }
            }
            foreach (Yii::$app->request->post('respuestasR') as $key => $value) {
                
            }
            foreach (Yii::$app->request->post('respuestasG') as $key => $value) {
                
            }
            foreach (Yii::$app->request->post('respuestasW') as $key => $value) {
                
            }
            foreach (Yii::$app->request->post('respuestasL') as $key => $value) {
                if (sizeof('respuestasL') != 0) {
                    $respuesta = $this->convertirRespuesta($value);
                    $table = new \app\models\Respuesta();
                    $table->fk_historial = $idHistorialCreado;
                    $table->fk_pregunta = $key;
                    $table->respuesta_usuario = $respuesta;
                    $table->save();
                    $es_buena = $this->calcularBuena($key, $respuesta);
                    if ($es_buena) {
                        $contadorL++;
                    }
                }
            }
            foreach (Yii::$app->request->post('respuestasR') as $key => $value) {
                if (sizeof('respuestasR') != 0) {
                    $respuesta = $this->convertirRespuesta($value);
                    $table = new \app\models\Respuesta();
                    $table->fk_pregunta = $key;
                    $table->fk_historial = $idHistorialCreado;
                    $table->respuesta_usuario = $respuesta;
                    $table->save();
                    $es_buena = $this->calcularBuena($key, $respuesta);
                    if ($es_buena) {
                        $contadorR++;
                    }
                }
            }
            foreach (Yii::$app->request->post('respuestasG') as $key => $value) {
                if (sizeof('respuestasG') != 0) {
                    $respuesta = $this->convertirRespuesta($value);
                    $table = new \app\models\Respuesta();
                    $table->fk_pregunta = $key;
                    $table->fk_historial = $idHistorialCreado;
                    $table->respuesta_usuario = $respuesta;
                    $table->save();
                    $es_buena = $this->calcularBuena($key, $respuesta);
                    if ($es_buena) {
                        $contadorG++;
                    }
                }
            }
            foreach (Yii::$app->request->post('respuestasW') as $key => $value) {
                if (sizeof('respuestasW') != 0) {
                    $respuesta = $value;
                    $table = new \app\models\Respuesta();
                    $table->fk_pregunta = $key;
                    $table->fk_historial = $idHistorialCreado;
                    $table->respuesta_usuario = $value;
                    $table->save();
                    $es_buena = $this->calcularBuena($key, $respuesta);
                    if ($es_buena) {
                        $contadorW++;
                    }
                }
            }
            foreach (Yii::$app->request->post('respuestasW2') as $key => $value) {
                if (sizeof('respuestasW2') != 0) {
                    $respuesta = $value;
                    $table = new \app\models\Respuesta();
                    $table->fk_pregunta = $key;
                    $table->fk_historial = $idHistorialCreado;
                    $table->respuesta_usuario = $value;
                    $table->save();
                    $es_buena = $this->calcularBuena($key, $respuesta);
                    if ($es_buena) {
                        $contadorW++;
                    }
                }
            }
            $cadenaR = $this->calificarLR($contadorR);
            $cadenaL = $this->calificarLR($contadorL);
            $cadenaG = $this->calificarG($contadorG);
            $cadenaW = $this->calificarW($contadorW);
            $cadenaTotal = $this->calificarTotal($cadenaL, $cadenaR, $cadenaG, $cadenaW, $contadorG);

            $historialM->resultado_listen = $cadenaL;
            $historialM->resultado_read = $cadenaR;
            $historialM->resultado_general = $cadenaG;
            $historialM->resultado_write = $cadenaW;
            $historialM->resultado_total = $cadenaTotal;
            $historialM->update();

            $diagnostico = "FUNCIONO READ son " . $contadorR . " buenas  de R y el nivel de R es " . $cadenaR
                    . "LISTEN son " . $contadorL . " buenas  de L y el nivel de L es " . $cadenaL
                    . "GENERAL son " . $contadorG . " buenas  de G y el nivel de G es " . $cadenaG
                    . "WRITE son " . $contadorW . " buenas  de W y el nivel de W es " . $cadenaW
                    . "TOTAL el nivel es " . $cadenaTotal;
            return $this->render("resultadoexamen", [
                        "diagnostico" => $diagnostico,
                        "cadenaR" => $cadenaR,
                        "cadenaL" => $cadenaL,
                        "cadenaG" => $cadenaG,
                        "cadenaW" => $cadenaW,
                        "cadenaTotal" => $cadenaTotal,
                        "contadorR" => $contadorR,
                        "contadorL" => $contadorL,
                        "contadorG" => $contadorG,
                        "contadorW" => $contadorW,
                            ]
            );
        }
        return $this->render("inglesformulario", [
                    "modeloRespuestaL" => $modeloRespuestaL
                        ]
        );
    }

    public function actionResultadoexamen() {
        $cadenaR = $this->calificarLR(2);
        $cadenaL = $this->calificarLR(7);
        $cadenaG = $this->calificarG(12);
        $cadenaW = $this->calificarW(2);
        $cadenaTotal = $this->calificarTotal($cadenaL, $cadenaR, $cadenaG, $cadenaW, 12);

        $diagnostico = "FUNCIONO READ son " . 2 . " buenas  de R y el nivel de R es " . $cadenaR
                . "LISTEN son " . 7 . " buenas  de L y el nivel de L es " . $cadenaL
                . "GENERAL son " . 12 . " buenas  de G y el nivel de G es " . $cadenaG
                . "WRITE son " . 2 . " buenas  de W y el nivel de W es " . $cadenaW
                . "TOTAL el nivel es " . $cadenaTotal;
        return $this->render("resultadoexamen", [
                    "diagnostico" => $diagnostico,
                    "cadenaR" => $cadenaR,
                    "cadenaL" => $cadenaL,
                    "cadenaG" => $cadenaG,
                    "cadenaW" => $cadenaW,
                    "cadenaTotal" => $cadenaTotal,
                    "contadorR" => 2,
                    "contadorL" => 7,
                    "contadorG" => 12,
                    "contadorW" => 2,
                        ]
        );
    }

    /**
     * Compara la respuesta del usuario con la respuesta correcta de la pregunta
     * @param String $id
     * @param String $respuesta
     * @return boolean true si es correcta, false si no
     */
    public function calcularBuena($id, $respuesta) {
        $preguntaBd = \app\models\Pregunta::findOne($id);
        $respuestaCorrecta = $preguntaBd->respuesta_correcta;
        if ($respuestaCorrecta == $respuesta) {
            return true;
        }
        return false;
    }

    /**
     * Convierte las respuestas a A, B, C, D
     * @param int $valor
     * @return string
     */
    public function convertirRespuesta($valor) {
        if ($valor == 1) {
            return "A";
        } else if ($valor == 2) {
            return "B";
        } else if ($valor == 3) {
            return "C";
        } else if ($valor == 4) {
            return "D";
        }
    }

    /**
     * Encuentra el nivel de la sección Listening and Reading de acuerdo a las respuestas correctas
     * @param int $buenas cantidad de respuestas buenas
     * @return string
     */
    public function calificarLR($buenas) {
        if ($buenas >= 0 && $buenas <= 3) {
            return "Fundamentals";
        } else if ($buenas >= 4 && $buenas <= 5) {
            return "Top Notch 1";
        } else if ($buenas >= 6 && $buenas <= 7) {
            return "Top Notch 2";
        } else if ($buenas == 8) {
            return "Top Notch 3";
        } else if ($buenas == 9) {
            return "Summit 1";
        } else if ($buenas == 10) {
            return "Summit 2";
        }
    }

    /**
     * Encuentra el nivel de la sección General de acuerdo a las respuestas correctas
     * @param int $buenas cantidad de respuestas buenas
     * @return string
     */
    public function calificarG($buenas) {
        if ($buenas >= 0 && $buenas <= 15) {
            return "Fundamentals";
        } else if ($buenas >= 16 && $buenas <= 25) {
            return "Top Notch 1";
        } else if ($buenas >= 26 && $buenas <= 35) {
            return "Top Notch 2";
        } else if ($buenas >= 36 && $buenas <= 45) {
            return "Top Notch 3";
        } else if ($buenas >= 46 && $buenas <= 55) {
            return "Summit 1";
        } else if ($buenas >= 56 && $buenas <= 60) {
            return "Summit 2";
        }
    }

    /**
     * Encuentra el nivel de la sección Writing de acuerdo a las respuestas correctas
     * @param int $buenas cantidad de respuestas buenas
     * @return string
     */
    public function calificarW($buenas) {
        if ($buenas >= 0 && $buenas <= 4) {
            return "Fundamentals";
        } else if ($buenas >= 5 && $buenas <= 8) {
            return "Top Notch 1";
        } else if ($buenas >= 9 && $buenas <= 10) {
            return "Top Notch 2";
        } else if ($buenas >= 11 && $buenas <= 12) {
            return "Top Notch 3";
        } else if ($buenas >= 13 && $buenas <= 14) {
            return "Summit 1";
        } else if ($buenas == 15) {
            return "Summit 2";
        }
    }

    /**
     * Encuentra el nivel de todas las secciones de acuerdo a las respuestas correcta
     * @param String $valorL Nivel de la seccion Listening
     * @param String $valorR Nivel de la seccion Reading
     * @param String $valorG Nivel de la seccion General
     * @param String $valorW Nivel de la seccion Writing
     * @param int $buenasG cantidad de respuestas buenas en la sección general
     * @return type
     */
    public function calificarTotal($valorL, $valorR, $valorG, $valorW, $buenasG) {
        $nivelL = $this->definirNivel($valorL);
        $nivelR = $this->definirNivel($valorR);
        $nivelG = $this->definirNivel($valorG);
        $nivelW = $this->definirNivel($valorW);
        $total = $buenasG;
        if ($nivelG > $nivelR) {
            $total -= 4;
        } elseif ($nivelG < $nivelR) {
            $total += 4;
        }
        if ($nivelG > $nivelL) {
            $total -= 4;
        } elseif ($nivelG < $nivelL) {
            $total += 4;
        }
        if ($nivelG > $nivelW) {
            $total -= 4;
        } elseif ($nivelG < $nivelW) {
            $total += 4;
        }
        $result = $this->calificarG($total);
        return $result;
    }

    /**
     * Convierte el resultado de cadena a numeros
     * @param type $cadena
     * @return int
     */
    public function definirNivel($cadena) {
        if ($cadena == "Fundamentals") {
            return 1;
        } else if ($cadena == "Top Notch 1") {
            return 2;
        } else if ($cadena == "Top Notch 2") {
            return 3;
        } else if ($cadena == "Top Notch 3") {
            return 4;
        } else if ($cadena == "Summit 1") {
            return 5;
        } else if ($cadena == "Summit 2") {
            return 6;
        }
    }

    /**
     * Muestra a todos los historiales al administrador
     * @return type
     */
    public function actionExamenespresentados() {
        $modeloHistorial = \app\models\Historial_examenes::find();
        $count = clone$modeloHistorial;
        $pages = new Pagination([
            "pageSize" => 15,
            "totalCount" => $count->count()
        ]);
        $model = $modeloHistorial
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        return $this->render("examenespresentados", [
                    "modeloHistorial" => $model,
                    "pages" => $pages,
        ]);
    }
    
    /**
     * Muestra los historiales solamente del usuario que este
     * @return type
     */
    public function actionExamenesestudiante() {
        $cedulaUsuario = Yii::$app->user->identity->cedula;
        $modeloHistorialUsuario = \app\models\Historial_examenes::find();
        $count = clone$modeloHistorialUsuario;
        $pages = new Pagination([
            "pageSize" => 15,
            "totalCount" => $count->count()
        ]);
        $model = $modeloHistorialUsuario
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        return $this->render("examenesestudiante", [
                    "modeloHistorial" => $model,
                    "pages" => $pages,
        ]);
    }

    public function actionDetalleexamen() {
        $id_examen_detalle = Html::encode($_GET["id_historial"]);
        //$id_examen_detalle=13;
        $historial = \app\models\Historial_examenes::findOne($id_examen_detalle);
        $fechaHistorial = $historial->fecha_historial;
        $resultadoR = $historial->resultado_read;
        $resultadoL = $historial->resultado_listen;
        $resultadoG = $historial->resultado_general;
        $resultadoW = $historial->resultado_write;
        $resultadoTotal = $historial->resultado_total;
        $usuario = \app\models\Usuario::findOne($historial->fk_usuario);
        $nombreUsuario = $usuario->nombre;
        $respuestas = \app\models\Respuesta::find()->where("fk_historial=:fk_historial", [":fk_historial" => $id_examen_detalle])->all();
        $respuestasL = [];
        $respuestasL1 = [];
        $respuestasL2 = [];
        $respuestasR = [];
        $respuestasR1 = [];
        $respuestasR2 = [];
        $respuestasG = [];
        $respuestasG1 = [];
        $respuestasG2 = [];
        $respuestasG3 = [];
        $respuestasG4 = [];
        $respuestasG5 = [];
        $respuestasG6 = [];
        $respuestasW = [];
        foreach ($respuestas as $respuesta) {
            $contieneL = strpos($respuesta->fk_pregunta, "L");
            $contieneR = strpos($respuesta->fk_pregunta, "R");
            $contieneG = strpos($respuesta->fk_pregunta, "G");
            $contieneW = strpos($respuesta->fk_pregunta, "W");
            if ($contieneL) {
                $respuestasL[] = $respuesta;
            } else if ($contieneR) {
                $respuestasR[] = $respuesta;
            } else if ($contieneG) {
                $respuestasG[] = $respuesta;
            } else if ($contieneW) {
                $respuestasW[] = $respuesta;
            }
        }
        for ($index = 0; $index < count($respuestasL); $index++) {
            if ($index < 5) {
                $respuestasL1[] = $respuestasL[$index];
            } else {
                $respuestasL2[] = $respuestasL[$index];
            }
        }
        for ($index = 0; $index < count($respuestasR); $index++) {
            if ($index < 5) {
                $respuestasR1[] = $respuestasR[$index];
            } else {
                $respuestasR2[] = $respuestasR[$index];
            }
        }
        for ($index = 0; $index < count($respuestasG); $index++) {
            if ($index < 10) {
                $respuestasG1[] = $respuestasG[$index];
            } else if ($index < 20) {
                $respuestasG2[] = $respuestasG[$index];
            } else if ($index < 30) {
                $respuestasG3[] = $respuestasG[$index];
            } else if ($index < 40) {
                $respuestasG4[] = $respuestasG[$index];
            } else if ($index < 50) {
                $respuestasG5[] = $respuestasG[$index];
            } else if ($index < 60) {
                $respuestasG6[] = $respuestasG[$index];
            }
        }
        return $this->render('detalleexamen', [
                    'id_examen_detalle' => $id_examen_detalle,
                    'resultadoR' => $resultadoR,
                    'resultadoL' => $resultadoL,
                    'resultadoG' => $resultadoG,
                    'resultadoW' => $resultadoW,
                    'resultadoTotal' => $resultadoTotal,
                    'fechaHistorial' => $fechaHistorial,
                    'nombreUsuario' => $nombreUsuario,
                    'respuestasL1' => $respuestasL1,
                    'respuestasL2' => $respuestasL2,
                    'respuestasR1' => $respuestasR1,
                    'respuestasR2' => $respuestasR2,
                    'respuestasG1' => $respuestasG1,
                    'respuestasG2' => $respuestasG2,
                    'respuestasG3' => $respuestasG3,
                    'respuestasG4' => $respuestasG4,
                    'respuestasG5' => $respuestasG5,
                    'respuestasG6' => $respuestasG6,
                    'respuestasW' => $respuestasW,
        ]);
    }

}
