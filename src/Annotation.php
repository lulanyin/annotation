<?php
namespace Inphp\Annotation;

use Doctrine\Common\Annotations\AnnotationRegistry;

class Annotation{

    /**
     * 处理
     * @param $class
     * @param string|null $method
     * @return void
     */
    public static function process($class, string $method = null)
    {
        AnnotationProcessor::init($class, $method)->parse();
    }

    /**
     * 注解实现初始化
     */
    public static function start(){
        AnnotationRegistry::registerLoader(function ($class){
            return class_exists($class) || interface_exists($class);
        });
    }
    public static function init(){
        self::start();
    }
}