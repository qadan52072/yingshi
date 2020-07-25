<?php

class CompileClass
{
    private $template;      // 待编译文件
    private $content;       // 需要替换的文本
    private $compile_file;       // 编译后的文件
    private $left         = '{';       // 左定界符
    private $right        = '}';      // 右定界符
    private $include_file = [];        // 引入的文件
    private $config;        // 模板的配置文件
    private $subjects     = [];     // 需要替换的表达式
    private $replaces     = [];     // 替换后的字符串
    private $vars         = [];

    public function __construct($template, $compile_file, $config)
    {
        $this->template     = $template;
        $this->compile_file = $compile_file;
        $this->content      = file_get_contents($template);
        $this->config       = $config;

        if ($this->config['php_turn'] === false) {
            $this->subjects[] = "/<\?(=|php|)(.+?)\?>/is";
            $this->replaces[] = "&lt;?\\1\\2?&gt;";
        }
        require 'smTag.php';
        // 需要替换的正则表达式
        $this->subjects[] = "/$this->left\s*\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\xf7-\xff\\[\\]\\$\\+\\*\\/\\(\\)]*)\s*$this->right/";
        $this->subjects[] = "/$this->left\s*(loop|foreach)\s*\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\xf7-\xff\\[\\]\\$]*)\s*$this->right/";
        $this->subjects[] = "/$this->left\s*(loop|foreach)\s*\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\xf7-\xff\\[\\]\\$]*)\s+"
            . "as\s+\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\xf7-\xff]*)$this->right/";
        $this->subjects[] = "/$this->left\s*\/(loop|foreach|if)\s*$this->right/";
        $this->subjects[] = "/$this->left\s*if(.*?)\s*$this->right/";
        $this->subjects[] = "/$this->left\s*(else if|elseif)(.*?)\s*$this->right/";
        $this->subjects[] = "/$this->left\s*else\s*$this->right/";
        $this->subjects[] = "/$this->left\s*([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\xf7-\xff\\[\\]\\$\\+\\*\\/\\(\\)]*)\s*$this->right/";


        // 替换后的字符串         
        $this->replaces[] = "<?php echo \$\\1; ?>";
        $this->replaces[] = "<?php foreach((array)\$\\2 as \$K=>\$V) { ?>";
        $this->replaces[] = "<?php foreach((array)\$\\2 as &\$\\3) { ?>";
        $this->replaces[] = "<?php } ?>";
        $this->replaces[] = "<?php if(\\1) { ?>";
        $this->replaces[] = "<?php } elseif(\\2) { ?>";
        $this->replaces[] = "<?php } else { ?>";
        $this->replaces[] = "<?php echo \$\\1; ?>";

    }

    public function compile()
    {
        $this->compileInclude();
        $this->compileVar();
        $this->compileStaticFile();
        file_put_contents($this->compile_file, $this->content);
    }

    // 处理include
    public function compileInclude()
    {
        $include_pattern = "/$this->left\s*include\s+file=\"([\\/\w\.]*)\"\s*$this->right/";
        preg_match_all($include_pattern, $this->content, $results, PREG_SET_ORDER);
        foreach ($results as &$result) {
            $include_file  = $this->config['template_dir'] . $result[1];
            $this->content = preg_replace($include_pattern, file_get_contents($include_file), $this->content, 1);
        }
    }

    // 处理各种赋值和基本语句
    public function compileVar()
    {
        $this->content = preg_replace($this->subjects, $this->replaces, $this->content);
    }

    // 对静态的JavaScript进行解析    
    public function compileStaticFile()
    {
        $this->content = preg_replace("/$this->left\s*\!(.*?)\!$this->right/",
            '<script src="\\1' . '?t=' . time() . '"></script>', $this->content);
    }

    public function __set($name, $value)
    {
        $this->vars[$name] = $value;
    }

    public function __get($name)
    {
        if (isset($this->vars[$name])) {
            return $this->vars[$name];
        } else {
            return false;
        }
    }
}