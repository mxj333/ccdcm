<?php

function saveCache($name, $value) {
    return file_put_contents(CACHE . '~' . $name . '.php', "<?php return " . var_export($value, true) . ";?>");
}

//判断当前浏览器是否为微信内置的浏览器
function is_weixin() {
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return true;
    }
    return false;
}

/**
 * 是否为移动端访问
 *
 * @return bool
 */
function is_mobile() {

    // returns true if one of the specified mobile browsers is detected
    // 如果监测到是指定的浏览器之一则返回true
    $regex_match = "/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";

    $regex_match .= "htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";

    $regex_match .= "blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";

    $regex_match .= "symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";

    $regex_match .= "jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";

    $regex_match .= ")/i";

    // preg_match()方法功能为匹配字符，既第二个参数所含字符是否包含第一个参数所含字符，包含则返回1既true
    return preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
}

//后台菜单
function ZEN_MEUN($structures, $managements, $controller) {
    $structure = json_decode($structures, true);
    $management = json_decode($managements, true);

    //数据重组
    $ZEN_MEUN = [];
    foreach ($structure as $key => $value) {

        $ZEN_MEUN[$value['id']] = $value['id'];

        //如果有二级菜单则显示
        if (isset($management[$value['id']])) {
            foreach ($management[$value['id']] as $k => $sub) {

                if ($sub['structure_id'] == $value['id']) {
                    $value['sub'][] = $sub;
                }

                //当前页面选中状态
                if (strtoupper($sub['name']) == strtoupper($controller)) {
                    $ZEN_MEUN['bannerActive'] = $sub['structure_id'];
                }
            }

            //设置一级菜单选中状态
            $value['name'] = $management[$value['id']][0]['name'];
        }
        $ZEN_MEUN[$value['id']] = $value;
    }

    return $ZEN_MEUN;
}

//路径导航
function breadcrumb($ZEN_MEUN, $bannerActive, $listsName, $child = false) {
    $i = 1;
    $breadcrumb[0]['label'] = $ZEN_MEUN[$bannerActive]['label'];
    $breadcrumb[0]['url'] = $ZEN_MEUN[$bannerActive]['url'];
    $name = strtolower($ZEN_MEUN[$bannerActive]['name']);
    foreach ($ZEN_MEUN[$bannerActive]['sub'] as $bre => $_breadcrumb) {
        if (strtolower($_breadcrumb['name']) == strtolower($listsName)) {
            $breadcrumb[$i]['label'] = $_breadcrumb['label'];
            $breadcrumb[$i]['url'] = $_breadcrumb['url'];
            if (strtolower($_breadcrumb['name']) == $name) {
                //unset($breadcrumb[$i]);
            }
        }
        $i++;
    }
    if ($child) {
        unset($breadcrumb[0]);
    }
    return $breadcrumb;
}

//根据权限重组菜单
function get_authorized($authorized, $structures, $managements) {

    //以,分割数组
    $_temp = explode(',', $authorized);
    foreach ($_temp as $key => $val) {
        //以-分割数组
        list($stru[], $mana[]) = explode('-', $val);
    }

    $result = [];

    //根据权限重组一级菜单
    $_st = array_unique($stru);
    $_oldst = setArrayByField(json_decode($structures, true), 'id');
    unset($structures);
    foreach ($_st as $key => $str) {
        $_structures[] = $_oldst[$str];
    }
    $result['structures'] = json_encode($_structures);

    //根据权限重组二级菜单
    $_mana = array_unique($mana);
    $_oldmana = json_decode($managements, true);
    unset($managements);
    foreach ($_mana as $val) {
        foreach ($_oldmana as $maval) {
            foreach ($maval as $usb) {
                if ($usb['id'] == $val) {
                    $subMent[$usb['structure_id']][] = $usb;
                }
            }
        }
    }
    $result['managements'] = json_encode($subMent);
    return $result;
}

function get_extension($file) {
    return pathinfo($file, PATHINFO_EXTENSION);
}

// 获取某个程序当前的进程数
function get_proc_count($name) {
    $cmd = "ps -e"; //调用ps命令
    $output = shell_exec($cmd);
    $result = substr_count($output, ' ' . $name);
    return $result;
}

//截取中文标题
function getShortTitle($title, $length = 12, $stat = '') {
    return msubstr(html_entity_decode($title), 0, $length, 'utf-8', $stat);
}

//截取中文字符串
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
    $str = strip_tags($str);
    if (function_exists("iconv_substr")) {
        return iconv_substr($str, $start, $length, $charset) . $suffix;
    } elseif (function_exists('mb_substr')) {
        return mb_substr($str, $start, $length, $charset) . $suffix;
    }
    $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("", array_slice($match[0], $start, $length));
    if ($suffix) {
        return $slice . "…";
    }
    return $slice;
}

//curl模拟post 数据
function curl_post($url, $post = array()) {
    $options = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $post,
    );

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

/**
 * 通过curl方式获取url地址的html内容
 * $url 目标网站
 * return string 返回HTML内容
 */
function getHtmlByCurl($url) {
    // curl 初始化
    $ch = curl_init();

    // 需要抓取的页面路径
    curl_setopt($ch, CURLOPT_URL, $url);

    // 伪造火狐浏览器
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    // 将获取的信息以文件流的形式返回，而不是直接输出
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // 超时时间
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);

    // 伪造ip
    curl_setopt($ch, CURLOPT_PROXY, C('CURL_AGENT_IP'));

    // 抓取的内容放在变量中
    $file_contents = curl_exec($ch);
    $curl_info = curl_getinfo($ch);

    // 状态码
    $http_code = $curl_info['http_code'];

    // 关闭 curl 资源
    curl_close($ch);
    if ($http_code == '200') {
        return $file_contents;
    } else {
        return '';
    }
}

/*
 * getValueByField
 * 获取数组字段值
 * @param array $array 数组 默认为 array()
 * @param string $field 字段名 默认为id
 *
 * @return array $result 数组(各字段值)
 *
 */
function getValueByField($array = array(), $field = 'id') {
    $result = array();
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            $result[] = $value[$field];
        }
    }
    return $result;
}

//设置、读取配置
function C($key, $value = 0) {
    if ($value) {
        return Configure::write($key, $value);
    } else {
      return Cake\Core\Configure::read($key);
    }
}

/*
 * setArrayByField
 * 根据字段重组数组
 * @param array $array 数组 默认为 array()
 * @param string $field 字段名 默认为id
 *
 * @return array $result 重组好的数组
 *
 */
function setArrayByField($array = array(), $field = 'id') {
    $result = array();
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            $result[$value[$field]] = $value;
        }
    }
    return $result;
}

/*
 * 获取某个时间段里的工作日
 * @param int $time 时间戳
 * @param int $days 天数
 */
function afterWorkingDay($time, $days) {
    $count = 0;

    //2016年法定节假日
    $legal_holidays = C('LEGAL_HOLIDAYS');
    $legal_workdays = C('LEGAL_WORKDAYS');

    while (intval($count) < $days) {
        $week = date('w', $time + (24 * 3600));
        if (in_array(C('LEGAL_WORKDAYS')) || ($week != 6 && $week != 0 && !in_array(date('Ymd', $time + (24 * 3600)), C('LEGAL_HOLIDAYS')))) {
            // if ($week != 6 && $week != 0 && !in_array(date('Ymd', $time + (24 * 3600)), $legal_holidays)) {
            $count++;
        }
        $time = $time + (24 * 3600);
    }
    return $time;
}

/*
 * download
 * 下载
 * @param string $filePath 文件相对路径 例: /Uploads/test/
 * @param string $fileName 下载文件名称 例: uploads
 * @param string $ext  文件后缀名 例: rar
 *
 */
function download($filePath, $fileName, $ext, $flag = true) {
    if ($flag) {
        $filePath = $filePath . $fileName . '.' . $ext;
    }
    $filesize = filesize($filePath);
    $downloadType = C('DOWNLOAD_TYPE');
    $type = $downloadType[$ext] ? $downloadType[$ext] : 'octet-stream';
    // fopen读取文件，重新输出
    if ($handle = fopen($filePath, "r")) {

        Header("Content-type:text/html;charset=utf8");
        Header("Content-type: application/" . $type);
        Header("Accept-Ranges: bytes");
        Header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        Header("Pragma: public");
        Header("Content-Length: " . $filesize);
        Header("Content-Disposition: attachment; filename=" . $fileName . '.' . $ext);
        readfile($filePath);
        fclose($handle);
        clearstatcache();
        exit();
    } else {
        Header('Location: http://' . $_SERVER['HTTP_HOST']);
    }
}

//汉字转拼音
function pinyin($_String, $_Code = 'gb2312') {
    $_DataKey = "a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha" .
        "|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|" .
        "cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er" .
        "|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui" .
        "|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang" .
        "|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang" .
        "|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue" .
        "|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne" .
        "|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen" .
        "|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang" .
        "|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|" .
        "she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|" .
        "tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu" .
        "|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you" .
        "|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|" .
        "zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo";

    $_DataValue = "-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990" .
        "|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725" .
        "|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263" .
        "|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003" .
        "|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697" .
        "|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211" .
        "|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922" .
        "|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468" .
        "|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664" .
        "|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407" .
        "|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959" .
        "|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652" .
        "|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369" .
        "|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128" .
        "|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914" .
        "|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645" .
        "|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149" .
        "|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087" .
        "|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658" .
        "|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340" .
        "|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888" .
        "|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585" .
        "|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847" .
        "|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055" .
        "|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780" .
        "|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274" .
        "|-10270|-10262|-10260|-10256|-10254";

    $_TDataKey = explode('|', $_DataKey);
    $_TDataValue = explode('|', $_DataValue);
    $_Data = (PHP_VERSION >= '5.0') ? array_combine($_TDataKey, $_TDataValue) : _Array_Combine($_TDataKey, $_TDataValue);

    arsort($_Data);
    reset($_Data);

    if ($_Code != 'gb2312') {
        $_String = _U2_Utf8_Gb($_String);
    }
    $_Res = '';
    for ($i = 0; $i < strlen($_String); $i++) {
        $_P = ord(substr($_String, $i, 1));
        if ($_P > 160) {
            $_Q = ord(substr($_String, ++$i, 1));
            $_P = $_P * 256 + $_Q - 65536;
        }
        $_Res .= _Pinyin($_P, $_Data);
    }

    return preg_replace("/[^a-z0-9]*/", '', $_Res);
}

//汉字转拼音
function _Pinyin($_Num, $_Data) {
    if ($_Num > 0 && $_Num < 160) {
        return chr($_Num);
    } elseif ($_Num < -20319 || $_Num > -10247) {
        return '';
    } else {
        foreach ($_Data as $k => $v) {
            if ($v <= $_Num) {
                break;
            }
        }
        return $k;
    }
}

function _U2_Utf8_Gb($_C) {
    $_String = '';
    if ($_C < 0x80) {
        $_String .= $_C;
    } elseif ($_C < 0x800) {
        $_String .= chr(0xC0 | $_C >> 6);
        $_String .= chr(0x80 | $_C & 0x3F);
    } elseif ($_C < 0x10000) {
        $_String .= chr(0xE0 | $_C >> 12);
        $_String .= chr(0x80 | $_C >> 6 & 0x3F);
        $_String .= chr(0x80 | $_C & 0x3F);
    } elseif ($_C < 0x200000) {
        $_String .= chr(0xF0 | $_C >> 18);
        $_String .= chr(0x80 | $_C >> 12 & 0x3F);
        $_String .= chr(0x80 | $_C >> 6 & 0x3F);
        $_String .= chr(0x80 | $_C & 0x3F);
    }
    return iconv('UTF-8', 'GB2312', $_String);
}

function _Array_Combine($_Arr1, $_Arr2) {
    for ($i = 0; $i < count($_Arr1); $i++) {
        $_Res[$_Arr1[$i]] = $_Arr2[$i];
    }
    return $_Res;
}

//获取封面图
function getCover($data) {
    $path = substr($data['art_cover_path'] . DS . 'thumbnail-' . $data['art_cover'], 7);
    if (file_exists('.' . $path)) {
        $result = $path;
    } else {
        $result = 'http://placehold.it/150x120?text=销保网';
    }
    return $result;
}

/**
 * 时间格式化
 * 格式如：yyyy-MM-dd HH:mm:ss
 */
function fromDate($datetime, $from = 'yyyy-MM-dd') {
    // use Cake\I18n\Time;
    class_alias('Cake\I18n\Time', 'Time');
    $now = Time::parse($datetime);
    return $now->i18nFormat($from);
}

//发送短信
function sendSMS($data) {

    //整理数据
    $mobile = $data['mobile'];
    $verify = $data['verify'];

    //引入阿里大于SDK，并实例化
    require_once ROOT . DS . 'vendor' . DS . "alidayu-sdk" . DS . "TopSdk.php";
    $c = new TopClient;

    //请填写自己的app key
    $c->appkey = "23446879";

    //请填写自己的app secret
    $c->secretKey = "";

    $req = new AlibabaAliqinFcSmsNumSendRequest;

    //公共回传参数
    $req->setExtend("123456");

    //短信类型，传入值请填写normal
    $req->setSmsType("normal");

    //短信签名，传入的短信签名必须是在阿里大于“管理中心-短信签名管理”中的可用签名。
    $req->setSmsFreeSignName("销保网");

    /** 短信模板变量，传参规则{"key":"value"}，
     * key的名字须和申请模板中的变量名一致，多个变量之间以逗号隔开。
     *示例：
     *
     *针对模板“验证码${code}，您正在进行${product}身份验证，打死不要告诉别人哦！”，
     *
     *传参时需传入{"code":"1234","product":"alidayu"}
     */
    // $req->setSmsParam("{\"code\":\"1234\",\"product\":\"alidayu\"}");
    $req->setSmsParam("{\"verify\": \"$verify\"}");

    //请填写需要接收的手机号码
    // $req->setRecNum('13693640316');
    $req->setRecNum("$mobile");

    //短信模板id
    // $req->setSmsTemplateCode("SMS_585014");
    $req->setSmsTemplateCode("SMS_14266852");

    $resp = $c->execute($req);
    pr($resp);

}

//递归创建目录
function mkpath($path) {
    // Make the slashes are all single and lean the right way
    $path = preg_replace('/(\/){2,}|(\\\){1,}/', '/', $path);

    // Make an array of all the directories in path
    $dirs = explode("/", $path);

    // Verify that each directory in path exist. Create it if it doesn't
    $path = "";
    foreach ($dirs as $element) {
        $path .= $element . "/";
        if (!is_dir($path)) { // Directory verified here
            mkdir($path); // Created if it doesn't exist
        }
    }
}

//获取微信公众号文章内容
function wechat($target) {
    require_once ROOT . DS . 'vendor' . DS . "Wechat.php";

    $path = './files' . DS . 'Articles' . DS . 'weixin' . DS . date('Y') . DS . date('md');
    $res = new Wechat($target, $path);

    return $res->fetch();
}

//删除特殊符号
function delete_special_mark($str) {
    //去除字符串 首尾 空白等特殊符号或指定字符序列
    $str = trim($str);

    //去掉 HTML、XML 以及 PHP 的标签
    $str = strip_tags($str, "");

    //去掉TAB切换产生的符号
    $str = ereg_replace("\t", "", $str);

    //去掉换行 通常是两个enter造成
    $str = ereg_replace("\r\n", "", $str);

    //去掉enter换行
    $str = ereg_replace("\r", "", $str);

    //去掉换行
    $str = ereg_replace("\n", "", $str);

    //去掉|
    // $str = str_replace("|", "", $str);

    //去掉空白
    $str = ereg_replace(" ", " ", $str);

    //处理从数据库或 HTML 表单中取回数据包含的特殊符号
    $str = stripslashes($str);

    //删除bom标记
    $str = preg_replace('/^(\xef\xbb\xbf)/', '', $str);

    return $str;
}

function parse_array($string, $beg_tag, $close_tag) {
    preg_match_all("($beg_tag(.*)$close_tag)siU", $string, $matching_data);
    return $matching_data[0];
}

function remove($string, $open_tag, $close_tag) {
    # Get array of things that should be removed from the input string
    $remove_array = parse_array($string, $open_tag, $close_tag);

    # Remove each occurrence of each array element from string;
    for ($xx = 0; $xx < count($remove_array); $xx++) {
        $string = str_replace($remove_array, "", $string);
    }

    return $string;
}

//从文章内容中保存远程图片
function saveRemoteImages($body) {

    require_once ROOT . DS . 'vendor' . DS . "autoload.php";
    // use MajaLin\Webbot\Parse as MS_Parse;
    // class_alias('MajaLin\Webbot', 'Parse');
    $parse = new Parse();

    $img_tag_array = $parse->parse_array($body, "<img", ">");

    if (count($img_tag_array) == 0) {
        return $body;
        exit;
    }

    var_dump($img_tag_array);exit;

/*
//删除反斜杠
$body = stripslashes($body);
$img_array = array();

//匹配内容中的图片
preg_match_all('/src="(http:\/\/(.*).(gif|jpg|jpeg|bmp|png))/is', $body, $img_array);
// preg_match("/[\/]([^\/]*)[\.]?[^\.\/]*$/", $imgUrl, $m);

// var_dump($img_array);
// exit;
// $img_array = array_unique($img_array[2]);
set_time_limit(0);

$img_dir = './ueditor' . DS . 'php' . DS . 'upload' . DS . 'image';
$imgUrl = $img_dir . "/" . strftime("%Y%m%d", time());
$imgPath = $imgUrl;
$milliSecond = strftime("%H%M%S", time());
if (!is_dir($imgPath)) {
@mkdir($imgPath, 0777);
}

foreach ($img_array as $key => $value) {
// var_dump($value);

// 取出防盗链地址中的data-src值后的http://url主体部分
preg_match('/[a-zA-z]+:\/\/[^\s]*\/[mmbiz|mmbiz_jpg]\/([^\s\/]*)\/\d+\?[^\s"]*|[a-zA-z]+:\/\/[^\s]*[mmbiz|mmbiz_jpg]\/([^\s\/]*)\/\d+/', $value, $temp);
$temp = array_filter($temp);

var_dump($temp);

// $value = trim($value);
// $get_file = @file_get_contents($value);
// $rndFileName = $imgPath . "/" . $milliSecond . $key . "." . substr($value, -3, 3);
// $fileurl = $imgUrl . "/" . $milliSecond . $key . "." . substr($value, -3, 3);
// if ($get_file) {
//     $fp = @fopen($rndFileName, "w");
//     @fwrite($fp, $get_file);
//     @fclose($fp);
// }
// $body = ereg_replace($value, $fileurl, $body);
}
 */
    // return $body; // = addslashes($body);
}

/**
 * 拉取远程图片
 * @return mixed
 */
function saveRemote($body) {
    $imgUrl = htmlspecialchars($body);
    $imgUrl = str_replace("&amp;", "&", $imgUrl);

    //http开头验证
    if (strpos($imgUrl, "http") !== 0) {
        $this->stateInfo = $this->getStateInfo("ERROR_HTTP_LINK");
        return;
    }
    //获取请求头并检测死链
    $heads = get_headers($imgUrl);
    if (!(stristr($heads[0], "200") && stristr($heads[0], "OK"))) {
        $this->stateInfo = $this->getStateInfo("ERROR_DEAD_LINK");
        return;
    }
    //格式验证(扩展名验证和Content-Type验证)
    $fileType = strtolower(strrchr($imgUrl, '.'));
    if (!in_array($fileType, $this->config['allowFiles']) || stristr($heads['Content-Type'], "image")) {
        $this->stateInfo = $this->getStateInfo("ERROR_HTTP_CONTENTTYPE");
        return;
    }

    //打开输出缓冲区并获取远程图片
    ob_start();
    $context = stream_context_create(
        array('http' => array(
            'follow_location' => false, // don't follow redirects
        ))
    );
    readfile($imgUrl, false, $context);
    $img = ob_get_contents();
    ob_end_clean();
    preg_match("/[\/]([^\/]*)[\.]?[^\.\/]*$/", $imgUrl, $m);

    $this->oriName = $m ? $m[1] : "";
    $this->fileSize = strlen($img);
    $this->fileType = $this->getFileExt();
    $this->fullName = $this->getFullName();
    $this->filePath = $this->getFilePath();
    $this->fileName = $this->getFileName();
    $dirname = dirname($this->filePath);

    //检查文件大小是否超出限制
    if (!$this->checkSize()) {
        $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
        return;
    }

    //创建目录失败
    if (!file_exists($dirname) && !mkdir($dirname, 0777, true)) {
        $this->stateInfo = $this->getStateInfo("ERROR_CREATE_DIR");
        return;
    } else if (!is_writeable($dirname)) {
        $this->stateInfo = $this->getStateInfo("ERROR_DIR_NOT_WRITEABLE");
        return;
    }

    //移动文件
    if (!(file_put_contents($this->filePath, $img) && file_exists($this->filePath))) {
        //移动失败
        $this->stateInfo = $this->getStateInfo("ERROR_WRITE_CONTENT");
    } else {
        //移动成功
        $this->stateInfo = $this->stateMap[0];
    }

}

/**
 *  上传文件方法
 *
 *  @param string $file //文件名
 *
 *  @param string $dir //目录
 *
 *  @param array $type //文件
 *
 */
function upload_file($file = 'file', $dir = 'image', $size = array(50, 50), $type = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif')) {
    // 设置上传路径并获取上传文件
    $upload_dir = 'files' . DS . $dir . DS;
    $upload_dir .= date('Y/m/d', time());
    // pr($upload_dir);die;
    if (!file_exists($upload_dir)) {
        //文件夹不存在，先生成文件夹
        mkdir($upload_dir, 0777, true);
    }
    $thumbnail = $upload_dir . '/thumbnail';
    if (!file_exists($thumbnail)) {
        //文件夹不存在，先生成文件夹
        mkdir($thumbnail, 0777, true);
    }
    // pr($upload_dir);die;
    $storage = new \Upload\Storage\FileSystem($upload_dir);
    $file = new \Upload\File($file, $storage);

    //检查上传文件
    if (!$file->validate()) {
        # code...
        $errors['status'] = 0;
        $errors['error'] = $file->getErrors();
        return $errors;
        exit();
    }

    // 重命名上传文件
    $new_filename = uniqid();
    $file->setName($new_filename);

    // 验证文件上传
    // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
    $file->addValidations(array(
        //您还可以添加多个mimetype验证
        new \Upload\Validation\Mimetype($type),
        new \Upload\Validation\Size('5M'),
    ));

    // 访问有关已上传文件的数据
    // $data = array(
    //     'name' => $file->getNameWithExtension(),
    //     'extension' => $file->getExtension(),
    //     'mime' => $file->getMimetype(),
    //     'size' => $file->getSize(),
    //     'md5' => $file->getMd5(),
    //     'dimensions' => $file->getDimensions(),
    // );
    // Try to upload file
    try {
        // Success!
        if ($file->upload()) {
            //上传成功后，生成缩略图
            $openfile = $upload_dir . DS . $file->getNameWithExtension();
            $imagine = new \Imagine\Gd\Imagine();
            $transformation = new \Imagine\Filter\Transformation();

            //设置缩略图的大小，及保存路径
            $transformation->thumbnail(new \Imagine\Image\Box($size[0], $size[1]));
            $transformation->apply($imagine->open($openfile))
                ->save($upload_dir . DS . 'thumbnail' . DS . $file->getNameWithExtension());
            return $res = array(
                'status' => 1,
                'data' => array(
                    'filename' => $openfile,
                    'thum_filename' => $upload_dir . DS . 'thumbnail' . DS . $file->getNameWithExtension(),
                ),
            );
        }
    } catch (\Exception $e) {
        // Fail!
        $errors['status'] = 0;
        $errors['error'] = $file->getErrors();
        return $errors;
    }
}

/**
 * 创建布局函数
 *
 * @param int       $width    //宽
 * @param int       $height   //高
 * @param int       $size     //网格宽度
 * @param string    $text     //布局名称
 * @param string    $bgimg    //背景图
 * @param int       $is_grid  //是否带网格 0:无网格; 1:有网格
 * @param string    $ttf      //字体
 */
function creat_layout($width = 800, $height = 600, $size = 50, $text = '布局平面图', $bgimg = '', $is_grid = 0, $ttf = 'msyh.ttf') {
    if (!empty($bgimg)) {
        //创建一个基于已知图片的画布
        $srcim = imagecreatefrompng($bgimg);
        //获取图片尺寸
        $w = imagesx($srcim);
        $h = imagesy($srcim);
    }

    //创建画布，准备画笔颜色
    $im = imagecreate($width, $height); //创建一个400X400像素的画布
    $bg = imagecolorallocate($im, 220, 220, 220); //灰色
    $red = imagecolorallocate($im, 000, 000, 000); //为画布分配色
    $blue = imagecolorallocate($im, 155, 155, 155); //为画布分配色

    $x = $width / 2 - imagefontwidth(4) * mb_strlen($text) / 2;
    // echo $x;die();
    //开始绘画
    if (!empty($bgimg)) {
        //有背景图片
        imagecopyresampled($im, $srcim, 0, 0, 0, 0, $width, $height, $w, $h);
    } else {
        //没有背景图
        imagefill($im, 0, 0, $bg); //填充背景颜色
    }

    $maxSize = max($width, $height);
    imagettftext($im, 14, 0, $x, 40, $red, $ttf, $text); //名称

    if ($is_grid == 1) {
        imagestring($im, 5, 5, 5, 'Y X', $red);
        for ($xy = $size; $xy < $maxSize; $xy += $size) {
            if ($xy < $width) {
                //y
                imagedashedline($im, $xy, 0, $xy, $height, $blue);
                imagestring($im, 5, $xy + 5, 5, $xy, $red);
                // imagestring($im,5,50,50,"Hello PHP!",$c2);
            }
            if ($xy < $height) {
                //x
                imageline($im, 0, $xy, $width, $xy, $blue);
                imagestring($im, 5, 5, $xy + 5, $xy, $red);
            }
        }
    }

    //3.输出图像
    header("Content-Type:image/png"); //指定响应类型
    return imagepng($im); //输出图像

    //4.释放资源
    if (!empty($bgimg)) {
        imagedestroy($srcim);
    }
    imagedestroy($im);
}

/**
 * 获取客户端IP
 */
function getClientIP() {
    //获取ip
    $ip = '';
    if (isset($_SERVER)) {
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } else if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else {
            $ip = getenv("REMOTE_ADDR");
        }
    }
    return $ip;
}

/**
 * 创建工单编号
 * @param $company_id = 0 //公司ID 默认0
 * @param $isAdd = 0 //默认加  0:加;1:减
 * @param $base = 1  //增加的基数  默认为1
 * @param $wo_num = ''; //默认编号
 */
function creatWorkOrderNumber($company_id = 0, $isAdd = 0, $base = 1, $wo_num = '') {
    $dir = TMP . 'work_order_num' . DS;
    $path = $dir . $company_id;

    if (!file_exists($dir)) {
        //文件夹不存在，先生成文件夹
        mkdir($dir, 0777, true);
    }
    if (strlen($wo_num) == 0) {
        $node = 0;
        $order_num = date('Ymd') . str_pad($node, 6, 0);
    } else {
        $order_num = $wo_num;
    }
    if (!file_exists($path)) {
        //文件不存在
        file_put_contents($path, $order_num);
    } else {
        $order_num = file_get_contents($path);
        if (strlen($wo_num) == 0) {
            //判断日期是否需要改变
            $today = date("Ymd");
            $num = substr($order_num, 0, 8);
            if ($today != $num) {
                $node = 0;
                $order_num = date('Ymd') . str_pad($node, 6, 0);
                file_put_contents($path, $order_num);
            }
        }
        $order_num = $order_num;
    }

    if ($isAdd) {
        $new_num = $order_num - $base;
        file_put_contents($path, $new_num);
    } else {
        $new_num = $order_num + $base;
        file_put_contents($path, $new_num);
    }

    return $order_num;

}


/**
 * 获取多维数组中指定key的所有值
 */
function searchMultiArray(array $array, $search, $mode = 'key') {
    $res = array();
    foreach (new RecursiveIteratorIterator(new RecursiveArrayIterator($array)) as $key => $value) {
        if ($search === ${${"mode"}}){
            if($mode == 'key'){
                $res[] = $value;
            }else{
                $res[] = $key;
            }
        }
    }
    return $res;
}
