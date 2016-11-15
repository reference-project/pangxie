<?php
/*
    $_GET=array("id"=>1,"nickname"=>"xxxx")
 * */
$uid=$_GET['id'];
$nid=$_GET['id'];
$name=$_GET['name'];
$nname=$_GET['fname'];
$ts=$_GET['t'];
$host='localhost';
$user='root';
$passwd='111111';
$database='pangxie';
$con=mysqli_connect($host,$user,$passwd,$database);
if (mysqli_connect_errno($con))
{
    echo "连接 MySQL 失败: " . mysqli_connect_error();
}
$sql="SELECT headimg  FROM  user where id='".$nid."'";
$res=mysqli_query($con,$sql);
$result = mysqli_fetch_array($res,MYSQLI_ASSOC);
$headimg=$result['headimg'];
$sql2="SELECT nickname  FROM  user where id='".$nid."'";
$res2=mysqli_query($con,$sql2);
$result2 = mysqli_fetch_array($res2,MYSQLI_ASSOC);
$nickname=$result2['nickname'];
$sql2="SELECT times  FROM  user where id='".$nid."'";
$res2=mysqli_query($con,$sql2);
$result2 = mysqli_fetch_array($res2,MYSQLI_ASSOC);
$times=$result2['times'];
$sql3="SELECT ticket2  FROM  user where id='".$nid."'";
$res3=mysqli_query($con,$sql3);
$result3 = mysqli_fetch_array($res3,MYSQLI_ASSOC);
$ticket2=$result3['ticket2'];
if($ticket1==1){//$ticket2是7.100折
    if($times>=200){ /*此处$times为用户获取朋友点击数量，为大于等于100切小于200时才对*/
        $sql1="SELECT price  FROM  seven where type='"."0"."'";
        $r=mysqli_query($con,$sql1);
        $data= mysqli_fetch_all($r,MYSQLI_ASSOC);
        $a=rand(0,count($data)-1);
        $ticket1=$data[$a]['price'];
        $sqle="UPDATE user SET ticket2='".$ticket1."' where id='".$uid."'  ";
        mysqli_query($con,$sqle);
        $ticket1=$data[$a]['price'];
        $sql2="UPDATE seven SET type='"."1"."'where price='".$ticket1."'";
        mysqli_query($con,$sql2);
    }else{

    }
}
$sql7="SELECT ticket1  FROM  user where id='".$nid."'";
$res7=mysqli_query($con,$sql7);
$result7 = mysqli_fetch_array($res7,MYSQLI_ASSOC);
$ticket1=$result7['ticket1'];
if($ticket2==1){//$ticket1 是8.7100折
if($times>=100&&$times<200){
    $sql1="SELECT price  FROM  eight where type='"."0"."'";
    $r=mysqli_query($con,$sql1);
    $data= mysqli_fetch_all($r,MYSQLI_ASSOC);
    $a=rand(0,count($data)-1);
    $ticket1=$data[$a]['price'];
    $sqle="UPDATE user SET ticket2='".$ticket1."' where id='".$uid."'  ";
    mysqli_query($con,$sqle);
    $ticket1=$data[$a]['price'];
    $sql2="UPDATE eight SET type='"."1"."'where price='".$ticket2."'";
    mysqli_query($con,$sql2);
}else{

    }
}
$sql1="SELECT *  FROM  friend where uid='".$nid."'";
$r=mysqli_query($con,$sql1);
$data= mysqli_fetch_all($r,MYSQLI_ASSOC);
require_once "jssdk.php";
$jssdk = new JSSDK("wx0beed264f1a96f07", "f157e5bb45da450c39352180f795300b");
$signPackage = $jssdk->GetSignPackage();
$news = array(
    "Title" =>$nickname."被伤了",
    "Description"=>$nickname."受伤了，快来帮帮忙",
    "PicUrl" =>$headimg,
    "Url" =>"http://all.minizhen.com/pangxie/ready.php?nid=$nid&name=$name",
);
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no"/>
    <title>速来补刀剁爪</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/mdialog.css">
</head>
<body>

<div class="main">
    <header>
        <img src="images/top.png">
    </header>
    <div class="px_wrap">
        <div class="head_img">
            <img src="<?php echo $headimg ?>">
        </div>
        <div class="px_leg l1">
            <img src="images/l1.png">
        </div>
        <div class="px_leg r1">
            <img src="images/r1.png">
        </div>
        <div class="px_leg l2">
            <img src="images/l2.png">
        </div>
        <div class="px_leg r2">
            <img src="images/r2.png">
        </div>
        <div class="px_leg l3">
            <img src="images/l3.png">
        </div>
        <div class="px_leg r3">
            <img src="images/r3.png">
        </div>
        <div class="px_leg l4">
            <img src="images/l4.png">
        </div>
        <div class="px_leg r4">
            <img src="images/r4.png">
        </div>
        <div class="px_leg l5">
            <img src="images/l5.png">
        </div>
        <div class="px_leg r5">
            <img src="images/r5.png">
        </div>

    </div>
    <div class="main_1">
        <h3><?php echo $nickname?></h3>
        <h4>被剁<span id="leg-num"><?php echo floor(count($data)/10); ?></span>只爪</h4>
        <p style="text-align: center;margin-top:2px">剁满10只爪获得1只大闸蟹</p>
        <div class="btn btn-get">
            <?php $a=count($data);
            if($a>=100&&$a<200){?>
            <a href="coupon.php?nname=<?php echo $nickname?>&user=<?php echo $_GET['fname'];?>">当前免费获得<span id="px-num">1</span>只阳澄湖大闸蟹</a>
            <?php }elseif($a>=200){ ?>
            <a href="coupon.php?nname=<?php echo $nickname?>&user=<?php echo $_GET['fname'];?>"> 当前免费获得<span id="px-num">2</span>只阳澄湖大闸蟹</a>
            <?php }else{ ?>
            <a href="coupon1.html"> 当前免费获得<span id="px-num">0</span>只大闸蟹</a>
        <?php } ?>
    </div>
        <div class="tip">
            免费获得的大闸蟹在大闸蟹礼盒中减免现金
        </div>
        <?php if($nickname==$nname || $nickname==$name){?>
            <div class="btn btn-yh">
                分享给好友，召唤小伙伴帮你剁爪
            </div>
        <?php }else{?>
            <div class="btn btn-look" onclick="window.location.href='ready.php'">
                查看给我补刀的好友
            </div>
     <?php   }?>
        <div class="friend_wrap">
            <h3>
                总计<span id='friend-num'><?php echo count($data)?></span>个好友给<?php echo $nickname?>剁爪补刀
            </h3>
            <div class="friend">
                <?php
                if(count($data)<10){?>
                <div class="friend_list">
                    <div class="">
                        还差<?php echo 10-(count($data)%10);?>个好友补刀，<font color="#000"><?php echo $nickname?></font>被剁爪1只
                    </div>
                    <ul>
                        <?php
                        $k=0;
                        for($i=0;$i<count($data);$i++){
                            $k++;
                            echo  $html="<li>".
                                "<img src='".$data[$i]['fimg']."'>"
                                ."</li>";
                            /*echo $html.= "<div class='list_head'>".
                             "再有". 9-count($data)%9."个好友补刀，我会被剁爪"
                             ."</div>";
                              }
                             echo $html;*/}
                        ?>
                    </ul>
                </div>
             <?php   }else{
                    $t=0;
                    for($j=0;$j<=floor(count($data)/10);$j++){
                        $t++;?>
                <div class="friend_list">
                    <div class="list_head">
                        <?php if( $t!=ceil(count($data)/10)){?>
                            10个好友补刀，<font color="black"><?php echo $nickname?></font>被剁爪1只
                        <?php }else{?>
                            还差个<?php echo 10-(count($data)%10);?>好友补刀，<font color="black"><?php echo $nickname?></font>再被剁爪1只
                        <?php }?>
                    </div>
                    <ul>
                        <?php
                        $k=0;
                        for($i=0;$i<10;$i++){
                            $k++;
                            echo  $html="<li>".
                                "<img src='".$data[($t-1)*10+($k-1)]['fimg']."'>"
                                ."</li>";
                            /*echo $html.= "<div class='list_head'>".
                             "再有". 9-count($data)%9."个好友补刀，我会被剁爪"
                             ."</div>";
                              }
                             echo $html;*/}
                        ?>
                    </ul>
                </div>
                    <?php }?>
             <?php    } ?>
        </div>
    </div>
</div>
<script src="js/zepto.js"></script>
<script src="js/mdialog.js"></script>
<script src="jquery-1.8.0.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    $(function(){
        wx.config({
            debug: false,
            appId: '<?php echo $signPackage["appId"];?>',
            timestamp: <?php echo $signPackage["timestamp"];?>,
            nonceStr: '<?php echo $signPackage["nonceStr"];?>',
            signature: '<?php echo $signPackage["signature"];?>',
            jsApiList: [
                // 所有要调用的 API 都要加到这个列表中
                'checkJsApi',
                'openLocation',
                'getLocation',
                'onMenuShareTimeline',
                'onMenuShareAppMessage'
            ]
            //微信配置信息
        });
        wx.ready(function(){
            // 在这里调用 API
            //检查是否支持
            //发送给朋友
            wx.onMenuShareAppMessage({
                title: '<?php echo $news['Title'];?>',
                desc: '<?php echo $news['Description'];?>',
                link: '<?php echo $news['Url'];?>',
                imgUrl: '<?php echo $news['PicUrl'];?>',
                trigger: function (res) {
                    // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
                    // alert('用户点击发送给朋友');
                },
                success: function (res) {
                    // alert('已分享');
                },
                cancel: function (res) {
                    // alert('已取消');
                },
                fail: function (res) {
                    // alert(JSON.stringify(res));
                }
            });
            wx.onMenuShareTimeline({
                title: '<?php echo $news['Title'];?>',
                link: '<?php echo $news['Url'];?>',
                imgUrl: '<?php echo $news['PicUrl'];?>',
                trigger: function (res) {
                    // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
                    // alert('用户点击分享到朋友圈');
                },
                success: function (res) {
                    // alert('已分享');
                },
                cancel: function (res) {
                    // alert('已取消');
                },
                fail: function (res) {
                    // alert(JSON.stringify(res));
                }
            });
        });
        var t="<?php echo floor(count($data)/10);?>";
        function cut(num){
            for (var i = 0; i < num; i++) {
                var $px_leg = $(".px_leg").eq(i)
                switch(i)
                {
                    case 0:
                        $px_leg.addClass("px_left_cut");
                        break;
                    case 1:
                        $px_leg.addClass("px_right_cut");
                        break;
                    case 2:
                        $px_leg.addClass("px_left1_cut");
                        break;
                    case 3:
                        $px_leg.addClass("px_right1_cut");
                        break;
                    case 4:
                        $px_leg.addClass("px_left2_cut");
                        break;
                    case 5:
                        $px_leg.addClass("px_right2_cut");
                        break;
                    case 6:
                        $px_leg.addClass("px_left3_cut");
                        break;
                    case 7:
                        $px_leg.addClass("px_right3_cut");
                        break;
                    case 8:
                        $px_leg.addClass("px_left4_cut");
                        break;
                    case 9:
                        $px_leg.addClass("px_right4_cut");
                        break;
                }
            };
        }

        cut(t);
        var start = window.localStorage.getItem("start")
        var ts ="<?php echo $ts;?>";
        if(ts == 1){
        }else{
            new TipBox({type:'success',str:'你已成功为<?php echo $nickname;?>补刀',hasBtn:true});
            window.localStorage.setItem("start",1)
        }     
    })
	$(".btn-yh").click(function(){
		$(".coupon").toggle();
	})
</script>
</body>
</html>
