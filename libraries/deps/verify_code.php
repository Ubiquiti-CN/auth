<?php

function rand_create() {
    //通知浏览器将要输出PNG图片
    Header("Content-type: image/PNG");
    //准备好随机数发生器种子
    srand((double)microtime()*1000000);
    //准备图片的相关参数
    $im = imagecreate(62,20);
    $black = ImageColorAllocate($im, 0,0,0);  //RGB黑色标识符
    $white = ImageColorAllocate($im, 255,255,255); //RGB白色标识符
    $gray = ImageColorAllocate($im, 200,200,200); //RGB灰色标识符
    //开始作图
    imagefill($im,0,0,$gray);
    while(($randval=rand()%100000)<10000);{
        $_SESSION["login_check_num"] = $randval;
        //将四位整数验证码绘入图片
        imagestring($im, 5, 10, 3, $randval, $black);
    }
    //加入干扰象素
    for($i=0;$i<200;$i++){
        $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
        imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
    }
    //输出验证图片
    ImagePNG($im);
    //销毁图像标识符
    ImageDestroy($im);
}

function getCode($num, $w, $h) {
    $code = "";
    for ($i = 0; $i < $num; $i++) {
        $code .= rand(0, 9);
    }
    //4位验证码也可以用rand(1000,9999)直接生成
    //将生成的验证码写入session，备验证时用
    $_SESSION["ubnt_verify_num"] = $code;
    //创建图片，定义颜色值
    header("Content-type: image/PNG");
    $im = imagecreate($w, $h);
    $black = imagecolorallocate($im, 0, 0, 0);
    $gray = imagecolorallocate($im, 200, 200, 200);
    $bgcolor = imagecolorallocate($im, 255, 255, 255);
    //填充背景
    imagefill($im, 0, 0, $gray);

    //画边框
    imagerectangle($im, 0, 0, $w-1, $h-1, $black);

    //随机绘制两条虚线，起干扰作用
    $style = array ($black,$black,$black,$black,$black,
        $gray,$gray,$gray,$gray,$gray
    );
    imagesetstyle($im, $style);
    $y1 = rand(0, $h);
    $y2 = rand(0, $h);
    $y3 = rand(0, $h);
    $y4 = rand(0, $h);
    imageline($im, 0, $y1, $w, $y3, IMG_COLOR_STYLED);
    imageline($im, 0, $y2, $w, $y4, IMG_COLOR_STYLED);

    //在画布上随机生成大量黑点，起干扰作用;
    for ($i = 0; $i < 80; $i++) {
        imagesetpixel($im, rand(0, $w), rand(0, $h), $black);
    }
    //将数字随机显示在画布上,字符的水平间距和位置都按一定波动范围随机生成
    $strx = rand(3, 8);
    for ($i = 0; $i < $num; $i++) {
        $strpos = rand(1, 6);
        imagestring($im, 5, $strx, $strpos, substr($code, $i, 1), $black);
        $strx += rand(8, 12);
    }
    imagepng($im);//输出图片
    imagedestroy($im);//释放图片所占内存
}