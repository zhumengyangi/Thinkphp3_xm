<?php
    return array(
        // '配置项'=>'配置值'
        
        //  给项目做静态文件访问路由路径的配置
        //  前台
        'HOME_CSS_URL'=>'/Application/Home/Public/css/',
        'HOME_JS_URL'=>'/Application/Home/Public/js/',
        'HOME_IMG_URL'=>'/Application/Home/Public/imgs/',
        //  后台
        'BACK_CSS_URL'=>'/Application/Back/Public/css/',
        'BACK_IMG_URL'=>'/Application/Back/Public/img/',
        'BACK_JS_URL'=>'/Application/Back/Public/js/',
        
        //配置路径，方便第三方功能包文件的访问
        'PLUGIN_URL'    => '/plugin/',
        
        /* 数据库设置 */
        'DB_TYPE'               =>  'mysql',     // 数据库类型
        'DB_HOST'               =>  'localhost', // 服务器地址
        'DB_NAME'               =>  'shop0926',          // 数据库名
        'DB_USER'               =>  'root',      // 用户名
        'DB_PWD'                =>  'root',          // 密码
        'DB_PORT'               =>  '3306',        // 端口
        'DB_PREFIX'             =>  'shop0926_',    // 数据库表前缀
        'DB_PARAMS'             =>  array(), // 数据库连接参数    
        'DB_DEBUG'              =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
        'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
        'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
        /*图片相关设置*/
        'IMG_maxSize'=>'3M',
        'IMG_exts'=>array('jpg','pjpeg','bmp','png','jpeg'),
        'IMG_rootPath'=>'./Public/Uploads',
        /*md5时用来复杂化的*/
        'MD5_KEY'=>'fdsa#@90#_j1239fds!215',

        // 发邮件的配置
        //发件人email
        'MAIL_ADDRESS'=>'1784311404@qq.com',
        //发件人姓名
        'MAIL_FROM'=>'1784311404@qq',
        //邮件服务器的地址
        'MAIL_SMTP'=>'smtp.163.com',
        'MAIL_LOGINNAME'=>'1784311404@qq',
        'MAIL_PASSWORD'=>'wx_860923',

    );

