<?php
function app()
{
    return Yii::$app;
}
function isPost()
{
    return Yii::$app->request->isPost;
}
function post($key = null)
{
    return Yii::$app->request->post($key);
}
function get($key = null)
{
    return Yii::$app->request->get($key);
}
function setFlash($type, $msg)
{
    Yii::$app->session->setFlash($type, $msg);
}
function userLang()
{
    return Yii::$app->user->identity->language;
}
