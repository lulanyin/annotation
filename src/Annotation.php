<?php
namespace Inphp\Annotation;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Inphp\Annotation\Processor\After;

class Annotation{

    /**
     * 处理
     * @param $class
     * @param string|null $method
     * @return mixed|null
     */
    public static function process($class, string $method = null)
    {
        $afterProcessors = AnnotationProcessor::init($class, $method)->parse();
        if(!is_null($method)){
            $result = $class->{$method}();
        }else{
            $result = null;
        }
        if(!empty($afterProcessors)){
            foreach ($afterProcessors as $processor){
                if($processor instanceof After){
                    $processor->setResult($result)->process($class, $method, 'method');
                    $result = $processor->getResult();
                }else{
                    $processor->process($class, $method, 'method');
                }
            }
        }
        return $result;
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