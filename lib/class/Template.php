<?php

class Template
{
    // 配置数组    
    private        $_array_config = [
        'root'         => '',               // 文件根目录
        'suffix'       => '.html',          // 模板文件后缀
        'template_dir' => 'templates',      // 模板所在文件夹
        'compile_dir'  => 'cache',          // 编译后存放的文件夹
        'cache_dir'    => 'cache',          // 静态html存放地址
        'cache_htm'    => false,            // 是否编译为静态html文件
        'suffix_cache' => '.htm',           // 设置编译文件的后缀
        'cache_time'   => 7200,             // 自动更新间隔
        'php_turn'     => true,             // 是否支持原生php代码
        'debug'        => 'false',
    ];
    private        $_value        = [];
    private        $_compileTool;      // 编译器
    private         $selfUrl;
    private         $Timestamp;
    static private $_instance     = null;
    public         $file;        // 模板文件名
    public         $debug         = [];        // 调试信息


    public function __construct($array_config = [])
    {

        $this->_array_config['root'] = $_SERVER['DOCUMENT_ROOT'] . '/';
        $this->debug['begin']        = microtime(true);
        $this->_array_config         = $array_config + $this->_array_config;
        $this->selfUrl               = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$this->isMobile();
        $this->Timestamp = $this->_array_config['cache_dir'].'/Time.stamp';
        $this->getPath();
        if (!is_dir($this->_array_config['compile_dir'])) {
            mkdir($this->_array_config['compile_dir']);
        }
        if (!is_dir($this->_array_config['cache_dir'])) {
            mkdir($this->_array_config['cache_dir']);
        }
        if(!file_exists($this->Timestamp)){
            file_put_contents($this->Timestamp,time());
        }
        $this->cleanOutTime();
        require('CompileClass.php');
    }

    // 将配置中的路径替换为绝对路径
    public function getPath()
    {
        $this->_array_config['template_dir'] = $this->_array_config['root'] . $this->_array_config['template_dir'] . '/';
        $this->_array_config['compile_dir']  = $this->_array_config['root'] . $this->_array_config['compile_dir'] . '/';
        $this->_array_config['cache_dir']    = $this->_array_config['root'] . $this->_array_config['cache_dir'] . '/';
    }

    //获取设备信息
    public function isMobile()
    {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $p = '/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i';
        $p2 = '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i';
        $ismobile = (preg_match($p, $useragent)||preg_match($p2, substr($useragent, 0, 4)))?"mobile":"computer";
        return $ismobile;
    }
    // 获取模板实例
    public static function getInstance()
    {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // 单步设置配置文件
    public function setConfig($key, $value = null)
    {
        if (is_array($key)) {
            $this->_array_config = $key + $this->_array_config;
        } else {
            $this->_array_config[$key] = $value;
        }
    }

    // 获取当前模板的配置信息
    public function getConfig($key = null)
    {
        if (isset($key)) {
            return $this->_array_config[$key];
        } else {
            return $this->_array_config;
        }
    }

    // 注入单个变量
    public function assign($key, $value)
    {
        $this->_value[$key] = $value;
    }

    // 注入数组变量
    public function assignArray($array)
    {
        if (is_array($array)) {
            foreach ($array as $k => $v) {
                $this->_value[$k] = $v;
            }
        }
    }

    public function path()
    {
        return $this->_array_config['template_dir'] . $this->file . $this->_array_config['suffix'];
    }

    // 是否开启缓存
    public function needCache()
    {
        return $this->_array_config['cache_htm'];
    }

    // 是否需要重新编译静态文件，返回true不编译
    public function reCache()
    {
        $flag       = false;
        $cache_file = $this->_array_config['cache_dir'] . md5($this->selfUrl) . $this->_array_config['suffix_cache'];

        if ($this->needCache() === true) {
            $time_flag = (time() - @filemtime($cache_file)) < $this->_array_config['cache_time'] ? true : false;
            if (is_file($cache_file) and filesize($cache_file) > 1 and $time_flag) {
                $flag = true;
            } else {
                $flag = false;
            }
        }

        return $flag;
    }

    // 显示模板
    public function show($file)
    {
        header('cms_CMS_Version:'.CMS_VERSION);
        header('isMobile:'.$this->isMobile());

        $this->file = $file;
        if (!is_file($this->path())) {
            exit("找不到对应的模板文件".str_replace($_SERVER['DOCUMENT_ROOT'],'',$this->path()));
        }

        $compile_file = $this->_array_config['compile_dir'] . md5($this->path()) . '.php';
        $cache_file   = $this->_array_config['cache_dir'] . md5($this->selfUrl) . $this->_array_config['suffix_cache'];

        // 如果需要重新编译文件
        if ($this->reCache() === false) {
            $this->debug['cached'] = 'false';
            $this->_compileTool    = new CompileClass($this->path(), $compile_file, $this->_array_config);

            if ($this->needCache() === true) {
                // 输出到缓冲区
                ob_start();
            }
            // 将赋值的变量导入当前符号表
            extract($this->_value, EXTR_OVERWRITE);

            if (!is_file($compile_file) or filemtime($compile_file) < filemtime($this->path())) {
                $this->_compileTool->vars = $this->_value;
                $this->_compileTool->compile();
                include($compile_file);
            } else {
                include($compile_file);
            }

            // 如果需要编译成静态文件
            if ($this->needCache() === true) {
                $message = ob_get_contents();
                file_put_contents($cache_file, $message);
            }
        } else {
            readfile($cache_file);
            $this->debug['cached'] = 'true';
        }
        $this->debug['spend'] = microtime(true) - $this->debug['begin'];
        $this->debug['count'] = count($this->_value);
        $this->debugInfo();
    }

    // 打印debug信息    
    public function debugInfo()
    {
        if ($this->_array_config['debug'] === true) {
            echo '----------DEBUG INFO----------', PHP_EOL;
            echo '程序运行日期:', date('Y-m-d h:i:s'), PHP_EOL;
            echo '模板解析耗时:', $this->debug['spend'], '秒', PHP_EOL;
            echo '模板包含标签数目:', $this->debug['count'], PHP_EOL;
            echo '是否使用静态缓存:', $this->debug['cached'], PHP_EOL;
            echo '模板引擎实例化参数:';
            var_dump($this->getConfig());
        }
    }

    // 清除静态的缓存文件
    public function clean($file = null)
    {
        if ($file === null) {
            // 匹配对应规则文件
            $file = array_merge(glob($this->_array_config['cache_dir'] . '*' . $this->_array_config['suffix_cache']),glob($this->_array_config['compile_dir'] . '*' . $this->_array_config['suffix']),glob($this->_array_config['compile_dir'] . '*.zip'));
        } else {
            $file = $this->_array_config['cache_dir'] . md5($this->selfUrl) . $this->_array_config['suffix_cache'];
        }
        foreach ((array)$file as $v) {
            // 删除文件
            unlink($v);
        }
    }

    // 清除过期静态的缓存文件
    public function cleanOutTime()
    {
        header('cleanTemp:'.(filemtime($this->Timestamp)+$this->_array_config['cache_time']));

        if(file_exists($this->Timestamp) && (time() - @filemtime($this->Timestamp)) > $this->_array_config['cache_time']){
            $file = glob($this->_array_config['cache_dir'] . '*' . $this->_array_config['suffix_cache']);
            foreach ((array)$file as $v) {
                // 删除文件
                $time_flag = (time() - @filemtime($v)) > $this->_array_config['cache_time'] ? true : false;
                if($time_flag){
                    unlink($v);
                }
            }
            file_put_contents($this->_array_config['cache_dir'].'/Time.stamp',time());
        }
    }
}