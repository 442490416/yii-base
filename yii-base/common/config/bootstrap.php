<?php
/**
 * 日志路径
 */
Yii::setAlias('@logPath',dirname(dirname(dirname(__DIR__))).'/logs/yii-base');

Yii::setAlias('@common', dirname(__DIR__));

//模块
Yii::setAlias('@modules', dirname(dirname(__DIR__)).'/modules');

