<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 13.06.15
 * Time: 13:10
 * To change this template use File | Settings | File Templates.
 */

namespace app\widgets\ajaxControls;

use Yii;
use yii\helpers\Html;
use yii\web\View;

class AjaxControls extends \yii\base\Widget {

    public $indexUrl = 'index';
    public $createUrl = 'create';
    public $updateUrl = 'update';
    public $deleteUrl = 'delete';
    public $mailingUrl = 'mailing';
    public $gridSelector = '#grid';
    public $formSelector = '#form';
    public $customButtons = [];

    public function init() {
        echo '<div class="row">';
        echo '<div class="col col-lg-9 action-buttons">';
        $this->renderButtons();
        echo '</div>';
        echo '<div class="col col-lg-3">';
        $this->renderSearch();
        echo '</div>';
        $this->view->registerCss($this->gridSelector . ' tr{cursor: pointer;}');
        $this->view->registerCss($this->gridSelector . ' tr.active td {background-color: #5BC0DE;}');
        echo '</div>
        <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            </div>
        </div>';
        $this->initScripts();
    }

    protected function renderSearch() {
        echo Html::textInput('search', Yii::$app->request->get('search'), ['id' => 'search', 'class' => 'form-control', 'placeholder' => Yii::t('app', 'Search')]);
    }

    protected function renderButtons() {
        if($this->createUrl && Yii::$app->user->can($this->createUrl)) {
            echo Html::a(Yii::t('app', 'Create'), ['#'], ['class' => 'btn btn-success', 'id' => 'create', 'role' => 'button']) . ' ';
        }
        if($this->updateUrl && Yii::$app->user->can($this->updateUrl)) {
            echo Html::a(Yii::t('app', 'Update'), ['#'], ['class' => 'btn btn-warning   ', 'id' => 'update', 'role' => 'button', 'disabled' => true]) . ' ';
        }
        if($this->deleteUrl && Yii::$app->user->can($this->deleteUrl)) {
            echo Html::a(Yii::t('app', 'Delete'), ['#'], ['class' => 'btn btn-danger   ', 'id' => 'delete', 'role' => 'button', 'disabled' => true]);
        }
        if(in_array('mailing', $this->customButtons)) {
            if(Yii::$app->user->can($this->mailingUrl)) {
                echo Html::a(Yii::t('app', 'Отправить письма'), ['#'], ['class' => 'btn btn-primary   ', 'id' => 'mailing', 'role' => 'button', 'disabled' => true]);
            }
        }
    }

    protected function initScripts() {
        $params = [];
        if(Yii::$app->request->get('page')) {
            $params['page'] = Yii::$app->request->get('page');
        }
        if(Yii::$app->request->get('per-page')) {
            $params['per-page'] = Yii::$app->request->get('per-page');
        }
        if(Yii::$app->request->get('search')) {
            $params['search'] = Yii::$app->request->get('search');
        }

        $this->view->registerJs('
         $(document).ready(function(){
                var gridSelector = "' . $this->gridSelector . '";
                var searchUrl = "' . Yii::$app->urlManager->createUrl($this->indexUrl, $params) . '";
                var edit = function(url){
                    $.ajax({
                       url: url,
                       success: function(data){

                         $("#myModal .modal-dialog").html(data);

                         $("#myModal").modal("show");

                          $("' . $this->formSelector . '").submit(function(){
                             var $form = $(this);
                             $.ajax({
                               url: url,
                               type: "POST",
                               data: $form.serialize(),
                               success: function(data){
                                    if(data=="success"){
                                        $.pjax.reload({
                                            container: gridSelector
                                        });
                                        $("#myModal").modal("hide");
                                        return false;
                                    }
                                    $(".help-block").html("");
                                    $(".form-group").removeClass("has-error");
                                    $.each(data, function(index,item){
                                        $("#"+index).parent().addClass("has-error");
                                        $(".help-block",$("#"+index).parent()).html(item);
                                        var tabPane = $("#"+index).parent().parent().parent();
                                        if(tabPane.hasClass("tab-pane")){
                                           $("a[href=\"#"+tabPane.attr("id")+"\"]").parent().addClass("has-error");
                                        }
                                    });
                               }
                            });
                            return false;
                         });
                       }
                    });
                }

                var initActivation = function(){
                  $("tr",$(gridSelector)).click(function(){
                        if($(this).hasClass("filters")){
                            return;
                        }
                        $("tr",$(gridSelector)).removeClass("active");
                        $(this).addClass("active");
                        $("#update").removeAttr("disabled");
                        $("#delete").removeAttr("disabled");
                        $("#mailing").removeAttr("disabled");
                        currentId = $(this).attr("data-key");
                    });
                }

                var currentId = 0;
                initActivation();
                $(document).ajaxSuccess(function() {
                    initActivation();
                });

                $("#create").on("click", function () {
                    edit("' . $this->createUrl . '");
                    return false;
                });

                $("#update").on("click", function () {
                    edit("' . $this->updateUrl . '?id="+currentId);
                    return false;
                });

                $("#delete").on("click", function () {
                    if(!confirm("Вы уверены, что хотите удалить запись?")){
                        return false;
                    }
                     $.ajax({
                       url: "' . $this->deleteUrl . '?id="+currentId,
                       type: "POST",
                       success: function(data){
                             $.pjax.reload({
                                container: gridSelector,
                             });
                       }
                     });
                    return false;
                });

                $("#mailing").on("click", function () {
                    var selection = new Array();
                    $(\'.grid-view table input[type="checkbox"]\').each(function() {
                        if($(this).attr("class") !== "select-on-check-all") {
                            if($(this).prop("checked")) {
                                selection[selection.length] = $(this).val();
                            }
                        }
                    });
                    var selectionJSON = JSON.stringify(selection);
                    console.log(selectionJSON)
                    window.location.href = "' . $this->mailingUrl . '?selection=" + selectionJSON
                    return false;
                });

                isEndEnter = false;
                $("#search").on("keypress",function(e){
                    if(e.which == 13) {
                        text = $(this).val();
                        $.pjax.reload({
                            container: gridSelector,
                            url: searchUrl+"?search="+text
                        });
                    }
                    isEndEnter = false;
                    var interval = setInterval(function() {
                    }, 2000);

                });


            });
        ', View::POS_END, 'create-user');
    }
}
